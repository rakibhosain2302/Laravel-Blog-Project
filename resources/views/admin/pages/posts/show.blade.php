@extends('admin.layouts.header')

@prepend('style')
    <style>
        .form {
            width: 100%;
            border-collapse: collapse;
        }

        table.form th,
        td {
            border: 1px solid #ddd;
            text-align: justify;
            padding: 10px !important;
        }


        table.form th {
            background-color: #f2f2f2;
            text-align: left;
            width: 115px;
        }

        .Btn a{
            border: 1px solid #000;
            border-radius: 4px;
            color: #FFF;
            cursor: pointer;
            font-size: 18px;
            padding: 1px 10px 3px 10px;
            font-weight: normal;
            background: green;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>View Post</h2>
            <div class="block">
                <table class="form">

                    <tr>
                        <th>Title Name</th>
                        <td>{{ $viewPost->title }}</td>
                    </tr>
                    <tr>
                        <th>Category Name</th>
                        <td>{{ $viewPost->category->name }}</td>
                    </tr>
                    <tr>
                        <th>CategoryID</th>
                        <td>{{ $viewPost->category_id }}</td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top; padding-top: 9px;">Images</th>
                        <td><img src="{{ asset('storage/'. $viewPost->images) }}" alt="Image Preview" style="max-width: 200px;"><br></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top; padding-top: 9px;">Content</th>
                        <td>{{ $viewPost->discription }}</td>
                    </tr>
                    <tr>
                        <th>Tags</th>
                        <td>{{ $viewPost->tags}}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>{{ $viewPost->user->name }}</td>
                    </tr>
                </table>
                <div class="Btn">
                    <a href="{{ Route('posts.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Post-Details
@endsection
