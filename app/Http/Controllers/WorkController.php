<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Category;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    private $response;

    public function index()
    {
        return view('works.index');
    }

    public function addView()
    {
        $agencies = Agency::where('id','!=',9)->get();
        $categories = Category::get();

        return view('works.add')
            ->with([
                'agencies' => $agencies,
                'categories' => $categories
            ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            for ($i = 0; $i < count($input['name']); $i++) {

                $response = uploadImage($input['main_image'][$i]);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;
                    break;
                }

                $mainImage = $response['result']['image'];


                $response = uploadImage($input['image_1'][$i]);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;
                    break;
                }

                $image1 = $response['result']['image'];


                $response = uploadImage($input['image_2'][$i]);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;
                    break;
                }

                $image2 = $response['result']['image'];

                $data = [
                    'agency_id' => $input['agency'],
                    'name' => $input['name'][$i],
                    'client' => $input['client'][$i],
                    'quote' => $input['quote'][$i],
                    'description' => $input['description'][$i],
                    'main_image' => $mainImage,
                    'image_1' => $image1,
                    'image_2' => $image2,
                ];

                $work = Work::create($data);
                
                array_shift($input['service'][$i]);
                foreach($input['service'][$i] as $service)
                    $work->categories()->attach($service);
            }

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success add work.',
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed add work, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function editView($id)
    {
        $agencies = Agency::where('id','!=',9)->get();
        $categories = Category::get();
        $data = Work::where('id', $id)
            ->withTrashed()
            ->first();

        return view('works.update')
            ->with([
                'work' => $data,
                'agencies' => $agencies,
                'categories' => $categories
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
                'client' => $input['client'],
                'quote' => $input['quote'],
                'description' => $input['description']
            ];

            if (isset($input['main_image'])) {
                $response = uploadImage($input['main_image']);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;

                    return redirect()
                        ->back()
                        ->with('response', $this->response);
                }

                $data['main_image'] = $response['result']['image'];
            }

            if (isset($input['image_1'])) {

                $response = uploadImage($input['image_1']);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;

                    return redirect()
                        ->back()
                        ->with('response', $this->response);
                }

                $data['image_1'] = $response['result']['image'];
            }

            if (isset($input['image_2'])) {

                $response = uploadImage($input['image_2']);

                if (!$response['status']) {
                    DB::rollback();
                    $this->response = $response;

                    return redirect()
                        ->back()
                        ->with('response', $this->response);
                }

                $data['image_2'] = $response['result']['image'];
            }

            Work::where('id', $id)
                ->withTrashed()
                ->update($data);
                
            $work = Work::where('id', $id)
                ->withTrashed()
                ->first();
                
            array_shift($input['service']);
            $work->categories()->detach();
            foreach($input['service'] as $service)
                $work->categories()->attach($service);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit work.'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit work, please try again.',
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

            Work::where('id', $id)
                ->delete();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success delete work.'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed delete work, please try again.',
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

            Work::where('id', $id)
                ->withTrashed()
                ->restore();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success restore work.'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed restore work, please try again.',
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
     * category_id - value: [number ex:1,2 | *null] - get all data with exact category
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
        $category = (isset($filter['category_id']) &&
            is_numeric($filter['category_id'])) ? $filter['category_id'] : null;
        $orderBy = (isset($filter['order_by']) &&
            in_array($filter['order_by'], $filterCondition['order_by'])) ? $filter['order_by'] : 'id';
        $orderType = (isset($filter['order_type']) &&
            in_array($filter['order_type'], $filterCondition['order_type'])) ? $filter['order_type'] : 'desc';
        $take = (isset($filter['take']) &&
            is_numeric($filter['take'])) ? $filter['take'] : null;

        $data = Work::orderBy($orderBy, $orderType);

        if ($agency)
            $data = $data->where('agency_id', $agency);

        if ($category)
            $data = $data->where('category_id', $category);

        if ($all == 'y')
            $data = $data->withTrashed();

        if ($take)
            $data = $data->take($take);

        $data = $data->with('agency')
            ->with('categories')
            ->get();

        $data = collect($data)->map(function ($item) use ($request) {
            $item->main_image_link = env('IMAGE_PATH').$item->main_image;
            $item->main_1_link = env('IMAGE_PATH').$item->image_1;
            $item->main_2_link = env('IMAGE_PATH').$item->image_2;
            return $item;
        });

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = Work::where('id', $id)
            ->with('agency')
            ->with('categories')
            ->first();

        $data->main_image_link = env('IMAGE_PATH').$data->main_image;
        $data->main_1_link = env('IMAGE_PATH').$data->image_1;
        $data->main_2_link = env('IMAGE_PATH').$data->image_2;

        return json_encode($data);
    }
}
