@extends('admin.layouts.header')

@prepend('style')
    <style>
        .left-side {
            float: left;
            width: 70%;
        }

        .copyright-form {
            margin-top: 20px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Copyright Text</h2>

            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif

            <div class="block sloginblock">
                <div class="left-side copyright-form">
                    <form action="{{ route('copyright.update', $noteData->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Copyright Note</label>
                                </td>
                                <td>
                                    <input type="text" name="note" class="medium" value="{{ $noteData->note }}" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Copyright
@endsection
