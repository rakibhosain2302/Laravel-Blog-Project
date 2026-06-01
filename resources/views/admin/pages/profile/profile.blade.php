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

        .profile-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
            gap: 20px;
            align-items: start;
        }

        .profile-card,
        .profile-form-card,
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

        .profile-form-card__head {
            padding: 24px 24px 0;
        }

        .profile-form-card__head h2 {
            margin: 0 0 6px;
            font-size: 24px;
            color: #0f172a;
            letter-spacing: -0.03em;
        }

        .profile-form-card__head p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
        }

        .profile-form {
            padding: 22px 24px 24px;
        }

        .profile-form__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .profile-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .profile-field--full {
            grid-column: 1 / -1;
        }

        .profile-field label {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
        }

        .profile-field input[type="text"],
        .profile-field input[type="email"],
        .profile-field input[type="file"] {
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 13px 14px;
            background: #fff;
            color: #0f172a;
            transition: border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
        }

        .profile-field input[type="text"]:focus,
        .profile-field input[type="email"]:focus,
        .profile-field input[type="file"]:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .profile-field input[readonly] {
            background: #f8fafc;
            color: #475569;
            cursor: not-allowed;
        }

        .profile-avatar-upload {
            display: grid;
            gap: 12px;
        }

        .profile-avatar-upload__preview {
            width: 108px;
            height: 108px;
            border-radius: 28px;
            object-fit: cover;
            border: 1px solid #dbe4f0;
            background: #f8fafc;
            padding: 4px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        .profile-avatar-upload__hint {
            color: #64748b;
            font-size: 13px;
            line-height: 1.55;
        }

        .field-error {
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        .profile-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .btn-back,
        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 14px;
            padding: 12px 18px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .btn-back {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-back:hover {
            background: #cbd5e1;
            transform: translateY(-1px);
        }

        .btn-save {
            background: linear-gradient(135deg, #0f172a, #334155);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.18);
        }

        .profile-side {
            display: grid;
            gap: 20px;
        }

        .profile-side-card {
            padding: 22px;
        }

        .profile-user {
            display: flex;
            gap: 16px;
            align-items: center;
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
            border-radius: 14px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.18);
        }

        .profile-security__link:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 1100px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .profile-form__grid {
                grid-template-columns: 1fr;
            }

            .profile-card__hero,
            .profile-meta,
            .profile-form,
            .profile-form-card__head,
            .profile-side-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .profile-card,
            .profile-form-card,
            .profile-side-card {
                border-radius: 22px;
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
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <div class="errorMsg" style="margin-bottom: 16px;">
                    Please fix the highlighted fields and try again.
                </div>
            @endif

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="profile-card__hero">
                        <div class="profile-badge">Profile overview</div>
                        <h1 class="profile-title">Welcome, {{ $user->name }}</h1>
                        <p class="profile-copy">
                            Update your account identity, keep your email current, and use the quick links when you need to jump
                            into password changes or the dashboard.
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
                    </div>
                </div>

                <div class="profile-side">
                    <div class="profile-side-card">
                        <div class="profile-user">
                            <img class="profile-user__avatar" src="{{ $profileImage }}" alt="Profile avatar">
                            <div>
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="profile-role">{{ $roleName }}</div>
                    </div>

                    <div class="profile-side-card">
                        <div class="profile-security">
                            <div class="profile-security__item">
                                <strong>Role summary</strong>
                                <span>{{ $roleDescription }}</span>
                            </div>
                            <div class="profile-security__item">
                                <strong>Security tip</strong>
                                <span>Change your password regularly to keep the account secure.</span>
                            </div>
                            <a href="{{ route('change.pass') }}" class="profile-security__link">Change Password</a>
                        </div>
                    </div>
                </div>

                <div class="profile-form-card" style="grid-column: 1 / -1;">
                    <div class="profile-form-card__head">
                        <h2>Edit Profile</h2>
                        <p>Keep your name and email accurate so notifications and admin actions stay consistent.</p>
                    </div>

                    <div class="profile-form">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="profile-form__grid">
                                <div class="profile-field profile-field--full">
                                    <label for="profile_image">Profile Image</label>
                                    <div class="profile-avatar-upload">
                                        <img
                                            id="profile_image_preview"
                                            class="profile-avatar-upload__preview"
                                            src="{{ $profileImage }}"
                                            alt="Current profile image"
                                        >
                                        <input
                                            id="profile_image"
                                            type="file"
                                            name="image"
                                            accept="image/*"
                                            onchange="document.querySelector('#profile_image_preview').src = window.URL.createObjectURL(this.files[0]);"
                                        >
                                        <div class="profile-avatar-upload__hint">
                                            JPG, PNG, WEBP. Max 2MB.
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="profile-field">
                                    <label for="profile_name">User Name</label>
                                    <input id="profile_name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your name">
                                    @error('name')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="profile-field">
                                    <label for="profile_email">User Email</label>
                                    <input id="profile_email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email">
                                    @error('email')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="profile-field profile-field--full">
                                    <label for="profile_role">User Role</label>
                                    <input id="profile_role" type="text" value="{{ $roleName }}" readonly>
                                </div>
                            </div>

                            <div class="profile-actions">
                                <a class="btn-back" href="{{ route('dashbord') }}">Back</a>
                                <button class="btn-save" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    User-Profile
@endsection
