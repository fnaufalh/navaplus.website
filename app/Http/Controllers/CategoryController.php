<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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

        $data = Category::orderBy($orderBy, $orderType);

        if ($all == 'y')
            $data = $data->withTrashed();
        if ($take)
            $data = $data->take($take);

        $data = $data->with('works')
            ->get();

        return json_encode($data);
    }

    /**
     * @param Request $request
     * $request include :
     * paginate - value: [number ex:5,13 | *9]
     * page - value: [number ex:5,13 | *1]
     * @return string
     */
    public function workByCategory(Request $request, $id)
    {

        $filter = $request->all();

        $paginate = (isset($filter['paginate']) &&
            is_numeric($filter['paginate'])) ? $filter['paginate'] : 9;
        $page = (isset($filter['page']) &&
            is_numeric($filter['page'])) ? $filter['page'] : 1;
        $offset = ($page * $paginate) - $paginate;

        $data = Category::where('id', $id)
            ->with('works')
            ->first();

        $works = collect($data)['works'];
        $works = collect($works)->map(function ($item, $key) {
            $item['preview_image_link'] = env('IMAGE_PATH') . $item['preview_image'];
            return $item;
        })->toArray();

        $data = array_slice($works, $offset, $paginate);
        $currentPage = $page;
        $lastPage = round(count($works) / $paginate);

        return json_encode([
            'data' => $data,
            'total_data' => count($works),
            'paginate' => (int)$paginate,
            'current_page' => $currentPage,
            'last_page' => $lastPage
        ]);
    }

}
