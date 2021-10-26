@inject('countries','App\Http\Utilities\Country')
@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'Reserve your seat for'. $tour->name,
        'title' => 'Book '. $tour->name.' '. $tour->days.' Day(s)',
        'description' => 'Secure your seat for '. $tour->name,
        'og' => $tour->ogTag,
        'twitter' => $tour->twitter,
        'robot' => 'noindex,nofollow'

    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div class="heading-wrapper-main">
    <div>
        <div class="container">
            <h1 class="heading-main">Book a Trip</h1>
        </div>
    </div>
</div>
<div>
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 book-trip-wrapper">
                    <div class="book-trip-wrapper__card">
                        <img src="{{ asset($tour->image->thumb) }}"
                            class="card-img-top" alt="...">
                        <div class="book-trip-wrapper__meta">
                            <h5 class="book-trip-wrapper__meta--name">{{$tour->name}}</h5>
                            <p class="book-trip-wrapper__meta--days">Days(s):{{$tour->days}} Day(s)</p>
                            <p class="book-trip-wrapper__meta--price">Price: ${{$tour->price}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="book-trip-form">
                        <div class="card-body">
                            <form action="{{ route('from.booking') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{$tour->id}}">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="travellersNo">No. of travellers</label>
                                        <select class="form-control" id="travellersNo" name="travellersNo">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value={{$i}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="date">Trip Start Date</label>
                                        <input type="text" class="form-control" id="date" aria-describedby="dateHelp" value="{{$departure->start}}">
                                    </div>
                                </div>
                                <hr>
                                <h4>Lead Travellers Details</h4>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"
                                        aria-describedby="nameHelp" placeholder="Enter full name" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" placeholder="Enter email" required name="email">
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact no.</label>
                                    <input type="text" class="form-control" id="contact"
                                        aria-describedby="contactnolHelp" placeholder="Contact no" required name="contact">
                                </div>
                                <div class="form-group">
                                    <label for="country">Example select</label>
                                    <select class="form-control" id="country" name="country" required>
                                        @foreach($countries::all() as $country)
                                        <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="detailedAddress">Detailed Address</label>
                                    <textarea class="form-control" id="detailedAddress" rows="3" required name="detailedAddress"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" rows="3" placeholder="Optional" name="messageBody"></textarea>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="agree" required name="agree">
                                    <label class="form-check-label" for="agree">
                                        By selecting to complete this booking I acknowledge that I have read and accept the
                                        terms & conditions, and privacy policy.
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>
<script>
    $('#date').datepicker({
    language: 'en',
    minDate: new Date(),
    dateFormat: "d M yyyy"
})
</script>
@endpush