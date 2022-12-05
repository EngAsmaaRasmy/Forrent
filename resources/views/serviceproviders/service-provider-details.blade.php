      
@extends('layouts.base',['title'=>'Service Provider Details'])
@section('main')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('serviceProvider.main')}}">{{trans('site.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route ('service.provider.account')}}">{{trans('site.account_details')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$service_providers->name}}</li>
        </ol>
    </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->
<div class="row">
    <aside class="col-md-3 col-lg-3 mx-5">
        @include('serviceproviders.navbar')
    </aside><!-- End .col-lg-3 -->

    <div class="col-md-7 col-lg-8 mb-5 rounded">
        <form action="{{ route('service-provider-account.update', [$service_providers->id]) }}" method="post" enctype="multipart/form-data">
            {{ method_field('patch') }}     
            {{ csrf_field() }}
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger col-md-11 rounded mx-4" role="alert" id="success-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif
           @if(Session::has('error'))
                    <div class="alert alert-danger col-md-9 m-4 px-5 rounded" id="success-alert"> {{ Session::get('error') }}</div>
            @endif
               <div class="product p-5">
                <label>{{trans('site.name')}} </label>
                <input type="text" class="form-control" name="name"required value="{{ $service_providers->name}}" pattern="\D.{2,}">
                
                <label>{{trans('site.phone')}} </label>
                <input type="text" class="form-control" disabled name="phone" required value="{{$service_providers->phone}}" pattern="^0[0-9]{9,12}">
    
                <label>{{trans('site.email')}}</label>
                <input type="email" class="form-control" name="email" required value="{{ $service_providers->email}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
    
                <label>{{trans('site.current_password')}}
                    @if(App::getlocale()=='ar')
                    (اتركه فارغا لتركه دون تغيير)
                            @else
                            (leave blank to leave unchanged) 
                            @endif
                </label>
                <input type="password" class="form-control"required disabled name="password">
    
                <label>{{trans('site.new_password')}}
                    @if(App::getlocale()=='ar')
                    (اتركه فارغا لتركه دون تغيير)
                            @else
                            (leave blank to leave unchanged) 
                            @endif
                </label>
                <input type="password" name="newPassword" class="form-control"pattern=".{6,}">
    
                <label>{{trans('site.confirm_password')}}</label>
                <input type="password" name="confirmPassword" class="form-control mb-2" pattern=".{6,}">
    
                <button type="submit" class="btn btn-outline-primary-2">
                    <span>{{trans('site.save_changes')}}</span>
                    <i class="icon-long-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>

    
</div><!-- .End .tab-pane -->
{{-- @endforeach --}}
@endsection          