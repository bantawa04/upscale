<div class="row">
    <nav aria-label="breadcrumb" class="{{$position ? $position : ''}}">
    <ol class="breadcrumb my-2 mx-3">
            @foreach ($links as $link)

            @if ($loop->last)
            <li class="breadcrumb-item active" aria-current="page">{{$link['text']}}</li>
            @else
            <li class="breadcrumb-item"><a href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
            @endif

            @endforeach
        </ol>
    </nav>
</div>