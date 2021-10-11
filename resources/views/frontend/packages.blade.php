@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => 'All Packages',
'title' => 'Our Travel Packages ',
'description' => 'Destinations we hold out for the travel buff. ',
'og' => '',
'twitter' => '',
'robot' => ''
])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url({{asset('images/package-bg.jpg')}});">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <h1 class="heading-main">
                        Our Packages
                    </h1>
                    <div class="description-main">
                        Here lies our well crafted travel packages suited for any travel buff. 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="trips row">
        @foreach ($results as $item)
        <div class="col-md-4 my-4">
            @include('frontend.partials.single-trip', ['tour' => $item])
        </div>
        @endforeach

    </div>
    {{$results->links()}}
</div>


@endsection
