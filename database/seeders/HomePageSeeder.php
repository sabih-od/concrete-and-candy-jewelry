<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CMSPages::where('name', 'Home')->delete();
        $content = [
            'name' => 'Home',
            'slug' => 'home',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'background_banner_image' => 'images/mainBnnr.jpg',
            'mouse_image' => 'images/mouse.png',
            'story_image' => 'images/story1.jpg',
            'story_image2' => 'images/story2.jpg',
            'content' => json_encode([
                'banner_title' => "Handmade 100% Stainless Steel Contemporary jewelry ",
                'banner_modern_bottom' => "modern",
                'banner_btn' => "Shop Now",
                'story_sec_heading' => "Story",
                'story_sec_desc' => "Most importantly, Concrete and Candy set out to create an environmentally sustainable
                                alternative to both high priced precious metals and lower quality metals prevalent in
                                most costume jewelry. (Fact : stainless steel is endlessly recyclable !) Concrete and
                                Candy also uses stainless steel only, because it is hypo allergenic , non reactive to
                                skin and can be worn by many with sensitive skin.",
                'fresh_sec_heading' => "Fresh Designs",
                'arrivals_sec_heading' => "New Arrivals",
                'most_love_sec_heading' => "Most Loved",

            ])
        ];

        $homeData = collect($content)->except(
            'background_banner_image',
            'mouse_image',
            'story_image',
            'story_image2'

        )->all();

        $page = CMSPages::create($homeData);

        $page->clearMediaCollection('background_banner_image');
        $page->clearMediaCollection('mouse_image');
        $page->clearMediaCollection('story_image');
        $page->clearMediaCollection('story_image2');


        $banner_image1 = public_path($content['background_banner_image']);
        if (file_exists($banner_image1)) $page->copyMedia($banner_image1)->toMediaCollection('background_banner_image');

        $background_banner_image = public_path($content['mouse_image']);
        if (file_exists($background_banner_image)) $page->copyMedia($background_banner_image)->toMediaCollection('mouse_image');

        $banner_image2 = public_path($content['story_image']);
        if (file_exists($banner_image2)) $page->copyMedia($banner_image2)->toMediaCollection('story_image');

        $weekly_sale_image = public_path($content['story_image2']);
        if (file_exists($weekly_sale_image)) $page->copyMedia($weekly_sale_image)->toMediaCollection('story_image2');


    }
}
