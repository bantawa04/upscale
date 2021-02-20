@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => $page->meta_title,
        'title' => $page->title,
        'description' => $page->meta_description,
        'image' => asset('apple-icon-180x180.png"'),
        'robot' => ''
    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')

<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url('{{asset($page->banner)}}');">
    <div>
        <div class="container">
            <h1 class="heading-main">{{$page->title}}</h1>
        </div>
    </div>
</div>

<div class="section-content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!!$page->content!!}
            </div>
        </div>
    </div>
</div>


@endsection