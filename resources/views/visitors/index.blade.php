@extends('layouts.base',['title'=>'Services'])
@section('main')
@php
    $customer = App\Models\Customer::where('name' , session('name'))->first();
@endphp
@if($customer && $customer->token != nulL)
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('customer.main')}}">{{trans('site.dashboard')}}</a></li>
            <li class="breadcrumb-item active">{{trans('site.services')}}</li>
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
            <div class=" col-md-8 m-auto">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">{{trans('site.all_services')}}</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
                </div><!-- End .heading -->
                <div class="tab-content tab-content-carousel">
           
                <!-- All tab-pane -->
                <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel" aria-labelledby="trending-all-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                       data-owl-options='{
                           "nav": false,
                           "dots": true,
                           "margin": 20,
                           "loop": false,
                           "responsive": {
                           "0": {
                                "items":1
                               },
                               "480": {
                                   "items":2
                               },
                               "768": {
                                    "items":3
                                },
                                "992": {
                                   "items":4
                               },
                               "1200": {
                                   "items":3,
                                   "nav": false
                                   
                               },
                               "1600": {
                                    "items":5,
                                    "nav": false
                                   
                               }
                           }
                       }'> 
                        @foreach($services as $service)
                        @if($service->allow == 1)
                        <div class="product text-center">
                            <figure class="product-media">
                                @if($service->discount && $service->discount_period < Carbon\Carbon::now())
                                <span class="product-label label-sale">{{$service->discount}} {{trans('site.off')}}</span>
                                @endif
                                <a href="{{route ('single-service', [$service->id])}}">
                                    <img src="{{asset('uploads/'.$service->image)}}" alt="Product image" class="product-image">
                                </a>
                                <div class="product-action-vertical"> 
                                    <form class="my-2" action="{{route ('store.favorite.service')}} " method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$service->id}}" name="service_id">
                                        <button type="submit" class="btn-product-icon btn-wishlist" title="Add to wishlist">
                                            <span>add to wishlist</span>
                                        </button>
                                    </form>
                                {{-- <a href="{{ route ('store.favorite.service',[$service->id])}}" class="btn-product-icon btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a> --}}
                                <a href="{{route ('single-service', [$service->id])}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->
   
                            <div class="product-body">
                                <h3 class="product-title"><a href="#">
                                    @if(App::getlocale()=='ar')
                                    {{$service->title_ar}}
                                    @else
                                    {{$service->title}}
                                    @endif
                                </a></h3><!-- End .product-title -->
                                @if($service->discount && $service->discount_period < Carbon\Carbon::now())
                                <div class="product-price"> 
                                     <span class="new-price"> {{$service->new_price ?? 'None'}}  @if(App::getlocale()=='ar')
                                        ج.س
                                        @else
                                        SDG 
                                        @endif</span>
                                </div>
                                <div class="product-price"> 
                                                   <span class="old-price"> <s>{{$service->price}}  @if(App::getlocale()=='ar')
                                                    ج.س
                                                    @else
                                                    SDG 
                                                    @endif</s></span>
                                             </div>
                                               @else
                                               <div class="product-price"> 
                                                    <span class="old-price"> {{$service->price}}  @if(App::getlocale()=='ar')
                                                        ج.س
                                                        @else
                                                        SDG 
                                                        @endif</span>
                                               </div>
                                               @endif
                            </div><!-- End .product-body --> 
                        </div><!-- End .product --> 
                        @endif
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .bg-lighter -->
        </div>    
     </div>
</div>
@else
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('home')}}">{{trans('site.home')}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{trans('site.services')}}</a></li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav --> 
        <div class="page-content">
            <div class="container">
                <!-- row opened -->
                <div class="row"> 
                    <div class="col-lg-8 m-auto">
                        <div class="products mb-5">
                            <div class="row justify-content-start">
                                @if($services->isNotEmpty())
                                @foreach ($services as $service)
                                @if($service->allow == 1)
                                <div class="col-6 col-md-4 col-lg-4 mb-2">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            @if($service->discount && $service->discount_period < Carbon\Carbon::now())
                                            <span class="product-label label-sale">{{$service->discount}} {{trans('site.off')}}</span>
                                            @endif
                                            <a href="{{route ('single-service', [$service->id])}}">
                                                <img src="{{asset('uploads/'.$service->image)}}" alt="Product image" class="product-image">
                                            </a>
                                            <div class="product-action-vertical">
                                                <form class="my-2" action="{{route ('store.favorite.service')}} " method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{$service->id}}" name="service_id">
                                                    <button type="submit" class="btn-product-icon btn-wishlist" title="Add to wishlist">
                                                        <span>add to wishlist</span>
                                                    </button>
                                                </form>
                                                 <a href="{{route ('single-service', [$service->id])}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                            </div><!-- End .product-action-vertical -->
                                        </figure><!-- End .product-media -->
    
                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="{{route ('categoryServices',[$service->subCategory->category->id ??'None'])}}">
                                                    @if(App::getlocale()=='ar')
                                                    {{$service->subCategory->category->name_ar ??'None'}} 
                                                    @else
                                                    {{$service->subCategory->category->name ??'None'}}
                                                    @endif
                                                </a><span style="color:#fcb941">|</span>
                                                <a href="{{route ('subCategoryServices',[$service->subCategory->id ??'None'])}}">
                                                    @if(App::getlocale()=='ar')
                                                    {{$service->subCategory->name_ar ??'None'}}
                                                    @else
                                                    {{$service->subCategory->name ??'None'}} 
                                                    @endif
                                                </a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{route ('single-service', [$service->id])}}">
                                                @if(App::getlocale()=='ar')
                                                {{$service->title_ar}}
                                                @else
                                                {{$service->title}}
                                                @endif
                                               </a></h3><!-- End .product-title -->
                                                @if($service->discount && $service->discount_period < Carbon\Carbon::now())
                                                <div class="product-price"> 
                                                    <span class="new-price"> {{$service->new_price ?? 'None'}}  @if(App::getlocale()=='ar')
                                                        ج.س
                                                        @else
                                                        SDG 
                                                        @endif</span>
                                               </div>
                                               <div class="product-price"> 
                                                   <span class="old-price"> <s>{{$service->price}}  @if(App::getlocale()=='ar')
                                                    ج.س
                                                    @else
                                                    SDG 
                                                    @endif</s></span>
                                             </div>
                                               @else
                                               <div class="product-price"> 
                                                    <span class="old-price"> {{$service->price}}  @if(App::getlocale()=='ar')
                                                        ج.س
                                                        @else
                                                        SDG 
                                                        @endif</span>
                                               </div>
                                               @endif
                                        </div><!-- End .product-body -->
                                    </div>
                                </div><!-- End .col-md-6 -->
                                @endif
                               @endforeach
                               @else
                               <div class="col-8 col-md-8 col-lg-8 m-auto">
                                 <div class="product product-7 text-center">
                                        <div class="product-body">
                                            <div class="product-cat p-5">
                                                <h2>{{trans('site.no_products')}}</h2>
                                            </div><!-- End .product-cat -->
                                            
                                        </div><!-- End .product-body -->
                                    </div>
                                </div><!-- End .col-md-6 -->
                                @endif
                            </div><!-- End .row -->
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first mx-2">
                        <form action="{{ route('services.filter') }}" method="GET" autocomplete="off">
                            {{csrf_field() }}
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>{{trans('site.all_categories')}}</label>
                                <a href="#" class="sidebar-filter-clear">{{trans('site.clear_all')}} </a>
                            </div><!-- End .widget widget-clean -->
                            <div class="widget widget-collapsible"> 
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        {{trans('site.category')}}
                                    </a>
                                 </h3><!-- End .widget-title -->
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach($categories as $category)
                                            @php
                                            $serviceCount = App\Models\Service::whereHas('subCategory.category', function ($query) use ($category){
                                                $query->where('category_id', $category->id);
                                            })->count();
                                            @endphp
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="custom-control-input" id="{{ $category->id }}">
                                                    <label class="custom-control-label" for="{{ $category->id }}">
                                                        @if(App::getlocale()=='ar')
                                                        {{$category->name_ar}}
                                                        @else
                                                        {{$category->name}}
                                                        @endif
                                                       </label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count">{{$serviceCount}}</span>
                                            </div><!-- End .filter-item -->   
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse --> 
                            </div><!-- End .widget -->
                            
                        </div><!-- End .sidebar sidebar-shop -->
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>{{trans('site.all_area')}}</label>
                                <a href="#" class="sidebar-filter-clear">{{trans('site.clear_all')}} </a>
                            </div><!-- End .widget widget-clean -->
                            <div class="widget widget-collapsible"> 
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        {{trans('site.area')}}
                                    </a>
                                 </h3><!-- End .widget-title -->
                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach($areas as $area)
                                            @php
                                            $serviceCount = App\Models\Service::whereHas('area', function ($query) use ($area){
                                                $query->where('area_id', $area->id);
                                            })->count();
                                            @endphp
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" value="{{ $area->id }}" name="area_id[]" class="custom-control-input" id="area{{$area->id}}">
                                                    <label class="custom-control-label" for="area{{$area->id }}">
                                                        @if(App::getlocale()=='ar')
                                                        {{$area->name_ar}}
                                                        @else
                                                        {{$area->name}}
                                                        @endif
                                                       </label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count">{{$serviceCount}}</span>
                                            </div><!-- End .filter-item -->   
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse --> 
                            </div><!-- End .widget -->
                            
                        </div><!-- End .sidebar sidebar-shop -->
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-collapsible"> 
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                        {{trans('site.price')}}
                                    </a>
                                 </h3><!-- End .widget-title -->
                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                <input type="search" name ="price"class="form-control" placeholder="{{trans('site.search_by_price')}} ..." > 
                                            </div><!-- End .filter-price-text -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse --> 
                            </div><!-- End .widget -->
                            
                        </div><!-- End .sidebar sidebar-shop -->
                        <button type="submit" class="btn btn-primary btn-marg btn-round ">
                            <span>{{trans('site.filters')}}</span>
                        </button>
                    </form>
                    </aside><!-- End .col-lg-3 -->
                </div>    
             </div>
        </div>

       
            
@endif
@endsection