<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CMSPages::where('name', 'Footer')->delete();
        $content = [
            'name' => 'Footer',
            'slug' => 'footer',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'social_media_pic1' => 'images/insta1.jpg',
            'social_media_pic2' => 'images/insta2.jpg',
            'social_media_pic3' => 'images/insta3.jpg',
            'social_media_pic4' => 'images/insta4.jpg',
            'content' => json_encode([
                'footer_heading' => "On Instagaram",
                'footer_sub_heading' => "Sign up for updates and offerings",
                'footer_description' => "What' s inside? Exclusive sales, new arrivals & much more.",
                'footer_button' => "Subscribe",

            ])
        ];

        $footerData = collect($content)->except(
            'social_media_pic1',
            'social_media_pic2',
            'social_media_pic3',
            'social_media_pic4',
        )->all();
        $page = CMSPages::create($footerData);

        $page->clearMediaCollection('social_media_pic1');
        $page->clearMediaCollection('social_media_pic2');
        $page->clearMediaCollection('social_media_pic3');
        $page->clearMediaCollection('social_media_pic4');

        $social_media_pic1 = public_path($content['social_media_pic1']);
        if (file_exists($social_media_pic1)) $page->copyMedia($social_media_pic1)->toMediaCollection('social_media_pic1');

        $social_media_pic2 = public_path($content['social_media_pic2']);
        if (file_exists($social_media_pic2)) $page->copyMedia($social_media_pic2)->toMediaCollection('social_media_pic2');

        $social_media_pic3 = public_path($content['social_media_pic3']);
        if (file_exists($social_media_pic3)) $page->copyMedia($social_media_pic3)->toMediaCollection('social_media_pic3');

        $social_media_pic4 = public_path($content['social_media_pic4']);
        if (file_exists($social_media_pic4)) $page->copyMedia($social_media_pic4)->toMediaCollection('social_media_pic4');

    }
}
