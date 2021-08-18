<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductLabelRequest;
use App\Models\Product\ProductLabel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductLabelController extends Controller
{
    public function index()
    {
        $labels = ProductLabel::get();
        $label = new ProductLabel();
        return view('dashboard.product.label.index', compact('labels', 'label'));
    }

    public function store(ProductLabelRequest $request)
    {
        $slug = Str::slug($request->label_name);
        $image = $request->file('label_image');
        $pathImage = $this->assignImageLabel($image, $slug);

        ProductLabel::create([
            'name' => $request->label_name,
            'slug' => $slug,
            'description' => $request->label_description,
            'image' => $pathImage
        ]);

        return redirect()->back()->with("success", "Product label has been created.");
    }

    public function edit(ProductLabel $label)
    {
        return view('dashboard.product.label.edit', compact('label'));
    }

    public function update(ProductLabelRequest $request, ProductLabel $label)
    {
        $image = $request->file('label_image');
        if ($image) {
            $slug = $label->slug;
            Storage::delete($label->image);
            $pathImage = $this->assignImageLabel($image, $slug);
        } else {
            $pathImage = $label->image;
        }

        $label->update([
            'name' => $request->label_name,
            'description' => $request->label_description,
            'image' => $pathImage,
        ]);

        return redirect()->route('label.index')->with("success", "Product Label has been updated.");
    }

    public function destroy(ProductLabel $label)
    {
        if ($label->products()->exists()) {
            return redirect()->back()->with("error", "The action is denied. The label has relation to products.");
        } else {
            Storage::delete($label->image);
            $label->delete();
            return redirect()->back()->with("success", "Product Label has been deleted.");
        }
    }

    public function assignImageLabel($image, $slug)
    {
        $imageExt = $image->getClientOriginalExtension();
        $imageName = "label-" . $slug . "-" . time() . ".$imageExt";
        $path = Storage::putFileAs('icon/label', $image, $imageName);
        return $path;
    }
}
