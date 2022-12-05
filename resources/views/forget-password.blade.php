
@extends('layouts.base')

@section('main')
<main class="main">
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container">
            <div class="form-box">
                @if ($errors->any())
                <div class="alert alert-danger col-md-11 rounded mx-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
               @endif
                <div class="form-tab">
                    <div class="card-header">{{trans('site.reset_password')}}</div>
                    <div class="tab-pane" >
                        <form method="POST" action="{{ route('forget.password.post') }}">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="singin-email-2">{{trans('site.email')}} *</label>
                                <input type="email" class="form-control" id="email_address" name="email" required autofocus>
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <div> 
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>{{trans('site.send')}}</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                </div>
                            </div><!-- End .form-footer -->
                            
                        </form>
                        
                    </div><!-- .End .tab-pane -->
                                  </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -
@endsection