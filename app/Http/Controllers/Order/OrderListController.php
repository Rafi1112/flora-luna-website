<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\PurchasedItem;
use Illuminate\Http\Request;
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
}
