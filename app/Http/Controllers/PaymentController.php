<?php

namespace App\Http\Controllers;

use App\Models\Midtrans\MidtransPaymentResponse;
use App\Models\Order\Gems;
use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\CoreApi;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $gems = Gems::orderBy('price', 'ASC')->get();
        return view('payment.index', compact('gems'));
    }

    public function payment(Request $request)
    {
        $request->validate([
            'gem' => 'required',
            'payment_method' => 'required'
        ]);

        $gems = Gems::findOrFail($request->gem);
        $payment_method = $request->payment_method;
        if (!($payment_method == "bca" || $payment_method == "bri" || $payment_method == "bni"))
            return back()->with("error", "Cannot find the payment method.");

        DB::transaction(function () use ($gems, $payment_method){
            $invoice = 'INV-GEMS-' . Carbon::now()->format('Ymd') . '-' . rand(100000, 999999);
            $price_gems = $gems->is_discount ? discount_price($gems->price, $gems->discount_amount) : $gems->price;

            $order = Auth::user()->orders()->create([
                'gems_id' => $gems->id,
                'invoice' => $invoice,
                'total_price' => $price_gems,
            ]);

            $payloads = [
                "payment_type" => "bank_transfer",
                "transaction_details" => [
                    'order_id' => $invoice,
                    'gross_amount' => $price_gems
                ],
                "customer_details" => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ],
                "item_details" => [
                    [
                        'id' => $gems->id,
                        'price' => $price_gems,
                        'quantity' => 1,
                        'name' => $gems->title
                    ]
                ],
                "bank_transfer" => [
                    "bank" => $payment_method,
                    "va_number" => ""
                ]
            ];
            $responseMidtrans = CoreApi::charge($payloads);
            $response = json_decode(json_encode($responseMidtrans));
            self::updateOrderTable($order, $response);
            self::midtransPaymentResponse($response);
            $this->response['invoice'] = $invoice;
        });

        return redirect()->route('invoice', $this->response['invoice'])
            ->with("success", "Success. Payment has been created.");
    }

    public function notificationHandler()
    {
        $notification = new Notification();
        DB::transaction(function () use ($notification) {
            $transaction = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $invoice = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('invoice', $invoice)->first();
            $amountGems = $order->gem->gems_amount;
            $user = $order->user;
            self::midtransPaymentResponse($notification);

            if ($transaction == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $order->setStatusPending();
                    } else {
                        $user->rechargeUserBalance($amountGems);
                        Log::info($user->username .'balance has been recharge by system.'.$amountGems.' gems. Order Success');
                        $order->setStatusSuccess();
                    }
                }
            } else if ($transaction == 'settlement') {
                $user->rechargeUserBalance($amountGems);
                Log::info($user->username .' balance has been recharge by system.'.$amountGems.' gems. Order Success');
                $order->setStatusSuccess();
            } else if ($transaction == 'pending') {
                $order->setStatusPending();
            } else if ($transaction == 'deny') {
                $order->setStatusFailed();
            } else if ($transaction == 'expire') {
                $order->setStatusExpired();
            } else if ($transaction == 'cancel') {
                $order->setStatusFailed();
            }
        });
    }

    static function updateOrderTable($order, $response){
        $order->payment_type = $response->payment_type;
        $order->bank_name = $response->va_numbers[0]->bank;
        $order->va_number = $response->va_numbers[0]->va_number;
        $order->transaction_time = $response->transaction_time;
        return $order->save();
    }

    static function midtransPaymentResponse($response) {
        return MidtransPaymentResponse::updateOrCreate(
            [
                'order_id' => $response->order_id,
            ],
            [
            'va_number' => $response->va_numbers[0]->va_number,
            'bank' => $response->va_numbers[0]->bank,
            'transaction_time' => $response->transaction_time,
            'transaction_status' => $response->transaction_status,
            'transaction_id' => $response->transaction_id,
            'status_message' => $response->status_message,
            'status_code' => $response->status_code,
            'signature_key' => $response->signature_key ?? null,
            'settlement_time' => $response->settlement_time ?? null,
            'payment_type' => $response->payment_type,
            'payment_amounts' => $response->payment_amounts ?? null,
            'paid_at' => $response->payment_amounts[0]->paid_at ?? null,
            'amount' => $response->payment_amounts[0]->amount ?? null,
            'merchant_id' => $response->merchant_id,
            'gross_amount' => $response->gross_amount,
            'fraud_status' => $response->fraud_status,
            'currency' => $response->currency
        ]);
    }

}
