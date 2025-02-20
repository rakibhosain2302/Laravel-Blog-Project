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
                <form action="{{ route('slider.update',$updateSlider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Slider Title..."
                                    class="medium  @error('title') is-invalid @enderror" value="{{ old('title', $updateSlider->title) }}" />
                                <br />
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
                                    onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" />
                                <br />
                                <!-- পুরাতন ইমেজ দেখানোর জন্য -->
                                @if ($updateSlider->image)
                                    <img id="output" style="border: 1px solid #000"
                                        src="{{ asset('/storage/' . $updateSlider->image) }}"
                                        class="img-thumbnuil img-fluid mt-2" width="400" height="150" alt="Post-Image">
                                @endif
                                <br />
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
                                <a class="Back-btn" href="{{ route('slider.index') }}">Back</a>
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
    Update-Slider
@endsection
