@extends('admin.layouts.header')

@prepend('style')
    <style>
        .text {
            width: 100%;
            height: 250px;
            font-size: 18px;
        }

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
            <h2>Update-User</h2>
            <div class="block boder">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <div class="page-name">
                                    <label for="name">User Name</label>
                                </div>
                                <input type="text" name="name" placeholder="Enter Post Title..."
                                    class="medium  @error('name') is-invalid @enderror" value="{{ $user->name }}" />
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
                                    <label for="email">User Email</label>
                                </div>
                                <input type="text" name="email" placeholder="Enter Post Title..."
                                    class="medium  @error('email') is-invalid @enderror" value="{{ $user->email }}" />
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
                                    <label>User Roles</label>
                                </div>
                                <select id="role_id" name="role_id" class=" @error('role_id') is-invalid @enderror">
                                    <option disabled>Select Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" data-description="{{ $role->description }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <br />
                                <span class="text-danger">
                                    @error('role_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="page-body">
                                    <label>Role Description</label>
                                </div>
                                <input type="text" id="role_description" class="form-control" name="role_description"
                                    value="{{ old('role_description', $user->role->description ?? '') }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="Back-btn" href="{{ route('users.index') }}">Back</a>
                                <input class="Btn" type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let roleSelect = document.getElementById("role_id");
            let roleDescription = document.getElementById("role_description");

            function updateRoleDescription() {
                let selectedOption = roleSelect.options[roleSelect.selectedIndex];
                roleDescription.value = selectedOption.getAttribute("data-description") || "";
            }

            roleSelect.addEventListener("change", updateRoleDescription);

            updateRoleDescription();
        });
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Update-Post
@endsection
