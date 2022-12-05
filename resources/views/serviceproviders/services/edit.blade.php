
<div id="edit">
    <div class="modal fade bd-example-modal-xl edit" id="edit{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" >
        <div class="modal-dialog modal-xl" role="document">
              
            <div class="modal-content p-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('site.edit')}} {{trans('site.service')}}  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('all-services.update', [ $service->id]) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    @csrf
                    <div class="modal-body py-2">
                        <input type="hidden" name="id" value="{{ $service->id }}">
                        @if(App::getlocale()=='en')
                        <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPassword1">{{trans('site.title')}} </label>
                                <input type="text" name="title" value="{{ $service->title }}" class="form-control" required pattern="^[a-zA-z][a-zA-Z].{1,}">
                            </div>
                          </div>
                          @else
                          <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPassword1">{{trans('site.title_ar')}} </label>
                                <input type="text" name="title_ar"  value="{{ $service->title_ar}}" class="form-control" required>
                              </div>
                          </div>
                          @endif
                    
                          <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">{{trans('site.price')}} </label>
                                <input type="text" name="price" value="{{ $service->price }}" class="form-control" required pattern="[1-9][0-9]*(,\d{1,3})*?"> 
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">{{trans('site.discount')}} </label>
                              <input type="text" name="discount" value="{{ $service->discount}}" pattern="^[1-9][0-9]?%" title="This Must be such as (10%)"  class="form-control">
                            </div>
                          </div>
                          <div class="form-row d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">{{trans('site.image')}} </label>
                                <input type="file" name="image" value="{{ $service->image_full_path}}" class="form-control mb-2" accept="image/*">
                                <img src="{{asset('uploads/'.$service->image)}}" alt="Product image"  width="70" height="20">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">{{trans('site.discount_period')}} </label>
                                <input type="date" name="discount_period" value="{{ $service->discount_period }}" class="form-control">
                            </div>
                          </div>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}} </button>
                        <button type="submit" class="btn btn-primary">{{trans('site.submit')}} </button>
                    </div>
                </form>
            </div>
    
        </div>
    </div>

</div>
<!-- Modal -->

