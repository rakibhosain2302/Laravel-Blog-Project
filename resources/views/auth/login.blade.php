<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/stylelogin.css') }}" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="{{ Route('login.match') }}" method="POST">
                @csrf
                <h1>Login</h1>
                @if (session('error'))
                    <p class="errorMsg">{{ session('error') }}</p>
                @endif
                <div>
                    <input type="email" class=" @error('email') is-invalid @enderror " placeholder="User Email" value="{{ old('email') }}" name="email" />
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <input type="password" class=" @error('password') is-invalid @enderror" placeholder="Password" name="password" />
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="Btn">
                    <a class="regi-btn" href="{{ Route('auth.register') }}">Register</a>
                    <input type="submit" value="Log in" />
                </div>
            </form>
            <div class="button">
                <a href="#">Training with live project</a>
            </div>
        </section>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
