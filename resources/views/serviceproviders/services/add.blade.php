@extends('layouts.base',['title'=>'Add Service'])

@section('main')
<style>
    Label
    {
      font-size: 15px;
    }
    INPUT
    {
      font-size: 13px;
    }
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 25px;
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
  height: 23px;
  width: 25px;
  left: 4px;
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
<!-- row -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
  <div class="container">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route ('serviceProvider.main')}}">{{trans('site.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{{ route ('all-services.index') }}">{{trans('site.services')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{trans('site.add_service')}}</li>
      </ol>
  </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="row">
  <aside class="col-md-3 col-lg-3 mx-5">
    @include('serviceproviders.navbar')
</aside><!-- End .col-lg-3 -->
<div class="col-md-7 col-lg-8">
  <h3 class="text-center py-3 mb-2 rounded" style="background-color: #ccc;">
    @if(App::getlocale()=='ar')
    {{$dayCost->cost ??  '...'}} سعر الإيجار لهذا اليوم
    @else
    Rental price for today {{$dayCost->cost ??  '...'}}
    @endif
  </h3>
                    <form action="{{ route('all-services.store') }}" method="post" autocomplete="off" class="form mb-5" enctype="multipart/form-data">
                      <h5 for="name">{{trans('site.important')}} <span class="span">*</span> {{trans('site.required')}}</h5>
                      {{csrf_field() }}
                      <div class="form-row d-flex justify-content-between">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">{{trans('site.category')}} <span class="span">*</span></label>

                            <select id="categoryList" name="category_id" class="form-control" value="{{old('category')}}" required>
                                <option>{{trans('site.category')}} </option>
                                @foreach ($categories as $category)
                                @if (old('category_id') == $category->id)
                                    <option value="{{ $category->id }}" selected="selected">
                                       @if(App::getlocale()=='ar')
                                      {{$category->name_ar}} 
                                       @else
                                       {{$category->name}} 
                                     @endif</option>
                                @else
                                <option value="{{ $category->id }}" >
                                  @if(App::getlocale()=='ar')
                                  {{$category->name_ar}} 
                                   @else
                                   {{$category->name}} 
                                 @endif</option>
                                @endif
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">{{trans('site.sub_category')}} <span class="span">*</span></label>

                            <select id="subcategoryList" name="sub_category_id" class="form-control hide" required >
        
                                <option value="">{{trans('site.sub_category')}} </option>
                                @foreach ($subCategories as $sub_category)
                                @if (old('sub_category_id') == $sub_category->id )
                                    <option value="{{ $sub_category->id  }}" selected class='parent-{{ $sub_category->category_id }} subcategory'>
                                      @if(App::getlocale()=='ar')
                                      {{ $sub_category->name_ar }}
                                      @else
                                      {{ $sub_category->name }}
                                    @endif</option>
                                @else
                                <option value="{{ $sub_category->id  }}" class='parent-{{ $sub_category->category_id }} subcategory'>
                                  @if(App::getlocale()=='ar')
                                      {{ $sub_category->name_ar }}
                                      @else
                                      {{ $sub_category->name }}
                                    @endif
                                </option>
                                @endif
                                @endforeach 
                            </select>
                                
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputPassword1">{{trans('site.area')}} <span class="span">*</span></label>
                          <select id="cat" name="area_id" class="form-control" required>
                              <option value="">
                                @if(App::getlocale()=='ar')
                                المنطقة
                                @else
                                Service Area
                                @endif
                                </option>
                              @foreach ($areas as $area)
                              @if (old('area_id') == $area->id)
                                  <option value="{{ $area->id }}" selected>
                                    @if(App::getlocale()=='ar')
                                    {{ $area->name_ar }} 
                                     @else
                                     {{ $area->name }}
                                   @endif</option>
                              @else
                              <option value="{{ $area->id }}" >
                                 @if(App::getlocale()=='ar')
                                {{ $area->name_ar }} 
                                 @else
                                 {{ $area->name }}
                               @endif</option>
                              @endif
                              @endforeach 
                          </select>
                      </div>
                      </div>
                        <div class="form-row d-flex justify-content-between">
                          <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">{{trans('site.title')}} <span class="span">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}" required pattern="^[a-zA-z][a-zA-Z].{1,}" title="This Must be letters dosn't contain number"> 
                            @if ($errors->any())
                            <small for="fname" class="error">{{ $errors->first('title') }}</small> 
                          @endif
                          </div>
                          <div class="form-group col-md-6">
                            <label class="form-label" for="customFile">{{trans('site.title_ar')}} <span class="span">*</span></label>
                            <input type="text" class="form-control" name="title_ar" required  value="{{old('title_ar')}}"/>
                            @if ($errors->any())
                            <small for="fname" class="error">{{ $errors->first('title_ar') }}</small> 
                          @endif
                          </div>
                        </div>
                        <div class="form-row d-flex justify-content-between">
                          <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">{{trans('site.description_en')}}  <span class="span">*</span></label>
                            <textarea type="text" name="description" class="form-control"  required pattern="[a-zA-Z].{4,}" title="Must contains letter">{{old('description')}}</textarea>
                            @if ($errors->any())
                            <small for="fname" class="text-danger">{{ $errors->first('description') }}</small> 
                          @endif
                            </div>
                          <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">{{trans('site.description_ar')}}  <span class="span">*</span></label>
                            <textarea type="text" name="description_ar" class="form-control" required >{{old('description_ar')}}</textarea>
                            @if ($errors->any())
                        <small for="fname" class="error">{{ $errors->first('description_ar') }}</small>
                        @endif
                          </div>
                        </div>
                       
                          <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">{{trans('site.price')}} <span class="span">*</span></label>
                                <input type="text" name="price" value="{{old('price')}}" class="form-control" required pattern="^[1-9]+[0-9]*\.?[0-9]{0,3}$" title="Must greater than 0 ">
                                @if ($errors->any())
                                <small for="fname" class="error">{{ $errors->first('price') }}</small> 
                              @endif
                              </div>
                            <div class="form-group col-md-6">
                              <label class="form-label" for="customFile">{{trans('site.image')}} <span class="span ">*</span> (280 * 280)</label>
                              <input type="file" class="form-control" name="image" required accept="image/*" value="{{old('image')}}"/>
                              @if ($errors->any())
                              <small for="fname" class="error text-danger" style="font-size: 15px">{{ $errors->first('image')}}</small> 
                            @endif
                            </div>
                          </div>
                          <div id="myFormId" class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">{{trans('site.discount')}} ({{trans('site.amount')}})</label>
                              <input type="text" name="discount" placeholder="@if(App::getlocale()=='ar')
                              100 كمثال
                              @else
                              100 eg
                              @endif" value="{{old('discount')}}" class="form-control" pattern="^[1-9]+[0-9]*\.?[0-9]{0,3}$" title="This Must be such as (100)" >
                          </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">{{trans('site.discount_period')}} </label>
                              <input type="date" name="discount_period" value="{{old('data')}}" class="form-control" >
                          </div>
                          </div>
                          <div id="mydateId" class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-4">
                              <label for="exampleInputPassword1">{{trans('site.start_date')}} <span class="span">*</span> </label>
                              <input type="date" name="start_date" value="{{old('data')}}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="exampleInputPassword1">{{trans('site.period_unit')}} <span class="span">*</span></label>
                              <select id="period_unit" name="period_unit" class="form-control" required onchange="yesnoCheck(this);">
                                  <option value="{{old('period_unit')}}">
                                    @if(App::getlocale()=='ar')
                                    مدة عرض الخدمة
                                    @else
                                    Service Period Unit
                                    @endif
                                     </option>
                                  <option value="day" @if (old('period_unit') == 'day') selected="selected" @endif>
                                    @if(App::getlocale()=='ar')
                                    يوم
                                    @else
                                    Day
                                    @endif
                                  </option>
                                  <option value="7" @if (old('period_unit') == '7')    @endif>
                                    @if(App::getlocale()=='ar')
                                    اسبوع
                                    @else
                                    Week
                                    @endif
                                  </option> 
                                  <option value="30" @if (old('period_unit') == '30') selected="selected" @endif>
                                    @if(App::getlocale()=='ar')
                                    شهر
                                    @else
                                    month
                                    @endif
                                    </option>    
                              </select>
                              <div id="ifYes" class="form-group my-2" style="display: none;">
                                <input type="text" id="day" name="day" class="form-control"/>
                               </div>
                            </div>
                            
                          <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">{{trans('site.end_date')}} </label>
                            <input disabled id="end_date" type="" name="discount_period" value="{{old('data')}}" class="form-control" >
                          </div>
                           
                          </div>
                         
                          <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">{{trans('site.status')}} <span class="span">*</span></label>
                              @if (old('disabled')== 1) 
                              <label class="switch">
                                <input data-action="disabled" type="checkbox"  name="disabled"  checked>
                                <span class="slider round"></span>
                              </label>
                              @else
                              <label class="switch">
                                <input data-action="disabled" type="checkbox" name="disabled">
                                <span class="slider round"></span>
                              </label>
                              @endif
                            </div>
                          </div>
                       
                          <div class="m-auto">
                            <button type="submit" class="btn btn-primary" id="button">{{trans('site.submit')}}</button>
                          </div>
                    </form>              
                
    </div>
</div>
@endsection