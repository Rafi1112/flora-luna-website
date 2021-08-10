<?php

namespace App\View\Components;

use App\Models\Product\ProductCategory;
use Illuminate\View\Component;

class StoreCategory extends Component
{
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product = null)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = ProductCategory::orderBy('position', 'ASC')->get();
        return view('components.store-category', compact('categories'));
    }
}
