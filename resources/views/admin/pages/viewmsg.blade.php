@extends('admin.layouts.header')
@prepend('style')
    <style>
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
    }

    .Btn{
        border: 1px solid #000;
        border-radius: 4px;
        color: #444;
        cursor: pointer;
        font-size: 18px;
        padding: 1px 10px 3px 10px;
        font-weight: normal;
        background: #f0f0f0;
    }
</style>
    </style>
@endprepend
@section('content')

@include('admin.layouts.sidebar')

<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
        <div class="block">
            <table class="form">
                    <tr>
                        <th>Name</th>
                        <td>{{ $viweMsg->firstname }}{{ $viweMsg->lastname }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ $viweMsg->email }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{ $viweMsg->message }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $viweMsg->created_at->format('d M, Y h:i A') }}</td>
                    </tr>
                </table>
                <a class="Btn" href="{{ route('message.index') }}">OK</a>
        </div>
    </div>
</div>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

@include('admin.layouts.footer')
@endsection
@section('title')
    Seen-Message
@endsection