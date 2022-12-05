<!-- Modal -->
<div class="modal fade p-5" id="delete{{ $favorite->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('site.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('favorite-services.destroy', [$favorite->id]) }}" method="post" enctype="multipart/form-data">
                {{method_field('DELET')}}
                {{csrf_field()  }}
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="modal-body py-3">
                <input type="hidden" name="id" value="{{ $favorite->id }}">
                <h5> @if(App::getlocale()=='ar')
                    {{$favorite->service->title_ar}}
                @else
                {{$favorite->service->title}}</h5>
                @endif
            </div>
            <div class="modal-footer d-flex justify-content-lg-between">
                <button type="submit" class="btn btn-danger">{{trans('site.submit')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}}</button>
                
            </div>
            </form>
        </div>
    </div>
</div>