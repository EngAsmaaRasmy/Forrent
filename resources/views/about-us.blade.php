@extends('layouts.base',['title'=>'About For Rent'])

@section('main')

<main class="main">
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 text-dark rounded border-3" style="background-color:white; padding:40px;">
                    <h3 class="eyebrow-header my-5">{{trans('site.about_our')}}</h3>
                    <p>  @if(App::getlocale()=='ar')
                        {{$info->about_Ar}}
                        @else
                        {{$info->about}}
                        @endif</p>
                </div>
            </div>

        </div>


    </div>

</main><!-- End .main -->

@endsection