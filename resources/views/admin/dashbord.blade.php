@extends('admin.layouts.header')

@prepend('style')
    <style>
        .dashboard-shell {
            position: relative;
            padding: 18px 0 0;
            font-family: "Avenir Next", "Nunito Sans", "Segoe UI", sans-serif;
        }

        .dashboard-shell::before,
        .dashboard-shell::after {
            content: "";
            position: fixed;
            inset: auto;
            pointer-events: none;
            z-index: 0;
            border-radius: 999px;
            filter: blur(18px);
            opacity: 0.45;
        }

        .dashboard-shell::before {
            top: 130px;
            right: -80px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.35), rgba(56, 189, 248, 0));
        }

        .dashboard-shell::after {
            bottom: 20px;
            left: -70px;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.28), rgba(168, 85, 247, 0));
        }

        .dashboard-content {
            position: relative;
            z-index: 1;
        }

        .dashboard-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(280px, 0.95fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .dashboard-hero__panel {
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 24px;
            padding: 26px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.96), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(168, 85, 247, 0.16));
            color: #f8fafc;
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.22);
            overflow: hidden;
            position: relative;
        }

        .dashboard-hero__panel::before {
            content: "";
            position: absolute;
            inset: auto -60px -70px auto;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.28), rgba(56, 189, 248, 0));
        }

        .dashboard-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.16);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .dashboard-hero__title {
            margin: 18px 0 10px;
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.05;
            letter-spacing: -0.04em;
            color: #fff;
        }

        .dashboard-hero__title strong {
            display: block;
            color: #67e8f9;
        }

        .dashboard-hero__copy {
            max-width: 720px;
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
        }

        .dashboard-hero__meta {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .meta-chip {
            border-radius: 18px;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.38);
            border: 1px solid rgba(226, 232, 240, 0.12);
            backdrop-filter: blur(10px);
        }

        .meta-chip__label {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .meta-chip__value {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
        }

        .dashboard-side {
            display: grid;
            gap: 20px;
        }

        .dashboard-card {
            border-radius: 24px;
            padding: 22px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.22);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
        }

        .dashboard-profile {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .dashboard-avatar {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
        }

        .dashboard-profile h3 {
            margin: 0 0 6px;
            font-size: 20px;
            color: #0f172a;
        }

        .dashboard-profile p {
            color: #475569;
            line-height: 1.6;
            margin: 0;
        }

        .dashboard-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            margin-top: 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(14, 165, 233, 0.08));
            color: #0f172a;
            font-size: 12px;
            font-weight: 800;
        }

        .dashboard-brand {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .dashboard-brand__logo {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            object-fit: cover;
            background: #fff;
            border: 1px solid #dbe4f0;
            padding: 4px;
        }

        .dashboard-brand__title {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
        }

        .dashboard-brand__slogan {
            margin: 4px 0 0;
            color: #64748b;
            line-height: 1.5;
            font-size: 13px;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: #fff;
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
            padding: 20px;
            min-height: 138px;
        }

        .stat-card::before {
            content: "";
            position: absolute;
            inset: auto -20px -24px auto;
            width: 92px;
            height: 92px;
            border-radius: 999px;
            opacity: 0.2;
            background: currentColor;
            filter: blur(3px);
        }

        .stat-card__label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .stat-card__value {
            display: block;
            font-size: 34px;
            line-height: 1;
            color: #0f172a;
            font-weight: 900;
            margin-bottom: 8px;
            letter-spacing: -0.04em;
        }

        .stat-card__note {
            color: #64748b;
            line-height: 1.55;
            max-width: 240px;
        }

        .stat-card__accent {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: currentColor;
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0.18);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .section-title h3 {
            margin: 0;
            font-size: 20px;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .section-title p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .section-pill {
            padding: 8px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .action-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 18px;
            border-radius: 18px;
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .action-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
            color: #fff
        }

        .action-link__text strong {
            display: block;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .action-link__text span {
            display: block;
            font-size: 13px;
            line-height: 1.45;
            color: inherit;
            opacity: 0.8;
        }

        .action-link__arrow {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            background: rgba(255, 255, 255, 0.22);
            font-size: 18px;
            font-weight: 900;
        }

        .action-link--primary {
            background: linear-gradient(135deg, #0f172a, #334155);
            color: #fff;
        }

        .action-link--dark {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #f8fafc;
        }

        .action-link--soft {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #0f172a;
            border-color: #bfdbfe;
        }

        .action-link--soft:hover {
            color: #000;
        }

        .action-link--ghost {
            background: linear-gradient(135deg, #fff, #f8fafc);
            color: #0f172a;
            border-color: #e2e8f0;
        }

        .action-link--ghost:hover {
            color: #000;
        }

        .activity-list {
            display: grid;
            gap: 12px;
        }

        .activity-item {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr);
            gap: 12px;
            align-items: start;
            padding: 14px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .activity-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 900;
            background: #eff6ff;
            color: #2563eb;
        }

        .activity-title {
            margin: 0 0 4px;
            font-size: 15px;
            color: #0f172a;
            font-weight: 800;
        }

        .activity-meta {
            margin: 0 0 8px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .activity-snippet {
            margin: 0;
            color: #475569;
            font-size: 14px;
            line-height: 1.65;
        }

        .activity-empty {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
            color: #64748b;
            line-height: 1.6;
        }

        .dashboard-subgrid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .panel-card {
            border-radius: 24px;
            padding: 22px;
            background: #fff;
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
        }

        .panel-card__head {
            margin-bottom: 16px;
        }

        .panel-card__head h3 {
            margin: 0;
            font-size: 18px;
            color: #0f172a;
        }

        .panel-card__head p {
            margin: 4px 0 0;
            color: #64748b;
            line-height: 1.5;
        }

        .mini-list {
            display: grid;
            gap: 12px;
        }

        .mini-item {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr);
            gap: 12px;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .mini-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .mini-item__badge {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 900;
            background: #f1f5f9;
            color: #0f172a;
        }

        .mini-item strong {
            display: block;
            font-size: 15px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .mini-item span {
            display: block;
            color: #64748b;
            line-height: 1.55;
            font-size: 13px;
        }

        .dashboard-footer-note {
            margin-top: 20px;
            padding: 16px 18px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.08), rgba(168, 85, 247, 0.08));
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #334155;
            line-height: 1.6;
        }

        @media (max-width: 1100px) {

            .dashboard-hero,
            .dashboard-grid,
            .dashboard-subgrid {
                grid-template-columns: 1fr;
            }

            .dashboard-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {

            .dashboard-stats,
            .dashboard-hero__meta,
            .quick-actions {
                grid-template-columns: 1fr;
            }

            .dashboard-card,
            .panel-card,
            .dashboard-hero__panel {
                border-radius: 20px;
                padding: 18px;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $roleName = optional(auth()->user()->role)->name ?? 'Guest';
        $canCreateOwnPosts = in_array($roleName, ['User', 'Editor', 'Admin']);
        $canManageContent = in_array($roleName, ['Editor', 'Admin']);
        $isAdmin = $roleName === 'Admin';
    @endphp

    <div class="grid_10">
        <div class="dashboard-shell">
            <div class="dashboard-content">
                <div class="dashboard-hero">
                    <div class="dashboard-hero__panel">
                        <div class="dashboard-kicker">Admin overview</div>
                        <h1 class="dashboard-hero__title">
                            Welcome back, {{ $user->name }}
                            <strong>Let’s keep the site moving.</strong>
                        </h1>
                        <p class="dashboard-hero__copy">
                            You are signed in as <strong>{{ $roleName }}</strong>.
                            {{ optional($user->role)->description ??
                                'Your admin permissions and workspace tools are ready
                                                                                here.' }}
                        </p>

                        <div class="dashboard-hero__meta">
                            <div class="meta-chip">
                                <span class="meta-chip__label">Access</span>
                                <div class="meta-chip__value">{{ $roleName }}</div>
                            </div>
                            <div class="meta-chip">
                                <span class="meta-chip__label">Today</span>
                                <div class="meta-chip__value">{{ date('M d, Y') }}</div>
                            </div>
                            <div class="meta-chip">
                                <span class="meta-chip__label">Status</span>
                                <div class="meta-chip__value">Online</div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-side">
                        <div class="dashboard-card">
                            <div class="dashboard-profile">
                                <img class="dashboard-avatar"
                                    src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/admin/img/img-profile.jpg') }}"
                                    alt="Profile">
                                <div>
                                    <h3>{{ $user->name }}</h3>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="dashboard-badge">
                                {{ $roleName }} workspace
                            </div>
                        </div>

                        <div class="dashboard-card">
                            <div class="dashboard-brand">
                                <img class="dashboard-brand__logo"
                                    src="{{ optional($siteBrand)->logo ? asset('storage/' . $siteBrand->logo) : asset('assets/admin/img/img-profile.jpg') }}"
                                    alt="Site logo">
                                <div>
                                    <p class="dashboard-brand__title">{{ optional($siteBrand)->title ?? 'Site Branding' }}
                                    </p>
                                    <p class="dashboard-brand__slogan">
                                        {{ optional($siteBrand)->slogan ?? 'Your branding controls live here.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-stats">
                    @foreach ($dashboardStats as $stat)
                        <div class="stat-card" style="color: {{ $stat['dot'] }};">
                            <div class="stat-card__accent" style="background: {{ $stat['accent'] }};"></div>
                            <div class="stat-card__label">
                                <span>{{ $stat['label'] }}</span>
                                <span class="section-pill">Live</span>
                            </div>
                            <span class="stat-card__value">{{ $stat['value'] }}</span>
                            <p class="stat-card__note">{{ $stat['note'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="dashboard-grid">
                    <div class="panel-card">
                        <div class="section-title">
                            <div>
                                <h3>Quick Actions</h3>
                                <p>Fast access to the admin areas you use most.</p>
                            </div>
                            <span class="section-pill">One click</span>
                        </div>

                        <div class="quick-actions">
                            @foreach ($quickActions as $action)
                                <a href="{{ $action['route'] }}" class="action-link action-link--{{ $action['tone'] }}">
                                    <div class="action-link__text">
                                        <strong>{{ $action['label'] }}</strong>
                                        <span>Jump straight to this workspace.</span>
                                    </div>
                                    <span class="action-link__arrow">→</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-card">
                        <div class="section-title">
                            <div>
                                <h3>Recent Messages</h3>
                                <p>Latest inbox activity from your visitors.</p>
                            </div>
                            <span class="section-pill">{{ $recentMessages->count() }} shown</span>
                        </div>

                        @if ($recentMessages->isNotEmpty())
                            <div class="mini-list">
                                @foreach ($recentMessages as $message)
                                    <div class="mini-item">
                                        <div class="mini-item__badge">M</div>
                                        <div>
                                            <strong>{{ $message->firstname }} {{ $message->lastname }}</strong>
                                            <span>{{ $message->email }}</span>
                                            <span>{{ \Illuminate\Support\Str::limit($message->message, 92) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="activity-empty">
                                No messages yet. Once visitors start writing, their latest messages will appear here.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="dashboard-subgrid">
                    <div class="panel-card">
                        <div class="section-title">
                            <div>
                                <h3>Recent Posts</h3>
                                <p>Your latest published or draft content at a glance.</p>
                            </div>
                            <span class="section-pill">{{ $recentPosts->count() }} shown</span>
                        </div>

                        @if ($recentPosts->isNotEmpty())
                            <div class="activity-list">
                                @foreach ($recentPosts as $post)
                                    <div class="activity-item">
                                        <div class="activity-icon">P</div>
                                        <div>
                                            <p class="activity-title">{{ $post->title }}</p>
                                            <p class="activity-meta">
                                                {{ optional($post->category)->name ?? 'No Category' }} •
                                                {{ optional($post->user)->name ?? 'Unknown author' }} •
                                                {{ optional($post->created_at)->diffForHumans() }}
                                            </p>
                                            <p class="activity-snippet">
                                                {{ \Illuminate\Support\Str::limit($post->discription, 120) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="activity-empty">
                                No posts yet. Add your first article to populate this panel.
                            </div>
                        @endif
                    </div>
                    <!-- #region -->
                    <div class="panel-card">
                        <div class="section-title">
                            <div>
                                <h3>Workspace Snapshot</h3>
                                <p>Some useful signals from the admin area.</p>
                            </div>
                            <span class="section-pill">Today</span>
                        </div>

                        @if ($roleName == 'Admin')
                            <div class="mini-list">
                                <div class="mini-item">
                                    <div class="mini-item__badge">U</div>
                                    <div>
                                        <strong>{{ $dashboardStats[3]['value'] }} users in the system</strong>
                                        <span>Keep roles and access up to date for a cleaner workflow.</span>
                                    </div>
                                </div>

                                <div class="mini-item">
                                    <div class="mini-item__badge">I</div>
                                    <div>
                                        <strong>{{ $dashboardStats[4]['value'] }} unread messages</strong>
                                        <span>There are visitor conversations waiting for attention.</span>
                                    </div>
                                </div>

                                <div class="mini-item">
                                    <div class="mini-item__badge">S</div>
                                    <div>
                                        <strong>{{ $dashboardStats[5]['value'] }} branding items</strong>
                                        <span>Title, slogan, socials and sliders are ready to shape the site
                                            identity.</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="dashboard-footer-note">
                            Manage posts, categories, pages, and site content from a clean and responsive dashboard designed
                            for efficient blog administration.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    Dashbord
@endsection
