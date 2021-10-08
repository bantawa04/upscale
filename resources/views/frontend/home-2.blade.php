@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => '',
        'title' => '',
        'description' => '',
        'image' => asset('apple-icon-180x180.png'),
        'robot' => ''

    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')
@include('frontend.partials.home', ['carousels' => $carousels])
<div class="section-best-seller">
    <div class="container">
        <div class="section-title">
            Travel Style
        </div>
        <div class="section-summary">
            Take a peek at our curated tours, there's something for everyone. Start your dream trip with upscale
            adventures & travel with style, service with exceeded expectations.
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-trip">
                @foreach ($categories as $category)
                @if ($loop->first)

                <div class="trip featured-trip">
                    <div class="image-wrapper">
                        <img src={{ asset($category->thumb) }} width="300" height="300" class="img-fluid w-100" alt="{{$category->slug}}">
                        <div class="text-wrapper">
                            <div class="trip-title">
                                <a href="{{ route('byCategory', $category->slug) }}">
                                    {{$category->name}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="row">
                    @foreach ($categories as $category)
                    @if ($loop->iteration != 1)
                    <div class="col-md-6 col-trip">
                        <div class="trip">
                            <div class="image-wrapper">
                                <img src="{{ $category->thumb }}" width="300" height="300" class="img-fluid w-100" alt="{{$category->slug}}">
                                <div class="text-wrapper">
                                    <div class="trip-title">
                                        <a href="{{ route('byCategory', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($loop->iteration == 5)
                    @break
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="text-center" style="margin-top: 40px; margin-bottom: 40px;">
            <a href="{{ route('activities') }}" class="btn btn-outline-primary"
                style="padding-left: 29px; padding-right: 29px; line-height: 28px;">VIEW MORE</a>
        </div>
    </div>
</div>

<div id="section-trip">
    <div class="container">
        <h2 class="section-title">
            Inspiring Hiking / Trekking Trips In Nepal for {{date('Y')}}
        </h2>
        <div class="section-summary">
            We hit the trails like nobody else & we pride ourselves on providing impartial information to help you
            decide the right trip for you. Dive into the heart of Himalayas & get a sense of adventure.
        </div>
    </div>
    <div class="container">
        <div class="trips row">
            @foreach($featureds as $tour)
            <div class="col-md-4 my-4">
                @include('frontend.partials.single-trip', ['tour' => $tour])
            </div>
            @endforeach
        </div>
    </div>
</div>

@if ($posts->count() > 0)
<div id="section-article">
    <div class="container">
        <div class="section-title">
            Travel Articles
        </div>
        <div class="section-summary">
            Hint..Hint Looking for travel inspiration, insider tips, travel guides, news, gear info and other awesome
            stuff look nowhere. Hear from our voracious travellers & their stories here.
        </div>
    </div>
    <div class="articles">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 my-4">
                    <div class="article">
                        <div class="image-wrapper">
                            <a href="{{ route('blog.singlePost',[$post->category->slug, $post->slug]) }}">
                                <img src="{{ asset($post->thumb) }}" width="379" height="259" alt="{{$post->slug}}"
                                    class="preview-image">
                            </a>
                        </div>
                        <div class="article-text-container">
                            <div class="article-date">
                                <div>{{date("F d, Y", strtotime($post->created_at))}}</div>
                            </div>
                            <div class="article-title font-weight-bold">
                                <a href="{{ route('blog.singlePost',[$post->category->slug, $post->slug]) }}">{{$post->title}}</a>
                            </div>
                            <div class="article-description">
                                {!!substr($post->meta_description, 0, 80) !!}{!! strlen($post->meta_description) > 80 ? '...' : "" !!}
                            </div>
                            <div>
                                <a href="{{ route('blog.singlePost',[$post->category->slug, $post->slug]) }}"
                                    class="detail-link">
                                    Read more
                                    <span class="fa fa-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
$(function(){var navbar=$('#navbar');var handleNavbar=function(){var st=$(this).scrollTop();if(st===0){navbar.addClass('top')}else if(st>0){navbar.removeClass('top')}};handleNavbar();$(window).scroll(handleNavbar)})
</script>
@endpush