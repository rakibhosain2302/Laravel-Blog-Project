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
            border: 1px solid #CCC;
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
            border: 1px solid #CCC;
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
            padding: 15px;
            border: 0;
            color: #ffffff;
            background: #2563eb;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            width: 100px;
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

    <style>
        :root {
            color-scheme: light;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        body {
            background: #f3f6fb;
            color: #111827;
            min-height: 100vh;
            font-smooth: always;
            -webkit-font-smoothing: antialiased;
        }

        .site-header {
            background: #ffffff;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .site-header .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 2rem;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
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
            border: 1px solid #e2e8f0;
        }

        .site-header .brand-text h2 {
            margin: 0;
            font-size: 1.75rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        .site-header .brand-text p {
            margin: 0.25rem 0 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        .site-header .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-end;
            width: 100%;
            max-width: 520px;
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
            border: 1px solid #d1d5db;
            border-radius: 50%;
            background: #f8fafc;
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
            width: 100%;
            background: #f8fafc;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            overflow: hidden;
        }

        .site-header .header-search input {
            flex: 1;
            border: 0;
            padding: 0.85rem 1rem;
            background: transparent;
            outline: none;
            font-size: 0.95rem;
            color: #111827;
        }

        .site-header .header-search input::placeholder {
            color: #94a3b8;
        }

        .site-header .header-search button {
            padding: 0.9rem 1.2rem;
            border: 0;
            color: #ffffff;
            background: #2563eb;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            width: auto;
        }

        .site-header .header-search button:hover {
            background: #1d4ed8;
        }

        .site-header .main-nav {
            background: #031926;
            padding: 0.85rem 2rem;
        }

        .site-header .main-nav .container {
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .site-header .main-nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
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

        .contentsection {
            padding: 3rem 0;
        }

        .section-heading {
            font-size: clamp(1.8rem, 2.5vw, 2.4rem);
            margin-bottom: 0.4rem;
            color: #111827;
        }

        .post-card {
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            background: #ffffff;
        }

        .post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 68px rgba(15, 23, 42, 0.12);
        }

        .post-card .card-body {
            padding: 1.5rem;
        }

        .post-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 260px;
        }

        .post-card h2 a {
            color: #0f172a;
            text-decoration: none;
        }

        .post-card h2 a:hover {
            color: #2563eb;
        }

        .widget {
            background: #ffffff;
            border-radius: 24px;
            padding: 1.6rem;
            box-shadow: 0 18px 52px rgba(15, 23, 42, 0.08);
            margin-bottom: 1.5rem;
        }

        .widget-title {
            margin-bottom: 1.2rem;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #111827;
        }

        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list li {
            margin-bottom: 0.85rem;
        }

        .category-list a {
            color: #475569;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .category-list a:hover {
            color: #2563eb;
        }

        .recent-post {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
        }

        .recent-post:last-child {
            border-bottom: none;
        }

        .recent-post__thumb {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, 0.22);
        }

        .recent-post__title a {
            color: #0f172a;
            font-size: 0.98rem;
            text-decoration: none;
        }

        .recent-post__title a:hover {
            color: #2563eb;
        }

        .site-footer {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.82);
            padding: 3rem 0 1.5rem;
        }

        .site-footer .footer-top {
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .site-footer h2,
        .site-footer p {
            color: #ffffff;
        }

        .site-footer .footer-socials {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .site-footer .footer-socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .site-footer .footer-socials a:hover {
            transform: translateY(-2px);
            background: #2563eb;
            border-color: transparent;
        }

        .footer-bottom {
            padding-top: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.68);
        }

        .slidersection {
            margin-bottom: 2.5rem;
        }

        .custom-slider {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            min-height: 360px;
            box-shadow: 0 28px 86px rgba(15, 23, 42, 0.12);
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .slide.active {
            opacity: 1;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slide-caption {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            padding: 2rem;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 45%, rgba(15, 23, 42, 0.85) 100%);
        }

        .slide-caption h2 {
            margin: 0;
            color: #ffffff;
            font-size: clamp(2rem, 3vw, 3.2rem);
            line-height: 1.05;
            text-shadow: 0 18px 50px rgba(15, 23, 42, 0.35);
        }

        .slider-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 52px;
            height: 52px;
            border: none;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.55);
            color: #ffffff;
            cursor: pointer;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-width 0.2s ease, transform 0.2s ease;
        }

        .slider-control:hover {
            background: rgba(37, 99, 235, 0.9);
            transform: translateY(-50%) scale(1.05);
        }

        .slider-control.prev {
            left: 1rem;
        }

        .slider-control.next {
            right: 1rem;
        }

        .slider-indicators {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.65rem;
        }

        .slider-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            border: none;
            background: rgba(255, 255, 255, 0.55);
            transition: transform 0.2s ease, background 0.2s ease;
            cursor: pointer;
        }

        .slider-indicators button.active {
            background: #2563eb;
            width: 14px;
            height: 14px;
        }

        @media (max-width: 860px) {
            .site-header .header-top {
                padding: 1rem 1.2rem;
            }

            .site-header .main-nav {
                padding: 0.75rem 1.2rem;
            }

            .site-header .header-actions {
                justify-content: space-between;
            }

            .site-header .header-search {
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

            .custom-slider {
                min-height: 240px;
            }
        }
    </style>
    <script src="{{ asset('assets/js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom-slider.js') }}" defer></script>
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
                    <input type="text" name="keyword" placeholder="Search keyword..."
                        value="{{ request('keyword') }}" />
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <nav class="main-nav">
            <div class="container">
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
        </nav>
    </header>

    <main class="container pt-0">

        @hasSection('content')
            @yield('content')
        @else
            <div class="alert alert-danger">
                Content Not Found
            </div>
        @endif

    </main>

    @include('layouts.footer')
