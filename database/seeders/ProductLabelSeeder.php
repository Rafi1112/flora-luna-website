<?php

namespace Database\Seeders;

use App\Models\Product\ProductLabel;
use Illuminate\Database\Seeder;

class ProductLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productLabels = [
            ['name' => 'HOT', 'slug' => 'hot', 'description' => 'Hot label image description.'],
            ['name' => 'NEW', 'slug' => 'new', 'description' => 'New label image description.'],
            ['name' => 'SALE', 'slug' => 'sale', 'description' => 'Sale label image description.']
        ];

        foreach ($productLabels as $label) {
            ProductLabel::create($label);
        }
    }
}
