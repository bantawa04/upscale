@inject('countries','App\Http\Utilities\Country')
@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'review.store', 'method' =>'POST'] ) !!}

                    <div class="col-12">
                        {{ Form::label('tour', 'Tour:')}}
                        <select name="tour_id" id="tour" class="form-control">
                            @foreach ($tours as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        {{ Form::text('name', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('email', 'Email:')}}
                        {{ Form::text('email', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('country', 'Country:')}}
                        <select name="country" id="country" class="form-control">
                            @foreach($countries::all() as $country)
                            <option value="{{$country}}">{{$country}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        {{ Form::label('Photo', 'Photo:')}}
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                    <div class="col-12">
                        {{ Form::label('rating', 'Rating')}}
                        <br>
                        <span class="my-rating-9"></span>
                        <span class="live-rating"></span>
                        <input type="hidden" name="rating" id="rating">

                    </div>

                    <div class="col-12">
                        {{ Form::label('title', 'Title:')}}
                        {{ Form::text('title', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('comment', 'Comment:')}}
                        {{ Form::textarea('comment', null, array("class"=>'form-control')) }}
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
<script src="https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/dist/jquery.star-rating-svg.min.js"></script>
<script>
    $(".my-rating-9").starRating({
        totalStars: 5,
  starShape: 'rounded',
  starSize: 30,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
    onHover: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentRating);
    },
    callback: function(currentRating, $el){
    $('#rating').val(currentRating);

  }
  });
</script>
@stop
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/src/css/star-rating-svg.min.css">
@stop