@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-9">
            <h4>{{$teams->count()}} Team Members</h4>
        </div>
        <div class="col-3">
            <a href="{{ route('team.create') }}" class="btn btn-success btn-block"> Add New</a>
        </div>
        <div class="col-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $item)
                            <tr class="text-center row{{$item->id}}">
                                <td><a href="{{ route('team.show',$item->id) }}">{{$item->name}}</a></td>
                                <td>
                                    {{$item->position}}
                                </td>
                                <td>
                                    @if ($item->image)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif

                                </td>
                                <td>
                                    {{$item->type->name}}
                                </td>
                                <td>
                                    <a href="{{ route('team.edit', $item->id) }}"
                                        class="btn btn-primary btn-block btn-sm">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-block btn-sm delete" data-id="{{$item->id}}">
                                        <i class="far fa-trash-alt"></i>
                                        Delete</button>
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

    $(".delete").click(function() { 
        
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
                type: "POST",
                url: '/manage/team/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'DELETE'
                },
                success: function (data) {
                    $('.row' + data['id']).remove();
                    Toast.fire({
                        type: 'success',
                        title: 'Deleted  successfully'
                    })  
                }              
            });        
        }
      })                
    });

} );
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection