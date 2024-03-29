<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/" >
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Upscale Adventures">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current()}}/" />
    <link rel=“canonical”  href="{{ url()->current()}}/" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{env('IMAGE_KIT_URL')}}/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{env('IMAGE_KIT_URL')}}/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{env('IMAGE_KIT_URL')}}/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{env('IMAGE_KIT_URL')}}/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{env('IMAGE_KIT_URL')}}/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{env('IMAGE_KIT_URL')}}/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{env('IMAGE_KIT_URL')}}/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{env('IMAGE_KIT_URL')}}/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{env('IMAGE_KIT_URL')}}/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{env('IMAGE_KIT_URL')}}/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{env('IMAGE_KIT_URL')}}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{env('IMAGE_KIT_URL')}}/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{env('IMAGE_KIT_URL')}}/favicon-16x16.png">
    <!--<link rel="manifest" href="{{ asset('manifest.json') }}">-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{env('IMAGE_KIT_URL')}}/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-site-verification" content="alKOmHO1iHSMk-UW__svD3oe9D1EFeyB34zzkA-KR-8">
    <meta name="yandex-verification" content="603a43b23fdd88e5" />
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" ></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @stack('styles')
    <!-- Global site tag (gtag.js) - Google Ads: 10864276212 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10864276212"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'AW-10864276212');
    </script>
</head>

<body class="template-{{ $viewName }}">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WV4PK97"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @if (Route::currentRouteName() != 'page.lead')
    @include('frontend.partials.navbar')
    @endif
    @yield('content')
    @if (Route::currentRouteName() != 'page.lead')
    @include('frontend.partials.footer-2')
    @endif
</body>
<script src="{{env('IMAGE_KIT_URL')}}/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="https://ik.imagekit.io/azq00gyzbcp/js/agolia.js"></script>
@stack('scripts')

</html>