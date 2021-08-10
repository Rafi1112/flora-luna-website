<?php

namespace App\Http\Controllers;

use App\Models\Product\Item;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::with('label:id,image')
                    ->where(['is_featured' => 1, 'is_published' => 1])
                    ->orderBy('created_at', 'ASC')
                    ->paginate(16);
        return view('store.index', compact('products'));
    }

    public function showByCategory(ProductCategory $category)
    {
        $products = Product::with('label:id,image')
                    ->where(['product_category_id' => $category->id, 'is_published' => 1])
                    ->orderBy('created_at', 'ASC')
                    ->paginate(16);
        return view('store.category', compact('products'));
    }

    public function showProduct(Product $product)
    {
        $items = Item::where(['product_id' => $product->id, 'is_published' => 1])
                ->orderBy('created_at')
                ->get();
//        return response()->json($product->items()->exists());
        return view('store.view-detail', compact('product', 'items'));
    }
}
