<?php

namespace SyntheticFilters\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Post;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Http\Request;
use ReflectionClass;
use SyntheticFilters\Traits\FilterTrait;
use SyntheticFilters\Traits\ResponseTrait;
use App\Models\User;

class FilterController
{
    use FilterTrait;
    use ResponseTrait;

    public function searchSelect(Request $request, $module, $prefix, $model)
    {
        $model = 'Moddule/' . ucfirst($module) . '/' . ucfirst($prefix) . '/' . ucfirst($model);
        $model = 'App\Models\Post';
        $model = new ReflectionClass($model);

        $modelname = $model->getName();
        $query = $modelname::query();

        $data = $query->select('_id', 'title')->where('title', $request->query('search_query'))->get()->toArray();
        $this->log('success', 'Data fetch successfully');
        return $this->response(
            data: $data,
            status: 200
        );
    }

    public function listWithSearch(Request $request)
    {
        $route_parameter = $request->route()->parameters();
        $namespace = collect($route_parameter)->map(function ($item) {
            return ucfirst($item);
        })->implode('\\');

        $model = new ReflectionClass($namespace);
        $modelname = $model->getName();
        $query = $modelname::query();
        $modelData = $query->filter()->paginate(10)->toArray();


        $data = collect($modelData['data'])->map(function ($item) {
            return [
                'label' => ucfirst($item['name']),
                'value' => $item['_id']
            ];
        });
        $modelData['data'] = $data;
        $this->log('success', 'Data fetch successfully');

        // dd(array_rand($all_data));

        // return $modelData;
        // $data = [
        //     [
        //         'label' => "Marketing",
        //         'value' => "marketing"
        //     ],
        //     [
        //         'label' => "Engineering",
        //         'value' => "engineering"
        //     ],
        //     [
        //         'label' => 'Product Management',
        //         'value' => 'product_management'
        //     ],
        //     [
        //         'label' => 'Sales',
        //         'value' => 'sales'
        //     ],
        //     [
        //         'label' => 'Design',
        //         'value' => 'design'
        //     ],
        //     [
        //         'label' => 'Human Resources',
        //         'value' => 'human_resources'
        //     ]
        // ];
        //if ($request->has('filters')) {
        // $array = $request->query('filters');
        // $array = $array['department'];
        // $array = $array[array_key_first($array)];
        // $array = str_replace(['[', ']'], '', $array);
        // $searchTerms = explode(',', $array);


        // foreach ($data as $item) {
        //     if (in_array($item['value'], $searchTerms)) {
        //         $resultArray[] = $item;
        //     }
        // }

        // $data = $query->filter()->get()->toArray();
        // $data = collect($data)->map(function ($item) use ($request) {
        //     dd($request->query('filters'));
        //     return [
        //         'lable' => array_keys($request->query('filters'))[0],
        //         'value' => $item['name']
        //     ];
        // })->toArray();
        // }

        return $this->response(
            data: $resultArray ?? $modelData,
            status: 200
        );
    }
}
