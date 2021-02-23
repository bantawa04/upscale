@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-9">
            <h5>{{$tour->name}}</h5>
        </div>
        <a class="btn btn-success col-3" href="{{ route('tour.index') }}"> Save</a>
    </div>
    <div class="row pt-3">
        <div class="col-8">
            @foreach ($itineraries as $item)
            <div class="card card-primary card-outline item{{$item->id}} collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Day {{$item->day}}: {{$item->title}}</h3>

                    <div class="card-tools">
                        <a href="{{ route('itinerary.edit', [$tour->id, $item->id]) }}" class="btn btn-tool"><i
                                class="far fa-edit"></i></a>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool delete" data-id="{{$item->id}}">
                            <i class="fas fa-times"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!!$item->description!!}
                </div>
                <!-- /.card-body -->
            </div>
            @endforeach
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'itinerary.store', 'method' =>'POST'] ) !!}
                    <input type="hidden" name="tour_id" value="{{$tour->id}}">
                    <div class="row">
                        <div class="col-4">
                            {{ Form::label('day', 'Day:')}}
                            {{ Form::number('day', null, array("class"=>'form-control')) }}
                            @error('day')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-8">
                            {{ Form::label('title', 'Title:')}}
                            {{ Form::text('title', null, array("class"=>'form-control')) }}
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ Form::label('description', 'Description:')}}
                            <textarea name="description" id="tinymce"></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        {{ Form::submit('Add', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $('.delete').click(function() {
                let id = $(this).data('id');      
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
            if (result.value) {
                $.ajax({
                    
                    type: 'DELETE',
                    url: '/manage/itinerary/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (data) {
                        $('.item' + id).remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Deleted  successfully'
                        })  
                    }
                });
            }
         })
    });           
</script>
<script src="https://cdn.tiny.cloud/1/8t3cusqbsgxjxtrx0cesy6fo1sdkesg3rsg41aky7y8m430h/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea#tinymce',
  height: 350,
  menubar: false,
  plugins: [
    'lists',
  ],
  toolbar: 
  'bullist numlist outdent indent |' +
  'help',
});
</script>
@endsection