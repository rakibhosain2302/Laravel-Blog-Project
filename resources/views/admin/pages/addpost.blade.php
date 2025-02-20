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
            <h2>Add New Post</h2>
            <div class="block">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..."
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="category_id" name="category_id"
                                    class=" @error('category_id') is-invalid @enderror">
                                    <option disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <br/>
                                <span class="text-danger">
                                    @error('category_id')
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
                                <input type="file" name="images" class=" @error('images') is-invalid @enderror"
                                    value="{{ old('images') }}" />
                                    <br/>
                                <span class="text-danger">
                                    @error('images')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="discription" class="text @error('discription') is-invalid @enderror" value="{{ old('discription') }}" placeholder="What's on your mind?"></textarea>
                                <br/>
                                <span class="text-danger">
                                    @error('discription')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags"
                                    class="medium @error('tags') is-invalid @enderror" value="{{ old('tags') }}" />
                                    <br/>
                                <span class="text-danger">
                                    @error('tags')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" class="medium" value="{{ Auth::user()->name }} ({{ Auth::user()->role->name }})" readonly />
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
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
    Add-Post
@endsection
