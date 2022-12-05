<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Mail;
class CustomerAuthController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    public function index(Request $request)
    {
        return view('customers.dashboard');
    }
    public function showRegisterForm()
    {
        return view('site.customers.login');
    }
    public function register(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|regex:/^0([0-9\s\-\+\(\)]*)$/|min:10|unique:customers,phone',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $otp = $this->otp();
        $customer = Customer::create($input);
        $customer->otp = $otp;
        $token = uniqid(base64_encode(Str::random(40)));
        $customer->token = $token;
        $customer->password = Hash::make($request->password);
        $customer->confirmed = 1;
        $customer->save();
        $session = session(['token' => $customer->token, 'id' => $customer->id, 'name' => $customer->name]);
        $this->translate($request, 'Customer', $customer->id);
        return redirect()->route('show.login-otp.form');
    }
    public function showForgetPasswordForm()
    {
        return view('forget-password');
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
        Mail::send('email.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', trans('main.reset_password'));
    }
    public function showResetPasswordForm($token)
    {
        return view('forget-password-link', ['token' => $token]);
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
                 'token' => $request->token,
        ])->first();
        if (!$updatePassword) {
             return back()->withInput()->with('error', trans('main.token_invalid'));
        }
        $customer = Customer::where('email', $request->email)
                     ->update(['password' => $request->password]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

         return redirect()->intended('/customer')->with('customer', $customer);
    }
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $customer = Customer::where('email', '=', $email )->first();
        if ($customer) {
            if (Hash::check($password, $customer->password)) {
                if ($customer->confirmed == 1) {
                    $token = uniqid(base64_encode(Str::random(40)));
                    $customer->token = $token;
                    $customer->save();
                    $session = session(['token' => $token, 'id' => $customer->id, 'name' => $customer->name]);
                    return redirect()->intended('/customer')->with('customer', $customer);
                } else {
                    return redirect()->back()->with(['error' => trans('main.account_not_confirmed')]);
                }
            } else {
                return redirect()->back()->with(['error' => trans('main.password_error')]);
            }
        } else {
            return redirect()->back()->with(['error' => trans('main.user_not_registered') ]);
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
            'customerOtp' => 'required'
        ]);
        $customer = Customer::where('token', session('token'))->first();
        return redirect()->intended('/customer')->with('customer', $customer);
    }
    public function logout()
    {
        $customer = Customer::where('id', session('id'))->first();
        if (session('token') !== null) {
            $customer->token = null;
            $customer->save();
            Session::forget('token');
            Session::flush();
            return redirect('/')->with('message', trans('main.log_out'));
        }
    }
}
