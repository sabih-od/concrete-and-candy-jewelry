<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Models\Setting;
use App\Services\Admin\SettingService;
use Illuminate\Http\Request;

class SettingController extends AdminBaseController
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function show(Setting $setting)
    {
        $setting = $this->settingService->getLatestSettings();

        return view('admin.pages.web_settings.edit', compact('setting'));
    }


    public function update(Request $request, Setting $setting)
    {
        try {
            $settings = $this->settingService->updateSetting($setting, $request->all());

            if ($settings instanceof \Exception) {
                return WebResponses::errorRedirectBack($settings->getMessage());
            }

            return back();
        } catch (\Exception $exception) {
            return WebResponses::errorRedirectBack($exception->getMessage());
        }
    }


}
