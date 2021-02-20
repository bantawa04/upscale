@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-10">
            <h3>Recommendeds</h3>
        </div>
        <div class="col-md-2">
            <a class="btn btn-success" href="{{ route('recommended.create') }}">
                Add New
                <i class="fas fa-plus fa-fw"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($items as $item)
        <div class="card col-md-4 mx-2 px-0 item{{$item->id}}">
            <img class="card-img-top" src="{{ asset($item->logo) }}" height="200px" width="auto" />

            @if($item->name)
            <p class="card-text mb-1 mx-1 px-2 py-1">{{$item->name}}</p>
            @else
            <p class="text-danger card-text mb-1 mx-1 px-2 py-1">No alt name given</p>
            @endif

            <div class="card-body mx-1 px-2 py-1">
                <a class="btn btn-primary btn-sm" href="{{ route('recommended.edit', $item->id) }}">Edit</a>

                <button class="btn btn-sm btn-danger delete" data-id={{$item->id}} >Delete</button>
            </div>
        </div>

        @endforeach

    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.delete').click(function() {
                let id = $(this).data('id');      
                
                $.ajax({
                    
                    type: "POST",
                    url: '/manage/recommended/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        "_method": 'DELETE'
                    },
                    success: function (data) {
                        $('.item' + id).remove();
                        Toast.fire({
                            type: data.type,
                            title:data.message
                         })                         
                    }
                });
            });
</script>
@endsection