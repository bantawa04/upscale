@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => 'Destinations',
'title' => 'Destinations',
'description' => 'Destinations we hold out for the travel buff. ',
'og' => '',
'twitter' => '',
'robot' => ''
])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')

<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url('{{asset('images/map.jpg')}}');">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <h1 class="heading-main">
                        All Destinations
                    </h1>
                    <div class="description-main">
                        There's no better tour which covers Himalayan Kingdom of Tibet, Nepal and Bhutan to explore the
                        grandeur of the sublime Himalayas & profound Buddhist culture. Delve into an untouched land on
                        the lap of the Himalayas & discover the nation's rich culture.
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
                    'url' => url()->current(),
                ]           
            ],
            'position' => 'mx-auto'
        ])
        <div class="row trip-category-list">
            @foreach ($countries as $country)
            <div class="col-lg-4 trip-category">
                <a href="{{ route('country', $country->slug) }}">
                    <div class="image-wrapper">
                        <img src="{{ asset($country->thumb) }}" width="358" height="240">
                    </div>
                    <div class="image-caption-wrapper">
                        <div class="image-caption">{{$country->name}}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection