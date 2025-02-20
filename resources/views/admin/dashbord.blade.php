@extends('admin.layouts.header')

@prepend('style')
    <style>
        table.form td {
            padding: 0px 0px 4px 0px;
        }

        .boder {
            border: 4px solid #e6f0f3;
            line-height: 40px;
            border-radius: 8px;
            margin-top: 20px;
            padding-left: 20px;
            width: 97.5%;
            height: 200px;
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
        .user-name{
            color: forestgreen;
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            font-weight: bold;
        }
        .roles{
            color: green;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">

        <div class="box round first grid">
            <h2>Dashbord</h2>
            <div class="block boder">
                @if (Auth::check())
                    @php
                        $user = Auth::user();
                        $role = $user->role->name ?? 'Guest';
                    @endphp

                    <p>Welcome <span class="user-name">{{ $user->name }}</span>! <br>
                        You are logged in as a <strong class="roles">{{ $role }}</strong>.
                        {{ $user->role->description }}
                    </p>
                @else
                    <p>Welcome Guest!</p>
                @endif


            </div>
        </div>
    </div>


    @include('admin.layouts.footer')
@endsection

@section('title')
    Dashbord
@endsection
