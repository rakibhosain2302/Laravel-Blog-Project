@extends('admin.layouts.header')

@prepend('style')
    <style>
        .left-side {
            float: left;
            width: 70%;
        }

        .right-side {
            margin-top: 20px;
            float: left;
            height: 150px;
            width: 150px;
            border: 2px solid #CCC;
            border-radius: 50%;
        }

        .right-side img {
            display: flex;
            margin: 18px 7px 1px 15px;
            height: 100px;
            width: 120px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar', ['data' => \App\Models\Titleslogan::first()])

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif
            <div class="block sloginblock">
                <div class="left-side">
                    <form action="{{ route('title.slogan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <table class="form">
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" class="medium" value="{{ $data->title }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" name="slogan" class="medium" value="{{ $data->slogan }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo"
                                        onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="right-side">
                    <div class="Title-logo">
                        <img id="output" class="img-thumbnuil img-fluid mt-2" src="{{ asset('storage/' . $data->logo) }}"
                            alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Title-Slogan
@endsection
