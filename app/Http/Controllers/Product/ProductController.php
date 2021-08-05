<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['label:id,image', 'category:id,name,slug,url,icon'])
            ->latest()
            ->paginate(16);
        return view('dashboard.product.product.index', compact('products'));
    }

    public function create()
    {
        $product = new Product();
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $labels = ProductLabel::get();
        return view('dashboard.product.product.create', compact('product', 'categories', 'labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:25',
            'product_category' => 'required',
            'product_label'=> 'required',
            'product_price' => 'required|integer|min:1',
            'product_description' => 'required|max:255',
            'product_half_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'product_full_image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $slug = Str::slug($request->product_name);
        $productCategory = ProductCategory::findOrFail($request->product_category);
        $productLabel = ProductLabel::find($request->product_label);
        $option = $request->product_option ? $this->storeOptionItem($request->product_option) : null;

        $halfImage = $request->file('product_half_image');
        $fullImage = $request->file('product_full_image');
        $pathHalfImage = $this->assignImage("half-", $halfImage, $slug);
        $pathFullImage = $this->assignImage("full-", $fullImage, $slug);

        Product::create([
            'product_category_id' => $productCategory->id,
            'product_label_id' => $productLabel->id ?? null,
            'name' => $request->product_name,
            'slug' => $slug,
            'price' => $request->product_price,
            'description' => $request->product_description,
            'option' => $option,
            'half_image' => $pathHalfImage,
            'full_image' => $pathFullImage,
            'is_featured' => $request->is_featured ? 1 : 0,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        return redirect()->back()->with("success", "New Product has been created.");
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $labels = ProductLabel::get();
        return view('dashboard.product.product.edit', compact('product', 'categories', 'labels'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|max:25',
            'product_category' => 'required',
            'product_label'=> 'required',
            'product_price' => 'required|integer|min:1',
            'product_description' => 'required|max:255',
            'product_half_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'product_full_image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $slug = Str::slug($request->product_name);
        $productCategory = ProductCategory::findOrFail($request->product_category);
        $productLabel = ProductLabel::find($request->product_label);
        $option = $request->product_option ? $this->storeOptionItem($request->product_option) : null;

        $halfImage = $request->file('product_half_image');
        $fullImage = $request->file('product_full_image');
        if ($halfImage) {
            Storage::delete($product->half_image);
            $pathHalfImage = $this->assignImage("half-", $halfImage, $slug);
            $pathFullImage = $product->full_image;
        } else if ($fullImage) {
            Storage::delete($product->full_image);
            $pathFullImage = $this->assignImage("full-", $fullImage, $slug);
            $pathHalfImage = $product->half_image;
        } else {
            $pathHalfImage = $product->half_image;
            $pathFullImage = $product->full_image;
        }

        $product->update([
            'product_category_id' => $productCategory->id,
            'product_label_id' => $productLabel->id ?? null,
            'name' => $request->product_name,
            'slug' => $slug,
            'price' => $request->product_price,
            'description' => $request->product_description,
            'option' => $option,
            'half_image' => $pathHalfImage,
            'full_image' => $pathFullImage,
            'is_featured' => $request->is_featured ? 1 : 0,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        return redirect()->route('product.index')->with("success", "Product {$product->name} has been updated.");
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->half_image);
        Storage::delete($product->full_image);
        $product->delete();
        return redirect()->back()->with("success", "Product has been deleted.");
    }

    public function assignImage($type, $image, $slug)
    {
        $imageExt = $image->getClientOriginalExtension();
        $imageName = $type . $slug . "-" . Str::random(6) . ".$imageExt";
        return Storage::putFileAs('icon/product', $image, $imageName);
    }

    public function storeOptionItem($content)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        return $dom->saveHTML();
    }
}
