<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use DataTables;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;

class CustomerApiController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    public function index()
    {
        return DataTables::of(Customer::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($customer) {
            return $customer->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);
    }

    public function list()
    {
        $customers = Customer::all()
        ->orderby('created_at', 'DESC')->get();

        return $this->success($customers);
    }
    public function show($id)
    {
        $customers = Customer::find($id);
        return $this->success(['customer' => $customers]);
    }
}
