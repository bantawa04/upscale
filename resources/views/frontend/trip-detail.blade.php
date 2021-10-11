@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => $tour->meta_title,
'title' =>  $tour->name.' '.$tour->days.' Day(s)',
'description' => $tour->meta_description,
'og' => $tour->ogTag,
'twitter' => $tour->twitterImg,
'robot' => $tour
])
<script type="application/ld+json">{"@context":"http://schema.org","@type":"Product","aggregateRating":{"@type":"AggregateRating","ratingValue":"4.5","reviewCount":"11"},"description":"{{$tour->meta_description}}","name":"{{$tour->name.' '.$tour->days.' Day(s)'}}","image":"{{$tour->twitterImg}}","offers":{"@type":"Offer","availability":"http://schema.org/InStock","price":"{{$tour->price}}.00","priceCurrency":"USD"}}</script>
@endpush
@inject('countries','App\Http\Utilities\Country')
@section('content')

<div class="navbar-gap"></div>

<div class="banner">
    <div class="images owl-carousel">
        @foreach($tour->slides as $item)
        <div class="embed-responsive embed-responsive-banner">
            <div class="embed-responsive-item">
                <img src="{{ asset($item->path) }}" width="1920" height="1080" class="" alt="{{$tour->title}}">
            </div>
        </div>
        @endforeach
    </div>
    <div class="trip-highlight">
        <div class="trip-highlight-box px-4">
            <div class="px-4">
                <div class="row mx-n4 justify-content-around">
                    <div class="col-sm-6 col-lg-auto px-4 my-4">
                        <div class="row mx-n2">
                            <div class="col-auto px-2">
                                <div>
                                    <span class="fa fa-mountain icon"></span>
                                </div>
                            </div>
                            <div class="col px-2">
                                <div>
                                    <div class="heading">Max Altitude</div>
                                    <div class="data">{{$tour->elevation()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-auto px-4 my-4">
                        <div class="row mx-n2">
                            <div class="col-auto px-2">
                                <div>
                                    <span class="fa fa-signal icon"></span>
                                </div>
                            </div>
                            <div class="col px-2">
                                <div>
                                    <div class="heading">Difficulty</div>
                                    <div class="data">{{$tour->difficulty->name}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-auto px-4 my-4">
                        <div class="row mx-n2">
                            <div class="col-auto px-2">
                                <div>
                                    <span class="fa fa-calendar-alt icon"></span>
                                </div>
                            </div>
                            <div class="col px-2">
                                <div>
                                    <div class="heading">Days</div>
                                    <div class="data">{{$tour->days}} Days</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-auto px-4 my-4">
                        <div class="row mx-n2">
                            <div class="col-auto px-2">
                                <div>
                                    <span class="fa fa-tag icon"></span>
                                </div>
                            </div>
                            <div class="col px-2">
                                <div>
                                    <div class="heading">Price</div>
                                    <div class="data">
                                        <div>
                                            @if ($tour->discountPrice)
                                            <span class="previous-price"><s>${{$tour->price}}</s></span>
                                            <span>${{$tour->discountPrice}}</span>
                                            @else
                                            <span>${{$tour->price}}</span>
                                            @endif
                                        </div>
                                        <div class="discount-hint">
                                            * Group Discounts Available
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-auto px-4 my-4">
                        <button class="btn btn-outline-primary btn-lg btn-block btn-book">
                            Get Quote
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>

<div class="position-relative">
    <div id="trip-detail-nav" class="container">
        <ul class="nav nav-pills nav-fill shadow">
            <li class="nav-item">
                <a href="#trip-detail-overview" class="nav-link">
                    Overview
                </a>
            </li>
            @if ($tour->itinerary->count() > 0)
            <li class="nav-item">
                <a href="#trip-detail-itinerary" class="nav-link">
                    Itinerary
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="#trip-detail-inclusion" class="nav-link">
                    Include/Exclude
                </a>
            </li>
            @if ($tour->departure->count() > 0)
            <li class="nav-item">
                <a href="#trip-detail-departures" class="nav-link">
                    Departures
                </a>
            </li>
            @endif

            @if ($tour->faq->count() > 0)
            <li class="nav-item">
                <a href="#trip-detail-faq" class="nav-link">
                    FAQ
                </a>
            </li>
            @endif
        </ul>
    </div>

    <div class="container">
        @include('frontend.partials.breadcrumb', [
            'links' => [
                [
                    'text' => 'Home',
                    'url' => url('/'),
                ],
                [
                    'text' => $tour->country->name,
                    'url' => route('country', $tour->country->slug),
                ],
                [
                    'text' => $tour->category->name,
                    'url' => route('countryCategory',[$tour->country->slug,$tour->category->slug]),
                ],
                [
                    'text' => $tour->name,
                    'url' => url()->current(),
                ],                
            ],
                'position' => ''
        ])
        <div class="row d-block">
            <div class="col-lg-4 float-right">

                <div id="trip-detail-overview" class="box-trip-overview">
                    <div class="title px-4 py-4 text-center">
                        Trip Overview
                    </div>
                    <div class="info px-4">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <span class="fa fa-map-signs icon"></span>
                                    </td>
                                    <td>
                                        <div class="heading">Trip Profile</div>
                                        <h3 class="data">{{$tour->name}},
                                            {{$tour->region ? $tour->region->name : $tour->country->name}}
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span class="fa fa-hiking icon"></span>
                                    </td>
                                    <td>
                                        <div class="heading">Type</div>
                                        <h3 class="data">{{$tour->category->name}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span class="fa fa-calendar-alt icon"></span>
                                    </td>
                                    <td>
                                        <div class="heading">Span</div>
                                        <h3 class="data">{{$tour->days}} Days</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span class="fa fa-bed icon"></span>
                                    </td>
                                    <td>
                                        <div class="heading">Accomodation</div>
                                        <h3 class="data">{{$tour->accomodation->name}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <span class="fa fa-utensils icon"></span>
                                    </td>
                                    <td>
                                        <div class="heading">Meal Plan</div>
                                        <h3 class="data">{{$tour->meal->name}}</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 float-left">

                <div class="trip-detail">

                    <div class="trip-detail-item">
                        <h1 class="mb-4 trip-title">
                            {{$tour->title ? $tour->title : $tour->name}} at a glance
                        </h1>
                        {!!$tour->overview!!}
                        <div class="col-12 my-2 p-1">
                            {!!$tour->note!!}
                        </div>
                    </div>

                    @if ($tour->itinerary->count() > 0)
                    <div id="trip-detail-itinerary" class="trip-detail-item">
                        <h2 class="mb-4 trip-subtitle">
                            {{$tour->days}} Day(s) Detailed Itinerary
                        </h2>
                        <div class="py-3 px-4 my-4 itinerary-overview">
                            <div class="row align-items-center">
                                <div class="col">
                                    Arrival on:{{$tour->location->name}}
                                    <br>
                                    Departure from: {{$tour->locationEnd->name}}
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn-expand">Expand All</a>
                                </div>
                                <div class="col-auto d-none">
                                    <a href="#" class="btn-collapse">Collapse All</a>
                                </div>
                            </div>
                        </div>
                        <div id="collapsible-itinerary" class="collapsible-list">
                            @foreach ($tour->itinerary as $itinerary)
                            <div class="collapsible-item">
                                <div id="itineraryHeading{{$loop->iteration}}" class="row mx-0 align-items-stretch">
                                    <div class="col px-4 py-3">
                                        Day {{$itinerary->day}}: {{$itinerary->title}}
                                    </div>
                                    <a href="#" class="collapsed col-auto px-0" data-toggle="collapse"
                                        data-target="#day{{$loop->iteration}}">
                                        <span>
                                            <span class="fa fa-plus icon"></span>
                                            <span class="fa fa-minus icon"></span>
                                        </span>
                                    </a>
                                </div>
                                <div id="day{{$loop->iteration}}" class="collapse"
                                    aria-labelledby="itineraryHeading{{$loop->iteration}}">
                                    <div class="px-4 py-3">
                                        {!!$itinerary->description!!}
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endif

                    <div id="trip-detail-inclusion" class="trip-detail-item">
                        <h2 class="mb-4 trip-subtitle">
                            Inclusion
                        </h2>
                        <div class="row">
                            <div class="col-md">
                                <h6 class="mb-3">What's included?</h6>
                                <ul class="list-unstyled">
                                    @foreach($tour->includes as $include)
                                    <li>
                                        <span class="fa fa-check text-success"></span>
                                        {{$include->name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md">
                                <h6 class="mb-3">What's not included?</h6>
                                <ul class="list-unstyled">
                                    @foreach($tour->excludes as $exclude)
                                    <li>
                                        <span class="fa fa-times text-danger"></span>
                                        {{$exclude->name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if ($tour->departure->count() > 0)
                    <div id="trip-detail-departures" class="trip-detail-item">
                        <h2 class="mb-4 trip-subtitle">
                            Departures
                        </h2>
                        <div>
                            The given cost are per person and exclude international flights. Given below are the
                            departure
                            dates available for online booking. If the given date is not favorable then please write us
                            and
                            we will happily customize your trip on dates more appropriate for you.
                        </div>
                        <form class="my-4 search-form">
                            <div class="row align-items-center mt-3">
                                <p class="mb-1 px-3">
                                    Please Check Available Dates for The Year of:
                                  </p>                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-md">
                                    <div class="row">
                                        <div class="col-md col-6">
                                            <input type="hidden" id="tour_id" value="{{$tour->id}}">
                                            <div class="form-group">
                                                <select class="form-control" id="year">
                                                    @for ($i = date('Y'); $i <= date('Y')+3; $i++) <option
                                                        value="{{$i}}">
                                                        {{$i}}</option>
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md col-6">
                                            <div class="form-group">
                                                <select class="form-control" id="month">
                                                    <option value="1">Jan</option>
                                                    <option value="2">Feb</option>
                                                    <option value="3">Mar</option>
                                                    <option value="4">Apr</option>
                                                    <option value="5">May</option>
                                                    <option value="6">Jun</option>
                                                    <option value="7">Jul</option>
                                                    <option value="8">Aug</option>
                                                    <option value="9">Sept</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block" id="search">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="ajaxloadmoredeparture">
                                    @foreach($departures as $item)
                                    <tr>
                                        <td>{{$item->start}}</td>
                                        <td>{{$item->end}}</td>
                                        <td>Available</td>
                                        <td>${{$tour->price}}</td>
                                        <td>
                                            <form action="{{ route('trip.book',$tour->slug) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="depID" value="{{$item->id}}">
                                                <button class="btn btn-sm btn-primary" type="submit">Book</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <td colspan="5" class="loading" style="display:none">
                                        <div class="fa-3x text-center">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </div>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if ($tour->faq->count() > 0)
                    <div id="trip-detail-faq" class="trip-detail-item">
                        <h3>
                            Frequently Asked Questions
                            </h2>
                            <div class="collapsible-list">
                                @foreach ($tour->faq as $faq)
                                <div class="collapsible-item">
                                    <div id="faqHeadingOne" class="row mx-0 align-items-stretch">
                                        <div class="col px-4 py-3">
                                            {{$faq->question}}
                                        </div>
                                        <a href="#" class="collapsed col-auto px-0" data-toggle="collapse"
                                            data-target="#faqCollapse{{$loop->iteration}}">
                                            <span>
                                                <span class="fa fa-plus icon"></span>
                                                <span class="fa fa-minus icon"></span>
                                            </span>
                                        </a>
                                    </div>
                                    <div id="faqCollapse{{$loop->iteration}}" class="collapse" aria-labelledby="faqHeadingOne">
                                        <div class="px-4 py-3">
                                            {!!$faq->answer!!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </div>
                    @endif
                </div>

            </div>
            <div class="col-lg-4 float-right">

                <div class="box-quick-enquiry">
                    <div class="title px-4 py-4 text-center">
                        Quick enquiry
                    </div>
                    <div id="response-msg" class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <form class="px-4" method="POST" action="{{ route('from.enquiry') }}" id="quick-enquiry">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{$tour->id}}">
                        <div class="form-group">
                            <label for="form-full-name">
                                Full name
                            </label>
                            <input name="full_name" id="form-full-name" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="form-email">
                                Email
                            </label>
                            <input name="email" id="form-email" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="form-contact-number">
                                Contact no.
                            </label>
                            <input name="contact_number" id="form-contact-number" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="form-country">
                                Country
                            </label>
                            <select name="country" id="form-country" class="form-control rounded-0">
                                @foreach($countries::all() as $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="form-message">
                                Message
                            </label>
                            <textarea name="messageBody" id="form-message" class="form-control rounded-0"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block mx-auto btn-send">
                                Send
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="clearfix push"></div>
        </div>
    </div>
</div>

<div class="container mt-5 mt-md-4">
    <div id="section-similar-trips">
        <h3 class="text-center">Related Trips</h2>
            <div class="trips row">
                @foreach($similars as $similar)
                <div class="col-md-4 my-4">
                    @include('frontend.partials.single-trip',['tour' => $similar])
                </div>
                @endforeach
            </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
 $(function(){var $navbar=$('#navbar');var $tripDetailNav=$('#trip-detail-nav');var navbarHeight=$navbar.outerHeight();var tripDetailNavHeight=$tripDetailNav.outerHeight();$tripDetailNav.css({top:navbarHeight,});$('body').scrollspy({target:'#trip-detail-nav',offset:navbarHeight+tripDetailNavHeight,});$tripDetailNav.find('.nav-item .nav-link').on('click',function(ev){ev.preventDefault();var href=$(this).attr('href');$('html,body').animate({scrollTop:$(href).offset().top-(navbarHeight+tripDetailNavHeight)+1,},'slow')})});$(function(){var $itinerary=$('#trip-detail-itinerary');var $collapsibleItinerary=$('#collapsible-itinerary');var toggleExpandCollapse=function(){var collapsed=$collapsibleItinerary.find('[data-toggle="collapse"].collapsed').length;if(collapsed===0){$itinerary.find('.btn-collapse').parent().removeClass('d-none');$itinerary.find('.btn-expand').parent().addClass('d-none')}else{$itinerary.find('.btn-collapse').parent().addClass('d-none');$itinerary.find('.btn-expand').parent().removeClass('d-none')}};$collapsibleItinerary.on('shown.bs.collapse',toggleExpandCollapse);$collapsibleItinerary.on('hidden.bs.collapse',toggleExpandCollapse);$itinerary.find('.btn-collapse').on('click',function(ev){ev.preventDefault();$itinerary.find('.collapse').collapse('hide')});$itinerary.find('.btn-expand').on('click',function(ev){ev.preventDefault();$itinerary.find('.collapse').collapse('show')})});$(function(){$("#quick-enquiry").submit(function(event){event.preventDefault();var post_url=$(this).attr("action");var request_method=$(this).attr("method");var form_data=$(this).serialize();$.ajax({url:post_url,type:request_method,data:form_data,success:function(data){$("#quick-enquiry").trigger("reset");if($.isEmptyObject(data.error))
{$("#response-msg").toggleClass('alert-danger alert-success');$('.print-error-msg').find('ul').empty();$('.print-error-msg').css('display','block');$('.print-error-msg').append("<p>"+data.message+"</p>");setTimeout(function(){$(".btn-send").prop("disabled",!1)},3000)}
else{printMessageErrors(data.error);$(".btn-send").prop("disabled",!1);setTimeout(function(){$('.print-error-msg').fadeOut()},3000)}}})});function printMessageErrors(msg){$('.print-error-msg').find('ul').empty();$('.print-error-msg').css('display','block');$.each(msg,function(key,value){$('.print-error-msg').find('ul').append("<li>"+value+"</li>")})}});$(function(){$('.btn-book').on('click',function(e){var $form=$('#quick-enquiry');var windowHeight=$(window).height();var formHeight=$form.height();var offset=(windowHeight>formHeight)?(windowHeight-formHeight)/2:0;e.preventDefault();$('html, body').animate({scrollTop:$("#quick-enquiry").offset().top-offset},800,'linear')})});$(function(){$('#search').click(function(e){e.preventDefault();let month=$("#month").val();let year=$("#year").val();let id=$("#tour_id").val();$(".loading").show(),$.ajax({type:"GET",url:"/ajax/load-departures",data:{'_token':$('meta[name="csrf-token"]').attr('content'),tour_id:id,year:year,month:month},success:function(data){$(".ajaxloadmoredeparture").html(data),$(".loading").hide()}})})})
</script>
@endpush