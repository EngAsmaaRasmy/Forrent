<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use DataTables;
use Illuminate\Support\Facades\File;
use Validator;

class CategoryController extends Controller
{
    use ApiResponser;
    use SlugTrait;
    use TranslationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Category::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($category) {
            return $category->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }

    public function list()
    {
        $categories = Category::with(['subCategories'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($categories);
    }
    public function subCategories($id)
    {
        $subCategories = SubCategory::with(['category'])
        ->where('category_id', $id)
        ->get();

        return $this->success($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:categories,name',
            'name_ar' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:240,height:400',
            'poster_image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:240,height:400',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $category = Category::create($input);
        $input['slug'] = $this->createSlug('Category', $category->id, $category->name, 'categories');

        if ($request->file('image')) {
            $image_name = md5($category->id . "app" . $category->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $category->image =  $image_full_name;
        }
        if ($request->file('posterImage')) {
            $image_name = md5($category->id . "app" . $category->id . rand(1, 1000));

            $image_ext = $request->file('posterImage')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/posters/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('posterImage')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $category->poster_image =  $image_full_name;
        }
        $category->save();
        $this->translate($request, 'Category', $category->id);

        return $this->success(['category' => $category], trans('main.category_create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $this->success(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return $this->success(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'name' => 'required|unique:categories,name,' . $category->id,
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:240,height:400',
            'poster_image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:240,height:400',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $category = Category::find($id);

        $this->editSlug('Category', $category->id, $category->name, 'categories');

        $category->update($input);

        if ($request->file('image')) {
            $image_name = md5($category->id . "app" . $category->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }


            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $category->image =  $image_full_name;
        }
        if ($request->file('posterImage')) {
            $image_name = md5($category->id . "app" . $category->id . rand(1, 1000));

            $image_ext = $request->file('posterImage')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/posters/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('posterImage')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $category->poster_image =  $image_full_name;
        }
        $category->save();
        $this->editTranslation($request, 'Category', $category->id);

        return $this->success(['category' => $category], __('main.category_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $subCategory = SubCategory::where('category_id', $id)->get();
        if (count($subCategory) > 0) {
            return $this->error(trans('main.category_has_sub_category'), 422);
        }
        if ($category->image) {
            File::delete(public_path() . "/uploads/" . $category->image);
        }
        if ($category->poster_image) {
            File::delete(public_path() . "/uploads/posters/" . $category->poster_image);
        }
        $category->delete();
        return $this->success('', trans('main.category_delete_success'));
    }
}
