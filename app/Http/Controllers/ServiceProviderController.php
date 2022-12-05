<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\ServiceProvider;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServiceProviderController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    public function index()
    {
        if (Auth::user()) {
            return view('site.serviceproviders.dashboard');
        }
        return view('site.serviceProviders.login');
    }
    public function accountDetails()
    {
        $service_provider_id = session('id');
        $service_providers = ServiceProvider::where('id', $service_provider_id)->first();
        return view('serviceproviders.service-provider-details', compact('service_providers'));
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $service_provider = ServiceProvider::findOrfail($id);
        $service_provider->update($input);
        if ($request->newPassword) {
            if ($request->newPassword == $request->confirmPassword && $request->newPassword != null) { 
                $service_provider = ServiceProvider::where('id', $id)->first();
                    $service_provider->update([ 'password'  => Hash::make($request->newPassword)]);
                        return redirect()->back()->with('message', trans('main.edit_password'));
            } else {
                return redirect()->back()->with('error', trans('main.doesnot_match'));
            }
        }
        return redirect()->back()->with('message', trans('main.edit_account'));
    }
}
