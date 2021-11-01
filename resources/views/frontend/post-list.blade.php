@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => $title ? $category->meta_title: 'Tips & Tricks on travelling by Upscale Adventures',
        'title' => $title ? $category->title : 'Wholesome Helpful Advice on Travel',
        'description' => $title ? $category->meta_description: 'Follow along our stories we write on travelling in Nepal, Tibet & Bhutan.',
        'og' => '',
        'twitter' => '',
        'robot' => ''
    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div>
    @if( !request()->query('page') )          
        @isset($featured)
        <div class="featured-article">
            <div class="row no-gutters">
                <div class="col-lg-6 align-self-stretch">
                    <img src="{{ asset($featured->thumb) }}" alt="" width="780" height="440" class="article-image">
                </div>
                <div class="col-lg-6 col-text align-self-center">
                    <div class="article-category">
                        Featured Article
                    </div>
                    <div class="article-title">
                        <a href="{{ route('blog.singlePost',[$featured->category->slug, $featured->slug]) }}">
                            {{$featured->title}}
                        </a>
                    </div>
                    <div class="read-more">
                        <a href="{{ route('blog.singlePost',[$featured->category->slug, $featured->slug]) }}"
                            class="btn-read-more btn btn-primary">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    @endif
    <div class="container">
        <div class="article-list">
            @foreach($posts as $post)
            <div class="article-list-item">
                <div class="article">
                    <div class="row no-gutters">
                        <div class="col-lg-6 align-self-stretch">
                            <img src="{{ asset($post->thumb) }}" alt="" width="780" height="440" class="article-image">
                        </div>
                        <div class="col-lg-6 col-text align-self-center">
                            <div class="article-category">
                                <a href="{{ route('blog.byCategory', $post->category->slug) }}"
                                    class="">{{$post->category->name}}</a>
                            </div>
                            <div class="article-title">
                                <a href="{{ route('blog.singlePost',[$post->category->slug, $post->slug]) }}">
                                    {{$post->title}}
                                </a>
                            </div>
                            <div class="article-short-detail">
                                <span class="published-date">{{date("M d, Y", strtotime($post->created_at))}}</span>
                                &mdash;
                                <span class="article-excerpt">
                                    {!!substr($post->meta_description, 0, 150) !!}{!! strlen($post->meta_description) > 150 ? '...' : "" !!}
                                </span>
                                <a href="{{ route('blog.singlePost',[$post->category->slug, $post->slug]) }}"
                                    class="btn-read-more btn btn-link">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>


@endsection