<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

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

        $data = Client::orderBy($orderBy, $orderType);

        if ($all == 'y')
            $data = $data->withTrashed();
        if ($take)
            $data = $data->take($take);

        $data = $data->get();

        $data = collect($data)->map(function ($item) use ($request) {
            $item->image_link = env('IMAGE_PATH').$item->image;
            return $item;
        });

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = Client::where('id', $id)
            ->first();

        $data->image_link = env('IMAGE_PATH').$item->image;

        return json_encode($data);
    }

}
