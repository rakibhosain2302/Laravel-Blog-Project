@extends('admin.layouts.header')

@prepend('style')
    <style>
        .profile-shell {
            position: relative;
            padding: 18px 0 28px;
        }

        .profile-shell::before {
            content: "";
            position: fixed;
            top: 120px;
            right: -80px;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
            pointer-events: none;
            filter: blur(18px);
        }

        .profile-shell::after {
            content: "";
            position: fixed;
            bottom: 10px;
            left: -90px;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
            pointer-events: none;
            filter: blur(18px);
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .profile-header-title {
            flex: 1;
            min-width: 250px;
        }

        .profile-header-title h1 {
            margin: 0 0 6px;
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.04em;
        }

        .profile-header-title p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }


        .btn-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 14px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.25);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(59, 130, 246, 0.35);
        }

        .profile-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
            gap: 20px;
            align-items: start;
        }

        .profile-card,
        .profile-side-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .profile-card__hero {
            padding: 26px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.96), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(56, 189, 248, 0.16), rgba(168, 85, 247, 0.12));
            color: #fff;
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #e2e8f0;
        }

        .profile-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .profile-title {
            margin: 18px 0 10px;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .profile-copy {
            margin: 0;
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            max-width: 40ch;
        }

        .profile-meta {
            display: grid;
            gap: 12px;
            padding: 22px 26px 26px;
        }

        .profile-meta__item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            padding: 14px 16px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .profile-meta__item span {
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .profile-meta__item strong {
            color: #0f172a;
            font-size: 14px;
            font-weight: 800;
            text-align: right;
        }

        .profile-side {
            display: grid;
            gap: 20px;
        }

        .profile-side-card {
            padding: 16px;
        }

        .profile-user {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .profile-user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-user__avatar {
            width: 68px;
            height: 68px;
            border-radius: 22px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
            flex: 0 0 auto;
        }

        .profile-user h3 {
            margin: 0 0 6px;
            font-size: 20px;
            color: #0f172a;
        }

        .profile-user p {
            margin: 0;
            color: #475569;
            line-height: 1.6;
        }

        .profile-role {
            display: inline-flex;
            margin-top: 12px;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .profile-security {
            display: grid;
            gap: 12px;
        }

        .profile-security__item {
            padding: 14px 16px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .profile-security__item strong {
            display: block;
            font-size: 14px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .profile-security__item span {
            color: #64748b;
            font-size: 13px;
            line-height: 1.55;
        }

        .profile-security__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 14px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.18);
            margin-top: 12px;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .profile-security__link:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.25);
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .profile-stat {
            padding: 14px 16px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-align: center;
        }

        .profile-stat__value {
            display: block;
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .profile-stat__label {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        @media (max-width: 1100px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-header-title h1 {
                font-size: 24px;
            }

            .profile-card__hero,
            .profile-meta,
            .profile-side-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .profile-card,
            .profile-side-card {
                border-radius: 22px;
            }

            .btn-edit {
                width: 100%;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $user = $userInfo ?? Auth::user();
        $roleName = optional($user->role)->name ?? 'Guest';
        $roleDescription = optional($user->role)->description ?? 'No role description available.';
        $profileImage = $user->image ? asset('storage/' . $user->image) : asset('assets/admin/img/img-profile.jpg');
    @endphp

    <div class="grid_10">
        <div class="profile-shell">

            <!-- Profile Header with Edit Button -->
            <div class="profile-header">
                <div class="profile-header-title">
                    <h1>{{ $user->name }}</h1>
                    <p>Manage and review your profile information</p>
                </div>

            </div>

            <!-- Profile Content Grid -->
            <div class="profile-grid">
                <!-- Main Profile Card -->
                <div class="profile-card">
                    <div class="profile-card__hero">
                        <div class="profile-badge">Profile Overview</div>
                        <h2 class="profile-title">Welcome, {{ $user->name }}</h2>
                        <p class="profile-copy">
                            Here's a complete overview of your profile information. You can update your details by clicking
                            the Edit Profile button above.
                        </p>
                    </div>

                    <div class="profile-meta">
                        <div class="profile-meta__item">
                            <span>Name</span>
                            <strong>{{ $user->name }}</strong>
                        </div>
                        <div class="profile-meta__item">
                            <span>Email</span>
                            <strong>{{ $user->email }}</strong>
                        </div>
                        <div class="profile-meta__item">
                            <span>Role</span>
                            <strong>{{ $roleName }}</strong>
                        </div>
                        <div class="profile-meta__item">
                            <span>Member Since</span>
                            <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Side Cards -->
                <div class="profile-side">
                    <!-- User Profile Card -->
                    <div class="profile-side-card">
                        <div class="profile-user">
                            <div class="profile-user-info">
                                <img class="profile-user__avatar" src="{{ $profileImage }}" alt="Profile avatar">

                                <div>
                                    <h3>{{ $user->name }}</h3>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="profile-header-actions">
                                <a href="{{ route('profile.edit') }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                        </div>
                        <div class="profile-role">{{ $roleName }}</div>

                        <div class="profile-stats">
                            <div class="profile-stat">
                                <span class="profile-stat__value">100%</span>
                                <span class="profile-stat__label">Profile Complete</span>
                            </div>
                            <div class="profile-stat">
                                <span class="profile-stat__value">Active</span>
                                <span class="profile-stat__label">Account Status</span>
                            </div>
                        </div>
                    </div>

                    <!-- Security & Quick Links Card -->
                    <div class="profile-side-card">
                        <div class="profile-security">
                            <div class="profile-security__item">
                                <strong>Role Summary</strong>
                                <span>{{ $roleDescription }}</span>
                            </div>
                            <div class="profile-security__item">
                                <strong>Security Tip</strong>
                                <span>Change your password regularly to keep your account secure.</span>
                            </div>
                            <a href="{{ route('change.pass') }}" class="profile-security__link">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Success Message --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('success')),
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: @json(session('error')),
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection

@section('title')
    User Profile
@endsection
