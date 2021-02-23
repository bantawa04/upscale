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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promoteds as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->days}} Day(s)</td>
                                <td>
                                    USD {{$item->price}}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-block btn-sm remove mt-2" data-id="{{$item->id}}">
                                        <i class="far fa-trash-alt"></i>
                                        Remove</button>
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
    $(document).ready(function() {
    $(document).on('click', '.remove', function(){
        
        let id = $(this).data('id');     
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({                    
                type: "POST",
                url: '/manage/tours/remove-promote/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'PUT'
                },
                success: function (data) {
                    $('.item' + id).remove();
                    Toast.fire({
                        type: 'success',
                        title: 'Removed  successfully'
                    })  
                }              
            });        
        }
      })                
    });
});
</script>
@stop
@section('styles')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection