<?php

namespace App\Http\Controllers;

use App\Agency;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    private $response;

    public function index()
    {
        return view('peoples.index');
    }

    public function addView()
    {
        $agencies = Agency::get();

        return view('peoples.add')
            ->with([
                'agencies' => $agencies
            ]);
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
                    'agency_id' => $input['agency'],
                    'name' => $input['name'][$i],
                    'department' => $input['department'][$i],
                    'email' => $input['email'][$i],
                    'description' => $input['description'][$i],
                    'image' => $image,
                ];

                People::create($data);

            }

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success add people',
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed add people, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function editView($id)
    {
        $agencies = Agency::get();
        $data = People::where('id', $id)
            ->withTrashed()
            ->first();

        return view('peoples.update')
            ->with([
                'people' => $data,
                'agencies' => $agencies
            ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $data = [
                'agency_id' => $input['agency'],
                'name' => $input['name'],
                'department' => $input['department'],
                'email' => $input['email'],
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

            People::where('id', $id)
                ->withTrashed()
                ->update($data);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit people'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit people, please try again.',
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

            People::where('id', $id)
                ->delete();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success delete people'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed delete people, please try again.',
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

            People::where('id', $id)
                ->withTrashed()
                ->restore();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success restore people'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed restore people, please try again.',
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
     * agency_id - value: [number between 1-8 | *null] - get all data with exact agency
     * order_by - value: [*id|name] - ordering data by
     * order_type - value: [asc|*desc] - ordering data ascending or descending
     * take - value: [number ex:5,13 | *null] - get all data include deleted data
     * @return string
     */
    public function list(Request $request)
    {

        $filterCondition = [
            'all' => ['y', 'n'],
            'order_by' => ['id', 'name'],
            'order_type' => ['asc', 'desc']
        ];

        $filter = $request->all();

        $all = (isset($filter['all']) &&
            in_array($filter['all'], $filterCondition['all'])) ? $filter['all'] : 'y';
        $agency = (isset($filter['agency_id']) &&
            ($filter['agency_id'] >= 1 && $filter['agency_id']) <= 8) ? $filter['agency_id'] : null;
        $orderBy = (isset($filter['order_by']) &&
            in_array($filter['order_by'], $filterCondition['order_by'])) ? $filter['order_by'] : 'id';
        $orderType = (isset($filter['order_type']) &&
            in_array($filter['order_type'], $filterCondition['order_type'])) ? $filter['order_type'] : 'desc';
        $take = (isset($filter['take']) &&
            is_numeric($filter['take'])) ? $filter['take'] : null;

        $data = People::orderBy($orderBy, $orderType);

        if ($agency)
            $data = $data->where('agency_id', $agency);

        if ($all == 'y')
            $data = $data->withTrashed();

        if ($take)
            $data = $data->take($take);

        $data = $data->with('agency')->get();

        $data = collect($data)->map(function ($item) use ($request) {
            $item->image_link = env('IMAGE_PATH').$item->image;
            return $item;
        });

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = People::where('id', $id)
            ->first();

        $data->image_link = env('IMAGE_PATH').$item->image;

        return json_encode($data);
    }
}
