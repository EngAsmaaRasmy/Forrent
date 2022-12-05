@extends('layouts.base ' ,['title'=>'For Rent'])

@section('main')
<main class="main">
    <div class="mb-lg-2"></div><!-- End .mb-lg-2 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-xxl-8 offset-lg-3 offset-xxl-2 m-auto">
                <div class="intro-slider-container slider-container-ratio mb-2">
                    <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                        }'>
                        @if($homePosters->isNotEmpty())
                        @foreach ($homePosters as $homePoster)
                        <div class="intro-slide">
                            <figure class="slide-image">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="assets/images/demos/demo-14/slider/slide-1-480w.jpg">
                                    <img src="{{asset('uploads/generals/'.$homePoster->image)}}" alt="Image Desc">
                                </picture>
                            </figure><!-- End .slide-image -->
                            <div class="intro-content mt-10">
                                <a href="{{$homePoster->link}}" class="btn btn-primary">
                                    <span>{{trans('site.discover_now')}}</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->
                        @endforeach
                        @else
                        <div class="intro-slide">
                            <figure class="slide-image">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="assets/images/demos/demo-14/slider/slide-1-480w.jpg">
                                    <img src="{{asset('assets/images/05.jpg')}}" alt="Image Desc">
                                </picture>
                            </figure><!-- End .slide-image -->
                            <div class="intro-content mt-10">
                                <a href="{{route ('home')}}" class="btn btn-primary">
                                    <span>{{trans('site.discover_now')}}</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->
                        @endif
                    <span class="slider-loader"></span><!-- End .slider-loader -->
                </div><!-- End .intro-slider-container -->
            </div><!-- End .col-xl-9 col-xxl-10 -->
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-xxl-11 m-auto">
                

                <div class="mb-3"></div><!-- End .mb-3 -->

                <!-- Brands section Removed -->

                <div class="mb-5"></div><!-- End .mb-5 -->

                <div class="bg-lighter trending-products">
                    <div class="heading heading-flex mb-3">
                        <div class="heading-left">
                            <h2 class="title">{{trans('site.trending')}}</</h2><!-- End .title -->
                        </div><!-- End .heading-left -->

                       <div class="heading-right">
                            <ul class="nav nav-pills justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab" role="tab" aria-controls="trending-all-tab" aria-selected="true">{{trans('site.all')}}</a>
                                </li>
                                @foreach ($firstCategories as $count => $first_category)
                                @php
                                    $count_services=APP\Models\SubCategory::has('services')->
                                    where('category_id' ,$first_category->id)->get();
                                @endphp
                                @if( count($count_services) >0 )
                                <li @if($count == 0 ) class="nav-item active" @endif>
                                    <a class="nav-link" id="{{$first_category->id}}" data-toggle="tab" href="#tab-{{$first_category->id}}" role="tab" aria-controls="#tab-{{$first_category->id}}">
                                        @if(App::getlocale()=='ar')
                                        {{ $first_category->name_ar }}
                                        @else
                                        {{ $first_category->name}}
                                        @endif
                                    </a>
                                </li>
                                
                                @else
                                <li class="d-none">   
                                </li>
                                @endif
                                @endforeach 
                            </ul>
                       </div><!-- End .heading-right -->
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
                                @if(count($mostServices) > 0)
                                @foreach ($mostServices as $service)
                                @if($service->allow == 1)
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{route ('single-service', [$service->id])}}">
                                            <img src="{{asset('uploads/'.$service ->image)}}" alt="Product image" class="product-image">
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
                                        {{-- <div class="product-cat">
                                            <a href="#">Vehicle</a>
                                        </div><!-- End .product-cat --> --}}
                                        <h3 class="product-title text_center"><a class="text-center" href="{{route ('single-service', [$service->id])}}">
                                            @if(App::getlocale()=='ar')
                                            {{$service->title_ar}}
                                            @else
                                            {{ $service->title}}
                                            @endif
                                        </a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="old-price"> {{$service->price}}  
                                                @if(App::getlocale()=='ar')
                                                ج.س
                                                @else
                                                SDG 
                                                @endif</span>
                                        </div><!-- End .product-price -->
                                        @if($customer && $customer->token != nulL && $services->rate !=null )
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                 <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                                <a class="ratings-text" href="#product-review-link" id="review-link">({{$services->rate->rating}} review)</a>
                                        </div><!-- End .rating-container -->
                                        @endif
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                                @else
                                <div class="product text-center col-md-12">
                                    THere is no service
                                </div><!-- End .product -->

                                @endif
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->

                        <!-- Vehicles tab-pane -->
                        @foreach ($firstCategories as $count => $first_category)
                        <div @if($count == 0) class="tab-pane p-0 fade show" @else class="tab-pane p-0 fade" @endif id="tab-{{$first_category->id}}" role="tabpanel">
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
                                @php
                                $services = App\Models\Service::whereHas('subCategory', function ($query) use ($first_category){
                                    $query->where('category_id', $first_category->id);
                                })
                                ->with(['subCategory'])->orderBy('id', 'DESC')->select('*', 'services.id as me_id')->paginate('6');
                                @endphp

                                @foreach($services as $service)
                                @if($service->allow == 1)
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{route ('single-service', [$service->id])}}">
                                            <img src="{{asset('uploads/'.$service ->image)}}" alt="Product image" class="product-image">
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
                                            <a href="{{ route ('categoryServices',[$first_category->id])}}">
                                                @if(App::getlocale()=='ar')
                                                {{$first_category->name_ar}}
                                                    @else
                                                    {{$first_category->name}}
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
                                        <div class="product-price">
                                            <span class="old-price"> {{$service->price}}  @if(App::getlocale()=='ar')
                                                ج.س
                                                @else
                                                SDG 
                                                @endif</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                        @endforeach
                    </div><!-- End .tab-content -->
                </div><!-- End .bg-lighter -->

                <div class="mb-5"></div><!-- End .mb-5 -->
                @foreach ($lastCategories as $last_category)
                <?php 
                $subCategories = App\Models\SubCategory::has('services')->where('category_id' , $last_category->id)->get();
                ?>
                
                <div class="mb-3"></div><!-- End .mb-3 -->
                        <div class="row cat-banner-row electronics">
                            @if(count($subCategories) >0)
                            <div class="col-xl-3 col-xxl-4">
                                <div class="cat-banner row no-gutters">
                                    <div class="cat-banner-list col-sm-6 d-xl-none d-xxl-flex" style="background-image: url(assets/images/demos/demo-14/banners/banner-bg-1.jpg);">
                                        <div class="banner-list-content">
                                            <h2><a href="#">@if(App::getlocale()=='ar')
                                                {{$last_category->name_ar}}
                                            @else
                                                {{$last_category->name}}
                                             @endif</a></li></a></h2>
                                            <ul>
                                                @foreach ($subCategories as $subCategory)
                                                <li><a href="#"> @if(App::getlocale()=='ar')
                                                    {{$subCategory->name_ar}}
                                                    @else
                                                    {{$subCategory->name}}
                                                    @endif</a></li>
                                                @endforeach  
                                                
                                            </ul>
                                        </div><!-- End .banner-list-content -->
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6 col-xl-12 col-xxl-6">
                                        <div class="banner banner-overlay">
                                            <a href="{{ route ('categoryServices',[$last_category->id])}}">
                                                <img src="assets/images/demos/demo-14/banners/banner-5.jpg" alt="Banner img desc">
                                            </a>

                                            <div class="banner-content">
                                                <h3 class="product-title text-white" style="font-size: 30px;"><a href="{{ route ('categoryServices',[$last_category->id])}}">
                                                    @if(App::getlocale()=='ar')
                                                    {{$last_category->name_ar}}
                                                   @else
                                                    {{$last_category->name}}
                                                 @endif</a></li></a></h4><!-- End .banner-subtitle -->
                                                 <h4 class="text-white my-5" style="font-size: 20px;">
                                                    @if(App::getlocale()=='ar')
                                                    {{$last_category->description_ar}}
                                                   @else
                                                    {{$last_category->description}}
                                                    @endif
                                                 </h4>
                                                <a href="{{ route ('categoryServices',[$last_category->id])}}" class="banner-link my-5">{{trans('site.discover_now')}} <i class="icon-long-arrow-right"></i></a>
                                            </div><!-- End .banner-content -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .cat-banner -->
                            </div><!-- End .col-xl-3 -->
                            @else
                           <div class="d-none">
                           </div>
                            @endif
                            @php
                                $services = App\Models\Service::whereHas('subCategory', function ($query) use ($last_category){
                                    $query->where('category_id', $last_category->id);
                                })
                                ->with(['subCategory'])->orderBy('id', 'DESC')->paginate('5');
                            @endphp

                            <div class="col-xl-9 col-xxl-8">
                                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                    data-owl-options='{
                                        "dots": true,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":2
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
                                                "items":3
                                            },
                                            "1600": {
                                                "items":4
                                            }
                                        }
                                    }'>
                                    @foreach($services as $service)
                                    @if($service->allow == 1)
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            @if($service->discount && $service->discount_period > Carbon\Carbon::now())
                                            <span class="product-label label-sale">{{$service->discount}} {{trans('site.off')}}</span>
                                            @endif
                                            <a href="{{route ('single-service', [$service->id])}}">
                                                <img src="{{asset('uploads/'.$service ->image)}}" alt="Service image" class="service-image">
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
                                            <div class="product-cat text-center">
                                                <a class="text-center" href="{{ route ('subCategoryServices',[$service->subCategory->id])}}">

                                                    @if(App::getlocale()=='ar')
                                                    {{$service->subCategory->name_ar}}
                                                    @else
                                                    {{$service->subCategory->name}}
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
                                            @if($service->discount && $service->discount_period > Carbon\Carbon::now())
                                                <div class="product-price"> 
                                                     <span class="new-price"> {{$service->new_price ?? 'None'}} 
                                                        @if(App::getlocale()=='ar')
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
                                            @if($service->rate != null)
                                            <div class="ratings-container">
                                                <p class="ratings-text" style="font-size: 15px; color: #fcb941;">({{$service->rate->rating}} &#9734;)</p>
                                            </div><!-- End .rating-container -->
                                            @endif
                                        </div><!-- End .product-body -->
                                        @if($service->discount && $service->discount_period > Carbon\Carbon::now())
                                        <div style="font-size: 20px !important; color: white;" class="product-countdown " data-countdown="{{$service->discount_period }}" data-relative="true" data-labels-short="false"></div><!-- End .product-countdown -->
                                       @endif
                                    </div><!-- End .product -->
                                    @endif
                                    @endforeach
                                </div><!-- End .owl-carousel -->
                            </div><!-- End .col-xl-9 -->
                        </div><!-- End .row cat-banner-row -->
                       
                        
                @endforeach

                <div class="mb-5"></div><!-- End .mb-3 -->

               

                

            </div><!-- End .col-lg-9 col-xxl-10 -->
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->
</main><!-- End .main -->

@endsection