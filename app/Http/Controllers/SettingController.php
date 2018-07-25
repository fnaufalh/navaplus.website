<?php

namespace App\Http\Controllers;

use App\Setting;

class SettingController extends Controller
{

    public function index()
    {
        $generalEmail = Setting::where('key', 'general_email')
            ->first();

        $careerEmail = Setting::where('key', 'career_email')
            ->first();

        return view('settings.index')
            ->with([
                'general_email' => $generalEmail->value,
                'career_email' => $careerEmail->value,
            ]);
    }

    public function detail()
    {
        $data = Setting::get();
        
        $generalEmail = collect($data)->where('key', 'general_email')->first();
        $careerEmail = collect($data)->where('key', 'career_email')->first();

        $data = [
            'general_email' => $generalEmail->value,
            'career_email' => $careerEmail->value
        ];

        return json_encode($data);
    }

}
