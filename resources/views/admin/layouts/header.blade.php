<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Blog Project - @yield('title')</title>

    <!-- Modern CSS Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/reset.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/text.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/grid.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/layout.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/nav.css') }}" media="screen" />
    <link href="{{ asset('assets/admin/css/table/demo_page.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/fancy-button/fancy-button.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/base/jquery.ui.all.css') }}" rel="stylesheet" type="text/css" />

    <!-- jQuery and Plugins -->
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
    <script src="{{ asset('assets/admin/js/setup.js') }}" type="text/javascript"></script>

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @yield('scripts')
    @stack('style')
    @stack('scripts')

    <style>
        :root {
            --primary-color: #0f172a;
            --secondary-color: #1e293b;
            --accent-color: #3b82f6;
            --accent-hover: #2563eb;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border-color: rgba(148, 163, 184, 0.12);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.2);
            --transition-fast: 0.15s ease;
            --transition-smooth: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        /* Modern Header Container */
        .admin-header-wrapper {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.99) 0%, rgba(30, 41, 59, 0.98) 100%);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .admin-header {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            min-height: 72px;
        }

        /* Logo and Branding Section */
        .header-branding-section {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
            min-width: 0;
        }

        .header-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform var(--transition-fast);
        }

        .header-logo-container:hover {
            transform: translateY(-2px);
        }

        .header-logo-image {
            height: 52px;
            width: auto;
            border-radius: 12px;
            filter: drop-shadow(var(--shadow-md));
            transition: filter var(--transition-smooth);
        }

        .header-logo-container:hover .header-logo-image {
            filter: drop-shadow(0 6px 20px rgba(59, 130, 246, 0.3));
        }

        .header-branding-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .header-title {
            margin: 0;
            color: var(--text-primary);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.03em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-slogan {
            margin: 0;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Center Navigation/Breadcrumb (optional space) */
        .header-center {
            display: none;
            flex: 1;
            justify-content: center;
        }

        .header-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 13px;
        }

        /* User Profile Section */
        .header-user-section {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }

        /* Notifications/Status Icons */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-secondary);
            border: 1px solid transparent;
            cursor: pointer;
            transition: all var(--transition-fast);
            font-size: 16px;
            position: relative;
        }

        .action-icon-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .action-icon-btn.active {
            background: rgba(59, 130, 246, 0.2);
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
        }

        .divider {
            width: 1px;
            height: 32px;
            background: var(--border-color);
        }

        /* User Profile Card */
        .user-profile-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px 8px 8px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all var(--transition-fast);
            cursor: pointer;
        }

        .user-profile-card:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(226, 232, 240, 0.2);
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition-fast);
        }

        .user-profile-card:hover .user-avatar {
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: left;
        }

        .user-name {
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .user-role {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .user-dropdown-icon {
            color: var(--text-secondary);
            font-size: 12px;
            transition: transform var(--transition-fast);
        }

        .user-profile-card:hover .user-dropdown-icon {
            transform: translateY(2px);
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            min-width: 240px;
            display: none;
            z-index: 1000;
        }

        .dropdown-menu.active {
            display: flex;
            flex-direction: column;
        }

        .dropdown-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all var(--transition-fast);
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        .dropdown-menu-item:first-child {
            border-radius: 11px 11px 0 0;
        }

        .dropdown-menu-item:last-child {
            border-radius: 0 0 11px 11px;
        }

        .dropdown-menu-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: var(--accent-color);
            padding-left: 18px;
        }

        .dropdown-menu-item i {
            width: 16px;
            text-align: center;
        }

        .dropdown-menu-divider {
            height: 1px;
            background: var(--border-color);
            margin: 4px 0;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #fecaca;
            padding-left: 18px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .admin-header {
                padding: 12px 16px;
                gap: 16px;
            }

            .header-title {
                font-size: 18px;
            }

            .header-logo-image {
                height: 44px;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-wrap: wrap;
                padding: 12px 16px;
                min-height: auto;
            }

            .header-branding-section {
                flex: 1 1 100%;
                min-width: 0;
            }

            .header-user-section {
                flex: 1 1 100%;
                margin-left: 0;
                justify-content: space-between;
            }

            .header-title {
                font-size: 16px;
            }

            .header-logo-image {
                height: 40px;
            }

            .header-center {
                display: none;
            }

            .user-info {
                display: none;
            }

            .action-icon-btn {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .divider {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                padding: 10px 12px;
            }

            .header-branding-section {
                gap: 10px;
            }

            .header-title {
                font-size: 14px;
            }

            .header-slogan {
                font-size: 11px;
            }

            .header-logo-image {
                height: 36px;
            }

            .header-actions {
                gap: 4px;
            }

            .action-icon-btn {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }
        }

        /* Loading and Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu.active {
            animation: fadeIn var(--transition-smooth) ease;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .action-icon-btn.pulse {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>

</head>

<body>
    <div class="container_12">
        <div class="grid_12">
            @php
                $data = \App\Models\Titleslogan::first();
                $authUser = Auth::user();
                $userRole = optional($authUser)->role;
            @endphp

            <!-- Modern Admin Header -->
            <div class="admin-header-wrapper">
                <div class="admin-header">
                    <!-- Branding Section -->
                    <div class="header-branding-section">
                        <div class="header-logo-container">
                            <img src="{{ asset('storage/' . optional($data)->logo) }}" 
                                 alt="Logo" 
                                 class="header-logo-image" />
                        </div>
                        <div class="header-branding-text">
                            <h1 class="header-title">{{ optional($data)->title }}</h1>
                            <p class="header-slogan">{{ optional($data)->slogan }}</p>
                        </div>
                    </div>

                    <!-- Center Navigation (optional, hidden by default) -->
                    <div class="header-center"></div>

                    <!-- User Actions Section -->
                    <div class="header-user-section">
                        <div class="header-actions">
                            <!-- Notifications Button -->
                            <button class="action-icon-btn" title="Notifications" id="notificationBtn">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </button>

                            <!-- Settings Button -->
                            <button class="action-icon-btn" title="Settings" id="settingsBtn">
                                <i class="fas fa-cog"></i>
                            </button>

                            <!-- Divider -->
                            <div class="divider"></div>
                        </div>

                        <!-- User Profile Card with Dropdown -->
                        <div style="position: relative;">
                            <div class="user-profile-card" id="userProfileBtn">
                                <img src="{{ optional($authUser)->image ? asset('storage/' . $authUser->image) : asset('assets/admin/img/img-profile.jpg') }}"
                                     alt="Profile Pic"
                                     class="user-avatar" />
                                @auth
                                    <div class="user-info">
                                        <span class="user-name">{{ Auth::user()->name }}</span>
                                        <span class="user-role">{{ $userRole?->name ?? 'Admin' }}</span>
                                    </div>
                                @endauth
                                <i class="fas fa-chevron-down user-dropdown-icon"></i>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu" id="userDropdown">
                                <a href="#" class="dropdown-menu-item">
                                    <i class="fas fa-user"></i>
                                    <span>My Profile</span>
                                </a>
                                <a href="#" class="dropdown-menu-item">
                                    <i class="fas fa-sliders-h"></i>
                                    <span>Account Settings</span>
                                </a>
                                <div class="dropdown-menu-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-menu-item logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            @hasSection('content')
                @yield('content')
            @else
                <div style="padding: 40px 20px; text-align: center; color: #dc2626;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px; margin-bottom: 10px;"></i>
                    <h2>Content Not Found</h2>
                </div>
            @endif
        </div>
    </div>

    @include('admin.layouts.footer')

    <script type="text/javascript">
        $(document).ready(function() {
            // Setup existing functionality
            setupLeftMenu();
            setSidebarHeight();

            // Modern header interactions
            const userProfileBtn = document.getElementById('userProfileBtn');
            const userDropdown = document.getElementById('userDropdown');
            const notificationBtn = document.getElementById('notificationBtn');
            const settingsBtn = document.getElementById('settingsBtn');

            // Toggle dropdown menu
            if (userProfileBtn) {
                userProfileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('active');
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (userDropdown && !userDropdown.contains(e.target) && e.target !== userProfileBtn) {
                    userDropdown.classList.remove('active');
                }
            });

            // Notification button handler
            if (notificationBtn) {
                notificationBtn.addEventListener('click', function() {
                    console.log('Notifications clicked');
                    // Add your notification logic here
                });
            }

            // Settings button handler
            if (settingsBtn) {
                settingsBtn.addEventListener('click', function() {
                    console.log('Settings clicked');
                    // Add your settings logic here
                });
            }

            // Add scroll effect to header
            let lastScrollTop = 0;
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.admin-header-wrapper');
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    header.style.opacity = '0.95';
                } else {
                    // Scrolling up
                    header.style.opacity = '1';
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            });
        });
    </script>
</body>

</html>
