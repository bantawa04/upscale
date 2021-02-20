<div class="footer-2">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row footer-recommended-wrapper">

                    <div class="col-sm-auto my-3">
                        <div class="footer-recommended">
                            <img src="{{ asset('images/tripadvisor.png') }}" alt="tripadvisor upscale adventures" />
                        </div>
                    </div>
                    <div class="col-sm-auto my-3">
                        <div class="footer-recommended">
                            <img src="{{ asset('images/bokun.png') }}" alt="bukon upscale adventures"/>
                        </div>
                    </div>
                    <div class="col-sm-auto my-3">
                        <div class="footer-recommended">
                            <img src="{{ asset('images/inspirock.png') }}" alt="inspirock upscale adventures" />
                        </div>
                    </div>
                </div>
                <hr class="footer-divider">
                <div class="row">
                    <div class="col-sm-6 col-lg-3 my-4 footer-content">
                        <div class="footer-heading-2">Travel Style</div>
                        @foreach ($categories as $item)
                        <div class="footer-link-wrapper">
                            <a href="{{ route('byCategory',$item->slug) }}">{{$item->name}}</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6 col-lg-3 my-4 footer-content">
                        <div class="footer-heading-2">About</div>
                        <div><a href="{{ url('about-us') }}">About us</a></div>
                        {{-- <div class="footer-link-wrapper"><a href="#">Awards</a></div> --}}                        
                        {{-- <div class="footer-link-wrapper"><a href="#">Our Team</a></div> --}}
                        @foreach ($left as $item)
                            <div class="footer-link-wrapper"><a href="{{ route('sub-page.get',$item->slug) }}">{{$item->title}}</a></div>
                        @endforeach                        
                        {{-- <div class="footer-link-wrapper"><a href="#">FAQ</a></div> --}}
                        {{-- <div class="footer-link-wrapper"><a href="#">Reviews</a></div> --}}
                        <div class="footer-link-wrapper"><a href="{{ route('blog.posts') }}">Travel Blog</a></div>
                    </div>
                    <div class="col-sm-6 col-lg-3 my-4 footer-content">
                        <div class="footer-heading-2">Useful links</div>
                        <div class="footer-link-wrapper"><a href="{{ route('destination') }}">All Destinations</a></div>
                        <div class="footer-link-wrapper"><a href="{{ route('activities') }}">All Activities</a></div>
                        @foreach ($right as $item)
                            <div class="footer-link-wrapper"><a href="{{ route('sub-page.get',$item->slug) }}">{{$item->title}}</a></div>
                        @endforeach   
                        {{-- <div class="footer-link-wrapper"><a href="#">Private Booking vs Group Join</a></div>
                        <div class="footer-link-wrapper"><a href="#">Travel Insurances</a></div>
                        <div class="footer-link-wrapper"><a href="#">Privacy &amp; Disclaimer</a></div> --}}
                    </div>
                    <div class="col-sm-6 col-lg-3 my-4 footer-content footer-details p-3">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid pr-4" alt="Upscale Adventures">
                        <div class="footer-address mt-3">
                            <p>Upscale Adventures</p>
                            <p>{{$setting->address}}</p>
                            <p>44600, {{$setting->city}}</p>
                            <p>{{$setting->mobile}}</p>
                            <p>{{$setting->phone}}</p>
                            <p><a href="{{ route('page.contact')}}">Use contact form</a></p>
                        </div>
                    </div>
                </div>
                <form class="newsletter-form">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-lg-2 my-2">
                            <label class="sr-only" for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="First Name">
                        </div>
                        <div class="col-6 col-lg-2 my-2">
                            <label class="sr-only" for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                        </div>
                        <div class="col-lg-4 my-2">
                            <label class="sr-only" for="email">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="email" placeholder="example@example.com">
                            </div>
                        </div>
                        <div class="col-lg-4 my-2">
                            <button type="submit" class="btn btn-primary btn-block">SIGNUP FOR NEWSLETTER</button>
                        </div>
                    </div>
                </form>
                <hr class="footer-divider">
                <div class="social-link-wrapper d-flex justify-content-center">
                    <a href="{{$setting->facebook}}" class="social-link">
                        <span class="fab fa-facebook-f social-icon"></span>
                    </a>
                    <a href="{{$setting->instagram}}" class="social-link">
                        <span class="fab fa-instagram social-icon"></span>
                    </a>
                    <a href="{{$setting->twitter}}" class="social-link">
                        <span class="fab fa-twitter social-icon"></span>
                    </a>
                    <a href="{{$setting->youtube}}" class="social-link">
                        <span class="fab fa-youtube social-icon"></span>
                    </a>
                    <a href="{{$setting->pintrest}}" class="social-link">
                        <span class="fab fa-pinterest-p social-icon"></span>
                    </a>
                    <a href="{{$setting->linkedin}}" class="social-link">
                        <span class="fab fa-linkedin social-icon"></span>
                    </a>                    
                </div>
                <hr class="footer-divider">
                <div class="col-12 copyright-text">
                    <p>Copyright {{date('Y')}} Upscale Adventures</p>
                    <p>Registered Office: Upscale Adventures Pvt. Ltd, Keshar Mahal Marg, Thamel, 44600 Kathmandu</p>
                    <p>Registered no: 168646/76/077</p>
                </div>
            </div>
        </div>
    </div>
</div>