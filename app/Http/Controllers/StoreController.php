<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $products = Product::with('label:id,image')
                    ->where(['is_featured' => 1, 'is_published' => 1])
                    ->orderBy('created_at', 'ASC')
                    ->paginate(16);
//        return response()->json($products);
        return view('store.index', compact('categories', 'products'));
    }

    public function showByCategory(ProductCategory $category)
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $products = Product::with('label:id,image')
                    ->where(['product_category_id' => $category->id, 'is_published' => 1])
                    ->orderBy('created_at', 'ASC')
                    ->get();
        return response()->json($products);
    }
}
