<nav id="navbar-menu">
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <a href="{{ route('country', 'nepal') }}">Nepal</a>
            <ul>
                <li>
                    <a href="{{ route('countryCategory',['nepal','trekking']) }}">Trekking</a>
                    <ul>
                        <li>
                            <a href="{{ route('categoryRegion',['trekking','annapurna-region']) }}">Annapurna Region</a>
                            <ul>
                                @foreach ($as as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="" {{ route('categoryRegion',['trekking','everest-region']) }}">Everest Region</a>
                            <ul>
                                @foreach ($es as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('categoryRegion',['trekking','manaslu-region']) }}">Manaslu Region</a>
                            <ul>
                                @foreach ($ms as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('categoryRegion',['trekking','langtang-region']) }}">Langtang Region</a>
                            <ul>
                                @foreach ($ls as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('categoryRegion',['trekking','off-beaten-path']) }}">Off Beaten Path</a>
                            <ul>
                                @foreach ($off as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('byCategory','climbing') }}">Peak Climbing</a>
                    <ul>
                        @foreach ($climb as $item)
                        <li>
                            <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('byCategory','excursion') }}">Excursion</a>
                    <ul>
                        @foreach ($ex as $item)
                        <li>
                            <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('byCategory', 'nature-wildlife') }}">Nature &amp; Wildlife</a>
                    <ul>
                        @foreach ($na as $item)
                        <li>
                            <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                <li>
            </ul>
        </li>
        <li>
            <a href="{{ route('country', 'tibet') }}">Tibet</a>
            <ul>
                @foreach ($tibet as $item)
                <li>
                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="{{ route('country', 'bhutan') }}">Bhutan</a>
            <ul>
                @foreach ($bhutan as $item)
                <li>
                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="{{ route('byCategory','heli-tour') }}">Heli Tour</a>
            <ul>
                @foreach ($ht as $item)
                <li>
                    <a href="{{ route('trip.show',$item->slug) }}">{{$item->name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#">About UA</a>
            <ul>
                <li>
                    <a href="{{ route('page.about-us') }}">About Us</a>
                </li>
                <li>
                    <a href="{{ route('blog.posts') }}">Travel Blog</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('page.contact') }}">Contact</a>
        </li>
    </ul>
</nav>
<nav id="navbar" class="navbar navbar-expand-xl navbar-dark fixed-top">
    <div class="container">
        <a href="{{ asset('/') }}" class="navbar-brand">
            <img src="{{env('IMAGE_KIT_URL')}}/images/logo.png" alt="Upscale Adventures" class="logo">
        </a>
        <button id="navbar-menu-toggler" class="navbar-toggler" type="button" data-toggle="collase"
            data-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto flex-grow-1 justify-content-around">
                <li class="nav-item mx-3">
                    <a href="{{ url('') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="{{ route('country', 'nepal') }}" class="nav-link dropdown-toggle">Nepal</a>
                    <ul class="dropdown-menu dropright">
                        <li>
                            <a href="{{ route('countryCategory',['nepal','trekking']) }}"
                                class="dropdown-item dropdown-toggle">Trekking</a>
                            <ul class="dropdown-menu dropright">
                                <li>
                                    <a href="{{ route('categoryRegion',['trekking','annapurna-region']) }}"
                                        class="dropdown-item dropdown-toggle">Annapurna Region</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($as as $item)
                                        <li>
                                            <a href="{{ route('trip.show',$item->slug) }}"
                                                class="dropdown-item">{{$item->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('categoryRegion',['trekking','everest-region']) }}"
                                        class="dropdown-item dropdown-toggle">Everest Region</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($es as $item)
                                        <li>
                                            <a href="{{ route('trip.show',$item->slug) }}"
                                                class="dropdown-item">{{$item->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('categoryRegion',['trekking','manaslu-region']) }}"
                                        class="dropdown-item dropdown-toggle">Manaslu Region</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($ms as $item)
                                        <li>
                                            <a href="{{ route('trip.show',$item->slug) }}"
                                                class="dropdown-item">{{$item->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('categoryRegion',['trekking','langtang-region']) }}"
                                        class="dropdown-item dropdown-toggle">Langtang Region</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($ls as $item)
                                        <li>
                                            <a href="{{ route('trip.show',$item->slug) }}"
                                                class="dropdown-item">{{$item->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('categoryRegion',['trekking','off-beaten-path']) }}"
                                        class="dropdown-item dropdown-toggle">Off Beaten Path</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($off as $item)
                                        <li>
                                            <a href="{{ route('trip.show',$item->slug) }}"
                                                class="dropdown-item">{{$item->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('byCategory','climbing') }}"
                                class="dropdown-item dropdown-toggle">Peak Climbing</a>
                            <ul class="dropdown-menu">
                                @foreach ($climb as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}"
                                        class="dropdown-item">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('byCategory','excursion') }}"
                                class="dropdown-item dropdown-toggle">Excursion</a>
                            <ul class="dropdown-menu">
                                @foreach ($ex as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}"
                                        class="dropdown-item">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('byCategory','nature-wildlife') }}"
                                class="dropdown-item dropdown-toggle">Nature & Wildlife</a>
                            <ul class="dropdown-menu">
                                @foreach ($na as $item)
                                <li>
                                    <a href="{{ route('trip.show',$item->slug) }}"
                                        class="dropdown-item">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        <li>
                    </ul>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="{{ route('country', 'tibet') }}" class="nav-link dropdown-toggle">Tibet</a>
                    <ul class="dropdown-menu">
                        @foreach ($tibet as $item)
                        <li>
                            <a href="{{ route('trip.show',$item->slug) }}"
                                class="dropdown-item">{{$item->name}}</a>
                        </li>
                        @endforeach

                    </ul>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="{{ route('country', 'bhutan') }}" class="nav-link dropdown-toggle">Bhutan</a>
                    <ul class="dropdown-menu">
                        @foreach ($bhutan as $item)
                        <li>
                            <a href="{{ route('trip.show',$item->slug) }}"
                                class="dropdown-item">{{$item->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="{{ route('byCategory', 'heli-tour') }}" class="nav-link dropdown-toggle">Heli Tour</a>
                    <ul class="dropdown-menu">
                    @foreach ($ht as $item)
                    <li>
                        <a href="{{ route('trip.show',$item->slug) }}"
                            class="dropdown-item">{{$item->name}}</a>
                    </li>
                    @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="#" class="nav-link dropdown-toggle">About UA</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('page.about-us') }}"class="dropdown-item" >About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('blog.posts') }}" class="dropdown-item">Travel Blog</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item mx-3">
                    <a href="{{ route('page.contact') }}" class="nav-link rounded-pill link-contact px-3">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>