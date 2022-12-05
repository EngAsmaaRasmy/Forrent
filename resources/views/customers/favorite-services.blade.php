@extends('layouts.base',['title'=>'Favorite Services'])
<style>
    .icon-close:hover{
        color :#fff !important;
    }
</style>
@section('main') 
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('customer.main')}}">{{trans('site.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route ('customer-services.index')}}">{{trans('site.services')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{trans('site.favorite_services')}}</li>
        </ol>
    </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <!-- row opened -->
        <div class="row">
            <aside class="col-md-3 col-lg-3">
                @include('customers.navbar')
            </aside><!-- End .col-lg-3 -->
            <div class="col-md-8 col-lg-8 m-auto">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">{{trans('site.favorite_services')}}</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
                </div><!-- End .heading -->
                <div class="row d-flex justify-content-lg-start" >
                    @if($services->isNotEmpty())
                    @foreach($favorites as $favorite)
                    <div class="col-6 col-md-4 col-lg-4 mb-2">
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <a href="{{route ('single-service', [$favorite->service->id])}}">
                                    <img src="{{asset('uploads/'.$favorite->service->image)}}" alt="Product image" class="product-image">
                                </a>
                                <div class="product-action-vertical">
                                    <button class="btn-remove modal-effect btn-product-icon" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$favorite->id}}"
                                        ><i class="icon-close" style="font-size: 15px; color: #fcb941;"></i></button> 
                                     <a href="{{route ('single-service', [$favorite->service->id])}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="{{route ('subCategoryServices',[$favorite->service->subCategory->id ??'None'])}}">
                                        @if(App::getlocale()=='ar')
                                        {{$favorite->service->subCategory->name_ar ??'None'}}
                                        @else
                                        {{$favorite->service->subCategory->name ??'None'}}
                                        @endif
                                        </a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{route ('single-service', [$favorite->id])}}">
                                    @if(App::getlocale()=='ar')
                                    {{$favorite->service->title_ar}}
                                    @else
                                    {{$favorite->service->title}}
                                    @endif
                                   </a></h3><!-- End .product-title -->
                            </div><!-- End .product-body -->
                            @include('customers.delete')
                        </div>
                    </div><!-- End .col-md-6 -->
                    @endforeach
                    @else 
                    <div class="product">
                        <div class="product-body">
                            <div class="product-cat p-5">
                                <h2>{{trans('site.no_service')}}</h2>

                            </div><!-- End .product-cat -->
                        </div>
                    </div>
                    @endif
                </div><!-- bd -->
            </div><!-- End .bg-lighter -->
        </div>    
     </div>
</div>                           
@endsection