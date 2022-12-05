<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use DataTables;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;

class ServiceProviderApiController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    public function index()
    {
        return DataTables::of(ServiceProvider::query()->orderBy('created_at', 'desc'))
        ->addColumn('block', function ($service_provider) {
            if ($service_provider->blocked == 0) {
                $input = '<input data-action="block" type="checkbox" class="switch" name="switchstatus" >';
            } else {
                $input = '<input data-action="block" type="checkbox" class="switch" name="switchstatus" checked>';
            }
            return '<label class="switch">' . $input . '<span class="slider round"></span></label>';
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['block'])
        ->make(true);
    }
    public function list()
    {
        $service_providers = ServiceProvider::all()
        ->orderby('created_at', 'DESC')->get();

        return $this->success($service_providers);
    }
    public function show($id)
    {
        $service_providers = ServiceProvider::with(['review'])->find($id);
        return $this->success(['service_providers' => $service_providers]);
    }

    public function blocked($id)
    {
        $service_provider = ServiceProvider::find($id);
        if ($service_provider) {
            $service_provider->blocked = ($service_provider->blocked == 0 ? 1 : 0);
            $service_provider->save();
            return $this->success($service_provider, __('main.blocked_success'));
        }
        return $this->error(__('main.item_not_found'), 404);
    }
}
