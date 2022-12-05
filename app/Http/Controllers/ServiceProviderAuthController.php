<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use Carbon\Carbon;
use Mail;
use App\Models\ServiceProvider;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\Hash;

class ServiceProviderAuthController extends Controller
{
    use TranslationTrait;

    public function index(Request $request)
    {
        return view('serviceproviders.dashboard');
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:service_providers,email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:service_providers,phone',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $otp = $this->otp();
        $serviceProvider = ServiceProvider::create($input);
        $serviceProvider->otp = $otp;
        $token = uniqid(base64_encode(Str::random(40)));
        $serviceProvider->token = $token;
        $serviceProvider->password = Hash::make($request->password);
        $serviceProvider->confirmed = 1;
        $serviceProvider->save();
        $session = session(['token' => $serviceProvider->token, 'id' => $serviceProvider->id, 'name' => $serviceProvider->name]);
        $this->translate($request, 'ServiceProvider', $serviceProvider->id);
        return redirect()->route('show.login-otp.form');
    }

    public function showForgetPasswordForm()
    {
        return view('forget-password-service-provider');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forget-passwordSp', ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', trans('main.reset_password'));
    }
    public function showResetPasswordForm($token)
    {
        return view('forget-password-service-provider-link', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
        ->where([
                'email' => $request->email,
                'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', trans('main.token_invalid'));
        }
        $service_provider = ServiceProvider::where('email', $request->email)
                    ->update(['password' => $request->password]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->intended('/service_provider')->with('service_provider', $service_provider);
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $serviceProvider = ServiceProvider::where('email', '=', $email)->first();

        if ($serviceProvider) {
            if (Hash::check($password, $serviceProvider->password)) {
                if ($serviceProvider->confirmed == 1 && !$serviceProvider->blocked == 1) {
                    $token = uniqid(base64_encode(Str::random(40)));
                    $serviceProvider->token = $token;
                    $serviceProvider->save();
                    $session = session(['token' => $token, 'id' => $serviceProvider->id,'name' => $serviceProvider->name]);
                    return redirect()->intended('/service-provider')->with('serviceProvider', $serviceProvider);
                } else {
                    return redirect()->back()->with(['error' => trans('main.account_not_confirmed'),trans('main.account_bloked')]);
                }
            } else {
                return redirect()->back()->with(['error' => trans('main.password_error')]);
            }
        } else {
            return redirect()->back()->with(['error' => trans('main.user_not_registered')]);
        }
    }

    public function otp()
    {
        $otp = rand(1000, 9999);
        return $otp;
    }

    public function otpCheck(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'serviceProviderOtp' => 'required'
        ]);
        $serviceProvider = ServiceProvider::where('token', session('token'))->first();
        return redirect()->intended('/service-provider')->with('serviceProvider', $serviceProvider);
    }
    public function logout()
    {
        $serviceProvider = ServiceProvider::where('id', session('id'))->first();
        if (session('token') !== null)
        {
            $serviceProvider->token = null;
            $serviceProvider->save();
            $serviceProvider->save();
            Session::flush();
            return redirect('/')->with('message', trans('main.log_out'));
        }
    }
}
