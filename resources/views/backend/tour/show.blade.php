@extends('layouts.master')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row pt-5">
        <div class="col-5">
        </div>
        <a href="{{ route('tour.edit',$tour->id) }}" class="col-2 btn btn-primary">Edit</a>
        <a href="{{ route('itinerary.index', $tour->id) }}" class="col-2 btn btn-info ml-1">Itinerary</a>         
        <a href="{{ route('tour.index') }}" class="col-2 btn btn-success ml-1">Save</a>

    </div>
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$tour->name.' '.$tour->days}} Day(s)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {{-- {{dd($tour->image->path)}} --}}
                            <img class="card-img-top" loading="lazy" src="{{ asset($tour->image->path) }}" alt="Card image cap">
                        </div>
                        <div class="col-12 pt-3">
                            <div class="row">
                                @foreach($tour->slides as $slide)
                                <div class="col-3">
                                    <a href="{{ url($slide->path) }}" data-lity>
                                        <img class="img-fluid" loading="lazy" src="{{asset($slide->thumb)}}" alt="">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <dt>Country</dt>
                                        </td>
                                        <td>{{$tour->country->name}}</td>
                                        <td>
                                            <dt>Category</dt>
                                        </td>
                                        <td>
                                            {{$tour->category->name}}
                                            @if ($tour->region_id)
                                            in {{$tour->region->name}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Price</dt>
                                        </td>
                                        <td>USD {{$tour->price}}</td>
                                        <td>
                                            <dt>Max altitude</dt>
                                        </td>
                                        <td>{{$tour->elevation()}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Group</dt>
                                        </td>
                                        <td>{{$tour->group->name}}</td>
                                        <td>
                                            <dt>Difficulty</dt>
                                        </td>
                                        <td>{{$tour->difficulty->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Meal</dt>
                                        </td>
                                        <td>{{$tour->meal->name}}</td>
                                        <td>
                                            <dt>Accomodation</dt>
                                        </td>
                                        <td>{{$tour->accomodation->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Trip Start</dt>
                                        </td>
                                        <td>{{$tour->location->name}}</td>
                                        <td>
                                            <dt>Trip End</dt>
                                        </td>
                                        <td>{{$tour->locationEnd->name}}</td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 pt-2">
                            <dt>Includes</dt>
                            <ol>
                                @foreach ($tour->includes as $item)
                                <li>{{$item->name}}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-6 pt-2">
                            <dt>Excludes</dt>
                            <ol>
                                @foreach ($tour->excludes as $item)
                                <li>{{$item->name}}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-12 pt-2">
                            <dt>Overview</dt>
                            {!!$tour->overview!!}
                        </div>
                        @if ($tour->note)
                        <div class="col-12 pt-2">
                            <dt>Note</dt>
                            {!!$tour->note!!}
                        </div>
                        @endif
                        <div class="col-12 pt-2">
                            <dt>Meta title</dt>
                            {!!$tour->meta_title!!}
                        </div>
                        <div class="col-12 pt-2">
                            <dt>Meta Description</dt>
                            {!!$tour->meta_description!!}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js"></script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.css">
@endsection