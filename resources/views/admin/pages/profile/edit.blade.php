@extends('admin.layouts.header')

@prepend('style')
    <style>
        .edit-profile-shell {
            position: relative;
            padding: 18px 0 28px;
        }

        .edit-profile-shell::before {
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

        .edit-profile-shell::after {
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

        .edit-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .edit-header-title {
            flex: 1;
            min-width: 250px;
        }

        .edit-header-title h1 {
            margin: 0 0 6px;
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.04em;
        }

        .edit-header-title p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }

        .edit-header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 14px;
            background: #e2e8f0;
            color: #0f172a;
            font-weight: 800;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .btn-back:hover {
            background: #cbd5e1;
            transform: translateY(-2px);
        }

        .edit-form-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .edit-form-card__head {
            padding: 26px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.96), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(56, 189, 248, 0.16), rgba(168, 85, 247, 0.12));
            color: #fff;
        }

        .edit-form-card__head h2 {
            margin: 0 0 6px;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .edit-form-card__head p {
            margin: 0;
            color: #cbd5e1;
            line-height: 1.6;
            font-size: 15px;
        }

        .edit-form {
            padding: 28px;
        }

        .edit-form__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .profile-field {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-field--full {
            grid-column: 1 / -1;
        }

        .profile-field label {
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.01em;
        }

        .profile-field input[type="text"],
        .profile-field input[type="email"],
        .profile-field input[type="file"] {
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 13px 14px;
            background: #fff;
            color: #0f172a;
            font-size: 14px;
            transition: all 0.18s ease;
        }

        .profile-field input[type="text"]:focus,
        .profile-field input[type="email"]:focus,
        .profile-field input[type="file"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            background: #f0f7ff;
        }

        .profile-field input[readonly] {
            background: #f8fafc;
            color: #475569;
            cursor: not-allowed;
        }

        .profile-field input::placeholder {
            color: #94a3b8;
        }

        .profile-avatar-upload {
            display: grid;
            gap: 14px;
        }

        .profile-avatar-upload__preview {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            object-fit: cover;
            border: 2px solid #dbe4f0;
            background: #f8fafc;
            padding: 4px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.1);
            transition: all 0.18s ease;
        }

        .profile-avatar-upload__preview:hover {
            border-color: #3b82f6;
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.15);
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

        .success-message {
            padding: 14px 16px;
            border-radius: 14px;
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-message {
            padding: 14px 16px;
            border-radius: 14px;
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }

        .btn-cancel,
        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 14px;
            padding: 12px 20px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.18s ease;
            cursor: pointer;
        }

        .btn-cancel {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
            transform: translateY(-1px);
        }

        .btn-save {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            box-shadow: 0 14px 30px rgba(59, 130, 246, 0.25);
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 36px rgba(59, 130, 246, 0.35);
        }

        @media (max-width: 768px) {
            .edit-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .edit-header-title h1 {
                font-size: 24px;
            }

            .edit-form__grid {
                grid-template-columns: 1fr;
            }

            .edit-form-card__head,
            .edit-form {
                padding-left: 18px;
                padding-right: 18px;
            }

            .edit-form-card {
                border-radius: 22px;
            }

            .profile-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-save {
                width: 100%;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $user = Auth::user();
        $roleName = optional($user->role)->name ?? 'Guest';
        $profileImage = $user->image ? asset('storage/' . $user->image) : asset('assets/admin/img/img-profile.jpg');
    @endphp

    <div class="grid_10">
        <div class="edit-profile-shell">
            <!-- Edit Header with Back Button -->
            <div class="edit-header">
                <div class="edit-header-title">
                    <h1>Edit Profile</h1>
                    <p>Update your account information and profile details</p>
                </div>
                <div class="edit-header-actions">
                    <a href="{{ route('profile') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Profile</span>
                    </a>
                </div>
            </div>

            <!-- Edit Form Card -->
            <div class="edit-form-card">
                <div class="edit-form-card__head">
                    <h2>Profile Information</h2>
                    <p>Keep your name and email accurate so notifications and admin actions stay consistent.</p>
                </div>

                <div class="edit-form">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="edit-form__grid">
                            <!-- Profile Image Upload -->
                            <div class="profile-field profile-field--full">
                                <label for="profile_image">Profile Image</label>
                                <div class="profile-avatar-upload">
                                    <img id="profile_image_preview" class="profile-avatar-upload__preview"
                                        src="{{ $profileImage }}" alt="Current profile image">
                                    <div>
                                        <input id="profile_image" type="file" name="image" accept="image/*"
                                            onchange="document.querySelector('#profile_image_preview').src = window.URL.createObjectURL(this.files[0]);">
                                        <div class="profile-avatar-upload__hint">
                                            <i class="fas fa-info-circle"></i> JPG, PNG, WEBP. Max 2MB.
                                        </div>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="field-error"><i class="fas fa-times-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Name Field -->
                            <div class="profile-field">
                                <label for="profile_name">Full Name</label>
                                <input id="profile_name" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" placeholder="Enter your full name" required>
                                @error('name')
                                    <span class="field-error"><i class="fas fa-times-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="profile-field">
                                <label for="profile_email">Email Address</label>
                                <input id="profile_email" type="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="Enter your email address"
                                    required>
                                @error('email')
                                    <span class="field-error"><i class="fas fa-times-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role Field (Read-only) -->
                            <div class="profile-field profile-field--full">
                                <label for="profile_role">User Role</label>
                                <input id="profile_role" type="text" value="{{ $roleName }}" readonly>
                                <span class="profile-avatar-upload__hint">
                                    <i class="fas fa-lock"></i> Your role cannot be changed here. Contact an administrator
                                    for role changes.
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="profile-actions">
                            <a href="{{ route('profile') }}" class="btn-cancel">
                                <i class="fas fa-times"></i>
                                <span>Cancel</span>
                            </a>
                            <button class="btn-save" type="submit">
                                <i class="fas fa-save"></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
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
    Edit Profile
@endsection
