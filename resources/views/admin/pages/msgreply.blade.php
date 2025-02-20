@extends('admin.layouts.header')
@prepend('style')
    <style>
        .block {
            padding-top: 0px;
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            width: 97%;
            padding: 10px;
            height: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        input[readonly] {
            background: #e9ecef;
            cursor: not-allowed;
        }


        .Btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            text-align: center;
        }

        .Btn:hover {
            background-color: #0056b3;
            color: white;
        }

        .form-group button[type="submit"] {
            padding: 10px 18px;
            background: #007bff;
            color: white;
            border: none;
            font-size: 17px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-group button[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
@endprepend
@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Reply Message</h2>
            <div class="block">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="toemail">To:</label>
                        <input type="email" id="toemail" name="toemail" value="{{ $replyMsg->email }}" class="medium"
                            readonly />
                    </div>

                    <div class="form-group">
                        <label for="fromemail">From:</label>
                        <input type="email" id="fromemail" name="fromemail" placeholder="Please enter your email..."
                            class="medium" />
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" placeholder="Please enter your subject..."
                            class="medium" />
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" class="text"></textarea>
                    </div>

                    <div class="form-group">
                        <a class="Btn" href="{{ route('message.index') }}">Back</a>
                        <button type="submit">Send</button>
                    </div>
                </form>
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
    Seen-Message
@endsection
