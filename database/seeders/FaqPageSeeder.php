<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class FaqPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        CMSPages::where('name', 'Faq')->delete();
        $content = [
            'name' => 'Faq',
            'slug' => 'faq',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'background_banner_image' => 'images/innerBg.jpg',
            'content' => json_encode([
                'faq_banner_title' => "FAQ's",
                'question_sec_heading' => "Frequently asked questions",

                'question1' => "What is Concrete and Candy Jewelry?",
                'answer1' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
                'question2' => "                                    Where does it come from?",
                'answer2' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
                'question3' => "                                    Why do we use it?",
                'answer3' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
                'question4' => "                                    There is an item on sale. Can it be customized?",
                'answer4' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
                'question5' => "                                    Where can I get some?",
                'answer5' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
                'question6' => "                                    How does your shipping work?",
                'answer6' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.",
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
