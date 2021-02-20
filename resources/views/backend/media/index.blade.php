@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-10">
            <h3>Medias</h3>
        </div>
        <div class="col-md-2">
            <a class="btn btn-success" href="{{ route('media.create') }}">
                Add New
                <i class="fas fa-plus fa-fw"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($medias as $item)
        <div class="card col-md-3 mx-2 px-0 item{{$item->id}}">
            <img class="card-img-top" src="{{ asset($item->thumb) }}" />

            @if($item->name)
            <p class="card-text mb-1 mx-1 px-2 py-1">{{$item->name}}</p>
            @else
            <p class="text-danger card-text mb-1 mx-1 px-2 py-1">No alt name given</p>
            @endif

            <div class="card-body mx-1 px-2 py-1">
                <a class="btn btn-primary btn-sm" href="{{ route('media.edit', $item->id) }}">Edit</a>

                <button class="btn btn-sm btn-danger delete" data-id={{$item->id}} id="delete">Delete</button>
            </div>
        </div>

        @endforeach

    </div>
    <div class="row">
        <div class="col">
            {{ $medias->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.delete').click(function() {
        console.log('Clicked');
                let id = $(this).data('id');      
                console.log(id);
                
                $.ajax({
                    
                    type: "POST",
                    url: '/manage/media/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        "_method": 'DELETE'
                    },
                    success: function (data) {
                        $('.item' + data['id']).remove();
                    }
                });
            });
</script>
@endsection