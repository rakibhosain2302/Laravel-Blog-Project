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
                        <th>Page Name</th>
                        <td>{{ $showData->name }}</td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top; padding-top: 9px;">Content</th>
                        <td>{{ $showData->body }}</td>
                    </tr>
                </table>
                <div class="Btn">
                    <a href="{{ Route('page.index') }}">Back</a>
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
    Page-Details
@endsection
