@extends('layouts.base',['title'=>'Privacy of For rent'])

@section('main')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route ('home')}}">{{trans('site.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ route ('show.register.form')}}">{{trans('site.sign_up')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(App::getlocale()=='ar')
                   الشروط والأحكام
                     @else
                   Privacy Policy
                   @endif</li> 
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('assets/images/backgrounds/login-bg.jpg')}})">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 text-dark rounded border-3" style="background-color:white; padding:40px;">
                     @if(App::getlocale()=='ar')
                        <h3>شروط الخدمة</h3>


                        <div  style="margin-bottom: 30px!important;"><span >آخر تحديث: 22 يناير 2022</span></div>
                        
                        
                        
                        <p style=" line-height: 50px">                   توافق أنت  على أن وصولك إلى موقع الويب الموجود على https://test.4rentsd.com/ واستخدامك له يخضع لموافقتك على شروط الخدمة هذه . لتسهيل قراءة شروط الخدمة هذه ، تمت الإشارة إلى موقع الويب المشار إليه سابقًا باسم "موقع الويب" والخدمات التي نقدمها من خلال موقع الويب يتم إحالتها إلى "الخدمات". يخضع استخدامك لموقع الويب أو الخدمات لموافقتك على شروط الخدمة هذه ، والتي ستصبح اتفاقية ملزمة بينك وبيننا ("الاتفاقية"). نحن نرغب في السماح لك بالوصول إلى موقع الويب وتقديم الخدمات فقط بشرط أنك تقبل جميع شروط هذه الاتفاقية. يرجى قراءة هذه الشروط بعناية. بعد قراءة الشروط ، إذا كنت توافق على شروط الخدمة ، فيرجى توضيح قرارك عن طريق النقر على مربع الاختيار الموجود في نموذج تسجيل / تسجيل الحساب التالي للبيان الذي يقرأ "لقد قرأت ووافقت على شروط الخدمة". إذا كنت لا توافق ، فلن تكون قادرًا على إنشاء حساب واستخدام خدماتنا. إذا كنت قد أنشأت حسابًا مسبقًا ، فقد يُطلب منك الموافقة على شروط الخدمة هذه قبل السماح لك بالوصول إلى أي من الخدمات. في جميع الحالات ، عن طريق الوصول إلى موقعنا أو عرضه أو استخدامه ، فإنك توافق على شروط الخدمة.
                        
                        
                            الخدمات متاحة فقط للأشخاص الذين يمكنهم إبرام عقود ملزمة قانونًا بموجب القانون المعمول به. بدون تقييد ما سبق ، لا تتوفر الخدمات للأفراد الذين تقل أعمارهم عن 18 عامًا. إذا كان عمرك أقل من 18 عامًا ، فلا يُسمح لك باستخدام الخدمات.</p>
     
                        @else
                        <h3>Terms of Service</h3>


                        <div  style="margin-bottom: 30px!important"><span></span>LAST UPDATED: January 22, 2022</span></div>
                        



                        
                        
                        
                        <p style=" line-height: 30px"> 
                        YOU AGREE THAT YOUR ACCESS TO AND USE OF THE WEB SITE LOCATED AT http://test.4rentsd.com/, IS SUBJECT TO YOUR AGREEMENT TO THESE TERMS OF SERVICE. TO MAKE THESE TERMS OF SERVICE EASIER TO READ, THE FOREGOING REFERENCED WEB SITE IS REFERRED TO AS THE “WEB SITE” AND THE SERVICES PROVIDED BY US THROUGH THE WEB SITE ARE REFERRED TO AS THE “SERVICES.” YOUR USE OF THE WEB SITE OR THE SERVICES IS SUBJECT TO YOUR AGREEMENT TO THESE TERMS OF SERVICE, WHICH WILL BECOME A BINDING AGREEMENT BETWEEN YOU AND US (THE "AGREEMENT"). WE ARE WILLING TO ALLOW YOU ACCESS TO THE WEB SITE AND PROVIDE THE SERVICES ONLY UPON THE CONDITION THAT YOU ACCEPT ALL OF THE TERMS OF THIS AGREEMENT. PLEASE READ THESE TERMS CAREFULLY. AFTER READING THE TERMS, IF YOU AGREE TO THE TERMS OF SERVICE, PLEASE INDICATE YOUR DECISION BY CLICKING THE CHECKBOX ON THE ACCOUNT SIGN UP/REGISTRATION FORM NEXT TO THE STATEMENT THAT READS “I have read and agreed to the Terms of Service.” IF YOU DO NOT AGREE, YOU WILL NOT BE ABLE TO ESTABLISH AN ACCOUNT AND USE OUR SERVICES. IF YOU HAVE PREVIOULY SET UP AN ACCOUNT, YOU MAY BE REQUIRED TO AGREE TO THESE TERMS OF SERVICE PRIOR TO BEING ALLOWED ACCESS TO ANY OF THE SERVICES. IN ALL CASES, BY ACCESSING, VIEWING OR USING OUR SITE, YOU AGREE TO THE TERMS OF SERVICE.
                        
                        
                        The Services are available only to persons who can form legally binding contracts under applicable law. Without limiting the foregoing, the Services are not available to individuals under the age of 18. If you are under 18, then you are not permitted to use the Services.
                        </p>
                        @endif
                </div>
            </div>

        </div>


    </div>

</main><!-- End .main -->

@endsection