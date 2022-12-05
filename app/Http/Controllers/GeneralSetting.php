<?php

namespace App\Http\Controllers;

use App\Models\DayCost;
use App\Models\HomePosters;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DataTables;
use Illuminate\Support\Facades\File;
use Validator;

class GeneralSetting extends Controller
{
    use ApiResponser;

    public function index()
    {
        return DataTables::of(HomePosters::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($general) {
            return $general->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:1180,height:500',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $general = HomePosters::create($input);

        if ($request->file('image')) {
            $image_name = md5($general->id . "app" . $general->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/generals/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $general->image =  $image_full_name;
        }
        $general->save();

        return $this->success(['general' => $general], trans('main.general_create_success'));
    }

    public function show($id)
    {
        $general = HomePosters::find($id);
        return $this->success(['general' => $general]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $general = HomePosters::find($id);
        if (!$general) {
            return $this->error(__('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:1180,height:500',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $general = HomePosters::find($id);

        $general->update($input);

        if ($request->file('image')) {
            $image_name = md5($general->id . "app" . $general->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/generals/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $general->image =  $image_full_name;
        }
        $general->save();

        return $this->success(['general' => $general], __('main.general_update_success'));
    }
    public function updateCost(Request $request)
    {
        $input = $request->all();
        $cost = DayCost::first();
        if (!$cost) {
            $input = $request->all();
            $validator = Validator::make($input, [
                 'cost' => 'required',
            ]);
            if ($validator->fails()) {
                $message = implode("\n", $validator->errors()->all());
                return $this->error($message, 422, $validator->errors());
            }
            $general = DayCost::create($input);
            $general->save();
            return $this->success(['cost' => $cost], trans('main.cost_create_success'));
        }
        $validator = Validator::make($input, [
            'cost' => 'required',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $cost->update($input);
        return $this->success(['cost' => $cost], trans('main.cost_update_success'));
    }
    public function destroy($id)
    {
        $general = HomePosters::find($id);
        if ($general->image) {
            File::delete(public_path() . "/uploads/generals" . $general->image);
        }
        $general->delete();
        return $this->success('', trans('main.category_delete_success'));
    }
}
