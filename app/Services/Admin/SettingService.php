<?php

namespace App\Services\Admin;

use App\Helpers\WebResponses;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use App\Models\Setting;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;


class SettingService
{
    private static $instance;
    /**
     * @var Setting
     */
    public $settingModel;

    private function __construct()
    {
        $this->settingModel = new Setting();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SettingService();
        }
        return self::$instance;
    }

    public function getAllSettings()
    {
        return $this->settingModel->get();
    }

    public function getLatestSettings()
    {
        return $this->settingModel->latest()->first();

    }


    public function getSetting($settingId)
    {
        return $this->settingModel->find($settingId);
    }


    public function updateSetting($setting, $settingData)
    {
        try {
            if ($settingData) {

//                if ($settingData['product_return_days'] >= $settingData['pay_out_days']) {
//                    throw new \Exception('The product return policy days should be set to a value less than the payout days. Please review and adjust your settings.');
//                }


                $updateData = [
                    'email' => $settingData['email'],
                    'address' => $settingData['address'],
                    'phone_no' => $settingData['phone_no'],
                    'social_link_1' => $settingData['social_link_1'],
                    'social_link_2' => $settingData['social_link_2'],
                    'social_link_3' => $settingData['social_link_3'],
                    'social_link_4' => $settingData['social_link_4'],
//                    'pay_out_days' => $settingData['pay_out_days'],
//                    'product_return_days' => $settingData['product_return_days'],
                ];

                if (isset($settingData['header_logo'])) {
                    $settingData['header_logo'] = ImageHelper::uploadImage($settingData['header_logo'], 'header_logo', 'setting_images');
                    $updateData['header_logo'] = $settingData['header_logo'];
                }

                if (isset($settingData['footer_logo'])) {
                    $settingData['footer_logo'] = ImageHelper::uploadImage($settingData['footer_logo'], 'footer_logo', 'setting_images');
                    $updateData['footer_logo'] = $settingData['footer_logo'];
                }

                if (isset($settingData['fav_image'])) {
                    $settingData['fav_image'] = ImageHelper::uploadImage($settingData['fav_image'], 'fav_image', 'setting_images');
                    $updateData['fav_image'] = $settingData['fav_image'];
                }

                // Check and update only if the key exists in $settingData
                foreach ($updateData as $key => $value) {
                    if (array_key_exists($key, $settingData)) {
                        $setting->update([$key => $value]);
                    }
                }
            }
            return $settingData;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


}
