<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Category;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{

    /**
     * @param Request $request
     * $request include :
     * all - value: [*y|n] - get all data include deleted data
     * agency_id - value: [number between 1-8 | *null] - get all data with exact agency
     * category_id - value: [number ex:1,2 | *null] - get all data with exact category
     * order_by - value: [*id|name] - ordering data by
     * order_type - value: [asc|*desc] - ordering data ascending or descending
     * paginate - value: [number ex:5,13 | *null] - get all data include deleted data
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
        $paginate = (isset($filter['paginate']) &&
            is_numeric($filter['paginate'])) ? $filter['paginate'] : null;
        $except = (isset($filter['except']) &&
            is_numeric($filter['except'])) ? $filter['except'] : null;


        $data = Work::orderBy($orderBy, $orderType);

        if ($agency)
            $data = $data->where('agency_id', $agency);

        if ($category)
            $data = $data->where('category_id', $category);

        if ($all == 'y')
            $data = $data->withTrashed();

        if($except != null)
            $data = $data->where('id', '!=', $except);

        $data = $data
            ->paginate($paginate);

        foreach ($data as $item) {
            $item->preview_image_link = env('IMAGE_PATH') . $item->preview_image;
            $item->main_image_link = env('IMAGE_PATH') . $item->main_image;
            $item->main_1_link = env('IMAGE_PATH') . $item->image_1;
            $item->main_2_link = env('IMAGE_PATH') . $item->image_2;
        }

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
