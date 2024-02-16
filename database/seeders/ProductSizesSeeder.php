<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizeNames = ['S', 'M', 'L', 'XL', 'XXL'];

        foreach ($sizeNames as $sizeName) {
            ProductSize::create([
                'name' => $sizeName,
            ]);
        }
    }
}
