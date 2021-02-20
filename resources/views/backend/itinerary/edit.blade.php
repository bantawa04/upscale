@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row py-3">
        <div class="col-12">
            <h5>{{$tour->name}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::model($itinerary, ['route' => ['itinerary.update', $itinerary->id], 'method' => 'PUT'])
                    !!}

                    <div class="row">
                        <input type="hidden" name="tour_id" value="{{$tour->id}}">
                        <div class="col-3">
                            {{ Form::label('day', 'Day:')}}
                            {{ Form::number('day', null, array("class"=>'form-control')) }}
                            @error('day')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-9">
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
                            {{ Form::textarea('description', null, array("id"=>'tinymce')) }}
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/8t3cusqbsgxjxtrx0cesy6fo1sdkesg3rsg41aky7y8m430h/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea#tinymce',
  height: 500,
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