<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="title" content="@yield('mtitle','Upscale Adventures|Proper Holidays, Pure Adventures')">
    <meta name="description"
        content="@yield('description','Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.')">
    <meta name="robots" content="@yield('robot','index, follow')">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Upscale Adventures">
    <title>@yield('title','Upscale Adventures|Proper Holidays, Pure Adventures')</title>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="@yield('title','Upscale Adventures|Proper Holidays, Pure Adventures')">
    <meta itemprop="description"
        content="@yield('description','Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.')">
    <meta itemprop="image" content="@yield('ogImage',asset('apple-icon-180x180.png"'))">  

    <link rel="apple-touch-icon" sizes="57x57" href="{{env('IMAGE_KIT_URL')}}/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{env('IMAGE_KIT_URL')}}/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{env('IMAGE_KIT_URL')}}/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{env('IMAGE_KIT_URL')}}/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{env('IMAGE_KIT_URL')}}/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{env('IMAGE_KIT_URL')}}/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{env('IMAGE_KIT_URL')}}/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{env('IMAGE_KIT_URL')}}/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{env('IMAGE_KIT_URL')}}/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{env('IMAGE_KIT_URL')}}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{env('IMAGE_KIT_URL')}}/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{env('IMAGE_KIT_URL')}}/favicon-16x16.png">
    <link rel="manifest" href="{{env('IMAGE_KIT_URL')}}/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{env('IMAGE_KIT_URL')}}/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{env('IMAGE_KIT_URL')}}/css/style.css" rel="stylesheet">
    @stack('styles')
</head>

<body>
    @yield('content')
</body>
<script src="{{env('IMAGE_KIT_URL')}}/js/script.js"></script>
@stack('scripts')

</html>