<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Flag;
use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SyntheticFilters\Models\Filter;
use SyntheticFilters\Traits\ResponseTrait;

class FilterController extends Controller
{
    use ResponseTrait;
    public function getContent()
    {
        $per_page = 10;

        if (request()->has('per_page')) {
            $per_page = (int) request()->per_page;
        }
        $posts = Post::with('department')->sort()->filter()->get()->take(10);

        // foreach ($posts as $value) {
        //     $department = Department::where('id', $value->department_id)->first();
        //     $value->department = $department->name;
        // }
        $posts->data = $posts->toFlatArray();
        $this->log('success', 'Data Fetched successfully');
        return $this->response(
            data: $posts->toArray(),
            status: 200
        );
    }
    /**
     * Retrieves the content structure.
     *
     * @return array The content structure.
     */
    public function getContentStructure()
    {
        $table_structure = Config('table-structure');
        $this->log('success', 'Data Fetched successfully');
        return $this->response(
            data: $table_structure,
            status: 200
        );
    }
    public function getFilterStructure()
    {
        $properties = new Post;
        $this->log('success', 'Data Fetched successfully');
        return $this->response(
            data: $properties->filterData(),
            status: 200
        );
    }
    public function getFilterContent()
    {

        $filter_data = Filter::where([
            'resource' => 'post',
            'user_id' => 5,
        ])->latest()->first();

        $this->log('success', 'Data Fetched successfully');
        // $filter_data = Filter::where([
        //     'resource' => 'App\Models\Post',
        //     'user_id' => '1'
        // ])->first() ?? Filter::where(['resource' => 'App\Models\Post', 'visibility' => true])->first();

        return $this->response(
            data: $filter_data ? $filter_data->toArray() : [],
            status: 200
        );
    }
    public function storeFilterContent(Request $request, $filter_id = null)
    {
        $request->merge([
            'resource' => Post::class,
            'resource_id' => '',
        ]);
        try {
            $validator = Validator::make($request->all(), [
                'filter_object' => 'required',
                'visibility' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                $this->log('error', $validator->errors());
                return $this->response(
                    data: [],
                    status: 403
                );
            }

            if ($filter_id) {
                $data = Filter::find($filter_id);

                if ($data) {
                    $data->resource = $request->resource;
                    $data->resource_id = $request->resource_id;
                    $data->user_id = 1;
                    $data->filter_object = $request->filter_object;
                    $data->visiblity = $request->visibility;
                    $data->save();
                    $this->log('success', 'Filter data updated successfully');
                } else {
                    $this->log('error', 'Filter data not found');
                    return $this->response(
                        data: [],
                        status: 404
                    );
                }
            } else {
                $data = new Filter;
                $data->resource = 'post';
                $data->resource_id = $request->resource_id;
                $data->user_id = 5;
                $data->filter_object = $request->filter_object;
                $data->visiblity = $request->visibility;
                $data->save();

                $this->log('success', 'Filter data store successfully');
            }
            return $this->response(
                data: $data->toArray(),
                status: 200
            );
        } catch (\Exception $e) {
            $this->log('error', $e->getMessage());
            return $this->response(
                data: [],
                status: 500
            );
        }
    }
    public function deleteFilterContent($id)
    {
        try {
            $filter = Filter::find($id);

            if ($filter) {
                $filter->delete();
                $this->log('success', 'Filter data deleted successfully');
            } else {
                $this->log('error', 'Filter data not found');
                return $this->response(
                    data: [],
                    status: 404
                );
            }
            return $this->response(

                data: [],
                status: 200
            );
        } catch (\Exception $e) {
            $this->log('error', $e->getMessage());
            return $this->response(
                data: [],
                status: 500
            );
        }
    }
    public function getCategoryStructure()
    {
        $properties = new Category;
        $this->log('success', 'Data Fetched successfully');
        return $this->response(
            data: $properties->filterData(),
            status: 200
        );
    }

    /**
     * This method search query from table
     */
    public function getCategoryRelationData()
    {
        if (request('search_text')) {
            $validator = Validator::make(request()->all(), [
                'search_text' => 'string|min:1'
            ]);

            $searchText = request('search_text');
            if ($validator->fails()) {
                $this->log('error', $validator->errors());
                return $this->response(
                    data: [],
                    status: 200
                );
            }

            $data = Category::where(
                [
                    ['name', 'LIKE', "%$searchText%"],
                ]
            )->orWhere('job_title', 'LIKE', "%$searchText%")
                ->orWhere('line_manager', 'LIKE', "%$searchText%")
                ->orWhere('department', 'LIKE', "%$searchText%")
                ->orWhere('Office', 'LIKE', "%$searchText%")
                ->orWhere('employee_status', 'LIKE', "%$searchText%")
                ->orWhere('account', 'LIKE', "%$searchText%")
                ->paginate(20);
        } else {
            $data = Category::simplePaginate(10);
        }

        $this->log('success', 'Data Fetched successfully');

        return $this->response(
            data: $data->toArray(),
            status: 200
        );
    }


    public function feedData()
    {

        $stat_arr = ['CSE', 'BBA', 'SWE', 'MATH', 'PHYSICS', 'ARCHITECT', 'MBA', 'CA', 'STUPID'];
        for ($i = 0; $i < count($stat_arr); $i++) {
            $data = new Flag();
            $data->name = $stat_arr[$i];
            $data->save();
        }
        return "Data Saved Successfully";
    }
    public function feedData1()
    {
        $this->log('success', 'New Category and Post Data inserted successfully');
        $stat_arr = ['Active', 'Inactive', 'Pending', 'Rejected'];
        $index = array_rand($stat_arr);
        $random_status = $stat_arr[$index];
        $faker = Faker::create();
        $randomCategoryName = $faker->word();
        $category = new Category;
        $category->name = $randomCategoryName;
        $category->status = $random_status;
        $category->user_id = 1;
        $category->save();
        $post = new Post;
        $post->category_id = $category->id;
        $post->title = $faker->sentence();
        $post->status = $random_status;
        $post->user_id = 1;
        $post->description = $faker->paragraph();
        $post->save();
        return $this->response(
            data: [],
            status: 200
        );
    }
}
