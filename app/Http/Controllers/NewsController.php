<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    private $response;

    public function index()
    {
        return view('news.index');
    }

    public function addView()
    {
        return view('news.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            for ($i = 0; $i < count($input['name']); $i++) {
                $response = uploadImage($input['image'][$i]);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;
                    break;
                }

                $image = $response['result']['image'];

                $data = [
                    'name' => $input['name'][$i],
                    'type' => $input['type'][$i],
                    'date' => $input['date'][$i],
                    'headline' => $input['headline'][$i],
                    'description' => $input['description'][$i],
                    'image' => $image
                ];

                News::create($data);

            }

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success add news',
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed add news, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function editView($id)
    {
        $data = News::where('id', $id)
            ->withTrashed()
            ->first();

        return view('news.update')
            ->with('news', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $input['name'],
                'type' => $input['type'],
                'date' => $input['date'],
                'headline' => $input['headline'],
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

            News::where('id', $id)
                ->withTrashed()
                ->update($data);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit news'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit news, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function destroy($id)
    {

        try {
            DB::beginTransaction();

            News::where('id', $id)
                ->delete();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success delete news'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed delete news, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);

    }

    public function restore($id)
    {

        try {
            DB::beginTransaction();

            News::where('id', $id)
                ->withTrashed()
                ->restore();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success restore news'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed restore news, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);

    }

    /**
     * @param Request $request
     * $request include :
     * all - value: [*y|n] - get all data include deleted data
     * order_by - value: [*id|date] - ordering data by
     * order_type - value: [asc|*desc] - ordering data ascending or descending
     * take - value: [number ex:5,13 | *null] - get all data include deleted data
     * @return string
     */
    public function list(Request $request)
    {

        $filterCondition = [
            'all' => ['y', 'n'],
            'order_by' => ['id', 'date'],
            'order_type' => ['asc', 'desc']
        ];

        $filter = $request->all();

        $all = (isset($filter['all']) &&
            in_array($filter['all'], $filterCondition['all'])) ? $filter['all'] : 'y';
        $orderBy = (isset($filter['order_by']) &&
            in_array($filter['order_by'], $filterCondition['order_by'])) ? $filter['order_by'] : 'id';
        $orderType = (isset($filter['order_type']) &&
            in_array($filter['order_type'], $filterCondition['order_type'])) ? $filter['order_type'] : 'desc';
        $take = (isset($filter['take']) &&
            is_numeric($filter['take'])) ? $filter['take'] : null;

        $data = News::orderBy($orderBy, $orderType);

        if ($all == 'y')
            $data = $data->withTrashed();
        if ($take)
            $data = $data->take($take);

        $data = $data->get();

        $data = collect($data)->map(function ($item) use ($request) {
            $temp = explode(" ", $item->date);
            $item->date_formated = $temp[1] . " " . $temp[2];
            
            $item->image_link = env('IMAGE_PATH').$item->image;
            
            return $item;
        });

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = News::where('id', $id)
            ->first();

        $temp = explode(" ", $data->date);
        $data->date_formated = $temp[1] . " " . $temp[2];

        $data->image_link = env('IMAGE_PATH').$data->image;

        return json_encode($data);
    }

}
