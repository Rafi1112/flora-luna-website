<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductLabel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::count();
        return view('dashboard.product.product.index', compact('products'));
    }

    public function table()
    {
        $products = Product::with(['label:id,image', 'category:id,name'])
                    ->latest()
                    ->get();
        return DataTables::of($products)
            ->editColumn('price', function ($product) {
                return '<div class="d-flex align-items-center">
                            '.$product->price.'
                            <img src="'.asset('assets/media/gem-coin.png').'" alt="gem" class="ml-1">
                        </div>';
            })
            ->editColumn('label', function ($product) {
                if ($product->product_label_id){
                    return '<img src="'.$product->label->labelImage.'" width="30px">';
                } else {
                    return '<div class="label label-info label-sm label-inline font-weight-bold text-white">NULL</div>';
                }
            })
            ->editColumn('action', function ($product) {
                $editProductUrl = route('product.edit', $product);
                $deleteProductUrl = route('product.delete', $product);
                $detailProductUrl = route('product.detail', $product);
                $addProductItemUrl = route('add.product.item', $product);
                return '
                     <div class="row">
                        <div class="dropdown dropdown-inline">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                <i class="la la-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.$detailProductUrl.'"><i class="nav-icon far fa-eye"></i><span class="nav-text">Details</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="'.$addProductItemUrl.'"><i class="nav-icon fas fa-plus"></i><span class="nav-text">Add Items</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <a href="'.$editProductUrl.'" class="btn btn-sm btn-clean btn-icon" title="Edit Product">
                            <i class="la la-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-clean btn-icon btn-delete"
                             data-remote="'.$deleteProductUrl.'" data-name="'.$product->name.'"
                             title="Delete">
                            <i class="la la-trash"></i>
                        </button>
                     </div>
                    ';
            })
            ->rawColumns(['price', 'label', 'action'])
            ->make();
    }

    public function create()
    {
        $product = new Product();
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        $labels = ProductLabel::get();
        return view('dashboard.product.product.create', compact('product', 'categories', 'labels'));
    }

    public function store(ProductRequest $request)
    {
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

    public function update(ProductRequest $request, Product $product)
    {
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
        if ($product->items()->exists()) {
            return redirect()->back()->with("error", "The action is unauthorized. This product has related to items.");
        } else {
            Storage::delete($product->half_image);
            Storage::delete($product->full_image);
            $product->delete();
            return redirect()->back()->with("success", "Product has been deleted.");
        }
    }

    public function detail(Product $product)
    {
        return view('dashboard.product.product.detail', compact('product'));
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
