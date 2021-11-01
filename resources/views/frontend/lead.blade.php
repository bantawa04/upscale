@inject('countries','App\Http\Utilities\Country')
@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'Travel Special',
        'title' => 'Travel Special',
        'description' => 'Chosen best ones from our wide scope of varieties for you to pick.',
        'og' => '',
        'twitter' => '',
        'robot' => 'noindex, nofollow'

    ])
    <script type="application/ld+json">
        {
          "@context": "http://schema.org/",
          "@type": "Organization",
          "name": "Upscale Adventures",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Keshar Mahal Marg, Thamel",
            "addressLocality": "Kathmandu",
            "addressRegion": "Bagmati",
            "postalCode": "44600"
          },
          "telephone": "+977-9851062726"
        }
        </script>
@endpush
@section('content')

<div class="section-main" style="background-image: url('{{ asset('images/bg_image.jpeg') }}');">
    <div class="content-wrapper">
        <div class="container">
            <div class="row d-block d-md-flex">
                <div class="col-md-6 col-lg-7 col-xl-8 col-text">
                    <div class="logo-wrapper">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Upscale Adventures" width="737" height="189"
                                class="logo">
                        </a>
                    </div>
                    <div class="message-main">
                        Plan your next wave of adventure
                    </div>
                    <div class="message-discount">
                        10% off on all showcased products
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4 col-form">
                    <form method="POST" action="{{ route('from.lead') }}">
                        @csrf
                        <div class="form-title">
                            Get a quote
                        </div>
                        <div class="form-group">
                            <input name="full_name" title="Full Name" placeholder="Full Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input name="email" title="Email" placeholder="Email" class="form-control" type="email">
                        </div>
                        <div class="form-group">
                            <input name="phone" title="Your Phone" placeholder="Your Phone" class="form-control"
                                type="tel">
                        </div>
                        <div class="form-group">
                            <select name="country" title="Country" class="form-control">
                                <option>Select Country</option>
                                @foreach($countries::all() as $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="tour_id" title="Trip" class="form-control" id="trip_id">
                                <option>Select Trip</option>
                                @foreach ($tours as $item)
                                <option value="{{$item->id}}">{{$item->name}} {{$item->days}} Days</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="messageBody" title="Message" placeholder="Message" rows="5"
                                class="form-control" style="resize: none"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-recommendation">
    <div class="container">
        <div class="section-title">Highly recommended on:</div>
        <div class="row ">
            <div class="col-md-10 offset-md-1">
                <div class="row recommended-by-brand mt-2">
                    <div class="col-sm-auto my-3">
                        <img src="{{ asset('images/tripadvisor.png') }}" alt="tripadvisor upscale adventures"/>
                    </div>
                    <div class="col-sm-auto my-3">
                        <img src="{{ asset('images/bokun.png') }}" alt="tripadvisor upscale adventures"/>
                    </div>
                    <div class="col-sm-auto my-3">
                        <img src="{{ asset('images/inspirock.png') }}" alt="tripadvisor upscale adventures"/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@if ($tours->count() > 0)
<div class="section-trips">
    <div class="container">
        <div class="trip-list">
            @foreach ($tours as $item)
            <div class="trip-list-item">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <div class="image-holder" style="background-image: url({{ asset($item->image->thumb) }});">
                        </div>
                    </div>
                    <div class="col-md-7 px-3 card-body col-text">
                        <div class="text-wrapper">
                            <div>
                                <span class="fa fa-calendar-alt"></span>
                                {{$item->days}} Days &mdash; {{$item->days-1}} Nights
                            </div>
                            <h5 class="trip-title item-title mt-3">
                                {{$item->name}}
                            </h5>
                            <div>
                                {{$item->meta_description}}
                            </div>
                            <div class="text-price">
                                Starting from just
                                <span class="price">
                                    @if ($item->discountPrice)
                                    <s>${{$item->price}}</s>
                                    <span>${{$item->discountPrice}}</span>
                                    @else
                                    <span>${{$item->price}}</span>
                                    @endif
                                </span>
                            </div>
                            <div class="mx-auto mx-md-0 plan-btn-wrapper">
                                <a href="#" class="btn btn-primary btn-block btn-plan-trip" data-val={{$item->id}}>
                                    Plan my trip
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="section-footer">
    <div class="container">
        <div class="text-center">
            Upscale Adventures is the company name of Aryatara Adventures Pvt. Ltd. The company’s logo, name and slogan
            are registered with the Ministry of Culture, Tourism & Civil Aviation (MOTCA), Government of Nepal. All
            content and photography within this website are subject to copyright and may not be reproduced without
            permission.
        </div>
        <div class="text-center mt-2">
            © 2019. All Rights Reserved
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $('.btn-plan-trip').on('click', function (ev) {
    ev.preventDefault();
    $('#trip_id').val($(this).data('val')).trigger('change');

    var windowHeight = $(window).height();
    var $form = $('.section-main .col-form');
    var formHeight = $form.height();
    var offset = (windowHeight > formHeight)
        ? (windowHeight - formHeight) / 2
        : 0;

    $('html,body').animate({
        scrollTop: $form.offset().top - offset,
    }, 500, 'linear');
});

</script>

@endpush