<meta name="robots" content="{{$robot ? $robot : 'index, follow'}}">
<meta name="title" content="{{$mtitle ? $mtitle : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}">
<meta name="description" content="{{$description ? $description : 'Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.'}}">
<!-- OG Tags-->
<meta property="og:type" content="product">
<meta property="og:title" content="{{$mtitle ? $mtitle : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}">
<meta property="og:description" content="{{$description ? $description : 'Start your dream trip on your preferred travel style Be It leisure Holidays or any adventure we stay upscale & help you get the most out of the tours.'}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:image" content="{{$og ? $og : $metaImages->ogTag }}">
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
@if (Route::currentRouteName() =='blog.singlePost')
<meta property="og:type" content="article">
<meta property="og:title" content="{{$title}}">
@endif
<!-- Twitter Tags-->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@upscaleadve" />
<meta name="twitter:creator" content="@upscaleadve" />
<meta name="twitter:title" content="{{$mtitle ? $mtitle : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}">
<meta name="twitter:url" content="{{url()->current()}}" />
<meta name="twitter:image" content="{{$twitter ? $twitter : $metaImages->twitter }}" />
@if (Route::currentRouteName() =='trip.show')
<meta property="product:price:amount" content="{{$tour->price}}">
<meta property="product:price:currency" content="USD">
@endif

<title>{{$title ? $title.'|Upscale Adventures' : 'Upscale Adventures|Proper Holidays, Pure Adventures'}}</title>