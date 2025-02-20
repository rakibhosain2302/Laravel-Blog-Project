<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/stylelogin.css') }}" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <h1>Register</h1>
                <div>
                    <input type="text" class=" @error('name') is-invalid @enderror " value="{{ old('name') }}" placeholder="name"
                        name="name" />
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <input type="email" class=" @error('email') is-invalid @enderror " value="{{ old('email') }}" placeholder="email"
                        name="email" />
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <input type="password" class=" @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="password"
                        name="password" />
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <input type="password" class=" @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="confirm password">
                    <span class="text-danger">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="Btn">
                    <a href="{{ route('auth.login') }}">Back</a>
                    <input type="submit" value="Register" />
                </div>
            </form>
            <div class="button">
                <a href="#">Training with live project</a>
            </div>
        </section>
    </div>
</body>

</html>
