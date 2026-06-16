<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
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
                    <input id="email" type="email" name="email" placeholder="User Email" value="{{ old('email') }}" class="form-input @error('email') invalid @enderror" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Password" class="form-input @error('password') invalid @enderror" />
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
</body>
</html>
