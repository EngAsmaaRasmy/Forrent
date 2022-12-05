@extends('layouts.base', ['title'=>'Sign Up to For Rent'])
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
    .input-control span ,.custom-control span{
        color: red;
    }
    .span{
        color: red;
    }
</style>

@section('main')

<main class="main">
    <div class="login-page bg-image pt-5 pb-5 pt-md-6 pb-md-6 pt-lg-5 pb-lg-5" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container ">
            <div class="form-box">
                <div class="form-tab ">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
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
                        <div class="tab-pane fade show" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form method="POST" action="{{ route('service.provider.register') }}" id="form">
                                <h6 for="name">{{trans('site.important')}} <span class="span">*</span> {{trans('site.required')}}</h6>
                                {{ csrf_field() }}
                                <div class="input-control">
                                    <label for="account_type_id">{{trans('site.account_type')}} <span>*</span></label>
                                    <select name="account_type_id" class="form-select form-control" aria-label="Default select example" onchange="qualificationSelected(this.selectedIndex)" required>
                                        <option value="">{{trans('site.account_type')}}</option>
                                        <option value="1">{{trans('site.individual')}} </option>
                                        <option value="2">{{trans('site.enterprise')}}</option>
                                    </select>
                                    <div class="row" style="display: none;" id="document" >
                                        <div class="col-md-6">
                                            <label for="singin-email-2">{{trans('site.document1')}}</label>
                                            <input type="file" class="form-control" id="singin-email-2" name="document1" accept=".pdf"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="singin-email-2">{{trans('site.document2')}}</label>
                                            <input type="file" class="form-control" id="singin-email-2" name="document2" accept=".pdf"/>
                                        </div>
                                    </div>
                                </div><!-- End .form-group -->
                                <div class="input-control">
                                    <label for="name">{{trans('site.name')}} <span>*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value ="{{old('name')}}" placeholder="Name " required pattern="\D.{2,}" title="Must Start with capital letter">
                                </div><!-- End .form-group -->


                                <div class=" input-control">
                                    <label for="email">{{trans('site.email')}} <span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="user@gmail.com" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Must be true email">
                                </div><!-- End .form-group -->

                                <div class="row">
                                    <div class="col-sm-6 input-control">
                                        <label for="phone">{{trans('site.phone')}} <span>*</span></label>
                                        <input type="phone" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="0XXXXXXXXX" required title="Must start with 0 and at least 10 or more digits">
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6 input-control">
                                        <label for="singin-email-2">{{trans('site.address')}} ({{trans('site.optional')}})</label>
                                        <input type="text" class="form-control" id="singin-email-2" name="address">
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6 input-control">
                                        <label for="password">{{trans('site.password')}} <span>*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" required pattern=".{6,}" title="Must be at least 6 or more characters">
                                        <i class="bi bi-eye-slash" id="togglePassword" style=""></i>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6 input-control">
                                        <label for="password">{{trans('site.confirm_password')}} <span>*</span></label>
                                        <input type="password" class="form-control"id="password2"  name="password_confirmation" pattern=".{6,}"  required>
                                        <i class="bi bi-eye-slash" id="togglePassword2" style=""></i>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                    <label class="custom-control-label" for="register-policy-2">{{trans('site.agree')}} <a href="{{route ('privacy-policy')}}">{{trans('site.privacy')}}</a> <span>*</span></label>
                                </div><!-- End .custom-checkbox -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>{{trans('site.sign_up')}}</span>
                                        <i class="icon-long-arrow-right"></i>
                                   </button>             
                                </div><!-- End .form-footer -->
                                <p  style="font-size: 12px; margin-top: 20px;"> {{trans('site.already')}}<a href="{{ url ('login') }}"> {{trans('site.log_in')}}</a></p> 
                                {{-- <div class="input-control">
                                    <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('login') }}'">{{trans('site.log_in')}}</button> 
                                </div><!-- End .form-group --> --}}
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form method="POST" action="{{ route('customer.register') }}" id="form" >
                                <h6 for="name">{{trans('site.important')}} <span class="span">*</span> {{trans('site.required')}}</h6>
                                {{ csrf_field() }}

                                <div class="input-control">
                                    <label for="name">{{trans('site.name')}} <span>*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Name" required pattern="\D.{2,}" title="Must Start with capital letter">
                                </div><!-- End .form-group -->

                                
                                
                                <div class="input-control">
                                    <label for="email">{{trans('site.email')}} <span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="user@gmail.com" title="Must be true email">
                                </div><!-- End .form-group -->

                                <div class="input-control">
                                    <label for="phone">{{trans('site.phone')}} <span>*</span></label>
                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required placeholder="0XXXXXXXXX" pattern="^0[0-9]{9,12}" title="Must start with 0 and at least 10 or more digits">
                                </div><!-- End .form-group -->

                                <div class="row">
                                    <div class="col-sm-6 input-control">
                                        <label for="password">{{trans('site.password')}} <span>*</span></label>
                                        <input type="password" class="form-control" id="password3" name="password" required pattern=".{6,}" title="Must be at least 6 or more characters">
                                        <i class="bi bi-eye-slash" id="togglePassword3"></i>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6 input-control">
                                        <label>{{trans('site.confirm_password')}} <span>*</span></label>
                                        <input type="password" class="form-control" id="password4" name="password_confirmation" required>
                                        <i class="bi bi-eye-slash" id="togglePassword4"></i>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->


                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy-3" required>
                                    <label class="custom-control-label" for="register-policy-3">{{trans('site.agree')}} <a href="{{route ('privacy-policy')}}">{{trans('site.privacy')}}</a> <span>*</span></label>
                                </div><!-- End .custom-checkbox -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>{{trans('site.sign_up')}}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>  
                                </div><!-- End .form-footer -->
                                <p  style="font-size: 12px; margin-top: 20px;"> {{trans('site.already')}}<a href="{{ url ('login') }}"> {{trans('site.log_in')}}</a></p> 
                                {{-- <div class="input-control">
                                    <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('login') }}'">{{trans('site.log_in')}}</button> 
                                </div><!-- End .form-group --> --}}
                            </form>
                            
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->

@endsection