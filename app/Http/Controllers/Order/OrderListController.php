<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\PurchasedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class OrderListController extends Controller
{
    public function listItemOrder()
    {
        return view('dashboard.orders.item-index');
    }

    public function listItemOrderTable()
    {
        $itemOrders = PurchasedItem::with(['user:id,username', 'item:id,product_id,name,icon,option'])
                    ->latest()
                    ->get();
        return DataTables::of($itemOrders)
            ->editColumn('price', function ($purchasedItem) {
                return '<div class="d-flex align-items-center">
                            '.$purchasedItem->price.'
                            <img src="'.asset('assets/media/gem-coin.png').'" alt="gem" class="ml-1">
                        </div>';
            })
            ->editColumn('icon', function ($purchasedItem) {
                return '<span data-theme="dark" data-html="true"
                               data-toggle="tooltip" data-placement="bottom" title="'.html_entity_decode($purchasedItem->item->option).'">
                            <img src="'.$purchasedItem->item->itemIcon.'" alt="icon" width="30px">
                        </span>';
            })
            ->editColumn('order_date', function ($purchasedItem) {
                return $purchasedItem->created_at->format('d F Y, H:i');
            })
            ->rawColumns(['price', 'icon'])
            ->make();
    }

    public function listGemsOrder()
    {
        return view('dashboard.orders.gems-index');
    }

    public function listGemsOrderTable()
    {
        $purchases = Order::with(['gem:id,title','user:id,username'])
            ->latest()
            ->get();
        return DataTables::of($purchases)
            ->editColumn('invoice', function ($purchase) {
                return '<a class="text-decoration-none text-dark" title="'.$purchase->invoice.'">'.Str::limit($purchase->invoice, 20, '...').'</a>';
            })
            ->editColumn('price', function ($purchase) {
                return 'Rp. '.rupiah_format($purchase->total_price).',-';
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
}
