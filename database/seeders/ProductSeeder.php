<?php

namespace Database\Seeders;

use App\Models\Product\Item;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_category_id' => 4,
            'product_label_id' => 3,
            'name' => 'Product Dummy',
            'slug' => 'product-dummy',
            'price' => 150,
            'description' => 'Product Description Dummy',
            'option' => null,
            'half_image' => null,
            'full_image' => null,
            'is_featured' => 1,
            'is_published' => 1
        ]);

        Item::create([
            'product_id' => 1,
            'name' => 'Item Dummy',
            'slug' => 'item-dummy',
            'price' => 150,
            'stock' => 100,
            'description' => null,
            'option' => null,
            'icon' => null,
            'is_limited' => 0,
            'is_published' => 1
        ]);
    }
}
