@extends('layouts.base',['title'=>'Log in to For Rent'])

@section('main')
<style>

    /* Important part */
    /* .form-box{
        overflow-y: initial !important;
    }
    .form-tab{
        height: 80vh;
        overflow-y: auto;
        padding-right: 10px;
        padding-left: 10px;
    } */
    .input-control {
    display: flex;
    flex-direction: column;
    }

    .input-control input ,select {
        border-radius: 4px;
        display: block;
        font-size: 14px;
        padding: 10px;
        width: 100%;
    }
    .input-control span{
        color: red;
    }
    .span{
        color: red;
    }
</style>

<main class="main">

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-6 pb-lg-6" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    @if(Session::has('error'))
                    <div class="alert alert-danger mt-1 ml-2 rounded" id="success-alert"> {{ Session::get('error') }}</div>
                    @endif
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">{{trans('site.service_provider')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">{{trans('site.customer')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form method="POST" action="{{ route('service.provider.login') }}">
                                <h6 for="name">{{trans('site.important')}} <span class="span">*</span> {{trans('site.required')}}</h6>
                                {{ csrf_field() }}
                                <div class="form-group input-control">
                                    <label for="singin-email-2">{{trans('site.email')}} <span>*</span></label>
                                    <input type="text" class="form-control" id="singin-email-2" value="{{old('email')}}" name="email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group input-control">
                                    <label for="singin-password-2">{{trans('site.password')}} <span>*</span></label>
                                    <input type="password" class="form-control password" id="password" name="password" required>
                                    <i class="bi bi-eye-slash togglePassword" id="togglePassword"></i>
                                </div><!-- End .form-group -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                    <label class="custom-control-label" for="signin-remember-2">{{trans('site.remember_me')}}</label>
                                </div><!-- End .custom-checkbox -->

                                <div class="form-footer">
                                    
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>{{trans('site.log_in')}}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div><!-- End .form-footer -->
                                <a href="{{route ('forget.passwordSp.get')}}" class="forgot-link" style="font-size: 15px">{{trans('site.forgot')}}</a>
                                <p style="font-size: 15px; margin-top: 20px;"> {{trans('site.donot')}}<a href="{{ url ('sign-up') }}"> {{trans('site.sign_up')}}</a></p> 
                                {{-- <div class="input-control" style="margin-top: 10px">
                                   <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('sign-up') }}'">{{trans('site.sign_up')}}</button>
                                </div><!-- End .form-group -->   --}}
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form method="POST" action="{{ route('customer.login') }}">
                                <h6 for="name">{{trans('site.important')}} <span class="span">*</span> {{trans('site.required')}}</h6>
                                {{ csrf_field() }}
                                <div class="form-group input-control">
                                    <label for="register-email-2">{{trans('site.email')}} <span>*</span></label>
                                    <input type="text" class="form-control" id="register-email-2" value="{{old('email')}}" name="email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group input-control">
                                    <label for="register-password-2">{{trans('site.password')}} <span>*</span></label>
                                    <input type="password" class="form-control password" id="password2" name="password" required>
                                    <i class="bi bi-eye-slash togglePassword" id="togglePassword2"></i>
                                </div><!-- End .form-group -->

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-remember-2">
                                    <label class="custom-control-label" for="register-remember-2">{{trans('site.remember_me')}}</label>
                                </div><!-- End .custom-checkbox -->

                                <div class="form-footer">
                                <div> 
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>{{trans('site.log_in')}}</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div><!-- End .form-footer -->
                                </div>
                                <a href="{{route ('forget.password.get')}}" class="forgot-link" style="font-size: 15px">{{trans('site.forgot')}}</a> 
                                 <p style="font-size: 15px; margin-top: 20px;"> {{trans('site.donot')}}<a href="{{ url ('sign-up') }}"> {{trans('site.sign_up')}}</a></p>  
                                {{-- <div class="input-control" style="margin-top: 10px !important">
                                    <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('sign-up') }}'">{{trans('site.sign_up')}}</button>
                                 </div><!-- End .form-group -->  --}}
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->

@endsection
