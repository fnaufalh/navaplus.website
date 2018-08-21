<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    /**
     * @param Request $request
     * $request include :
     * all - value: [*y|n] - get all data include deleted data
     * order_by - value: [*id|date] - ordering data by
     * order_type - value: [asc|*desc] - ordering data ascending or descending
     * paginate - value: [number ex:5,13 | *null] - get all data include deleted data
     * except - value: [number ex:1,13 | *null] - remove except id
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
        $paginate = (isset($filter['paginate']) &&
            is_numeric($filter['paginate'])) ? $filter['paginate'] : null;
        $except = (isset($filter['except']) &&
            is_numeric($filter['except'])) ? $filter['except'] : null;

        $data = News::orderBy($orderBy, $orderType);

        if ($all == 'y')
            $data = $data->withTrashed();

        if($except != null)
            $data = $data->where('id', '!=', $except);

        $data = $data->paginate($paginate);

        foreach ($data as $item) {
            $temp = explode(" ", $item->date);
            $item->date_formated = $temp[1] . " " . $temp[2];

            $item->preview_image_link = env('IMAGE_PATH') . $item->preview_image;
            $item->image_link = env('IMAGE_PATH') . $item->image;
        }

        return json_encode($data);
    }

    public function detail($id)
    {
        $data = News::where('id', $id)
            ->first();

        $data->description = nl2br($data->description);

        $temp = explode(" ", $data->date);
        $data->date_formated = $temp[1] . " " . $temp[2];

        $data->image_link = env('IMAGE_PATH').$data->image;

        return json_encode($data);
    }

}
