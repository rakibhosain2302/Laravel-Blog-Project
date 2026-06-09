@prepend('style')
    <style>
        .modern-sidebar-wrap {
            position: sticky;
            top: calc(72px + 18px);
            max-height: calc(100vh - 108px);
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 6px;
        }

        .modern-sidebar-wrap::-webkit-scrollbar {
            width: 10px;
        }

        .modern-sidebar-wrap::-webkit-scrollbar-track {
            background: transparent;
        }

        .modern-sidebar-wrap::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.24);
            border-radius: 999px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        .modern-sidebar-wrap:hover::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.38);
        }

        .modern-sidebar-wrap {
            scrollbar-width: thin;
            scrollbar-color: rgba(148, 163, 184, 0.24) transparent;
        }

        .modern-sidebar {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            padding: 20px;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.15), transparent 30%),
                linear-gradient(180deg, #0f172a 0%, #111827 48%, #0b1220 100%);
            color: #e2e8f0;
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.26);
            border: 1px solid rgba(148, 163, 184, 0.12);
        }

        .modern-sidebar::before {
            content: "";
            position: absolute;
            inset: auto -40px -70px auto;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.18), rgba(56, 189, 248, 0));
            pointer-events: none;
        }

        .sidebar-brand {
            display: flex;
            gap: 14px;
            align-items: center;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .sidebar-brand__logo {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            object-fit: cover;
            background: #fff;
            border: 1px solid rgba(226, 232, 240, 0.18);
            padding: 4px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.16);
            flex: 0 0 auto;
        }

        .sidebar-brand__title {
            margin: 0 0 4px;
            color: #fff;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .sidebar-brand__subtitle {
            margin: 0;
            color: #cbd5e1;
            font-size: 12px;
            line-height: 1.5;
        }

        .sidebar-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.14);
            color: #f8fafc;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .sidebar-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .sidebar-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .sidebar-stat {
            border-radius: 18px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.10);
            backdrop-filter: blur(10px);
        }

        .sidebar-stat strong {
            display: block;
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .sidebar-stat span {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-quicklinks {
            display: grid;
            gap: 10px;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .sidebar-quicklinks__title {
            margin: 0 0 2px;
            font-size: 12px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .sidebar-quicklink {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            color: #e2e8f0;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.09);
            transition: transform 0.18s ease, background 0.18s ease, border-color 0.18s ease;
        }

        .sidebar-quicklink:hover,
        .sidebar-quicklink.is-active {
            transform: translateY(-1px);
            background: rgba(59, 130, 246, 0.16);
            border-color: rgba(96, 165, 250, 0.24);
            color: #fff;
        }

        .sidebar-quicklink__label {
            display: block;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.2;
        }

        .sidebar-quicklink__hint {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.35;
        }

        .sidebar-quicklink__arrow {
            color: #94a3b8;
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .sidebar-menu>li {
            border-radius: 18px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.09);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
        }

        .sidebar-menu>li>.menuitem {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 16px;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.01em;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.03));
        }

        .sidebar-menu>li>.menuitem::after {
            content: "▾";
            color: #94a3b8;
            font-size: 14px;
            font-weight: 700;
            transition: transform 0.18s ease;
        }

        .sidebar-menu>li>.menuitem.is-active {
            background: rgba(59, 130, 246, 0.16);
            color: #fff;
        }

        .sidebar-menu>li>.menuitem.is-active::after {
            color: #fff;
        }

        .sidebar-menu>li.ui-accordion-header-active>.menuitem::after {
            transform: rotate(180deg);
        }

        .sidebar-menu>li>.submenu {
            list-style: none;
            margin: 0;
            padding: 0 10px 12px;
            background: rgba(15, 23, 42, 0.2);
        }

        .sidebar-menu>li>.submenu li {
            margin: 0;
        }

        .sidebar-menu>li>.submenu a {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            padding: 11px 12px;
            border-radius: 12px;
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid transparent;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease;
        }

        .sidebar-menu>li>.submenu a::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #38bdf8, #60a5fa);
            box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.12);
            flex: 0 0 auto;
        }

        .sidebar-menu>li>.submenu a:hover,
        .sidebar-menu>li>.submenu a.active {
            color: #fff;
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(96, 165, 250, 0.25);
        }

        .sidebar-footer {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid rgba(226, 232, 240, 0.10);
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .sidebar-footer strong {
            color: #fff;
        }

        @media (max-width: 1100px) {
            .modern-sidebar-wrap {
                position: static;
            }
        }

        .mt {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
@endprepend

<div class="grid_2 mt">
    <div class="modern-sidebar-wrap">
        <div class="modern-sidebar">
            @php
                $brand = \App\Models\Titleslogan::first();
                $roleName = optional(auth()->user()->role)->name ?? 'Guest';
                $roleDescription = optional(auth()->user()->role)->description ?? 'Workspace access ready.';
                $postCount = \App\Models\Post::count();
                $pageCount = \App\Models\Page::count();
                $unreadCount = \App\Models\Contract::where('is_seen', false)->count();
                $canManageSite = in_array($roleName, ['Admin', 'Editor']);
            @endphp

            <div class="sidebar-brand">
                <div>
                    <div class="sidebar-badge">Welcome {{ $roleName }}</div>
                </div>
            </div>

            <div class="sidebar-quicklinks">
                <p class="sidebar-quicklinks__title">Workspace</p>
                <a href="{{ route('dashbord') }}"
                    class="sidebar-quicklink {{ Request::routeIs('dashbord') ? 'is-active' : '' }}">
                    <div>
                        <span class="sidebar-quicklink__label">Dashboard</span>
                        <span class="sidebar-quicklink__hint">Overview and activity</span>
                    </div>
                    <span class="sidebar-quicklink__arrow">→</span>
                </a>
                <a href="{{ route('profile') }}"
                    class="sidebar-quicklink {{ Request::routeIs('profile') ? 'is-active' : '' }}">
                    <div>
                        <span class="sidebar-quicklink__label">Profile</span>
                        <span class="sidebar-quicklink__hint">Your account settings</span>
                    </div>
                    <span class="sidebar-quicklink__arrow">→</span>
                </a>
                @if ($canManageSite)
                    <a href="{{ route('users.index') }}"
                        class="sidebar-quicklink {{ Request::routeIs('users.index') ? 'is-active' : '' }}">
                        <div>
                            <span class="sidebar-quicklink__label">User List</span>
                            <span class="sidebar-quicklink__hint">Manage registered users</span>
                        </div>
                        <span class="sidebar-quicklink__arrow">→</span>
                    </a>
                @endif
                <a href="{{ route('change.pass') }}"
                    class="sidebar-quicklink {{ Request::routeIs('change.pass') ? 'is-active' : '' }}">
                    <div>
                        <span class="sidebar-quicklink__label">Password</span>
                        <span class="sidebar-quicklink__hint">Keep your account secure</span>
                    </div>
                    <span class="sidebar-quicklink__arrow">→</span>
                </a>
                @if ($roleName === 'Admin')
                    <a href="{{ route('message.index') }}"
                        class="sidebar-quicklink {{ Request::routeIs('message.index') ? 'is-active' : '' }}">
                        <div>
                            <span class="sidebar-quicklink__label">Inbox</span>
                            <span class="sidebar-quicklink__hint">Pending visitor messages</span>
                        </div>
                        <span class="sidebar-quicklink__arrow">{{ $unreadCount }}</span>
                    </a>
                @endif
            </div>

            <ul class="section menu sidebar-menu">

                @if ($canManageSite)
                    <li class="{{ Request::routeIs('categories.*') ? 'ui-accordion-header-active' : '' }}">

                                        <a class="menuitem {{ Request::routeIs('categories.*') ? 'is-active' : '' }}">Category Option</a>
                        <ul class="submenu">
                            <li><a href="{{ route('categories.create') }}" class="{{ Request::routeIs('categories.create') ? 'active' : '' }}">Add Category</a></li>
                            <li><a href="{{ route('categories.index') }}" class="{{ Request::routeIs('categories.index') ? 'active' : '' }}">Category List</a></li>
                        </ul>
                    </li>
                @endif

                <li class="{{ Request::routeIs('posts.*') ? 'ui-accordion-header-active' : '' }}">


                                    <a class="menuitem {{ Request::routeIs('posts.*') ? 'is-active' : '' }}">Post Option</a>
                    <ul class="submenu">
                        <li><a href="{{ route('posts.create') }}" class="{{ Request::routeIs('posts.create') ? 'active' : '' }}">Add Post</a></li>
                        <li><a href="{{ route('posts.index') }}" class="{{ Request::routeIs('posts.index') ? 'active' : '' }}">Post List</a></li>
                    </ul>
                </li>

                @if ($canManageSite)
                    <li class="{{ Request::routeIs('page.*') ? 'ui-accordion-header-active' : '' }}">

                                        <a class="menuitem {{ Request::routeIs('page.*') ? 'is-active' : '' }}">Pages Option</a>
                        <ul class="submenu">
                            <li><a href="{{ route('page.create') }}" class="{{ Request::routeIs('page.create') ? 'active' : '' }}">Add New Page</a></li>
                            <li><a href="{{ route('page.index') }}" class="{{ Request::routeIs('page.index') ? 'active' : '' }}">Page List</a></li>
                        </ul>
                    </li>
                @endif

                @if ($canManageSite)
                    <li class="{{ Request::routeIs('slider.*') ? 'ui-accordion-header-active' : '' }}">

                                        <a class="menuitem {{ Request::routeIs('slider.*') ? 'is-active' : '' }}">Slider Option</a>
                        <ul class="submenu">
                            <li><a href="{{ route('slider.create') }}" class="{{ Request::routeIs('slider.create') ? 'active' : '' }}">Add New Slider</a></li>
                            <li><a href="{{ route('slider.index') }}" class="{{ Request::routeIs('slider.index') ? 'active' : '' }}">Slider List</a></li>
                        </ul>
                    </li>
                @endif

                @if ($canManageSite)
                    <li class="{{ Request::routeIs('blog.title.*') || Request::routeIs('social.*') || Request::routeIs('copyright.*') ? 'ui-accordion-header-active' : '' }}">

                                        <a class="menuitem {{ Request::routeIs('blog.title.*') || Request::routeIs('social.*') || Request::routeIs('copyright.*') ? 'is-active' : '' }}">Site Option</a>
                        <ul class="submenu">
                            <li><a href="{{ route('blog.title.index') }}" class="{{ Request::routeIs('blog.title.*') ? 'active' : '' }}">Title &amp; Slogan</a></li>
                            <li><a href="{{ route('social.index') }}" class="{{ Request::routeIs('social.*') ? 'active' : '' }}">Social Media</a></li>
                            <li><a href="{{ route('copyright.index') }}" class="{{ Request::routeIs('copyright.*') ? 'active' : '' }}">Copyright</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            <div class="sidebar-footer">
                <strong>{{ auth()->user()->name }}</strong><br>
                {{ $roleDescription }}<br>
                Last updated {{ date('M d, Y') }}
            </div>
        </div>
    </div>
</div>
