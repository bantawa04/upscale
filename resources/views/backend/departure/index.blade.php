@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-9">
            <h4>{{$tours->count()}} Tours</h4>
        </div>
        <div class="col-3">
            <a href="{{ route('departure.create') }}" class="btn btn-success btn-block"> Add New</a>
        </div>
        <div class="col-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Departures</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $item)
                            <tr class="text-center row{{$item->id}}">
                                <td>{{$item->name}}</td>
                                <td>{{$item->departure->count()}}</td>
                                <td>
                                    <a href="{{ route('departure.show',$item->id) }}"
                                        class="btn btn-sm btn-info btn-block">
                                        <i class="far fa-eye"></i>
                                        View</a>


                                    {!! Form::open( array('route'=>array('departure.delete',
                                    $item->id),'method'=>'DELETE' ,'class'=>'pt-2')) !!}

                                    <button class="btn btn-danger btn-block btn-sm" type="submit">

                                        <i class="far fa-trash-alt"></i>
                                        Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {

    $('#table').DataTable({
              "ordering": false,
    }); 
} );
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection