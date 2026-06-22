@extends('layouts.header')

@prepend('style')
    <style>
        .contact-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding-top: 24px;
            border-radius: 10px;
        }

        .contact-form {
            flex: 1;
            background: #f9f9f9;
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
            border-color: #3399ff;
            outline: none;
        }

        .contact-form input[type="submit"] {
            background: #3399ff;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 20px;
            font-size: 18px;
            padding: 7px 30px;
            transition: 0.3s;
        }

        .contact-form input[type="submit"]:hover {
            background: #3399cc;
        }

        .contact-info {
            flex: 1;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info h3 {
            margin-bottom: 15px;
            color: #3399ff;
            font-size: 22px;
            border-bottom: 1px solid #3399ff;
            padding-bottom: 5px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .info-item .icon {
            font-size: 22px;
            margin-right: 10px;
            color: #b7801c;
        }

        .info-item p {
            margin: 0;
            font-size: 16px;
            color: #333;
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

                    {{-- <div class="contract-info">
                        <h2>Contract Information</h2>
                        <p><strong>Name:</strong> {{ $userInfo->firstname }} {{ $userInfo->lastname }}</p>
                        <p><strong>Email:</strong> {{ $userInfo->email }}</p>
                        <p><strong>Phone:</strong> {{ $userInfo->phone ?? 'N/A' }}</p>
                    </div> --}}

                    <!-- Left Side Info -->
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <div class="info-item">
                            <span class="icon">📧</span>
                            <p><strong>Email:</strong> info@example.com</p>
                        </div>
                        <div class="info-item">
                            <span class="icon">📞</span>
                            <p><strong>Phone:</strong> +88 0123456789</p>
                        </div>
                        <div class="info-item">
                            <span class="icon">📍</span>
                            <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                        </div>
                    </div>


                    <!-- Right Side Form -->
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

                        <input class="form-btn" type="submit" value="Send">
                    </form>
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
