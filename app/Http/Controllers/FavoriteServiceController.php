<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerServiceFavorite;
use Illuminate\Http\Request;

class FavoriteServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_id = session('id');
        $favorites = CustomerServiceFavorite::all()
        ->where('customer_id', $customer_id);
        return view('customers.favorite-services', compact('favorites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\8Response
     */
    public function store(Request $request)
    {
        $customer_id = session('id');
        $customer = Customer::where('id', '=', $customer_id)->first();
        $input = $request->all();
        if ($customer) {
            if (
                    CustomerServiceFavorite::where('customer_id', $customer_id)
                    ->where('service_id', $input['service_id'])->count() > 0) {
                        return redirect()->back()->with('message', trans('main.already_added_to_wishlist'));
            } else {
                    $data =
                    [
                        'service_id' => $input['service_id'] ,
                        'customer_id' => session('id'),
                    ];
                    $favorites = CustomerServiceFavorite::create($data);
                    session()->flash('added to wishlist');
                    return redirect()->back()->with('message', trans('main.added_to_wishlist'));
            }
        } else {
            return view('login');
        }
    }
    public function destroy($id)
    {
        CustomerServiceFavorite::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->back()->with('message', trans('main.delete_service'));
    }
}
