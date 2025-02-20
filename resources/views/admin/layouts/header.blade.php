<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>My Blog Project- @yield('title')</title>


    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/admin/css/reset.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/admin/css/text.css') }} " media="screen" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/admin/css/grid.css') }} " media="screen" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/admin/css/layout.css') }} " media="screen" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/admin/css/nav.css') }}" media="screen" />
    <link href=" {{ asset('assets/admin/css/table/demo_page.css') }}" rel="stylesheet" type="text/css" />

    <link href=" {{ asset('assets/admin/css/fancy-button/fancy-button.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('assets/admin/css/themes/base/jquery.ui.all.css') }} " rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="{{ asset('assets/admin/js/jquery-1.6.4.min.js') }} " type="text/javascript"></script>
    <script type="text/javascript" src=" {{ asset('assets/admin/js/jquery-ui/jquery.ui.core.min.js') }}"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.ui.widget.min.js') }} " type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.ui.accordion.min.js') }} " type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.effects.core.min.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.effects.slide.min.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.ui.mouse.min.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/jquery-ui/jquery.ui.sortable.min.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/table/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src=" {{ asset('assets/admin/js/fancy-button/fancy-button.js') }}" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src=" {{ asset('assets/admin/js/table/table.js') }}"></script>
    <script src=" {{ asset('assets/admin/js/setup.js') }}" type="text/javascript"></script>

    @yield('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    @stack('style')

</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            @php
                $data = \App\Models\Titleslogan::first();
            @endphp
            <div id="branding">
                <div class="floatleft logo">
                    <img src="{{ asset('storage/' . $data->logo) }}" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>{{ $data->title }}</h1>
                    <p>{{ $data->slogan }}</p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src=" {{ asset('assets/admin/img/img-profile.jpg') }}" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            @auth
                                <li><span class="hello">Hello</span>, <span class="auth-name">{{ Auth::user()->name }}</span></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="{{ Route('dashbord') }}" class="{{ Request::routeIs('dashbord') ? 'active' : '' }}"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="{{ Route('profile') }}" class="{{ Request::routeIs('profile') ? 'active' : '' }}"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="{{ Route('change.pass') }}" class="{{ Request::routeIs('change.pass') ? 'active' : '' }}"><span>Change Password</span></a></li>
               @if (auth()->user()->role->name === 'Admin')
               <li class="ic-grid-tables">
                   <a href="{{ route('message.index') }}" class="{{ Request::routeIs('message.index') ? 'active' : '' }}">
                       <span>
                           Inbox 
                           @if(isset($unreadCount) && $unreadCount > 0)
                           ({{ $unreadCount }})
                           @else
                           (0)
                           @endif
                        </span>
                    </a>
                </li>
                @endif
                @if (in_array(auth()->user()->role->name , ['Admin','Editor']))
                <li class="ic-grid-tables"><a href="{{ route('users.index') }}" class="{{ Request::routeIs('users.index') ? 'active' : '' }}"><span>User List</span></a></li>
                @endif
            </ul>
        </div>
        <div class="clear">
        </div>


        @hasSection('content')
            @yield('content')
        @else
            <h2 class="text-danger">Content Not Pound</h2>
        @endif
