@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'Contact Upscale Adventures',
        'title' => 'Contact Us',
        'description' => 'Get in touch with Upscale Adventures',
        'image' => asset('apple-icon-180x180.png"'),
        'robot' => ''

    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url('/images/contact.jpg');">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-8 mx-auto text-center">
                    <h1 class="heading-main">
                        Get in Touch
                    </h1>
                    <div class="description-main">
                        Please feel free to reach us by email, phone or mail using the information found on this
                        page. We are always glad to address any queries or concerns you may have about Upscale Adventures,
                        your trip, or our trips in general.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-contact-form">
    <div class="container">
        @include('frontend.partials.breadcrumb', [
            'links' => [
                [
                    'text' => 'Home',
                    'url' => url('/'),
                ],
                [
                    'text' => 'Contact Us',
                    'url' => url()->current(),
                ]           
            ],
            'position' => 'mx-auto'
        ])
        <div class="row row-contact-form">
            <div class="col-md-6">
                @include('frontend.partials._message')
                <form action="{{ route('from.contact') }}" method="POST" class="contact-form">
                    @csrf
                    <h2 class="heading">
                        Contact Us
                    </h2>
                    <div class="form-group">
                        <label for="input-full-name">
                            Full Name
                        </label>
                        <input name="full_name" class="form-control" id="input-full-name">
                    </div>
                    <div class="form-group">
                        <label for="input-email">
                            Email
                        </label>
                        <input type="email" name="email" class="form-control" id="input-email">
                    </div>
                    <div class="form-group">
                        <label for="input-subject">
                            Subject
                        </label>
                        <input name="subject" class="form-control" id="input-subject">
                    </div>
                  
                    <div class="form-group">
                        <label for="input-message">
                            Message
                        </label>
                        <textarea name="messageBody" rows="6" class="form-control" id="input-message"></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LchwMcUAAAAABMJDoJJSsRIwTsoQy6T73hu0ctQ"></div>
                    </div> --}}
                    <div class="form-group">
                        <label for="input-answer">
                            Value of <strong>!5</strong>:
                        </label>
                        <input name="answer" class="form-control" type="number" id="input-answer">
                    </div>  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block mx-auto btn-send">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="contact-other">
                    <div class="heading">
                        Other ways to connect
                    </div>
                    <div class="subheading">
                        Call, email, send us a postcard — whatever works for you. We'll be here.
                    </div>
                    <div class="d-flex contact-other-item">
                        <span class="fab fa-whatsapp icon"></span>
                        <span class="align-self-center pl-3">{{$setting->mobile}}</span>
                    </div>
                    <div class="d-flex contact-other-item">
                        <span class="fa fa-at icon"></span>
                        <span class="align-self-center pl-3">{{$setting->email}}</span>
                    </div>
                    <div class="d-flex contact-other-item">
                        <span class="fa fa-envelope icon"></span>
                        <span class="align-self-center pl-3">
                            {{$setting->address}}
                            <br>
                            {{$setting->city}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-social">
    <div class="container">
        <div class="text-center heading1">
            Get help 24/7 on social
        </div>
        <div class="text-center heading2">
            Contact support via
        </div>
        <div class="row social-list">
            <div class="col-md-4 social-list-item-wrapper">
                <div class="social-list-item">
                    <a href="{{$setting->facebook}}" class="social-link"></a>
                    <div>
                        <img src="{{ asset('images/facebook.svg') }}" alt="Upscale Adventures Facebook" width="80" height="80">
                    </div>
                    <div class="social-name">
                        Facebook
                    </div>
                    <div class="social-handle">
                        /upscaleadventures
                    </div>
                </div>
            </div>
            <div class="col-md-4 social-list-item-wrapper">
                <div class="social-list-item">
                    <a href="{{$setting->twitter}}" class="social-link"></a>
                    <div>
                        <img src="{{ asset('images/twitter.svg') }}" alt="Upscale Adventures Twitter" width="80" height="80">
                    </div>
                    <div class="social-name">
                        Twitter
                    </div>
                    <div class="social-handle">
                        @upscaleadventures
                    </div>
                </div>
            </div>
            <div class="col-md-4 social-list-item-wrapper">
                <div class="social-list-item">
                    <a href="{{$setting->instagram}}" class="social-link"></a>
                    <div>
                        <img src="{{ asset('images/instagram.svg') }}" alt="Upscale Adventures Instagram" width="80" height="80">
                    </div>
                    <div class="social-name">
                        Instagram
                    </div>
                    <div class="social-handle">
                        @upscaleadventures
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-location">
    <div class="container">
        <div class="section-heading">
            Our Head Office
        </div>
    </div>
    <div class="embed-responsive embed-responsive-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0764877416423!2d85.31186525072161!3d27.714924582704267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19029bf523e7%3A0x4f44794ea0cf2542!2sKeshar%20Mahal%20Marg%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1572337074631!5m2!1sen!2snp"
            width="800" height="600" frameborder="0" style="border:0;" allowfullscreen=""
            class="embed-responsive-item"></iframe>
    </div>
</div>


@endsection
{{-- @push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush --}}