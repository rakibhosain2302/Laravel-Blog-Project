@extends('layouts.header')

@prepend('style')
    <style>
        .contact-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding: 40px;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .contact-form {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #b7801c;
            outline: none;
        }

        .contact-form input[type="submit"] {
            background: #b7801c;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .contact-form input[type="submit"]:hover {
            background: #e6af4b;
        }

        .contact-info {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info h3 {
            margin-bottom: 15px;
            color: #b7801c;
        }

        .contact-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }
        }
    </style>
@endprepend

@section('content')
    <div class="contentsection contemplete clear">
        <div class="maincontent clear">
            <div class="about">
                <h2>Contact Us</h2>
                <div class="contact-container">

                    <!-- Left Side Form -->
                    <form action="{{ Route('message.store') }}" method="POST" class="contact-form">
                        @csrf
                        <input type="text" name="firstname" placeholder="First Name" value="{{ old('firstname') }}">
                        <span class="text-danger">
                            @error('firstname')
                                {{ $message }}
                            @enderror
                        </span>

                        <input type="text" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
                        <span class="text-danger">
                            @error('lastname')
                                {{ $message }}
                            @enderror
                        </span>

                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>

                        <textarea name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                        <span class="text-danger">
                            @error('message')
                                {{ $message }}
                            @enderror
                        </span>

                        <input type="submit" value="Send">
                    </form>

                    <!-- Right Side Info -->
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p><strong>Email:</strong> anasahibve@gmail.com</p>
                        <p><strong>Phone:</strong> +88 01601-139968</p>
                        <p><strong>Location:</strong> Hathazari, Chattogram, Bangladesh</p>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('title')
    Contact Us
@endsection
