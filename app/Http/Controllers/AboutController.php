<?php

namespace App\Http\Controllers;

use App\About;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function detail()
    {
        $data = About::first();
        
        $data->image_link = env('IMAGE_PATH').$data->image;

        return json_encode([
            'data' => $data
        ]);
    }
}
