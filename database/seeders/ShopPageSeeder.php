<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class ShopPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        CMSPages::where('name', 'Shop')->delete();
        $content = [
            'name' => 'Shop',
            'slug' => 'shop',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'background_banner_image' => 'images/innerBg.jpg',
            'content' => json_encode([
                'shop_banner_title' => "SHOP",
            ])
        ];

        $shopData = collect($content)->except(
            'background_banner_image',
        )->all();
        $page = CMSPages::create($shopData);

        $page->clearMediaCollection('background_banner_image');

        $background_banner_image = public_path($content['background_banner_image']);
        if (file_exists($background_banner_image)) $page->copyMedia($background_banner_image)->toMediaCollection('background_banner_image');
    }
}
