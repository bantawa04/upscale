@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => 'Travel style we offer on Upscale Adventures',
'title' => 'Travel Style',
'description' => 'Look over assortment of alternatives we offer for travel enthusiast',
'image' => asset('apple-icon-180x180.png"'),
'robot' => ''
])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url({{asset('images/kyanjinri.jpg')}});">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <h1 class="heading-main">
                        Travel Style
                    </h1>
                    <div class="description-main">
                        We at upscale believe in creating memories that last forever, we share a common love of
                        adventure & we are able to deliver as little or as much as our customers want. From Trekking,
                        climbing, Heli tours to exciting sightseeing activities & Wildlife Excursions we can do it all.
                        No matter what kind of traveller you are our team is standby to kick start your journey. Pop in
                        or Drop us a line!
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
                    'text' => 'Travel Style',
                    'url' => url()->current(),
                ]           
            ],
            'position' => 'mx-auto'
        ])        
        <div class="row trip-category-list">
            @foreach ($categories as $item)
            <div class="col-lg-4 trip-category">
                <a href="{{ route('byCategory', $item->slug) }}">
                    <div class="image-wrapper">
                        <img src="{{ asset($item->thumb) }}" width="292" height="292">
                    </div>
                    <div class="image-caption-wrapper">
                        <div class="image-caption">{{ $item->name }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection