<!-- Modal -->
<div class="modal fade p-5" id="delete{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@if(App::getlocale()=='ar')
                    {{$service->title_ar}}
                    @else
                    {{$service->title}}
                    @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('all-services.destroy', [ $service->id]) }}" method="post" enctype="multipart/form-data">
                {{method_field('DELET')}}
                {{csrf_field()  }}
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body py-3">
                <input type="hidden" name="id" value="{{ $service->id }}">
                <h5>{{ $service->title }}</h5>
            </div>
            <div class="modal-footer d-flex justify-content-lg-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}}</button>
                <button type="submit" class="btn btn-danger">{{trans('site.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>