<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\PurchasedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class HistoryController extends Controller
{
    public function itemHistory()
    {
        return view('account.histories.item-index');
    }

    public function itemHistoryTable()
    {
        $items = PurchasedItem::where('user_id', Auth::user()->id)
                ->with('item:id,name,icon')
                ->latest()
                ->get();
        return DataTables::of($items)
            ->editColumn('price', function ($item) {
                return '<div class="d-flex align-items-center">
                            '.$item->price.'
                            <img src="'.asset('assets/media/gem-coin.png').'" alt="gem" class="ml-1">
                        </div>';
            })
            ->editColumn('icon', function ($item) {
                return '<span data-theme="dark" data-html="true"
                               data-toggle="tooltip" data-placement="bottom" title="'.html_entity_decode($item->item->option).'">
                            <img src="'.$item->item->itemIcon.'" alt="icon" width="30px">
                        </span>';
            })
            ->editColumn('order_date', function ($item) {
                return $item->created_at->format('d F Y, H:i');
            })
            ->rawColumns(['price', 'icon'])
            ->make();
    }

    public function purchaseHistory()
    {
        return view('account.histories.purchases-index');
    }

    public function purchaseHistoryTable()
    {
        $purchases = Order::where('user_id', Auth::user()->id)
                    ->with('gem:id,title')
                    ->latest()
                    ->get();
        return DataTables::of($purchases)
            ->editColumn('invoice', function ($purchase) {
                return '<a class="text-decoration-none text-dark" title="'.$purchase->invoice.'">'.Str::limit($purchase->invoice, 20, '...').'</a>';
            })
            ->editColumn('price', function ($purchase) {
                return 'Rp. '.rupiah_format($purchase->total_price).',-';
            })
            ->editColumn('payment_type', function ($purchase) {
                return Str::replace('_', ' ', Str::upper($purchase->payment_type));
            })
            ->editColumn('action', function ($purchase) {
                $detailInvoice = route('invoice', $purchase);
                return '<a href="'.$detailInvoice.'" class="btn btn-sm btn-light-primary btn-icon" title="Detail" target="_blank">
                            <i class="fas fa-eye"></i>
                        </a>';
            })
            ->rawColumns(['invoice', 'action'])
            ->make();
    }

    public function invoice(Order $order)
    {
        if (!($order->user_id == Auth::user()->id || Auth::user()->hasRole('Game Master'))) abort(404);
        return view('payment.invoice', compact('order'));
    }
}
