@extends('admin.layouts.header')

@prepend('style')
    <style>
        .text {
            width: 75%;
            height: 200px;
            font-size: 18px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Slider</h2>
            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif
            <div class="block">
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Slider Title..."
                                    class="medium  @error('title') is-invalid @enderror" value="{{ old('title') }}" />
                                    <br/>
                                <span class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" class=" @error('image') is-invalid @enderror"
                                    value="{{ old('image') }}" />
                                    <br/>
                                <span class="text-danger">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
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
    Add-Slider
@endsection
