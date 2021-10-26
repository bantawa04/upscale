@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'Travel style to look over from '. $country->name,
        'title' => $country->name,
        'description' => $country->description,
        'og' => '',
        'twitter' => '',
        'robot' => ''
    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')

<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url('{{asset($country->path)}}');">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-auto">
                    <div>
                        <img src="{{ asset($country->map) }}" width="350" height="176" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-auto"></div>
                <div class="col-lg">
                    <h1 class="heading-main">
                        {{$country->name}}
                    </h1>
                    <div class="description-main">
                        {!!$country->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-trip-categories">
    <div class="container">
        @include('frontend.partials.breadcrumb', [
            'links' => [
                [
                    'text' => 'Home',
                    'url' => url('/'),
                ],
                [
                    'text' => 'Destinations',
                    'url'  => route('destination')
                ],
                [
                    'text' => $country->name,
                    'url' => url()->current(),
                ]           
            ],
            'position' => 'mx-auto'
        ])        
        <div class="row trip-category-list"> 
            @foreach ($categories as $category)
                <div class="col-lg-4 trip-category">
                    <a href="{{ route('countryCategory',[$country->slug, $category->slug]) }}">
                        <div class="image-wrapper">
                            <img src="{{ asset($category->thumb) }}" width="358" height="240">
                        </div>
                        <div class="image-caption-wrapper">
                            <div class="image-caption">{{$category->name}}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
