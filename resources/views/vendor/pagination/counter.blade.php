<b>{{$paginator->firstItem()}}</b> &ndash; <b>
    @if ($paginator->lastPage())
    {{$paginator->lastItem()}}
    @else
    {{$paginator->lastPage()}}
    @endif</b> of <b>{{$paginator->total()}}</b> Results