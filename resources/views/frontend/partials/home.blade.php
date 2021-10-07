<div class="banner">
    {{-- medium & large screen --}}
    <div class="owl-slider">
        <div id="carousel" class="owl-carousel">
            @foreach($carousels as $item)
            <div class="item">
                <img src="{{ asset($item->url)}}" alt="1000X1000" >
            </div>
            @endforeach
        </div>
    </div>

    <div class="banner-overlay">
        <div class="container banner-content">
            <div class="banner-text">
                <div class="message-secondary">See the world beyond ordinary</div>
                <div class="message-primary">Where do you like to go ?</div>
            </div>
            <form action="{{ route('page.search') }}" class="search-wrapper" method="GET">
                @csrf
                <input name="q" placeholder="Search by destination or travel type" class="form-control">
                <button class="btn btn-primary btn-search">
                    <span class="icon fa fa-search"></span>
                    <span class="d-md-none">Search</span>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="container-triple">
    <div class="row-triple justify-content-center">
        <div class="col-sm-triple-10 col-md-triple-8 col-lg-triple-4 col-xxl-triple-4">
            <div class="box">
                <div class="box-icon-wrapper">
                    <span class="box-icon fas fa-first-aid"></span>
                </div>
                <div class="box-title">
                    Comfort and Safety First
                </div>
                <div class="box-description">
                    We always make sure that we provide customer care, We especially plan &
                    cater for your safety & comfort.
                </div>
            </div>
        </div>

        <div class="col-sm-triple-10 col-md-triple-8 col-lg-triple-4 col-xxl-triple-4">
            <div class="box">
                <div class="box-icon-wrapper">
                    <span class="box-icon fa fa-thumbs-up"></span>
                </div>
                <div class="box-title">
                    Best Price &amp; Value
                </div>
                <div class="box-description">
                    We've got a competitive price on our tour offerings yet we provide the best services to our valued
                    clients.
                </div>
            </div>
        </div>

        <div class="col-sm-triple-10 col-md-triple-8 col-lg-triple-4 col-xxl-triple-4">
            <div class="box">
                <div class="box-icon-wrapper">
                    <span class="box-icon fa fa-check icon"></span>
                </div>
                <div class="box-title">
                    Guaranteed Departure
                </div>
                <div class="box-description">
                    Booked trips are guaranteed to run on the scheduled date. With our commitment, travel worry-free.
                </div>
            </div>
        </div>
    </div>
</div>

<div id="section-about" class="container">
    <div class="box-experience">
        <div class="box">
            <div class="section-subtitle">About Upscale</div>
            <h1 class="section-title">
                Dream and Dare. Travel Nepal!
            </h1>
            <div class="box-description">
                At Upscale adventures, We stay up close, personal & promise to amend the very definition of what an
                adventure should be.

                Discover inspiring Himalayan trekking tours curated with passion & care just for you. Ranging from day
                tour to multi-day adventures our tours include- sightseeing, trekking, peak climbing, jungle safari,
                paragliding, bungee jumping and rafting tours.

                If you have a passion for lively, fascinating, & adrenaline adventures, join us as we explore the paths
                through a local perspective.

            </div>
            <div class="learn-more">
                <a href="{{ route('page.about-us') }}" class="btn btn-outline-primary btn-sm">
                    Learn More
                </a>
            </div>
            {{-- <div class="mx-auto promotional-video">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/_x7E38ULU-Y" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div> --}}
        </div>
    </div>
</div>