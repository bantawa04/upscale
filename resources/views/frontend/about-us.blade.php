@extends('layouts.app')
@push('meta')
    @include('frontend.partials._meta-tags', [
        'mtitle' => 'About Upscale Adventures',
        'title' => $page->title,
        'description' => $page->meta_description,
        'image' => asset('apple-icon-180x180.png"'),
        'robot' => ''
    ])
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}</script>
@endpush
@section('content')

<div class="navbar-gap"></div>

<div class="heading-wrapper-main" style="background-image: url({{$page->banner}});">
    <div>
        <div class="container">
            <h1 class="heading-main">{{$page->title}}</h1>
        </div>
    </div>
</div>

<div class="section-message">
    <div class="container">
        @include('frontend.partials.breadcrumb', [
            'links' => [
                [
                    'text' => 'Home',
                    'url' => url('/'),
                ],
                [
                    'text' => 'About',
                    'url' => url()->current(),
                ]           
            ],
            'position' => 'mx-auto'
        ])
        <div class="row row-message">
            <div class="col-md-auto">
                {{-- <img src="{{ asset('images/tripadvisor-travelers-choice.png') }}" alt="Tripadvisor travelers
                choice"
                width="396" height="380" class="img-fluid"> --}}
                <div id="TA_selfserveprop228" class="TA_selfserveprop">
                    <ul id="sHIzY26I" class="TA_links gi2uRr4F">
                        <li id="PlX02pov5Ki" class="hxZMYEMv2"><a target="_blank"
                                href="https://www.tripadvisor.com/"><img
                                    src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png"
                                    alt="TripAdvisor" /></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-block"></div>
            <div class="col-md">
                <div class="h2 heading">It's all about the adventure</div>
                {!!$page->content!!}
            </div>
        </div>
    </div>
</div>

<div class="section-key-notes">
    <div class="container">
        <div class="text-center">
            <div class="section-title">
                Key Notes
            </div>
            <div class="section-description">
                Reasons to go for Upscale Adventures
            </div>
        </div>
        <div class="row key-notes-list">
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fa fa-first-aid icon"></span>
                <div class="title">
                    Comfort and Safety First
                </div>
                <div class="description">
                    We always make sure that we provide customer care, We especially plan &
                    cater for your safety & comfort

                </div>
            </div>
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fa fa-thumbs-up icon"></span>
                <div class="title">
                    Best Price &amp; Value
                </div>
                <div class="description">
                    We've got a competitive price on our tour offerings yet we provide the best services to our valued
                    clients.
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fa fa-check icon"></span>
                <div class="title">
                    Guaranteed Departure
                </div>
                <div class="description">
                    Booked trips are guaranteed to run on the scheduled date. With our commitment, travel worry-free.
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fa fa-award first-aid icon"></span>
                <div class="title">
                    Local Expert Guides
                </div>
                <div class="description">
                    Our enthusiastic team of local professionals who help you put your trip together who has a decade of
                    experience in the himalayas of Nepal. They give suggestions about places, share tips & take your
                    worries.
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fas fa-sync icon"></span>
                <div class="title">
                    24/7 Customer Support
                </div>
                <div class="description">
                    Communication is important to us, we stay in touch both before & during the journey. we are always
                    upfront to respond to your queries & keep you posted about the trip.
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 text-center key-notes-list-item">
                <span class="fa fa-seedling icon"></span>
                <div class="title">
                    Responsible Tourism
                </div>
                <div class="description">
                    We strongly promote community-based sustainable & eco-friendly tourism. A little effort towards the
                    planet earth can reduce the multitude of threats to the environment. We avoid the use of plastic on
                    our tours
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-team">
    <div class="container">
        <div class="text-center">
            <div class="section-title">
                Our Team
            </div>
            <div class="section-description">
                If you are looking for unique, authentic experiences, local immersion, & unparalleled personal touches,
                because you are not ready to layoff your vacation on doing generic things-these smiling faces are here
                to sort an epic trip for you.
            </div>
        </div>
        <div class="team-member-list">
            <ul class="nav nav-pills nav-fill" role="tablist">
                @foreach($tcategories as $category)
                @if ($category->team->count() > 0)
                <li class="nav-item">
                    <a href="#{{str_slug($category->name)}}" class="nav-link {{$loop->first ? 'active' : ''}}"
                        data-toggle="tab" role="tab">{{ $category->name}}</a>
                </li>
                @endif
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($tcategories as $category)
                @if ($category->team->count() > 0)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{str_slug($category->name)}}"
                    role="tabpanel">
                    @foreach($category->team->chunk(4) as $row)
                    <div class="row row-team-member">
                        @foreach($row as $team)
                        @if($team->show_status)
                        <div class="col-md-3 team-member">
                            <img src="{{$team->image}}" alt="{{ $team->name }}" width="348" height="435"
                                class="img-fluid">
                            <div class="member-name"><strong>{{ $team->name }}</strong></div>
                            <div class="member-designation">{{$team->position}}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script async
    src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=228&amp;locationId=19493509&amp;lang=en_US&amp;rating=true&amp;nreviews=2&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=true&amp;display_version=2"
    data-loadtrk onload="this.loadtrk=true"></script>
@endpush