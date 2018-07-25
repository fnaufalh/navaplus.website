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
        $email = Setting::where('key', 'general_email')
            ->orWhere('key', 'career_email')
            ->get();

        $data = [
            'email' => $email
        ];

        return json_encode($data);
    }

}
