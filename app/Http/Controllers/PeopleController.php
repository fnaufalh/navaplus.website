<?php

namespace App\Http\Controllers;

use App\Agency;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{

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
