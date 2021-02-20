@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-8 offset-2">
            <form action="{{ route('promote.store') }}" method="POST">
                @csrf
                @method('PUT')
                <select name="promote[]" id="promote" class="form-control" multiple="multiple">
                    @foreach ($tours as $item)
                        <option value="{{$item->id}}" {{$item->promote ? 'selected': ''}}>{{$item->name}} {{$item->days}} Days</option>
                    @endforeach
                </select>

                <button class="btn btn-success btn-block mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Promoted Tours</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Day</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promoteds as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->days}} Day(s)</td>
                                <td>
                                    USD {{$item->price}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js">
</script>
<script>
    $('#promote').multiselect({
        includeSelectAllOption: true,
        selectAllJustVisible: false,
        enableFiltering: true,
        numberDisplayed: 1,
        maxHeight: 600,
        buttonWidth: '100%'
    });
</script>
@stop
@section('styles')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection