@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => $post->meta_title,
        'title' => $post->title_tag ? $post->title_tag : $post->title,
        'description' => $post->meta_description,
        'og' => $post->ogTag,
        'twitter' => $post->twitter,
        'robot' => ''
    ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://google.com/article"
      },
      "headline": "{{$post->title}}",
      "image": [
        "{{ $post->twitter }}"
       ],
      "datePublished": "{{ date("Y-m-d", strtotime($post->created_at))}}",
      "dateModified": "{{ date("Y-m-d", strtotime($post->modified_at))}}",
      "author": {
        "@type": "Person",
        "name": "Hari Bhattarai"
      },
       "publisher": {
        "@type": "Organization",
        "name": "Upscale Adventures",
        "logo": {
          "@type": "ImageObject",
          "url": "{{asset('apple-icon-180x180.png')}}"
        }
      },
      "description": "{{$post->meta_description}}"
    }
    </script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="section-article">
    <div class="container">
        <article>
            <h1 class="article-heading">
                {{$post->title}}
            </h1>
            <div class="metas">
                <div>
                    Posted in
                    <a href="{{ route('blog.byCategory', $post->category->slug) }}">{{$post->category->name}}</a>
                    by
                    Upscale Adventures
                </div>
                <div>
                    Published on
                    {{date("M d, Y", strtotime($post->created_at))}}
                </div>
            </div>
            <div class="image-wrapper mx-n3">
                <img src="{{ asset($post->path) }}" width="1200" height="394" class="img-fluid w-100">
            </div>
            <div class="text-content">
                {!!$post->content!!}
            </div>
        </article>
        <div class="section-share">
            <div class="share-title">
                Share
            </div>
            <div class="social-link-wrapper">
                <a href="https://www.facebook.com/sharer/sharer.php?'{{url()->current()}}" target="_blank" class="social-link">
                    <span class="fab fa-facebook-f social-icon"></span>
                </a>
                <a href="https://twitter.com/share?url={{url()->current()}}" class="social-link">
                    <span class="fab fa-twitter social-icon"></span>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
$('a[href*="#"]')
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { 
            return false;
          } else {
            $target.attr('tabindex','-1'); 
            $target.focus();
          };
        });
      }
    }
  });
</script>
@endpush