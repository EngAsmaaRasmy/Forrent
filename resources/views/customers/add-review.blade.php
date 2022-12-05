<style>
div.stars {
  display: inline-block;
}

input.star { display: none; }

label.star {
  /* float: right; */
  padding: 10px;
  font-size: 25px;
  color: 
#ccc;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\2605';
  color: 
#fcb941;
  transition: all .25s;
}

input.star-1:checked ~ label.star:before {
  color: 
#fcb941;
  text-shadow: 0 0 2px 
#7f8c8d;
}

input.star-5:checked ~ label.star:before { color: 
#fcb941; }

label.star:hover { transform: rotate(-10deg) scale(1.2); }

label.star:before {
  content: '\2605';
}


.horline > li:not(:last-child):after {
    content: " |";
}
.horline > li {
  font-weight: bold;
  color: 
#fcb941;

}
</style>
<div class="modal fade p-5 overflow-auto " id="add{{$services->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">>
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@if(App::getlocale()=='ar')
                    {{$services->title_ar}}
                    @else
                    {{$services->title}}
                    @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer-services.store', [$services->id]) }}" method="post" id="addStar">
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="col-sm-12 text-center">
                          <input class="star star-5" value="5" id="star-5" type="radio" name="rating"/>
                          <label class="star star-5" for="star-5"></label>
                          <input class="star star-4" value="4" id="star-4" type="radio" name="rating"/>
                          <label class="star star-4" for="star-4"></label>
                          <input class="star star-3" value="3" id="star-3" type="radio" name="rating"/>
                          <label class="star star-3" for="star-3"></label>
                          <input class="star star-2" value="2" id="star-2" type="radio" name="rating"/>
                          <label class="star star-2" for="star-2"></label>
                          <input class="star star-1" value="1" id="star-1" type="radio" name="rating"/>
                          <label class="star star-1" for="star-1"></label>
                          <input type="hidden" name="service_id" class="form-control" value="{{$services->id}}">
                         </div>
                      </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('site.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div> 