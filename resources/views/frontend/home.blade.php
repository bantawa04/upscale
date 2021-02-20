@extends('layouts.app')

@section('content')
@include('frontend.partials.home', ['carousels' => $carousels])
<div id="section-middle" class="pt-3 pt-lg-5 pb-lg-3">
    <div class="background"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-text col-lg-3 col-xxl-4 py-4">
                <div class="section-subtitle">
                    WAYS TO TRAVEL
                </div>
                <div class="section-title">
                    Travelling With Upscale
                </div>
                <div class="section-summary">
                    We hit the trails like nobody else & we pride ourselves on providing impartial information to help
                    you decide the right trip for you. Dive into the heart of Himalayas & get a sense of adventure.
                </div>
            </div>
            <div class="col-slide col-lg-9 col-xxl-8 py-4 p-lg-0">
                <div class="row mx-auto owl-carousel owl-theme">
                    @foreach($categories as $category)
                    <div class="col-sm">
                        <div class="image-wrapper">
                            <img src="{{ asset($category->thumb1) }}" width="344" height="534" alt="" class="img-fluid">
                            <div class="image-caption">{{$category->name}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="section-trip">
    <div class="container">
        <div class="section-title">
            Inspiring Trip Ideas
        </div>
        <div class="section-summary">
            We hit the trails like nobody else & we pride ourselves on providing impartial information to help you
            decide the right trip for you. Dive into the heart of Himalayas & get a sense of adventure
        </div>
    </div>
    <div class="container">
        <div class="trips row">
            <?php foreach ([
                    'https://demo.rarathemes.com/travel-agency-pro/wp-content/uploads/sites/24/2017/10/kayak-1465191_19201-1-410x250.jpg',
                    'https://demo.rarathemes.com/travel-agency-pro/wp-content/uploads/sites/24/2017/11/theravada-buddhism-1823527_19201-1-410x250.jpg',
                    'https://demo.rarathemes.com/travel-agency-pro/wp-content/uploads/sites/24/2017/10/lake-louise-1761286_1920-1-410x250.jpg'
            ] as $i => $image): ?>
            <div class="col-md-4 my-4">
                @include('frontend.partials.single-trip')
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div id="section-featured">
    <div class="container">
        <div>
            <div class="section-title">As seen in...</div>
            <div class="row justify-content-center row-image">
                <?php foreach (range(1, 6) as $i): ?>
                <div class="col-sm-6 col-md-3 col-lg-2 text-center">
                    <img src="http://logoipsum.com/assets/logo/logo-{{ $i }}.svg" alt="Logo of Vogue"
                        class="bg-white my-2">
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div id="section-article">
    <div class="container">
        <div class="section-title">
            Travel Articles
        </div>
        <div class="section-summary">
            Hint..Hint Looking for travel inspiration, insider tips, travel guides, news, gear info and other awesome
            stuff look nowhere. Hear from our voracious travellers & their stories here. .
        </div>
    </div>
    <div class="articles">
        <div class="container">
            <div class="row">
                <?php foreach (range(1,3) as $i): ?>
                <div class="col-md-4 my-4">
                    <div class="article">
                        <div class="image-wrapper">
                            <a href="{{ url('posts/1') }}">
                                <img src="http://placehold.it/379x259" width="379" height="259"
                                    alt="Article Preview Image" class="preview-image">
                            </a>
                        </div>
                        <div class="article-text-container">
                            <div class="article-date">
                                <div>DECEMBER 10, 2016</div>
                            </div>
                            <div class="article-title font-weight-bold">
                                <a href="{{ url('posts/1') }}">Everest Base Camp Trek</a>
                            </div>
                            <div class="article-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit,
                            </div>
                            <div>
                                <a href="{{ url('posts/1') }}" class="detail-link">
                                    Read more
                                    <span class="fa fa-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

{{-- @include('footer') --}}

@endsection

@push('scripts')
<script>
    $(function () {

});

$(function () {

    var navbar = $('#navbar');

    var handleNavbar = function () {
        var st = $(this).scrollTop();
        if (st === 0) {
            navbar.addClass('top');
        } else if (st > 0) {
            navbar.removeClass('top');
        }
    };

    handleNavbar();
    $(window).scroll(handleNavbar);
});

</script>
@endpush