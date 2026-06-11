@extends('admin.layouts.header')

@prepend('style')
    <style>
        .password-shell {
            position: relative;
            padding: 18px 0 28px;
        }

        .password-shell::before {
            content: "";
            position: fixed;
            top: 110px;
            right: -80px;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
            filter: blur(18px);
            pointer-events: none;
        }

        .password-shell::after {
            content: "";
            position: fixed;
            bottom: 10px;
            left: -90px;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
            filter: blur(18px);
            pointer-events: none;
        }

        .password-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
            gap: 20px;
            align-items: start;
        }

        .password-hero,
        .password-card,
        .password-side-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .password-hero {
            padding: 28px;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.97), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(59, 130, 246, 0.16), rgba(168, 85, 247, 0.12));
        }

        .password-badge {
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

        .password-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .password-hero h1 {
            margin: 16px 0 10px;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .password-hero p {
            margin: 0;
            max-width: 58ch;
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
        }

        .password-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .password-mini {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .password-mini span {
            display: block;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .password-mini strong {
            display: block;
            font-size: 18px;
            letter-spacing: -0.03em;
        }

        .password-card__head {
            padding: 24px 24px 0;
        }

        .password-card__head h2 {
            margin: 0 0 6px;
            font-size: 24px;
            color: #0f172a;
            letter-spacing: -0.03em;
        }

        .password-card__head p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
        }

        .password-form {
            padding: 22px 24px 24px;
        }

        .password-form__grid {
            display: grid;
            gap: 16px;
        }

        .password-field {
            display: grid;
            gap: 8px;
        }

        .password-field label {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
        }

        .password-input-wrap {
            position: relative;
        }

        .password-input-wrap input {
            width: 100%;
            min-height: 30px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 48px 12px 14px;
            background: #fff;
            color: #0f172a;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .password-input-wrap input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            background: rgba(148, 163, 184, 0.12);
            color: #0f172a;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }

        .password-toggle .password-icon--hidden {
            display: none;
        }

        .password-hint {
            color: #64748b;
            font-size: 12px;
            line-height: 1.55;
        }

        .password-error {
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        .password-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .password-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 14px;
            border: 0;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .password-btn:hover {
            transform: translateY(-1px);
        }

        .password-btn--back {
            background: #e2e8f0;
            color: #0f172a;
        }

        .password-btn--save {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.16);
        }

        .password-side {
            display: grid;
            gap: 16px;
        }

        .password-side-card {
            padding: 22px;
        }

        .password-side-card h3 {
            margin: 0 0 10px;
            color: #0f172a;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .password-side-card p,
        .password-side-card li {
            color: #475569;
            line-height: 1.65;
            font-size: 14px;
        }

        .password-side-card ul {
            margin: 0;
            padding-left: 18px;
            display: grid;
            gap: 8px;
        }

        .password-side-note {
            display: grid;
            gap: 10px;
        }

        .password-side-pill {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 8px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .password-success {
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.14), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(34, 197, 94, 0.18);
            color: #065f46;
            font-weight: 700;
        }

        .password-actions{
            margin-top: 20px;
        }

        @media (max-width: 991px) {
            .password-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .password-mini-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $authUser = Auth::user();
    @endphp

    <div class="grid_10">
        <div class="password-shell">
            <div class="password-grid">
                <div class="password-hero">
                    <div class="password-badge">Security center</div>
                    <h1>Change your password with a cleaner, safer flow.</h1>
                    <p>
                        Keep your account protected with a quick password update. We only ask for the current password
                        once, then let you set a fresh one with confirmation.
                    </p>

                    <div class="password-mini-grid">
                        <div class="password-mini">
                            <span>Current user</span>
                            <strong>{{ $authUser->name }}</strong>
                        </div>
                        <div class="password-mini">
                            <span>Account email</span>
                            <strong>{{ $authUser->email }}</strong>
                        </div>
                    </div>
                </div>

                <div class="password-side">
                    <div class="password-side-card">
                        <div class="password-side-note">
                            <div class="password-side-pill">Best practice</div>
                            <h3>Strong password tips</h3>
                            <ul>
                                <li>Use at least 6 characters, but longer is better.</li>
                                <li>Mix letters, numbers, and symbols when possible.</li>
                                <li>Do not reuse a password from another site.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="password-side-card">
                        <h3>Quick links</h3>
                        <p>Need to leave the page? Jump back to your dashboard or profile settings anytime.</p>
                        <div class="password-actions" style="justify-content:flex-start; margin-top:14px;">
                            <a class="password-btn password-btn--back" href="{{ route('dashbord') }}">Back to Dashboard</a>
                            <a class="password-btn password-btn--back" href="{{ route('profile') }}">Profile</a>
                        </div>
                    </div>
                </div>

                <div class="password-card" style="grid-column: 1 / -1;">
                    <div class="password-card__head">
                        <h2>Change Password</h2>
                        <p>Fill in your current password, then set and confirm the new one.</p>
                    </div>

                    <div class="password-form">
                        @if (session('success'))
                            <div class="password-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('update.password', Auth::user()) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="password-form__grid">
                                <div class="password-field">
                                    <label for="old_password">Old Password</label>
                                    <div class="password-input-wrap">
                                        <input id="old_password" type="password" name="old_password" placeholder="Enter current password">
                                        <button type="button" class="password-toggle" data-target="old_password" aria-label="Show password" aria-pressed="false">
                                            <svg class="password-icon password-icon--show" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" />
                                                <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <svg class="password-icon password-icon--hide password-icon--hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.477 10.48a3 3 0 0 0 4.243 4.243" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.96 10.96 0 0 1 12 4.5c6 0 9.75 7.5 9.75 7.5a19.09 19.09 0 0 1-4.07 4.73" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.11 6.11C3.77 8.05 2.25 12 2.25 12s3.75 7.5 9.75 7.5a10.98 10.98 0 0 0 3.04-.43" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('old_password')
                                        <span class="password-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="password-field">
                                    <label for="new_password">New Password</label>
                                    <div class="password-input-wrap">
                                        <input id="new_password" type="password" name="new_password" placeholder="Enter new password">
                                        <button type="button" class="password-toggle" data-target="new_password" aria-label="Show password" aria-pressed="false">
                                            <svg class="password-icon password-icon--show" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" />
                                                <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <svg class="password-icon password-icon--hide password-icon--hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.477 10.48a3 3 0 0 0 4.243 4.243" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.96 10.96 0 0 1 12 4.5c6 0 9.75 7.5 9.75 7.5a19.09 19.09 0 0 1-4.07 4.73" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.11 6.11C3.77 8.05 2.25 12 2.25 12s3.75 7.5 9.75 7.5a10.98 10.98 0 0 0 3.04-.43" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="password-hint">Use a password you do not use anywhere else.</div>
                                    @error('new_password')
                                        <span class="password-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="password-field">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <div class="password-input-wrap">
                                        <input id="new_password_confirmation" type="password" name="new_password_confirmation" placeholder="Repeat new password">
                                        <button type="button" class="password-toggle" data-target="new_password_confirmation" aria-label="Show password" aria-pressed="false">
                                            <svg class="password-icon password-icon--show" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" />
                                                <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <svg class="password-icon password-icon--hide password-icon--hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.477 10.48a3 3 0 0 0 4.243 4.243" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.96 10.96 0 0 1 12 4.5c6 0 9.75 7.5 9.75 7.5a19.09 19.09 0 0 1-4.07 4.73" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.11 6.11C3.77 8.05 2.25 12 2.25 12s3.75 7.5 9.75 7.5a10.98 10.98 0 0 0 3.04-.43" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('new_password_confirmation')
                                        <span class="password-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="password-actions">
                                <a class="password-btn password-btn--back" href="{{ route('dashbord') }}">Back</a>
                                <button class="password-btn password-btn--save" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.password-toggle').forEach(function (button) {
                button.addEventListener('click', function () {
                    const targetId = button.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const showIcon = button.querySelector('.password-icon--show');
                    const hideIcon = button.querySelector('.password-icon--hide');

                    if (!input) {
                        return;
                    }

                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    if (showIcon && hideIcon) {
                        showIcon.classList.toggle('password-icon--hidden', isPassword);
                        hideIcon.classList.toggle('password-icon--hidden', !isPassword);
                    }
                    button.setAttribute('aria-pressed', String(isPassword));
                    button.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('title')
    Change-Password
@endsection
