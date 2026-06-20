<!DOCTYPE html>
<html>

<head>
    <title>My Blog Project - @yield('title')</title>
    <meta name="language" content="English">
    <meta name="description" content="It is a website about education">
    <meta name="keywords" content="blog,cms blog">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome-4.5.0/css/font-awesome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/nivo-slider-css/nivo-slider.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .site-header {
            background: #ffffff;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .site-header .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 2rem;
            flex-wrap: wrap;
        }

        .site-header .brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
        }

        .site-header .brand-logo {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .site-header .brand-text h2 {
            margin: 0;
            font-size: 1.6rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        .site-header .brand-text p {
            margin: 0.3rem 0 0;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .site-header .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .site-header .social-icons {
            display: flex;
            gap: 0.75rem;
        }

        .site-header .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f3f4f7;
            color: #1f2937;
            transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease;
            text-decoration: none;
        }

        .site-header .social-icons a:hover {
            transform: translateY(-2px);
            background: #2563eb;
            color: #ffffff;
        }

        .site-header .header-search {
            display: flex;
            align-items: center;
            min-width: 260px;
            max-width: 420px;
            width: 100%;
            background: #f8fafc;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            overflow: hidden;
        }

        .site-header .header-search input {
            flex: 1;
            border: 0;
            padding: 0.9rem 1rem;
            background: transparent;
            outline: none;
            font-size: 0.95rem;
            color: #111827;
        }

        .site-header .header-search input::placeholder {
            color: #9ca3af;
        }

        .site-header .header-search button {
            padding: 0.88rem 1.2rem;
            border: 0;
            color: #ffffff;
            background: #2563eb;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .site-header .header-search button:hover {
            background: #1d4ed8;
        }

        .site-header .main-nav {
            background: #031926;
            padding: 0.85rem 2rem;
        }

        .site-header .main-nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .site-header .main-nav a {
            color: #dbeafe;
            text-decoration: none;
            display: inline-block;
            padding: 0.75rem 1rem;
            border-radius: 999px;
            font-weight: 600;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .site-header .main-nav a:hover,
        .site-header .main-nav a.active {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .site-header .main-nav li {
            margin: 0;
        }

        @media (max-width: 860px) {
            .site-header .header-top {
                padding: 1rem 1.2rem;
            }

            .site-header .main-nav {
                padding: 0.75rem 1.2rem;
            }

            .site-header .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .site-header .header-search {
                min-width: 0;
                width: 100%;
            }

            .site-header .main-nav ul {
                justify-content: center;
            }
        }

        @media (max-width: 620px) {
            .site-header .header-top {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .site-header .header-actions {
                justify-content: space-between;
            }

            .site-header .brand {
                width: 100%;
            }

            .site-header .main-nav ul {
                flex-direction: column;
                gap: 0.5rem;
            }

            .site-header .main-nav a {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <script src="{{ asset('assets/js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>

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
    <header class="site-header">
        <div class="header-top">
            <a class="brand" href="{{ route('home') }}">
                @foreach ($titleslogan as $headerData)
                    <img class="brand-logo" src="{{ asset('storage/' . $headerData->logo) }}" alt="Logo" />
                    <div class="brand-text">
                        <h2>{{ $headerData->title }}</h2>
                        <p>{{ $headerData->slogan }}</p>
                    </div>
                @endforeach
            </a>

            <div class="header-actions">
                <div class="social-icons">
                    @foreach ($socialslink as $link)
                        <a href="{{ $link->fblink }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $link->twlink }}" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $link->lnlink }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="{{ $link->gllink }}" target="_blank"><i class="fa fa-google-plus"></i></a>
                    @endforeach
                </div>

                <form class="header-search" action="{{ route('search') }}" method="get">
                    <input type="text" name="keyword" placeholder="Search keyword..." value="{{ request('keyword') }}" />
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <nav class="main-nav">
            <ul>
                <li>
                    <a href="{{ Route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                @foreach ($navPage as $nav)
                    <li>
                        <a href="{{ Route('single.page', $nav->id) }}" class="{{ Request::routeIs('single.page') && request()->route('id') == $nav->id ? 'active' : '' }}">
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
        </nav>
    </header>

    @hasSection('content')
        <div class="container">
            @yield('content')
        </div>
    @else
        <h2 class="text-danger">Content Not Pound</h2>
    @endif
