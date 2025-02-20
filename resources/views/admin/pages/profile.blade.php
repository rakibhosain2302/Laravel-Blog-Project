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
            width: 99%;
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
            <h2>User Profile</h2>
            <div class="block boder">
                @if (session('success'))
                    <p class="successMsg">{{ session('success') }}</p>
                @endif
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <div class="page-name">
                                    <label for="name">User-Name</label>
                                </div>
                                <input type="text" name="name" class="medium  @error('name') is-invalid @enderror"
                                    value="{{ old('name', Auth::user()->name) }}" />
                                <br />
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="page-body">
                                    <label>User-Email</label>
                                </div>
                                <input name="email" type="email" class="medium @error('email') is-invalid @enderror"
                                    value="{{ old('email', Auth::user()->email) }}" />
                                <br />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="page-body">
                                    <label>User-Role(s)</label>
                                </div>
                                <input name="role" type="text" class="medium @error('email') is-invalid @enderror"
                                    value="{{ Auth::user()->role->name ?? 'No Role Assigned' }}" readonly />
                                <br />
                                <span class="text-danger">
                                    @error('role')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="Back-btn" href="{{ route('dashbord') }}">Back</a>
                                <input class="Btn" type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    User-Profile
@endsection
