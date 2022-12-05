@extends('layouts.base',['title'=>'Log in as Customer'])
@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route ('customer.main')}}">{{trans('site.dashboard')}}</a></li>
                <li class="breadcrumb-item active"><a>{{trans('site.my_account')}}</a></li>
            </ol>
        </div><!-- End .container -->
      </nav><!-- End .breadcrumb-nav -->

    <div class="page-content ">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-3 col-lg-3 mx-5">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" id="tab-dashboard-link"  href="{{route ('customer.main')}}" role="tab" aria-controls="tab-dashboard" aria-selected="true">{{trans('site.dashboard')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('customer/customer-services') ? 'active' : '' }}"  href="{{ route ('customer-services.index')}}">{{trans('site.services')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('customer/favorite-services') ? 'active' : '' }}"  href="{{route ('favorite-services.index')}}">{{trans('site.favorite_services')}}</a>
                            </li>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('customer/logout') ? 'active' : '' }}" href="{{ route ('customer.logout') }}">{{trans('site.log_out')}}</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->
                    <div class="col-md-6 col-lg-7">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                @if(App::getlocale()=='ar')
                                <p>مرحبا <span class="font-weight-normal text-dark"></span> (ليس <span class="font-weight-normal text-dark">مستخدم</span>? <a href="{{ route ('customer.logout') }}">تسجيل خروج</a>) 
                                    <br>
                                    من لوحة تحكم حسابك يمكنك عرض <a href="{{ route ('customer-services.index')}} " class="tab-trigger-link link-underline"> الخدمات ،</a>,  <a href="{{route ('favorite-services.index')}}" class="tab-trigger-link link-underline">والتحكم في خدماتك المفضلة</a>.</p>
                                @else
                                <p>Hello <span class="font-weight-normal text-dark"></span> (not <span class="font-weight-normal text-dark">User</span>? <a href="{{ route ('customer.logout') }}">Log out</a>) 
                                <br>
                                From your account dashboard you can view your <a href={{ route ('customer-services.index')}} class="tab-trigger-link link-underline">services </a>. and, <a href="{{route ('favorite-services.index')}}{{ route ('service.provider.account')}}"  class="tab-trigger-link link-underline"> mange </a> your favorite services.</p>
                            @endif
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection