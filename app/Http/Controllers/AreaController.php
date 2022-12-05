<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use DataTables;
use Validator;

class AreaController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    public function index()
    {
        return DataTables::of(Area::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($area) {
            return $area->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }


    public function list()
    {
        $areas = Area::with(['services'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($areas);
    }

    public function services($id)
    {
        $services = Service::with(['Area', 'services'])
        ->where('area_id', $id)
        ->get();

        return $this->success($services);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:areas,name',
            'name_ar' => 'required',
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $area = Area::create($input);

        $area->save();
        $this->translate($request, 'Area', $area->id);

        return $this->success(['area' => $area], trans('main.area_create_success'));
    }

    public function show($id)
    {
        $area = Area::find($id);
        return $this->success(['area' => $area]);
    }
    public function edit($id)
    {
        $area = Area::find($id);
        return $this->success(['area' => $area]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $area = Area::find($id);
        if (!$area) {
            return $this->error(__('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'name' => 'required|unique:areas,name,' . $area->id
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $area = Area::find($id);

        $area->update($input);

        $area->save();
        $this->editTranslation($request, 'Area', $area->id);

        return $this->success(['area' => $area], trans('main.area_update_success'));
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $services = Service::where('area_id', $id)->get();
        if (count($services) > 0) {
            return $this->error(trans('main.area_has_services'), 422);
        }
        $area->delete();
        return $this->success('', trans('main.area_delete_success'));
    }
}
