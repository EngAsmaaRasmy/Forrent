<?php

namespace App\Http\Controllers;

use App\Models\InfoUs;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use DataTables;
use Validator;


class InfoUsApiController extends Controller
{
    use ApiResponser;
    use TranslationTrait;
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(InfoUs::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($info) {
            return $info->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }

    public function list()
    {
        $info = InfoUs::with(['services', 'services.topics'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($info);
    }

    public function show()
    {
        $info = InfoUs::first();
        return $this->success(['info' => $info]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'address' => 'required',
            'phone'=> 'required',
            'email' => 'required',
            'about' => 'required',
            'about_ar' => 'required',
            'address_ar' => 'required',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $info = InfoUs::create($input);
        $info->save();
        $this->translate($request, 'InfoUs', $info->id);

        return $this->success(['info' => $info], trans('main.info_us_create_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $info = InfoUs::first();
        $input = $request->all();
        if (!$info) {
            return $this->error(trans('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'address' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'address_ar' => 'nullable',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $info->update($input);
        $this->editTranslation($request, 'InfoUs', $info->id);
        return $this->success(['info' => $info], __('main.info_update_success'));
    }
}
