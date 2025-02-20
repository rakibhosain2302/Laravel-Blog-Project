@extends('admin.layouts.header')

@prepend('style')
    <style>
        table.form td {
            padding: 0px 0px 4px 0px;
        }

        .boder {
            border: 4px solid #e6f0f3;
            line-height: 40px;
            margin: 0 auto;
            border-radius: 8px;
            margin-top: 20px;
            padding-left: 20px;
            width: 60%;
        }

        input.medium {
            width: 98%;
        }

        table.form input,
        table.form select {
            font-size: 15px;
            padding: 8px 4px 8px 8px;
        }

        table.form input[type="submit"] {
            border: 1px solid #000;
            color: #fff;
            background-color: green;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
            padding: 4px 10px;
        }

        table.form {
            width: 97%;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Change Password</h2>
            <div class="block boder">
                <form action="{{ route('update.password', Auth::user()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <div class="page-name">
                                    <label for="name">Old Password</label>
                                </div>
                                <input type="password" name="old_password"
                                    class="medium  @error('old_password') is-invalid @enderror"
                                    value="{{ old('old_password') }}" />
                                <br />
                                <span class="text-danger">
                                    @error('old_password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="page-body">
                                    <label>New Password</label>
                                </div>
                                <input name="new_password" type="password"
                                    class="medium @error('new_password') is-invalid @enderror"
                                    value="{{ old('new_password') }}" />
                                <br />
                                <span class="text-danger">
                                    @error('new_password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="page-body">
                                    <label>Confirm New Password</label>
                                </div>
                                <input name="new_password_confirmation" type="password"
                                    class="medium @error('new_password_confirmation') is-invalid @enderror"
                                    value="{{ old('new_password_confirmation') }}" />
                                <br />
                                <span class="text-danger">
                                    @error('new_password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="Back-btn" href="{{ route('dashbord') }}">Back</a>
                                <input type="submit" name="submit" value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
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
    @include('admin.layouts.footer')
@endsection

@section('title')
    Change-Password
@endsection
