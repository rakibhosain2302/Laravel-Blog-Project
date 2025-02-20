@extends('layouts.header')

@prepend('style')
    <style>
        input[type="text"],
        input[type="email"] {
            border: 1px solid #cfc5b6;
            border-radius: 3px;
            margin-bottom: 5px;
            padding: 6px;
            width: 450px;
        }

        textarea {
            height: 200px;
            margin-bottom: 10px;
            padding: 6px;
            width: 450px;
            border: 1px solid #cfc5b6;
        }

        input[type="submit"] {
            background: #b7801c none repeat scroll 0 0;
            border: 1px solid #e6af4b;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            font-size: 20px;
            padding: 5px 10px;
        }
    </style>
@endprepend

@section('content')
    <div class="contentsection contemplete clear">
        <div class="maincontent clear">
            <div class="about">
                <h2>Contact us</h2>
                <form action="{{ Route('message.store') }}" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td>Your First Name:</td>
                            <td>
                                <input type="text" name="firstname" class=" @error('firstname') is-invalid @enderror"
                                    value="{{ old('firstname') }}" placeholder="Enter first name" />
                                <span class="text-danger">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Your Last Name:</td>
                            <td>
                                <input type="text" name="lastname" class=" @error('firstname') is-invalid @enderror"
                                    value="{{ old('firstname') }}" placeholder="Enter Last name" />
                                <span class="text-danger">
                                    @error('lastname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Your Email Address:</td>
                            <td>
                                <input type="email" name="email" class=" @error('firstname') is-invalid @enderror"
                                    value="{{ old('firstname') }}" placeholder="Enter Email Address" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Your Message:</td>
                            <td>
                                <textarea name="message" class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                <span class="text-danger">
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Send" />
                            </td>
                        </tr>
                    </table>
                    <form>
            </div>
        </div>

        @include('layouts.sidebar')

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

        @include('layouts.footer')
    @endsection

    @section('title')
        Contract-us
    @endsection
