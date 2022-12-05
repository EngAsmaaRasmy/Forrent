@extends('layouts.base' ,['title'=>'Services'])
<script>
  $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
</script>
<style>
     .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin: 0px 30px;
   }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 32px;
  width: 32px;
  left: 1px;
  bottom: 1px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

  input:checked + .slider {
    background-color: #fcb941;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #fcb941;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
    .span{
        color: red;
    }
</style>
@section('main')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
<div class="container">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route ('serviceProvider.main')}}">{{trans('site.dashboard')}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{trans('site.my_services')}}</li>
  </ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<!-- row -->
                    <!-- row opened -->
                    <div class="row">
                      <aside class="col-md-3 col-lg-3 mx-5">
                            @include('serviceproviders.navbar')
                      </aside>
                        <div class="col-md-8 col-lg-8" >
                            <div class="">
                                <div class="card-header">
                                    @if ($errors->any())
                                    <div class="alert alert-danger col-md-11 rounded mx-4" role="alert" id="success-alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                   @endif
                                    <div class="d-flex justify-content-between">
                                        <h4  class="m-3 ">
                                            {{trans('site.all_services')}}
                                         <h4>
                                    </div>
                                </div>
                               
                                    <div class="table-responsive overflow-auto">
                                        <table class="table table-borderless">
                                            
                                            <tr class="text-center">
                                                <th width="70px">{{trans('site.service_no')}}</th>
                                                <th width="100px">{{trans('site.image')}}</title></th>
                                                @if(App::getlocale()=='ar')
                                                <th width="300px">{{trans('site.title_ar')}}</title></th>
                                                @else
                                                <th width="300px">{{trans('site.title')}}</title></th>
                                                @endif
                                                {{-- <th class=" border-bottom-0">Description</th> --}}
                                                <th width="70px">{{trans('site.price')}}</th>
                                                {{-- <th class=" border-bottom-0">Period unit</th> --}}
                                                <th width="70px">{{trans('site.discount')}}</th>
                                                <th width="150px">{{trans('site.discount_period')}}</th>
                                                {{-- <th width="70px">{{trans('site.area')}}</th>
                                                <th width="100px">{{trans('site.sub_category')}}</th> --}}
                                                <th class="50px">{{trans('site.status')}}</th>
                                                <th width="20px" >{{trans('site.action')}}</th>
                                                
                                            </tr>
                                           @foreach($services as $service)
                                               <tr class="text-center">
                                                   <td class="">{{$loop->iteration}}</td>
                                                   <td class="text-center">
                                                   	    <figure >                                    
                                                           <a href="{{route ('single-service', [$service->id])}}">
                                                               <img src="{{asset('uploads/'.$service->image)}}" alt="Product image"  width="100" height="25">
                                                           </a>                                
                                                     </figure><!-- End .product-media -->
                                                   </td>
                                                   <td class="">
                                                    @if(App::getlocale()=='ar')
                                                    {{$service->title_ar}}
                                                    @else
                                                    {{$service->title}}
                                                    @endif
                                                   </td>
                                                   <td class="">{{ $service->price}}</td>
                                                   <td class="">{{ $service->discount}}</td>
                                                   <td class="">{{ $service->discount_period}}</td>
                                                    @if($service->disabled == 1)
                                                    <td class=""> <label class="switch">
                                                        <input data-action="disabled" type="checkbox" name="disabled" checked>
                                                        <span class="slider round"></span>
                                                      </label></td>
                                                      @else
                                                    <td class=""> <label class="switch">
                                                        <input data-action="disabled" type="checkbox" name="disabled" >
                                                        <span class="slider round"></span>
                                                      </label></td>
                                                    @endif
                                                      
                                                   <td width="100px">
                                                       <button class="btn btn-primary btn-sm" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$service->id}}">{{trans('site.edit')}}</button>
                                                       <br>
                                                       <br>
                                                       <button class="modal-effect btn btn-sm btn-danger btn-sm" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$service->id}}">{{trans('site.delete')}}</button>
                                                   </td>
                                               </tr>

                                               @include('serviceproviders.services.edit')
                                               @include('serviceproviders.services.delete')

                                           @endforeach
                                           
                                        </table>
                                    </div>
                               
                            </div><!-- bd -->
                        </div>
                        <!--/div-->

                   
                    <!-- /row -->

				</div>
				<!-- row closed -->

			<!-- Container closed -->

		<!-- main-content closed -->
@endsection

