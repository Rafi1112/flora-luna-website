<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Item;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('product:id,name,slug')
                ->latest()
                ->paginate(16);
        return view('dashboard.product.item.index', compact('items'));
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

        return redirect()->route('item.index')->with("success", "Item has been updated.");
    }

    public function destroy(Item $item)
    {
        Storage::delete($item->icon);
        $item->delete();
        return redirect()->back()->with("success", "Item has been deleted.");
    }

    public function assignItemIcon($icon, $slug)
    {
        $iconExt = $icon->getClientOriginalExtension();
        $iconName = "item-" . $slug . "-" . Str::random(6) . ".$iconExt";
        return Storage::putFileAs('icon/item', $icon, $iconName);
    }
}
