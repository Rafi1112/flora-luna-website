<?php

namespace App\View\Components;

use App\Models\Product\Product;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $is_featured = Product::where(['is_published' => 1, 'is_featured' => 1])
                        ->latest()
                        ->limit(7)
                        ->get();
        return view('components.sidebar', compact('is_featured'));
    }
}
