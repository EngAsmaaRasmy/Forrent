<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use DataTables;

class BlockAndUnblockApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        });
    }
    public function blocked($id)
    {
        $service_provider = ServiceProvider::find($id);
        if ($service_provider) {
            $service_provider->blocked = ($service_provider->blocked == 0 ? 1 : 0);
            $service_provider->save();
            return $this->success($service_provider, trans('main.blocked_success'));
        }
        return $this->error(__('main.item_not_found'), 404);
    }
}
