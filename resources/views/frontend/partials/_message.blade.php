@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    <strong>Success: {{ Session::get('success')}}</strong>
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    <strong>Success: {{ Session::get('error')}}</strong>
</div>
@endif
@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">{{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endforeach
@endif