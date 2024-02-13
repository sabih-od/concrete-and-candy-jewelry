<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::create([
            'phone_no' => '(800) 4000-234',
            'address' => 'Working hours Mon-Fri 10-18h CET
             50 NE. Surrey St.Ossining, NY 10562 USA',
            'email' => 'support@yourdomain.tld',
        ]);

        $setting->clearMediaCollection('header_logo');

        $header_logo = public_path('images/logo.png');
        if (file_exists($header_logo)) $setting->copyMedia($header_logo)->toMediaCollection('header_logo');

        $setting->clearMediaCollection('footer_logo');

        $footer_logo = public_path('images/footerlogo.png');
        if (file_exists($footer_logo)) $setting->copyMedia($footer_logo)->toMediaCollection('footer_logo');

        $setting->clearMediaCollection('fav_icon');

        $fav_icon = public_path('images/logo.png');
        if (file_exists($fav_icon)) $setting->copyMedia($fav_icon)->toMediaCollection('fav_icon');

    }

}

