<meta name="robots" content="{{$robot ? $robot : 'index, follow'}}">
<meta name="title" content="{{$mtitle ? $mtitle : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}">
<meta name="description" content="{{$description ? $description : 'Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.'}}">
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@upscaleadve" />
<meta name="twitter:creator" content="@upscaleadve" />
<meta property="og:type" content="product">
<meta property="og:title" content="{{$mtitle ? $mtitle.'|Upscale Adventures' : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}">
<meta property="og:description" content="{{$description ? $description : 'Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.'}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:image" content="{{$image ? $image : asset('apple-icon-180x180.png') }}">
@if (Route::currentRouteName() =='blog.singlePost')
<meta property="og:type" content="article">
<meta property="og:title" content="{{$title}}">
@endif
@if (Route::currentRouteName() =='trip.show')
<meta property="product:price:amount" content="{{$tour->price}}">
<meta property="product:price:currency" content="USD">
@endif

<title>{{$title ? $title.'|Upscale Adventures' : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}</title>