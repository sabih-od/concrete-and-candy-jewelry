<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Earrings', 'slug' => 'earrings'],
            ['name' => 'Rings', 'slug' => 'rings'],
            ['name' => 'Necklace', 'slug' => 'necklace'],
            ['name' => 'Bracelets', 'slug' => 'bracelets'],
        ];

        foreach ($categories as $categoryData) {
            $newCategory = Category::updateOrCreate([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
            ]);

        }
    }
}
