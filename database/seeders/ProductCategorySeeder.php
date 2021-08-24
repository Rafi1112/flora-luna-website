<?php

namespace Database\Seeders;

use App\Models\Product\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategories = [
            ['name' => 'Consumables', 'slug' => 'consumables', 'url' => 'consume', 'description' => 'Consumables Product Category', 'position' => 2],
            ['name' => 'Equipment', 'slug' => 'equipment', 'url' => 'equip', 'description' => 'Equipment Product Category', 'position' => 3],
            ['name' => 'Costumes', 'slug' => 'costumes', 'url' => 'costume', 'description' => 'Costumes Product Description', 'position' => 4],
            ['name' => 'Accessories', 'slug' => 'accessories', 'url' => 'accessories', 'description' => 'Accessories Product Category', 'position' => 5],
            ['name' => 'Back Gear', 'slug' => 'back-gear', 'url' => 'back', 'description' => 'Back Gear Product Category', 'position' => 6],
            ['name' => 'Pets', 'slug' => 'pets', 'url' => 'pet', 'description' => 'Pet Product Category', 'position' => 7],
        ];

        foreach ($productCategories as $category) {
            ProductCategory::create($category);
        }
    }
}
