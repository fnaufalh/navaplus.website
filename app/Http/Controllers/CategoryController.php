<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    private $response;

    public function index()
    {
        return view('categories.index');
    }

    public function addView()
    {
        return view('categories.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            for ($i = 0; $i < count($input['name']); $i++) {

                $data = [
                    'name' => $input['name'][$i]
                ];

                Category::create($data);

            }

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success add category.',
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed add category, please try again.',
                'error' => $e->getMessage()
            ];
        }

        return redirect()
            ->back()
            ->with('response', $this->response);
    }

    public function editView($id)
    {
        $data = Category::where('id', $id)
            ->withTrashed()
            ->first();

        return view('categories.update')
            ->with('category', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $input['name']
            ];

            Category::where('id', $id)
                ->withTrashed()
                ->update($data);

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success edit category'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed edit category, please try again.',
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

            Category::where('id', $id)
                ->delete();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success delete category'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed delete category, please try again.',
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

            Category::where('id', $id)
                ->withTrashed()
                ->restore();

            DB::commit();

            $this->response = [
                'status' => true,
                'message' => 'Success restore category'
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $this->response = [
                'status' => false,
                'message' => 'Failed restore category, please try again.',
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
        $orderBy = (isset($filter['order_by']) &&
            in_array($filter['order_by'], $filterCondition['order_by'])) ? $filter['order_by'] : 'id';
        $orderType = (isset($filter['order_type']) &&
            in_array($filter['order_type'], $filterCondition['order_type'])) ? $filter['order_type'] : 'desc';
        $take = (isset($filter['take']) &&
            is_numeric($filter['take'])) ? $filter['take'] : null;

        $data = Category::orderBy($orderBy, $orderType);

        if ($all == 'y')
            $data = $data->withTrashed();
        if ($take)
            $data = $data->take($take);

        $data = $data->with('works')
            ->get();

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = Category::where('id', $id)
            ->with('works')
            ->first();

        return json_encode($data);
    }

}
