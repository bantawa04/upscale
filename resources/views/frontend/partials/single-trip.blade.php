<div class="trip">
    <div class="wrapper-image">
        <a href="{{route('trip.show',$tour->slug)}}">
            <img src="{{ asset($tour->image->thumb) }}" width="410" height="250" alt="{{$tour->name}}" class="img-fluid">
        </a>
        <div class="trip-price">
            <div>
                @if ($tour->discountPrice)
                    <span class="previous-price"><s>$ {{number_format($tour->price)}}</s></span>&nbsp;
                    <span class="current-price">$ {{number_format($tour->discountPrice)}}</span>
                @else
                <span class="current-price">$ {{number_format($tour->price)}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="wrapper-text">
        <div class="trip-description">
            <div class="trip-title">
                <a href="{{ route('trip.show',$tour->slug) }}">{{$tour->name}}</a>
            </div>
            <div class="trip-duration">
                <div>
                    <span class="far fa-clock text-primary"></span>
                    {{$tour->days}} Days - {{$tour->days -1}} Nights
                </div>
            </div>
        </div>
        <div class="wrapper-book-now">
            <a href="{{ route('trip.show',$tour->slug) }}" class="btn btn-outline-primary rounded-pill btn-block btn-book-now">Read More</a>
        </div>
    </div>
</div>