
@extends('layouts.base',['title'=>'search for service'])
@section('main')
<nav aria-label="breadcrumb" class="breadcrumb-nav ">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route ('home')}}">{{trans('site.home')}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{trans('site.search_for')}}</a></li>
        </ol>  
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <!-- row opened -->
            <div class="col-lg-8 m-auto">
                <div class="products mb-5">
                    <div class="row">
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
                                            </a>
                                    </div><!-- End .product-cat -->
                                    <div class="product-price"> 
                                        <p class="old-price">
                                             @if(App::getlocale()=='ar')
                                             {{$service->area->name_ar}} |{{$service->area->city->name_ar}}  
                                            @else
                                            {{$service->area->name}}  | {{$service->area->city->name}} 
                                            @endif</p>
                                   </div>
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
                <!-- /row -->
            
        <!-- container closed -->
        </div>
 <!-- dashboard closed -->
    </div>
<!-- main-content closed -->

</div> 
        </div>     
@endsection
