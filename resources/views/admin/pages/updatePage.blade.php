@extends('admin.layouts.header')

@prepend('style')
    <style>
        .text {
            width: 100%;
            height: 200px;
            font-size: 18px;
            text-align: justify
        }

        .boder {
            border: 4px solid #e6f0f3;
            line-height: 40px;
            margin-left: 100px;
            border-radius: 8px;
            margin-top: 20px;
            padding-left: 20px;
            width: 80%;
        }

        input.medium {
            width: 99%;
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
            <h2>Update Page</h2>
            <div class="block boder">
                <form action="{{ route('page.update', $editPage->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <div class="page-name">
                                    <label for="name">Page Name</label>
                                </div>
                                <input type="text" name="name" placeholder="Enter Page Name..."
                                    class="medium  @error('name') is-invalid @enderror" value="{{ old('name', $editPage->name) }}" />
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
                                    <label>Page Description</label>
                                </div>
                                <textarea name="body" class="text @error('body') is-invalid @enderror">{{ old('body', $editPage->body) }}</textarea>
                                <br />
                                <span class="text-danger">
                                    @error('body')
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
    Update-Page
@endsection
