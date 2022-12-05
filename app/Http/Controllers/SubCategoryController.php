<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use DataTables;
use Illuminate\Support\Facades\File;
use Validator;

class SubCategoryController extends Controller
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
        return DataTables::of(SubCategory::query()->orderBy('created_at', 'desc'))
        ->addColumn('category', function ($sub_category) {
            if ($sub_category->category) {
            return $sub_category->category->name;
            }
            return null;
        })->addColumn('created_at', function ($subCategory) {
            return $subCategory->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['category' , 'created_at'])
        ->make(true);
    }



    public function list()
    {
        $subCategories = SubCategory::with(['services', 'services.topics'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($subCategories);
    }

    public function services($id)
    {
        $services = Service::with(['SubCategory'])
        ->where('sub_category_id', $id)
        ->get();

        return $this->success($services);
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
            'name' => 'required|unique:sub_categories,name',
            'name_ar' =>'required',
            'image' => 'file|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $subCategory = SubCategory::create($input);
        $input['slug'] = $this->createSlug('SubCategory', $subCategory->id, $subCategory->name, 'subCategories');

         $uploads_folder =  getcwd() . '/uploads/';

        if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
        }

        if ($request->file('image')) {
            $image_name = md5($subCategory->id . "app" . $subCategory->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;


            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $subCategory->image =  $image_full_name;
        }
        $subCategory->save();
        $this->translate($request, 'SubCategory', $subCategory->id);

        return $this->success(['sub_category' => $subCategory], trans('main.subCategory_create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory = SubCategory::with(['category'])->find($id);
        return $this->success(['subCategory' => $subCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::find($id);

        return $this->success(['subCategory' => $subCategory]);
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
        $sub_category = SubCategory::find($id);
        if (!$sub_category) {
            return $this->error(__('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'name' => 'required|unique:sub_categories,name,' . $sub_category->id
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $sub_category = SubCategory::find($id);

        $this->editSlug('SubCategory', $sub_category->id, $sub_category->name, 'subcategories');

        $sub_category->update($input);

        if ($request->file('image')) {
            $image_name = md5($sub_category->id . "app" . $sub_category->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }


            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $sub_category->image =  $image_full_name;
        }
        $sub_category->save();
        $this->editTranslation($request, 'SubCategory', $sub_category->id);

        return $this->success(['subCategory' => $sub_category], trans('main.subCategory_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $services = Service::where('sub_category_id', $id)->get();
        if (count($services) > 0) {
            return $this->error(trans('main.subCategory_has_services'), 422);
        }
        if ($subCategory->image) {
            File::delete(public_path() . "/uploads/" . $subCategory->image);
        }
        $subCategory->delete();
        return $this->success('', trans('main.subCategory_delete_success'));
    }
}
