<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $category = new ProductCategory();
        return view('dashboard.product.category.index', compact('categories', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_url' => 'required',
            'category_description' => 'required',
            'category_position' => 'required|integer|min:1',
            'category_icon' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $slug = Str::slug($request->category_name);
        $icon = $request->file('category_icon');
        $iconPath = $this->assignIconCategory($icon, $slug);

        ProductCategory::create([
            'name' => $request->category_name,
            'slug' => $slug,
            'url' => $request->category_url,
            'description' => $request->category_description,
            'icon' => $iconPath,
            'position' => $request->category_position
        ]);

        return redirect()->back()->with("success", "New product category has been created.");
    }

    public function edit(ProductCategory $category)
    {
        return view('dashboard.product.category.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'category_name' => 'required',
            'category_url' => 'required',
            'category_description' => 'required',
            'category_position' => 'required|integer|min:1',
            'category_icon' => 'image|mimes:png,jpg,jpeg',
        ]);

        $icon = $request->file('category_icon');

        if ( $icon ) {
            $slug = $category->slug;
            Storage::delete($category->icon);
            $iconPath = $this->assignIconCategory($icon, $slug);
        } else {
            $iconPath = $category->icon;
        }

        $category->update([
            'name' => $request->category_name,
            'url' => $request->category_url,
            'description' => $request->category_description,
            'icon' => $iconPath,
            'position' => $request->category_position
        ]);

        return redirect()->route('product.category.index')->with("success", "Product category has been updated.");
    }

    public function destroy(ProductCategory $category)
    {
        Storage::delete($category->icon);
        $category->delete();
        return redirect()->back()->with("success", "Product category has been deleted.");
    }

    public function assignIconCategory($icon, $slug)
    {
        $iconExtensions = $icon->getClientOriginalExtension();
        $iconName = time() . "-icon-" . $slug . ".$iconExtensions";
        $path = Storage::putFileAs('icon/category', $icon, $iconName);
        return $path;
    }
}
