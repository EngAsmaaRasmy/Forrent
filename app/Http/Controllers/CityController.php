<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use DataTables;
use Validator;

class CityController extends Controller
{
    use ApiResponser;
    use SlugTrait;
    use TranslationTrait;

    public function index()
    {
        return DataTables::of(City::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($city) {
            return $city->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }
    public function list()
    {
        $cities = City::with(['areas', 'area.services'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($cities);
    }

    public function areas($id)
    {
        $areas = Area::with(['city', 'services'])
        ->where('area_id', $id)
        ->get();

        return $this->success($areas);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:cities,name',
            'name_ar' => 'required',
        ]);
        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $city = City::create($input);

        $city->save();
        $this->translate($request, 'City', $city->id);

        return $this->success(['city' => $city], trans('main.city_create_success'));
    }

    public function show($id)
    {
        $city = City::find($id);
        return $this->success(['city' => $city]);
    }

    public function edit($id)
    {
        $city = City::find($id);

        return $this->success(['city' => $city]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $city = City::find($id);
        if (!$city) {
            return $this->error(__('main.not_found'), 404);
        }
        $validator = Validator::make($input, [
            'name' => 'required|unique:cities,name,' . $city->id
        ]);

        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $city = City::find($id);

        $city->update($input);

        $city->save();
        $this->editTranslation($request, 'City', $city->id);

        return $this->success(['city' => $city], __('main.city_update_success'));
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $areas = Area::where('city_id', $id)->get();
        if (count($areas) > 0) {
            return $this->error(trans('main.city_has_areas'), 422);
        }
        $city->delete();
        return $this->success('', trans('main.city_delete_success'));
    }

}
