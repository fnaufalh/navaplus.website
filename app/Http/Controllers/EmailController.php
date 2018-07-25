<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function editView()
    {
        $generalEmail = Setting::where('key', 'general_email')
            ->first();

        $careerEmail = Setting::where('key', 'career_email')
            ->first();

        return view('settings.emails.update')
            ->with([
                'general_email' => $generalEmail->value,
                'career_email' => $careerEmail->value,
            ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $data = [
                'value' => $input['general_email']
            ];

            Setting::where('key', 'general_email')
                ->update($data);

            $data = [
                'value' => $input['career_email']
            ];

            Setting::where('key', 'career_email')
                ->update($data);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit email'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit email, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

}
