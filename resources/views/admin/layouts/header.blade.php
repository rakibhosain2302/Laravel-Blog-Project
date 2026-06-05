<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>My Blog Project- @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/reset.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/text.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/grid.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/layout.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/nav.css') }}" media="screen" />
    <link href="{{ asset('assets/admin/css/table/demo_page.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/admin/css/fancy-button/fancy-button.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/base/jquery.ui.all.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery-ui/jquery.ui.core.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.ui.widget.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.ui.accordion.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.effects.core.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.effects.slide.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.ui.mouse.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui/jquery.ui.sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/table/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/fancy-button/fancy-button.js') }}" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="{{ asset('assets/admin/js/setup.js') }}" type="text/javascript"></script>

    @yield('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    <!-- SweetAlert2 Library -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    @stack('style')
    @stack('scripts')

    <style>
        .modern-header {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
            padding: 18px 0;
        }

        .header-branding {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-logo img {
            height: 52px;
            width: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
        }

        .header-title {
            margin: 0;
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .header-slogan {
            margin: 4px 0 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.5;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-user__avatar {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            object-fit: cover;
            border: 2px solid rgba(226, 232, 240, 0.2);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.15);
        }

        .header-user__info {
            text-align: right;
        }

        .header-user__greeting {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .header-user__name {
            display: block;
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .header-user__logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.18s ease;
        }

        .header-user__logout:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #fff;
        }

        @media (max-width: 767px) {
            .header-branding {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-user {
                align-self: stretch;
                justify-content: space-between;
            }

            .header-user__info {
                text-align: left;
            }
        }
    </style>

</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            @php
                $data = \App\Models\Titleslogan::first();
                $authUser = Auth::user();
            @endphp
            <div class="modern-header">
                <div class="header-branding">
                    <div class="header-logo">
                        <img src="{{ asset('storage/' . optional($data)->logo) }}" alt="Logo" />
                        <div>
                            <h1 class="header-title">{{ optional($data)->title }}</h1>
                            <p class="header-slogan">{{ optional($data)->slogan }}</p>
                        </div>
                    </div>
                    <div class="header-user">
                        <img class="header-user__avatar"
                            src="{{ optional($authUser)->image ? asset('storage/' . $authUser->image) : asset('assets/admin/img/img-profile.jpg') }}"
                            alt="Profile Pic" />
                        <div class="header-user__info">
                            @auth
                                <span class="header-user__greeting">Hello,</span>
                                <span class="header-user__name">{{ Auth::user()->name }}</span>
                                <br>
                                <a class="header-user__logout" href="{{ route('logout') }}">Logout</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @hasSection('content')
            @yield('content')
        @else
            <h2 class="text-danger">Content Not Pound</h2>
        @endif
    </div>

    @include('admin.layouts.footer')