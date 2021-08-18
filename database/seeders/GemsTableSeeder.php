<?php

namespace Database\Seeders;

use App\Models\Order\Gems;
use Illuminate\Database\Seeder;

class GemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gems = [
            [
                'title' => '20 Gems Box',
                'gems_amount' => 20,
                'price' => 20000,
                'description' => 'Contains 20 Gems',
            ],
            [
                'title' => '30 Gems Box',
                'gems_amount' => 30,
                'price' => 30000,
                'description' => 'Contains 30 Gems',
            ],
            [
                'title' => '40 Gems Box',
                'gems_amount' => 40,
                'price' => 40000,
                'description' => 'Contains 40 Gems',
            ],
            [
                'title' => '50 Gems Box',
                'gems_amount' => 50,
                'price' => 50000,
                'description' => 'Contains 50 Gems',
            ],
            [
                'title' => '105 Gems Box',
                'gems_amount' => 105,
                'price' => 100000,
                'description' => 'Contains 105 Gems',
            ],
            [
                'title' => '220 Gems Box',
                'gems_amount' => 220,
                'price' => 200000,
                'description' => 'Contains 220 Gems',
            ],
            [
                'title' => '340 Gems Box',
                'gems_amount' => 340,
                'price' => 300000,
                'description' => 'Contains 340 Gems',
            ],
            [
                'title' => '580 Gems Box',
                'gems_amount' => 580,
                'price' => 500000,
                'description' => 'Contains 580 Gems',
            ],
            [
                'title' => '1200 Gems Box',
                'gems_amount' => 1200,
                'price' => 1000000,
                'description' => 'Contains 1200 Gems',
            ],
            [
                'title' => '2400 Gems Box',
                'gems_amount' => 2400,
                'price' => 2000000,
                'description' => 'Contains 2400 Gems',
            ],
            [
                'title' => '3800 Gems Box',
                'gems_amount' => 3800,
                'price' => 3000000,
                'description' => 'Contains 3800 Gems',
            ],
            [
                'title' => '6500 Gems Box',
                'gems_amount' => 6500,
                'price' => 5000000,
                'description' => 'Contains 6500 Gems',
            ],
        ];

        foreach ($gems as $gem) {
            Gems::create($gem);
        }
    }
}
