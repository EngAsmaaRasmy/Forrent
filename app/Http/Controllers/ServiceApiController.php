<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use DataTables;


class ServiceApiController extends Controller
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

        return DataTables::of(Service::query()->orderBy('created_at', 'desc'))
        ->addColumn('service_provider', function ($service) {
            return ($service->serviceProvider ? $service->serviceProvider->name : '');
        })
        ->addColumn('allow', function ($service) {
            if ($service->allow == 0) {
                $input = '<input data-action="allow" type="checkbox" class="switch" name="switchstatus" >';
            } else {
                $input = '<input data-action="allow" type="checkbox" class="switch" name="switchstatus" checked>';
            }
            return '<label class="switch">' . $input . '<span class="slider round"></span></label>';
        })
        ->addColumn('created_at', function ($general) {
            return $general->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at','allow'])
        ->make(true);

    }

    public function list()
    {
        $services = Service::with(['serviceProvider'])
        ->orderby('created_at', 'DESC')->get();

        return $this->success($services);
    }
    public function show($id)
    {
        $services = Service::with(['serviceProvider','area.city','subCategory.category'])->find($id);

        return $this->success(['service' => $services]);
    }

    public function allow($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->allow = ($service->allow == 0 ? 1 : 0);
            $service->save();
            return $this->success($service, __('main.allow_success'));
        }
        return $this->error(__('main.item_not_found'), 404);
    }
}
