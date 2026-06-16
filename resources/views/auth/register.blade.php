<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/stylelogin.css') }}" />
</head>

<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-header">
                <h1>Create Account</h1>
                <p class="subtext">Join now and start managing your blog.</p>
            </div>

            <form action="{{ route('register.store') }}" method="POST" class="login-form">
                @csrf

                <div class="input-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" placeholder="Full Name"
                        value="{{ old('name') }}" class="form-input @error('name') invalid @enderror" />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email Address"
                        value="{{ old('email') }}" class="form-input @error('email') invalid @enderror" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" placeholder="Password"
                            class="form-input @error('password') invalid @enderror" />
                        <span class="toggle-password" onclick="togglePassword('password','eyeIcon')">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-wrapper">
                        <input id="confirm_password" type="password" name="confirm_password"
                            placeholder="Confirm Password" class="form-input" />
                        <span class="toggle-password" onclick="togglePassword('confirm_password','eyeIconConfirm')">
                            <i id="eyeIconConfirm" class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="login-actions">
                    <a class="button button-ghost" href="{{ route('auth.login') }}">Back</a>
                    <button type="submit" class="button button-primary">Register</button>
                </div>
            </form>

            <p class="login-note">{{ $data->title ?? 'Your Blog Website' }}</p>
        </div>
    </div>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("bi-eye");
                eyeIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("bi-eye-slash");
                eyeIcon.classList.add("bi-eye");
            }
        }
    </script>

</body>

</html>
