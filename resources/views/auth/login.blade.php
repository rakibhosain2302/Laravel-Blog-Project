<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/stylelogin.css') }}" />
</head>

<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-header">
                <h1>Welcome Back</h1>
                <p class="subtext">Sign in to your account</p>
            </div>

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ Route('login.match') }}" method="POST" class="login-form">
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="User Email"
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
                        <span class="toggle-password" onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="login-actions">
                    <a class="button button-ghost" href="{{ Route('auth.register') }}">Register</a>
                    <button type="submit" class="button button-primary">Log in</button>
                </div>
            </form>
            <p class="login-note">{{ $data->title ?? 'Your Blog Website' }}</p>
        </div>
    </div>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    <!-- ✅ Eye toggle script সবসময় load হবে -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

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
