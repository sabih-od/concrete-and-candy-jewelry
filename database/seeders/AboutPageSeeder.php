<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CMSPages::where('name', 'About')->delete();
        $content = [
            'name' => 'About',
            'slug' => 'about',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'background_banner_image' => 'images/innerBg.jpg',
            'story_image' => 'images/story1.jpg',
            'story_image2' => 'images/story2.jpg',
            'mission_right_image' => 'images/missionImg.jpg',
            'mission_image1' => 'images/mission1.jpg',
            'mission_image2' => 'images/mission2.jpg',
            'mission_image3' => 'images/mission3.jpg',
            'content' => json_encode([
                'about_banner_title' => "About us",
                'story_sec_heading' => "Story",
                'story_sec_desc' => "Most importantly, Concrete and Candy set out to create an environmentally sustainable
                                alternative to both high priced precious metals and lower quality metals prevalent in
                                most costume jewelry. (Fact : stainless steel is endlessly recyclable !) Concrete and
                                Candy also uses stainless steel only, because it is hypo allergenic , non reactive to
                                skin and can be worn by many with sensitive skin.",

                'mission_sec_heading' => "Our Mission",
                'mission_sec_para1' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para2' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para3' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para4' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para5' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para6' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",

                'mission_sec_para7' => "Concrete and Candy offers handmade 100 % stainless steel contemporary jewelry .
                 It was created by a visual artist , a former theatrical prop builder. It was born from the love of fashion,
                 music and minimalist streamlined urban sensibilities, sprinkled with a touch of playfulness.",


            ])
        ];

        $aboutData = collect($content)->except(
            'background_banner_image',
            'story_image',
            'story_image2',
            'mission_right_image',
            'mission_image1',
            'mission_image2',
            'mission_image3'
        )->all();
        $page = CMSPages::create($aboutData);

        $page->clearMediaCollection('background_banner_image');
        $page->clearMediaCollection('story_image');
        $page->clearMediaCollection('story_image2');
        $page->clearMediaCollection('mission_right_image');
        $page->clearMediaCollection('mission_image1');
        $page->clearMediaCollection('mission_image2');
        $page->clearMediaCollection('mission_image3');

        $background_banner_image = public_path($content['background_banner_image']);
        if (file_exists($background_banner_image)) $page->copyMedia($background_banner_image)->toMediaCollection('background_banner_image');

        $about_right_image = public_path($content['story_image']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('story_image');

        $about_right_image = public_path($content['story_image2']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('story_image2');

        $about_right_image = public_path($content['mission_right_image']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('mission_right_image');

        $about_right_image = public_path($content['mission_image1']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('mission_image1');

        $about_right_image = public_path($content['mission_image2']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('mission_image2');

        $about_right_image = public_path($content['mission_image3']);
        if (file_exists($about_right_image)) $page->copyMedia($about_right_image)->toMediaCollection('mission_image3');
    }
}
