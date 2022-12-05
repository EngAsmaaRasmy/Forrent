@extends('layouts.base',['title'=>'Service details'])
<style>
    h1::before,
h1::after {
    display: inline-block;
    content: "";
    border-top: .1rem solid rgb(177, 171, 171);
    width: 33%;
    margin: 0 3rem;
    transform: translateY(-1rem);
}
@media only screen and (max-width: 1024px) {
    h1::before,
    h1::after {
        width: 25%;
        margin: 0 1rem;
    }
}
@media only screen and (max-width: 900px) {
    h1::before,
    h1::after {
        width: 25%;
        margin: 0 1rem;
    }
}
@media only screen and (max-width: 768px) {
    h1::before,
    h1::after {
        width: 25%;
        margin: 0 1rem;
    }
}
@media only screen and (max-width: 600px) {
    h1::before,
    h1::after {
        width: 20%;
        margin: 0 1rem;
    }

}

@media only screen and (max-width: 480px) {
    h1::before,
    h1::after {
        width: 10%;
        margin: 0 1rem;
    }

}

    .copy {
      position: relative;
      display: inline-block;
    }
    
    .copy .tooltiptext {
      visibility: hidden;
      width: 140px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px;
      position: absolute;
      z-index: 1;
      bottom: 150%;
      left: 50%;
      margin-left: -75px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    
    .copy .tooltiptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }
    
    .copy:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }
</style>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>

@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav" style="width: 80%; margin-left: 10%;">
        <div class="container">
            <ol class="breadcrumb">
                @php
                $customer = App\Models\Customer::where('name' , session('name'))->first();
                $service_provider = App\Models\ServiceProvider::where('token' , session('token'))->first();
            @endphp
                @if($customer && $customer->token != nulL)
                <li class="breadcrumb-item"><a href="{{route ('customer.main')}}">{{trans('site.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ route ('customer-services.index')}}">{{trans('site.services')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(App::getlocale()=='ar')
                    {{$services->title_ar}}
                     @else
                    {{$services->title}}
                   @endif</li>
                @elseif($service_provider && $service_provider->token != nulL)
                <li class="breadcrumb-item"><a href="{{route ('serviceProvider.main')}}">{{trans('site.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route ('all-services.index')}}">{{trans('site.services')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(App::getlocale()=='ar')
                    {{$services->title_ar}}
                     @else
                    {{$services->title}}
                   @endif</li>
                @else
                <li class="breadcrumb-item"><a href="{{route ('home')}}">{{trans('site.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route ('visitors.index')}}">{{trans('site.services')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(App::getlocale()=='ar')
                    {{$services->title_ar}}
                     @else
                    {{$services->title}}
                   @endif</li>
                @endif
               
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top m-auto" style="width: 80%; margin-left: 10%;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    @if($services->discount && $services->discount_period < Carbon\Carbon::now())
                                    <span class="product-label label-sale">{{$services->discount}} {{trans('site.off')}}</span>
                                    @endif
                                    <img src="{{asset('uploads/'.$services->image)}}" alt="Product image" class="product-image"  width="50px" height="100px">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h3 class="product-title">
                                @if(App::getlocale()=='ar')
                                {{$services->title_ar}}
                                 @else
                                {{$services->title}}
                               @endif
                            </h3><!-- End .product-title -->
                            @if($services->rate != null)
                            <div class="ratings-container">
                                <p  style="font-size: 20px;" class="ratings-text">
                               @for ($i = 0; $i < 5; $i++)
                                @if ($i < $services->rate->rating)
                                <span style="color:#fcb941; font-size: 27px;">&#9733;</span>
                                {{-- <i  style="color:#fcb941; font-size: 17px; content: '\2605';" class="fas fa-star"></i> --}}
                                @else
                                <span  style="color:cccccc!important; font-size: 27px;">&#9733;</span>
                                {{-- <i  style=" font-size: 17px; content: '\2605';" class="fas fa-star"></i> --}}
                                @endif
                                @endfor
                                <span style="font-size: 20px;" class="px-5">({{$countRate}} 
                                    @if(App::getlocale()=='ar')
                                      تقييمات
                                    @else
                                    Reviews 
                                    @endif )</span>
                           </p>  
                            </div><!-- End .rating-container -->
                            @endif

                            @if($services->discount && $services->discount_period < Carbon\Carbon::now())
                                                <div class="product-price"> 
                                                    <span class="new-price"> {{$services->new_price ?? 'None'}}  @if(App::getlocale()=='ar')
                                                        ج.س
                                                        @else
                                                        SDG 
                                                        @endif</span>
                                               </div>
                                               <div class="product-price"> 
                                                   <span class="old-price"> <s>{{$services->price}}  
                                                    @if(App::getlocale()=='ar')
                                                    ج.س
                                                    @else
                                                    SDG 
                                                    @endif</s></span>
                                             </div>
                                               @else
                                               <div class="product-price"> 
                                                    <span class="old-price"> {{$services->price}}  @if(App::getlocale()=='ar')
                                                        ج.س
                                                        @else
                                                        SDG 
                                                        @endif</span>
                                               </div>
                                               @endif

                            <div class="product-content">
                                <p>
                                @if(App::getlocale()=='ar')
                                {{$services->description_ar}}
                                 @else
                                 {{$services->description}}
                               @endif
                                    
                                 </p>
                            </div><!-- End .product-content -->
                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>{{trans('site.category')}} : </span>
                                    <span class="text-dark">
                                        @if(App::getlocale()=='ar')
                                        {{$category->name_ar}} | {{$services->subCategory->name_ar}} 
                                         @else
                                         {{$category->name}} | {{$services->subCategory->name}}
                                       @endif
                                       </span>
                                </div><!-- End .product-cat -->
                            </div><!-- End .product-details-footer -->
                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>{{trans('site.address')}} : </span>
                                    <span class="text-dark">  @if(App::getlocale()=='ar')
                                        {{$services->area->name_ar}} | {{$services->area->city->name_ar}}  
                                       @else
                                       {{$services->area->name}}  | {{$services->area->city->name}} 
                                       @endif</span>
                                </div><!-- End .product-cat -->
                            </div>
                        <div class="product-details-footer row d-flex justify-content-start">
                                <div class="input-group">
                                    <input id="myInput" disabled class="form-control" value="{{url("/single-service/{$services->id}")}}"> 
                                    <div class="copy">
                                        <button class="btn btn-primary" onclick="myFunction()" onmouseout="outFunc()"><img src="https://img.icons8.com/external-becris-lineal-becris/64/000000/external-copy-mintab-for-ios-becris-lineal-becris.png" width="20px" height="10px"/></button>
                                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                    </div> 
                                </div>
                        </div><!-- .End .input-group --> 
                        @php
                        $customer = App\Models\Customer::where('name' , session('name'))->first();
                        $service_provider = App\Models\ServiceProvider::where('token' , session('token'))->first();
                        @endphp
                        @if($customer && $customer->token != nulL)
                        {{-- @if($services->rate == null) --}}
                        <div class="product-details-footer">
                            <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#add{{$services->id}}">
                                {{trans('site.add_review')}}
                             </button>
                        </div>
                        {{-- @endif        --}}
                        @endif
                    </div><!-- End .product-details -->
                 </div><!-- End .col-md-6 -->
                 @include('customers.add-review') 
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->
        <div class="row mt-5">
            <div class=" col-md-9 m-auto bg-lighter trending-products">
                <div class="heading mb-3">
                    <div class="heading-center">
                        <h1 class="title text-center">{{trans('site.also_like')}}</h1><!-- End .title -->
                    </div><!-- End .heading-left -->
                </div><!-- End .heading -->
                <div class="tab-content tab-content-carousel">
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
                            @foreach ($suggests as $suggest_service)
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{route ('single-service', [$suggest_service->id])}}">
                                        <img src="{{asset('uploads/'.$suggest_service->image)}}" alt="Product image" class="product-image">
                                    </a>

                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <p>@if(App::getlocale()=='ar')
                                            {{$suggest_service->subCategory->name_ar}}
                                            @else
                                            {{$suggest_service->subCategory->name}}
                                        @endif</p>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">@if(App::getlocale()=='ar')
                                        {{$suggest_service->title_ar}}
                                        @else
                                        {{$suggest_service->title}}
                                    @endif</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        {{$suggest_service->price}}
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->    
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div>
                </div>
            </div>

        </div>
          
    </div><!-- End .page-content -->
</main><!-- End .main -->
@section('sticky-bar')
<!-- Sticky Bar -->
<div class="sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <figure class="product-media">
                    <a href="{{route ('single-service', [$suggest_service->id])}}">
                        <img src="{{asset('uploads/'.$services->image)}}" alt="Product image" height="4vh" class="product-image">
                    </a>
                </figure><!-- End .product-media -->
                <h4 class="product-title"> @if(App::getlocale()=='ar')
                    {{$services->title_ar}}
                     @else
                    {{$services->title}}
                   @endif</h4><!-- End .product-title -->
            </div><!-- End .col-6 -->

            <div class="col-6 justify-content-end">
                <div class="product-price">
                    @if(App::getlocale()=='ar')
                    ج.س
                    @else
                    SDG 
                    @endif  {{$services->price}} 
                </div><!-- End .product-price -->
                <div class="product-details-quantity"> 
            </div><!-- End .col-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .sticky-bar -->
@endsection

@endsection

