<!DOCTYPE html>
<html lang="en" @if(App::getlocale()=='en') dir="ltr" @else dir="rtl" @endif>


<!-- molla/index-14.html  22 Nov 2019 09:59:31 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @if(isset($title))
            {{ $title }}
        @endif 
     </title>
    <link rel="icon" href="{{asset('assets/images/demos/demo-14/logo.png')}}" type="image/icon type">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="ForRent online services, Market, store">
    <meta name="author" content="">
    <!-- Favicon -->
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="{{ asset('assets/images/icons/safari-pinned-tab.svg')}}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico')}}">
    <meta name="apple-mobile-web-app-title" content="ForRent">
    <meta name="application-name" content="ForRent">
    <meta name="msapplication-TileColor" content="#cc9966">
    {{-- <meta name="msapplication-config" content="{{ asset('assets/images/icons/browserconfig.xml')}}"> --}}
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery.countdown.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Main CSS File -->
    
    @if(App::getlocale()=='en')
 
    <link rel="stylesheet" href="{{ asset('assets/css/ltr.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-demo-14ltr.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouisliderltr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demos/demo-14ltr.css')}}">
    @else
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css')}}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-demo-14rtl.css')}}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouisliderrtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demos/demo-14rtl.css')}}">

    <style>
       *
       {
        font-family: 'Droid Arabic Kufi', serif !important;      
       }
       li
        {
            text-align:right;
        }
       select{
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1rem !important;
        padding: 0.1rem 2rem 0.1rem 4rem !important;
        }
       
    </style>
    @endif
    <style>
         html, body
         {
            background: rgb(250, 250, 250);
            
         }
         
        .input-control input:focus {
            outline: 0;
        }
    
        input:required:valid , select:required:valid  ,textarea:required:valid{
            border-color: #dadada;
         }
        input:required:invalid ,select:required:invalid ,textarea:required:invalid {
            border-color: #fcb941;
        } 
        .product-media img
        {
            height: 42vh;
        }
        .button-18 {
                align-items: center;
                background-color: rgba(0, 0, 0, .08);
                border: 0;
                border-radius: 100px;
                box-sizing: border-box;
                color: #333 !important;
                cursor: pointer;
                display: inline-flex;
                justify-content: center;
                line-height: 20px;
                max-width: 480px;
                min-height: 40px;
                min-width: 0px;
                overflow: hidden;
                padding: 0px;
                padding-left: 20px;
                padding-right: 20px;
                text-align: center;
                touch-action: manipulation;
                user-select: none;
                -webkit-user-select: none;
                vertical-align: middle;
                }
                .button-18:hover,
                .button-18:focus { 
                background-color: #333;
                color: #ffffff !important;
                }

                .button-18:active {
                background: #333;
                color: rgb(255, 255, 255, .7);
                }

                .button-18:disabled { 
                cursor: not-allowed;
                background: rgba(0, 0, 0, .08);
                color: rgba(0, 0, 0, .3);
                }
        .favorite img
        {
            height: 30vh;
        }
        .header-search .search-custom {
        flex: 0 0 500px;
        width: 100% !important;
        padding-right: 0;
        margin: 0;
        align-self: center;
         }
        .input-group ,.input-control{
        position:relative;
        }
        .sticky-bar .product-media img
        {
            height: 8vh;
        }
        @media only screen and (max-width: 600px) {
            .product-media img
            {
                height: 30vh;
            }
        }
}
    </style>
     @if(App::getlocale()=='en')
     <style>
       .lang{
         font-family: 'Noto Kufi Arabic', sans-serif;
       }
     </style>
     @elseif(App::getlocale()=='ar')
     <style>
      .lang{
       font-family: 'Poppins', sans-serif;
       }
     </style>
     @endif

    <script src="https://use.fontawesome.com/31a535df83.js"></script>

</head>

<body>
    <div class="page-wrapper">
        <header class="header header-14">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                    @if(session()->has('message'))
                    <div class="alert alert-success col-md-9 m-4 px-5 rounded" id="success-alert">
                         {{ session()->get('message') }}
                    </div>
                    @endif
                        <a href="tel:{{$info->phone}}"><i class="icon-phone"></i>{{trans('site.call')}} : <span style=" direction: ltr !important; unicode-bidi: embed;">{{$info->phone}}</span></a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#" class="sf-with-ul">{{trans('site.links')}}</a>
                                <ul class="menus text-center">
                                    <li style="margin: 0px !important;"> 
                                        @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                        <a class="lang button-18" href="{{ route('lang.switch', $lang) }}">
                                            {{$language['display']}} </a>
                                            {{-- <img src="{{asset($language['img'])}}"> --}}
                                            <!-- HTML !-->
                                        @endif
                                        @endforeach
                                    @php
                                        $customer = App\Models\Customer::where('name' , session('name') )->first();
                                        $service_provider =App\Models\ServiceProvider::where('token' , session('token'))->first();
                                    @endphp
                                    <li class="login megamenu-container ">
                                        <div class="header-dropdown">
                                            @if($customer && $customer->token != nulL)
                                            <a>
                                                <img src="{{asset('assets/images/backgrounds/profile.jpg')}}" alt="ForRent Logo" width="35" height="30">
                                                {{$customer->name}}
                                            </a>
                                            <div class="header-menu">
                                                <ul class="p-3">
                                                    {{-- @if(session('name') == $service_provider->name) --}}
                                                    <li class="mb-1"><a href="{{ route('customer.logout') }}">{{trans('site.log_out')}}</a></li> 
                                                    <li><a href="{{route ('customer.main')}}">{{trans('site.dashboard')}}</a></li> 
                                                </ul>
                                            </div><!-- End .header-menu --> 
                                            @elseif($service_provider && $service_provider->token != nulL)
                                            <a>
                                                <img src="{{asset('assets/images/backgrounds/profile.jpg')}}" alt="ForRent Logo" width="40" height="40">
                                                {{$service_provider->name}}
                                            </a>
                                            <div class="header-menu">
                                                <ul class="p-3">
                                                    {{-- @if(session('name') == $service_provider->name) --}}
                                                    <li class="mb-1"><a href="{{ route('service.provider.logout') }}">{{trans('site.log_out')}}</a></li> 
                                                    <li><a href="{{route ('serviceProvider.main')}}">{{trans('site.dashboard')}}</a></li> 
                                                </ul>
                                            </div><!-- End .header-menu --> 
                                        </div>
                                    </li>
                                     @else
                                     <style>
                                         .login ,.header-dropdown
                                         {
                                             display: none;
                                         }

                                     </style>
                                     <li class="my-3">
                                        <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('login') }}'">{{trans('site.log_in')}}</button>
                                     </li>
                                     {{-- <li>
                                        <button  class="btn btn-dark rounded"  onclick= "location.href='{{ url ('sign-up') }}'">{{trans('site.sign_up')}}</button>
                                     </li>       --}}
                                     @endif 
                                    
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-auto col-lg-3 col-xl-3 col-xxl-2">
                            <button class="mobile-menu-toggler">
                                <span class="sr-only">Toggle mobile menu</span>
                                <i class="icon-bars"></i>
                            </button>
                            <a href="{{route ('home')}}" class="logo text-center">
                                <img src="{{asset('assets/images/demos/demo-14/logo.png')}}" alt="ForRent Logo" width="120" height="30">
                                <p style="font-size: 12px;">{{trans('site.rent')}}</p>
                            </a>
                        </div><!-- End .col-xl-3 col-xxl-2 -->
                    
                        <div class="col col-lg-9 col-xl-9 col-xxl-10 header-middle-right">
                            <div class="row">
                                <div class="col-lg-8 col-xxl-4-5col d-none d-lg-block">
                                    <div class="header-search header-search-extended header-search-visible header-search-no-radius">
                                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                        <form action="{{route ('services.search')}}">
                                            {{ csrf_field() }}
                                            <div class=" header-search-wrapper search-wrapper-wide">
                                                <div class="select-custom">
                                                    <select id="cat" name="category_id">
                                                        <option value="">{{trans('site.all_departments')}}</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            @if(App::getlocale()=='ar')
                                                            {{ $category->name_ar }}
                                                            @else
                                                            {{ $category->name}}
                                                            @endif
                                                        </option> 
                                                        @endforeach
                                                    </select>
                                                </div><!-- End .select-custom -->
                                                <div class="select-custom">
                                                    <select id="cat" name="area_id">
                                                        <option value="">{{trans('site.all_area')}}</option>
                                                        @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}">
                                                            @if(App::getlocale()=='ar')
                                                            {{ $area->name_ar }}
                                                            @else
                                                            {{ $area->name}}
                                                            @endif
                                                        </option> 
                                                        @endforeach
                                                    </select>
                                                </div><!-- End .select-custom -->
                                                <div class="input-group  search-location ">
                                                    <input type="search" name ="search"class="form-control py-3 mr-3" placeholder="{{trans('site.search_product')}} ..." >   
                                                </div><!-- .End .input-group --> 
                                                 <div class="input-group-append">
                                                    <button class="btn btn-dark" type="submit"><i class="icon-search"></i></button>
                                                </div>                          
                                                    <!-- bd -->
                                            </div><!-- End .header-search-wrapper -->
                                        </form>
                                    </div><!-- End .header-search -->
                                </div><!-- End .col-xxl-4-5col -->

                                <div class="col-lg-4 col-xxl-5col d-flex justify-content-end align-items-center">
                                    <div class="header-dropdown-link">
                                      @php
                                         $customer_id = session('id');
                                          $customer = App\Models\Customer::where('name' , session('name'))->first();
                                          $favorite = App\Models\CustomerServiceFavorite::all()
                                          ->where('customer_id',$customer_id); 
                                      @endphp
                                        @if($service_provider && $service_provider->token != null)
                                        <button  class="btn btn-primary  py-3" style="color: #333 !important;
                                        text-transform: uppercase;
                                        letter-spacing: 0;"  onclick= "window.location='{{ route ('service-provider-add-service') }}'">{{trans('site.post_an_ad')}}</button>
                                        @elseif($customer && $customer->token != nulL)
                                        <a href="{{route ('favorite-services.index')}}" class="wishlist-link">
                                            <i class="icon-heart-o"></i>
                                            <span class="wishlist-count">{{count($favorite)}}</span>
                                            <span class="wishlist-txt">{{trans('site.wishlist')}}</span>
                                        </a>
                                        @else
                                        <button  class="btn btn-primary py-3" style="color: #333 !important;
                                        text-transform: uppercase;
                                        letter-spacing: 0;"  onclick= "location.href='{{ url ('login') }}'">{{trans('site.post_an_ad')}}</button>
                                        @endif
                                    </div>
                                </div><!-- End .col-xxl-5col -->
                            </div><!-- End .row -->
                        </div><!-- End .col-xl-9 col-xxl-10 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-auto col-lg-3 col-xl-3 col-xxl-2 header-left">
                            <div class="dropdown category-dropdown show is-on" data-visible="false">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="" title="Browse Categories">
                                    {{trans('site.browse_categories')}}
                                </a>
            
                                <div class="dropdown-menu ">
                                    <nav class="side-nav">
                                        <ul class="menu-vertical sf-arrows">
                                            @foreach ($categories as $category)
                                                @if ($category->subCategories()->count() > 0)
                                                    <li class="megamenu-container {{ request()->is('/') ? 'colorlib-active' : '' }}">
                                                        <a class="sf-with-ul" href="{{ route ('categoryServices',[$category->id])}}"><i class="icon-tshirt"></i>
                                                            @if(App::getlocale()=='ar')
                                                            {{$category->name_ar}}
                                                            @else
                                                            {{$category->name}}
                                                            @endif
                                                        
                                                        </a> 
                                                        <div class="megamenu col-md-8">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-8 col-lg">
                                                                    <div class="menu-col">
                                                                        <div class="row">
                                                                            
                                                                                <ul>
                                                                                    <?php 
                                                                                        $subCategories = App\Models\SubCategory::where('category_id' , $category->id)->get();
                                                                                    ?>
                                                                                    @foreach ($subCategories as $subCategory)
                                                                                    <li><a href="{{ route ('subCategoryServices',[$subCategory->id])}}">
                                                                                        @if(App::getlocale()=='ar')
                                                                                        {{$subCategory->name_ar}}
                                                                                        @else
                                                                                        {{$subCategory->name}}
                                                                                        @endif
                                                                                        </a></li>
                                                                                    @endforeach
                                                                                    
                                                                                    
                                                                                </ul>

                                                                        </div><!-- End .row -->
                                                                    </div><!-- End .menu-col -->
                                                                </div><!-- End .col-md-8 -->
                    
                                                               
                                                            </div><!-- End .row -->
                    
                                                            
                                                        </div><!-- End .megamenu --> 
                                                    
                                                    </li>      
                                                    
                                                @else 
                                                    <li><a href="#"><i class="icon-blender"></i>{{ $category->name }}</a></li>
                                                        
                                                @endif

                                                
                                                
                                            @endforeach
                                            

                                        </ul><!-- End .menu-vertical -->
                                    </nav><!-- End .side-nav -->
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .category-dropdown -->
                        </div><!-- End .col-xl-3 col-xxl-2 -->
            
                        <div class="col col-lg-6 col-xl-6 col-xxl-8 header-left" id="menu">
                            <nav class="main-nav">
                                <ul class="menu sf-arrows">
                                    <li class="megamenu-container {{ Request::is('/') ? 'active' : '' }}">
                                        <a href="{{route ('home')}}">{{trans('site.home')}}</a>
            
                                    </li>
            
                                    <li class="megamenu-container {{ request()->is('about-us') ? 'active' : '' }}">
                                        <a href="{{route ('about-us')}}">{{trans('site.about_us')}}</a>
            
                                    </li>
            
            
                                    <li class="megamenu-container {{ Request::is('all-services') ? 'active' : '' }}">
                                        @if($service_provider && $service_provider->token != nulL)
                                        <a href="{{ route ('all-services.index') }}">{{trans('site.my_services')}}</a>
                                        @else
                                        <a href="{{ route ('visitors.index') }}">{{trans('site.services')}}</a>
                                        @endif
            
                                    </li>
                                    <li>
                                        
                                        <a href="#" class="sf-with-ul">{{trans('site.categories')}}</a>
            
                                        <ul class="menu-vertical sf-arrows">
                                            @foreach ($categories as $category)
                                            @if ($category->subCategories()->count() > 0)
                                            <li>
                                                <a class="sf-with" href="{{ route ('categoryServices',[$category->id])}}"><i class="icon-tshirt"></i>
                                                    @if(App::getlocale()=='ar')
                                                    {{$category->name_ar}}
                                                    @else
                                                    {{$category->name}}
                                                    @endif
                                                
                                                </a> 
                                                {{-- <div class="megamenu col-md-12 col-lg-12">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-8" >
                                                            <div class="menu-col">
                                                                <div class="row">
                                                                    
                                                                        <ul>
                                                                            <?php 
                                                                                $subCategories = App\Models\SubCategory::where('category_id' , $category->id)->get();
                                                                            ?>
                                                                            @foreach ($subCategories as $subCategory)
                                                                            <li class="megamenu-container">
                                                                                <a href="{{ route ('subCategoryServices',[$subCategory->id])}}">
                                                                                    @if(App::getlocale()=='ar')
                                                                                        {{$subCategory->name_ar}}
                                                                                    @else
                                                                                        {{$subCategory->name}}
                                                                                     @endif
                                                                                
                                                                                </a>
                                                                            </li>
                                                                            @endforeach 
                                                                            
                                                                        </ul>

                                                                </div><!-- End .row -->
                                                            </div><!-- End .menu-col -->
                                                        </div><!-- End .col-md-8 -->
            
                                                       
                                                    </div><!-- End .row -->
            
                                                    
                                                </div><!-- End .megamenu -->  --}}
                                            
                                            </li>      
                                            
                                            @else 
                                            <li><a href="#"><i class="icon-blender"></i>
                                            @if(App::getlocale()=='ar')
                                                {{$category->name_ar}}
                                            @else
                                                {{$category->name}}
                                             @endif</a></li>
                                                
                                        @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    
                                    <li class="megamenu-container {{ Request::is('contact-us') ? 'active' : '' }} " style="">
                                        <a href="{{route ('contact-us')}}">{{trans('site.contact_us')}}</a>
                                    </li>
            
                                </ul><!-- End .menu -->
                                
                            </nav><!-- End .main-nav -->
                            
                        </div><!-- End .col-xl-9 col-xxl-10 -->
                        
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->

@yield('main')
        <footer class="footer">
            <div class="cta cta-horizontal cta-horizontal-box bg-dark bg-image" style="background-image: url('assets/images/demos/demo-14/bg-1.jpg'); padding:0px !important;">

            <div class="footer-middle border-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="widget widget-about">
                                <img src="{{asset('assets/images/demos/demo-14/logo.png')}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                                <p style=" height:60px;
                                line-height:20px;
                                overflow:hidden;" >  
                                @if(App::getlocale()=='ar')
                                    {{$info->about_Ar}}
                                    @else
                                    {{$info->about}}
                                    @endif
                                </p>
                                <div class="widget-about-info">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <span class="widget-about-title" style="color: white !important;" >{{trans('site.got')}} {{trans('site.call_us')}}</span>
                                            <a  class="call" href="tel:{{$info->phone}}"><i class="icon-phone px-3 "></i><span style=" direction: ltr !important; unicode-bidi: embed;">{{$info->phone}}</span></a>
                                        </div><!-- End .col-sm-6 -->
                                    </div>
                                </div><!-- End .widget-about-info -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-12 col-lg-4 -->

                        <div class="col-sm-4 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title" style="color: white !important;">{{trans('site.useful_links')}}</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="{{route ('about-us')}}">{{trans('site.about_us')}} ForRent</a></li>
                                    <li><a href="{{route ('contact-us')}}">{{trans('site.contact_us')}}</a></li>
                                    <li><a href="{{ route ('visitors.index') }}">{{trans('site.services')}}</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->

                        

                        <div class="col-sm-4 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title" style="color: white !important;">{{trans('site.my_account')}}</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="{{route ('show.register.form')}}">{{trans('site.sign_up')}}</a></li>
                                    <li><a href="{{route ('show.login.form')}}">{{trans('site.log_in')}}</a></li>
                                    @if($customer && $customer->token != nulL)
                                    <li><a href="{{route ('favorite-services.index')}}">{{trans('site.wishlist')}}</a></li>
                                    @endif
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container-fluid">
                    <p class="footer-copyright text-center">{{trans('site.copy')}}</p><!-- End .footer-copyright -->
                </div><!-- End .container-fluid -->
            </div><!-- End .footer-bottom -->

            @yield('sticky-bar')
            </div>
            
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="{{route ('services.mobileSearch')}}" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">{{trans('site.search_product')}} </label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="{{trans('site.search_product')}}..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">{{trans('site.menu')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">{{trans('site.categories')}}</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="{{route ('home')}}">{{trans('site.home')}}</a>
                            </li>
                            <li>
                                @if($service_provider && $service_provider->token != nulL)
                                <a href="{{ route ('all-services.index') }}">{{trans('site.services')}}</a>
                                @else
                                <a href="{{ route ('visitors.index') }}">{{trans('site.services')}}</a>
                                @endif
                                <ul>
                                    @foreach ($firstServices as $service)
                                        <li><a href="{{route ('single-service', [$service->id])}}">@if(App::getlocale()=='ar')
                                            {{$service->title_ar}}
                                        @else
                                            {{$service->title}}
                                         @endif</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#">{{trans('site.pages')}}</a>
                                <ul>
                                    <li>
                                        <a href="{{route ('about-us')}}">{{trans('site.about_us')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route ('contact-us')}}">{{trans('site.contact_us')}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            @foreach ($categories as $category)
                                            @if ($category->subCategories()->count() > 0)
                                            <li class="megamenu-container">
                                                <a class="sf-with-ul" href="{{ route ('categoryServices',[$category->id])}}"><i class="icon-tshirt"></i>
                                                    @if(App::getlocale()=='ar')
                                                    {{$category->name_ar}}
                                                    @else
                                                    {{$category->name}}
                                                    @endif
                                                
                                                </a> 
                                                <div class="megamenu col-md-12 col-lg-12">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-8" >
                                                            <div class="menu-col">
                                                                <div class="row">
                                                                    
                                                                        <ul>
                                                                            <?php 
                                                                                $subCategories = App\Models\SubCategory::where('category_id' , $category->id)->get();
                                                                            ?>
                                                                            @foreach ($subCategories as $subCategory)
                                                                            <li class="megamenu-container">
                                                                                <a href="{{ route ('subCategoryServices',[$subCategory->id])}}">
                                                                                    @if(App::getlocale()=='ar')
                                                                                        {{$subCategory->name_ar}}
                                                                                    @else
                                                                                        {{$subCategory->name}}
                                                                                     @endif
                                                                                
                                                                                </a>
                                                                            </li>
                                                                            @endforeach 
                                                                            
                                                                        </ul>

                                                                </div><!-- End .row -->
                                                            </div><!-- End .menu-col -->
                                                        </div><!-- End .col-md-8 -->
            
                                                       
                                                    </div><!-- End .row -->
            
                                                    
                                                </div><!-- End .megamenu --> 
                                            
                                            </li>      
                                            
                                            @else 
                                            <li><a href="#"><i class="icon-blender"></i>
                                                @if(App::getlocale()=='ar')
                                                    {{$category->name_ar}}
                                                @else
                                                    {{$category->name}}
                                                @endif</a></li>
                                                
                                            @endif
                             @endforeach                                           
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the ForRent eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    @include('layouts.script')

</body>


<!-- Forrent.app/index-14.html  22 Nov 2019 09:59:54 GMT -->
</html>