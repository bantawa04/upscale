<button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#modal-xl">
    <i class="far fa-image"></i>  Image
</button>
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Images</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @if(!empty($images))
                    <select class="image-picker show-html" name="featured">
                        <option value=""></option>
                        @foreach($images as $image)

                        <option data-img-src="{{asset($image->thumb)}}" value="{{$image->id}}">
                        </option>
                        @endforeach
                    </select>
                    @else
                    <h4 class="text-center">No images uploaded in media.</h4>
                    @endif
                </select>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@section('image')
<script src="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.0/image-picker.min.js"></script>
<script>
    $(document).ready(function () {
            $(".image-picker").imagepicker();
            $(".slides").imagepicker();
        });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.0/image-picker.min.css">
@stop