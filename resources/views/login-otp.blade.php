@extends('layouts.base')

@section('main')

<main class="main">

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-6 pb-lg-6" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container">
            <div class="form-box">
                @if(Session::has('error'))
                    <div class="alert alert-danger mt-1 ml-2 rounded" id="success-alert"> {{ Session::get('error') }}</div>
                 @endif
               @php
               $customer = App\Models\Customer::where('name' , session('name') )->first();
               $service_provider =App\Models\ServiceProvider::where('name' , session('name'))->first();
               @endphp
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        @if($service_provider && $service_provider->token != nulL)
                        <li class="nav-item">
                            <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">{{trans('site.service_provider')}}</a>
                        </li>
                        @elseif($customer && $customer->token != nulL)
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">{{trans('site.customer')}}</a>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if($service_provider && $service_provider->token != nulL)
                        <div class="tab-pane fade show active " id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form method="POST" action="{{ route('service.provider.login-otp') }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="singin-email-2">{{trans('site.code')}} *</label>
                                    <input type="text" class="form-control" id="singin-email-2" name="serviceProviderOtp" required>
                                </div><!-- End .form-group -->
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>{{trans('site.log_in')}}</span>
                                        <i class="icon-long-arrow-right"></i>
                                   </button>             
                                </div><!-- End .form-footer -->
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                        @elseif($customer && $customer->token != nulL)
                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form method="POST" action="{{ route('customer.login-otp') }}">
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label for="singin-email-2">{{trans('site.code')}} *</label>
                                    <input type="text" class="form-control" id="singin-email-2" name="customerOtp" required>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>{{trans('site.log_in')}}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>  
                                </div><!-- End .form-footer -->
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                        @endif
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->

@endsection
