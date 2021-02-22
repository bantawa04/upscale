@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newsletters as $item)
                            <tr class="item{{$item->id}}">
                                <td>
                                    {{$item->fname }}
                                </td>
                                <td>
                                    {{$item->lname}}
                                </td>
                                <td>
                                    {{$item->email}}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-block btn-sm delete mt-2" data-id="{{$item->id}}">
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

    $(document).on('click', '.delete', function(){
        
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
                url: '/manage/newsletter/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'DELETE'
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
});
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection