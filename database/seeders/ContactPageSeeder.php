<?php

namespace Database\Seeders;

use App\Models\CMSPages;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CMSPages::where('name', 'Contact')->delete();
        $content = [
            'name' => 'Contact',
            'slug' => 'contact',
            'meta_title' => 'concrete-and-candy-jewelry',
            'meta_description' => 'concrete-and-candy-jewelry',
            'background_banner_image' => 'images/innerBg.jpg',
            'content' => json_encode([
                'contact_banner_title' => "Contact us",
                'contact_form_heading' => "Contact us",
                'contact_form_description' => "To send us a message, first leave your contact info so we can get back to you.",
                'contact_form_footer_para' => "This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.",
            ])
        ];

        $contactData = collect($content)->except(
            'background_banner_image',
        )->all();
        $page = CMSPages::create($contactData);

        $page->clearMediaCollection('background_banner_image');


        $background_banner_image = public_path($content['background_banner_image']);
        if (file_exists($background_banner_image)) $page->copyMedia($background_banner_image)->toMediaCollection('background_banner_image');

    }
}
