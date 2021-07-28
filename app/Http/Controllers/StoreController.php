<?php

namespace App\Http\Controllers;

use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        return view('store.index', compact('categories'));
    }
}
