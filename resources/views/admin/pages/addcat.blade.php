@extends('admin.layouts.header')


@section('content')
    @include('admin.layouts.sidebar')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Category</h2>
            <div class="block copyblock">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <table class="form">
                        <tr>
                            <td>
                                <label for="name">Category-Name :</label>
                                <input type="text" name="name" placeholder="Enter Category Name..."
                                    class="medium @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                <br />
                                <span class="text-danger" style="text-align: center; display: block;">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="Back-btn" href="{{ route('categories.index') }}">Back</a>
                                <input type="submit" name="submit" Value="Save" />
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
    Add-Category
@endsection
