@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => 'Search Results',
'title' => 'Search Results',
'description' => 'Query items as indicated by your choice.',
'og' => '',
'twitter' => '',
'robot' => 'noindex, nofollow'
])
<script type="application/ld+json">
    {
          "@context": "http://schema.org/",
          "@type": "Organization",
          "name": "Upscale Adventures",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Keshar Mahal Marg, Thamel",
            "addressLocality": "Kathmandu",
            "addressRegion": "Bagmati",
            "postalCode": "44600"
          },
          "telephone": "+977-9851062726"
        }
</script>
@endpush
@section('content')

<div class="navbar-gap"></div>

<div class="container pt-5">
    <h1 class="h2">Search Results</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div id="search-filter">
                <div class="container py-3">
                    Filter Search
                </div>
                <form class="container py-3" method="GET" action="{{ route('page.search') }}">
                    @csrf
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" class="form-control">
                            <option>Select Country</option>
                            @foreach ($countries as $item)
                            <option value="{{$item->slug}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Difficulty</label>
                        <select name="difficulty" class="form-control">
                            <option>Select Difficulty</option>
                            @foreach ($difficulties as $item)
                            <option value="{{strtolower($item->name)}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price Range</label>
                        <input name="price_min" type="hidden" id="price-min">
                        <input name="price_max" type="hidden" id="price-max">
                        <div id="price-slider" class="mx-2"></div>
                        <div class="d-flex justify-content-between">
                            <span id="text-price-min" class="end"></span>
                            <span id="text-price-max"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Travel Style</label>
                        @foreach ($categories as $item)
                        <div class="form-check">
                            <input name="travel_type[]" type="checkbox" class="form-check-input"
                                id="travel-type-{{$loop->iteration}}" value="{{$item->slug}}">
                            <label for="travel-type-{{$loop->iteration}}"
                                class="form-check-label">{{$item->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block mx-auto btn-search">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9">

            @if ($results->count() > 0) 
            <div id="result-summary" class="px-5 py-3">
                <div class="row align-items-center">
                    <div class="col">
                        {{ $results->appends(request()->except('page'))->links('vendor.pagination.counter') }}
                    </div>
                </div>     
            </div>       
            @endif
        
        <div class="result-list">
            @forelse ($results as $item)
            <div class="result-item my-4">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <div class="img-holder" style="background-image: url({{$item->image->thumb}});">

                        </div>
                    </div>
                    <div class="col-md-7 px-3">
                        <div class="text-dar">
                            <h5 class="trip-title item-title mt-3">
                                {{$item->name}}
                            </h5>
                            <p class="trip-description item-desc">
                                {{$item->meta_description}}
                            </p>
                            <div class="row item-meta justify-content-between">
                                <div class="col-sm-6 my-1">
                                    <span>
                                        <?php foreach (array_fill(0, 3, null) as $i): ?><span
                                            class="fa fa-star text-primary"></span>
                                        <?php endforeach ?>
                                        <?php foreach (array_fill(0, 2, null) as $i): ?><span
                                            class="far fa-star"></span>
                                        <?php endforeach ?>
                                    </span>
                                    <span>4&nbsp;reviews</span>
                                </div>
                                <div class="col-sm-6 my-1">
                                    <span class="fa fa-calendar-alt"></span>
                                    <span>{{$item->days}} Days - {{$item->days-1}} Nights</span>
                                </div>
                            </div>
                            <div class="item-action-wrapper d-flex justify-content-between align-items-end mt-4 mb-3">
                                <div class="price-wrapper">
                                    <span class="price-label">
                                        From
                                    </span>
                                    <span class="price">
                                        ${{$item->price}}
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('trip.show',$item->slug) }}" class="btn btn-primary">
                                        VIEW TOUR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info my-3">
                No results found.
            </div>
            @endforelse

        </div>
        <div>
            <div>
                {{ $results->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
    $(function () {

    var defaultMin = 0;
    var defaultMax = 5000;
    var $priceMin = $('#price-min');
    var $priceMax = $('#price-max');
    var $textPriceMin = $('#text-price-min');
    var $textPriceMax = $('#text-price-max');
    var min = $priceMin.val() || defaultMin;
    var max = $priceMax.val() || defaultMax;
    function updateTexts() {
        $textPriceMin.text('$' + min);
        $textPriceMax.text('$' + max);
    }
    function updateInputs() {
        $priceMin.val(min);
        $priceMax.val(max);
    }
    updateTexts();
    $('#price-slider').slider({
        range: true,
        min: defaultMin,
        max: defaultMax,
        step: 10,
        values: [ min, max ],
        classes: {
            'ui-slider': '',
            'ui-slider-handle': '',
            'ui-slider-range': 'ui-widget-header',
        },
        slide: function (ev, ui) {
            min = ui.values[0];
            max = ui.values[1];
            updateTexts();
            updateInputs();
        }
    });
});

</script>
@endpush