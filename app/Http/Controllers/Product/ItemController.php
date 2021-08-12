<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Item;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('product:id,name,slug')
                ->latest()
                ->paginate(16);
        return view('dashboard.product.item.index', compact('items'));
    }

    public function table()
    {
        $items = Item::with('product:id,name,slug')
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
                               data-toggle="tooltip" data-placement="bottom" title="'.html_entity_decode($item->option).'">
                            <img src="'.$item->itemIcon.'" alt="icon" width="30px">
                        </span>';
            })
            ->editColumn('action', function ($item) {
                $editItemUrl = route('item.edit', $item);
                $deleteItemUrl = route('item.delete', $item);
                return '
                     <div class="row">
                        <a href="'.$editItemUrl.'" class="btn btn-sm btn-clean btn-icon" title="Edit Item">
                            <i class="la la-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-clean btn-icon btn-delete"
                             data-remote="'.$deleteItemUrl.'" data-name="'.$item->name.'"
                             title="Delete">
                            <i class="la la-trash"></i>
                        </button>
                     </div>
                    ';
            })
            ->rawColumns(['price', 'icon' , 'action'])
            ->make();
    }

    public function create()
    {
        $products = Product::latest()->get();
        $item = new Item();
        return view('dashboard.product.item.create', compact('products', 'item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_parent' => 'required',
            'item_name' => 'required|max:25',
            'item_stock' => 'required|integer|min:1',
            'item_price' => 'required|integer|min:1',
            'item_description' => 'max:255',
            'item_option' => 'max:255',
            'item_icon' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $productParent = Product::findOrFail($request->product_parent);
        $slug = Str::slug($request->item_name);
        $icon = $request->file('item_icon');
        $iconPath = $this->assignItemIcon($icon, $slug);

        Item::create([
            'product_id' => $productParent->id,
            'name' => $request->item_name,
            'slug' => $slug,
            'stock' => $request->item_stock,
            'price' => $request->item_price,
            'description' => $request->item_description,
            'option' => $request->item_option,
            'icon' => $iconPath,
            'is_limited' => $request->is_limited ? 1 : 0,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        return redirect()->back()->with("success", "Success added item to $productParent->name");
    }

    public function edit(Item $item)
    {
        $products = Product::latest()->get();
        return view('dashboard.product.item.edit', compact('item', 'products'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'product_parent' => 'required',
            'item_name' => 'required|max:25',
            'item_stock' => 'required|integer|min:1',
            'item_price' => 'required|integer|min:1',
            'item_description' => 'max:255',
            'item_option' => 'max:255',
            'item_icon' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $productParent = Product::findOrFail($request->product_parent);
        $slug = Str::slug($request->item_name);
        $icon = $request->file('item_icon');
        if ($icon) {
            Storage::delete($item->icon);
            $iconPath = $this->assignItemIcon($icon, $slug);
        } else {
            $iconPath = $item->icon;
        }

        $item->update([
            'product_id' => $productParent->id,
            'name' => $request->item_name,
            'slug' => $slug,
            'stock' => $request->item_stock,
            'price' => $request->item_price,
            'description' => $request->item_description,
            'option' => $request->item_option,
            'icon' => $iconPath,
            'is_limited' => $request->is_limited ? 1 : 0,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        return back()->with("success", "Item has been updated.");
    }

    public function destroy(Item $item)
    {
        Storage::delete($item->icon);
        $item->delete();
        return redirect()->back()->with("success", "Item has been deleted.");
    }

    public function addProductItem(Product $product)
    {
        return view('dashboard.product.product.add-item', compact('product'));
    }

    public function storeProductItem(Request $request, Product $product)
    {
        $request->validate([
            'item_name' => 'required|max:25',
            'item_stock' => 'required|integer|min:1',
            'item_price' => 'required|integer|min:1',
            'item_description' => 'max:255',
            'item_option' => 'max:255',
            'item_icon' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $slug = Str::slug($request->item_name);
        $icon = $request->file('item_icon');
        $iconPath = $this->assignItemIcon($icon, $slug);

        $product->items()->create([
            'name' => $request->item_name,
            'slug' => $slug,
            'stock' => $request->item_stock,
            'price' => $request->item_price,
            'description' => $request->item_description,
            'option' => $request->item_option,
            'icon' => $iconPath,
            'is_limited' => $request->is_limited ? 1 : 0,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        return redirect()->back()->with("success", "Success added item to $product->name");
    }

    public function assignItemIcon($icon, $slug)
    {
        $iconExt = $icon->getClientOriginalExtension();
        $iconName = "item-" . $slug . "-" . Str::random(6) . ".$iconExt";
        return Storage::putFileAs('icon/item', $icon, $iconName);
    }
}
