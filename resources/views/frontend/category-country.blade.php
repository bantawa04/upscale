@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => $stuff->meta_title,
'title' =>  $stuff->title,
'description' => $stuff->meta_title,
'og' => '',
'twitter' => '',
'robot' => ''

])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url({{asset($category->path)}});">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <h1 class="heading-main">
                        {{$stuff->title}}
                    </h1>
                    <div class="description-main">
                        {{$category->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if($stuff->content)
    <div class="row mt-4">
         <div class="col">
            {!! $category->content !!}
        </div>
    </div>
    @endif
    <div class="trips row">
        @foreach ($results as $item)
        <div class="col-md-4 my-4">
            @include('frontend.partials.single-trip', ['tour' => $item])
        </div>
        @endforeach

    </div>
</div>


@endsection