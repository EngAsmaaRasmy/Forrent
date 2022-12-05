@extends('layouts.base',['title'=>'Contact with For Rent'])
<style>
    .product {
        box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
    }
    .text a 
    {
        font-size: 2rem !important;

    }
    .text i
    {
        font-size: 2.2rem !important;

    }

</style>

@section('main')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('site.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('site.contact_us')}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div id="map"><div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=khartom&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fridaynightfunkin.net/friday-night-funkin-mods-fnf-play-online/">FNF Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:100%;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:100%;}.gmap_iframe {height:100%!important;}</style></div></div><!-- End #map -->
    <div class="page_content bg-image  pb-8 pt-md-12 pb-md-12 pt-lg-6 pb-lg-6" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}});">
        <div class="page-content">
            <div class="container">
                <div class="touch-container row justify-content-center my-5">
                    <div class="col-md-9 col-lg-7">
                        <div class="text-center">
                        <h4 class="title mb-1" style="color: rgb(245, 236, 236) !important; font-size: 50px !important;">{{trans('site.get_in_touch')}}</h4><!-- End .title mb-2 -->
                        <p class="lead" style="color: white !important; font-size: 25px !important;">
                            {{trans('site.contact_p')}}  
                        </p><!-- End .lead text-primary -->
                        </div><!-- End .text-center -->
                    </div><!-- End .col-md-9 col-lg-7 -->
                </div><!-- End .row -->
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 product mx-5 py-5">
                        <div class="contact-box text-center text">
                            <h4 style="color: #fcb941;">{{trans('site.mobile')}}</h4>
                            <div><i class="icon icon-phone" style=""></i>
                                <a href="tel:{{$info->phone}}"><span style=" direction: ltr !important; unicode-bidi: embed;">{{$info->phone}}</span></a>
                        </div>
                        </div><!-- End .contact-box -->
                    </div><!-- End .col-md-3 -->
                    <div class="col-md-3 product mx-5 py-5">
                        <div class="contact-box text-center">
                            <h4 style="color: #fcb941;">{{trans('site.email')}}</h4>
    
                            <div class="text">
                                <i class="icon icon-envelope" style=""></i><a class="mx-3" href="mailto:{{$info->email}}">{{$info->email ?? 'None'}}</a>
                            </div>
                        </div><!-- End .contact-box -->
                    </div><!-- End .col-md-3 -->
                    <div class="col-md-3 product mx-5 py-5">
                        <div class="contact-box text-center">
                            <h4 style="color: #fcb941;">{{trans('site.address')}}</h4>
    
                            <div class="text">
                                <i class="icon icon-map-marker" style=""></i><a>
                                    @if(App::getlocale()=='ar')
                                    {{$info->address_ar ?? 'None'}}
                                    @else
                                    {{$info->address ?? 'None'}}
                                    @endif</a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .contact-box -->
                    </div><!-- End .col-md-3 -->
                </div><!-- End .row -->
    
                
            </div><!-- End .container -->
        </div>
        
    </div>
    
    
</main><!-- End .main -->

@endsection