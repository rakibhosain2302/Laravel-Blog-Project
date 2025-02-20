<!DOCTYPE html>
<html>

<head>
    <title>My Blog Project- @yield('title')</title>
    <meta name="language" content="English">
    <meta name="description" content="It is a website about education">
    <meta name="keywords" content="blog,cms blog">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href=" {{ asset('assets/fonts/font-awesome-4.5.0/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nivo-slider-css/nivo-slider.css') }}" type="text/css"
        media="screen" />
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
    <script src=" {{ asset('assets/js/jquery.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect: 'random',
                slices: 10,
                animSpeed: 500,
                pauseTime: 5000,
                startSlide: 0, //Set starting Slide (0 index)
                directionNav: false,
                directionNavHide: false, //Only show on hover
                controlNav: false, //1,2,3...
                controlNavThumbs: false, //Use thumbnails for Control Nav
                pauseOnHover: true, //Stop animation while hovering
                manualAdvance: false, //Force manual transitions
                captionOpacity: 0.8, //Universal caption opacity
                beforeChange: function() {},
                afterChange: function() {},
                slideshowEnd: function() {} //Triggers after all slides have been shown
            });
        });
    </script>
    @stack('style')
</head>

<body>
    <div class="headersection templete clear">
        <a href="{{ route('home') }}">
            @foreach ($titleslogan as $headerData)
                <div class="logo">
                    <img src="{{ asset('storage/' . $headerData->logo) }}" alt="Logo" />
                    <h2>{{ $headerData->title }}</h2>
                    <p>{{ $headerData->slogan }}</p>
                </div>
            @endforeach
        </a>
        <div class="social clear">
            <div class="icon clear">
                @foreach ($socialslink as $link)
                    <a href="{{ $link->fblink }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="{{ $link->twlink }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="{{ $link->lnlink }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="{{ $link->gllink }}" target="_blank"><i class="fa fa-google-plus"></i></a>
                @endforeach
                <div class="login-btn">
                    <a href="{{ Route('auth.login') }}">Login</a>
                </div>
            </div>
            <div class="searchbtn clear">
                <form action="{{ route('search') }}" method="get">
                    <input type="text" name="keyword" placeholder="Search keyword..." value="{{ request('keyword') }}" />
                    <input type="submit" value="Search" />
                </form>
            </div>
            
        </div>
    </div>
    <div class="navsection templete">
        <ul>
            <li>
                <a href="{{ Route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                    Home
                </a>
            </li>
            @foreach ($navPage as $nav)
                <li>
                    <a href="{{ Route('single.page', $nav->id) }}"
                        class="{{ Request::routeIs('single.page') && request()->route('id') == $nav->id ? 'active' : '' }}">
                        {{ $nav->name }}
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ Route('contract') }}" class="{{ Request::is('contract') ? 'active' : '' }}">
                    Contact Us
                </a>
            </li>
        </ul>
    </div>



    @hasSection('content')
        @yield('content')
    @else
        <h2 class="text-danger">Content Not Pound</h2>
    @endif
