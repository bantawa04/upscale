@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'Thank You',
        'title' => 'Thank You',
        'description' => 'We are exceptionally appreciative for that you have picked us for your next adventure.',
        'og' => '',
        'twitter' => '',
        'robot' => 'noindex,nofollow'
    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')


<div class="navbar-gap"></div>

<div>
    <section class="section-content">
        <div class="container">
            <div class="row">                
                <div class="col-12 mt-5">
                    <h1 class="text-center">Thank You</h1>
                    @include('frontend.partials._message')
                </div>
            </div>
            <div class="row mt-2">
                <p class="thanks-message">
                    Thank you for submitting the booking form. Your necessary information has been forwarded to
                    operations team and you will receive confirmation of recipient with trekking preparation guide
                    and
                    other necessary information like visa advice, medical requirements, equipments, payment detail,
                    insurance and others. You will then be requested to provide us your flight and insurance detail
                    soon.
                    Required minimum deposit amount must be paid in advance to confirm your reservation.
                    Confirmation
                    will be shared when the deposited amount is entered in our bank account.
                </p>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h3>Important Notes</h3>
                        <ul class="thanks-message">
                            <li>Minimum deposit amount i.e. 25% of the total amount must be paid within 10 days of
                                booking
                                confirmation for reservation of your place in the team.
                            </li>
                            <li>
                                Remaining balance must be paid before 30 days of the trip. The payments are accepted
                                only in
                                USD.
                            </li>
                            <li>
                                We accept Check, bank transfer, wire transfer and credit card. Additional 4% fee is
                                applied to
                                all credit card transfers. Clients themselves will be responsible for fees required for
                                wire
                                transfer.
                            </li>
                        </ul>
                        <div class="col-12">
                            <p class="text-center"><strong id="counter"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
            let text = "Your will be redirected to home page in ";
            let count = 30;
            let countdown = setInterval(function(){
            if(countdown < 2){
                $("strong#counter").html(text + count + " second.");
            }
            else{
                $("strong#counter").html(text + count + " seconds.");
            }    
            if (count == 0) {
            clearInterval(countdown);
            window.open('/', "_self");

            }
            count--;
        }, 1000);
    });
</script>
@endpush