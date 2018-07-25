<?php

namespace App\Http\Controllers;

use App\About;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    private $response;

    public function index()
    {
        $data = About::first();

        $data->image_link = \request()->getHttpHost() . "/" . $data->image;

        return view('abouts.index')
            ->with('about', $data);
    }

    public function editView()
    {
        $data = About::first();

        return view('abouts.update')
            ->with('about', $data);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $data = [
                'vision' => $input['vision'],
                'mission' => $input['mission'],
                'description' => $input['description']
            ];

            if (isset($input['image'])) {
                $response = uploadImage($input['image']);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;
                    
                    return redirect()
                        ->back()
                        ->with('response', $this->response);
                }

                $data['image'] = $response['result']['image'];
            }

            About::first()
                ->update($data);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit about.'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit about, please try again.',
                'error' => $e->getMessage()
            ];
        }
        
        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function detail()
    {
        $data = About::first();
        
        $data->image_link = env('IMAGE_PATH').$data->image;

        return json_encode([
            'data' => $data
        ]);
    }
}
