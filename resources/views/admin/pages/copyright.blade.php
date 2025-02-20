@extends('admin.layouts.header')

@prepend('style')
    <style>
        .boder {
            border: 4px solid #e6f0f3;
            line-height: 32px;
            margin-left: 100px;
            border-radius: 8px;
            margin-top: 60px;
            padding-left: 20px;
            width: 600px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar', ['noteData' => \App\Models\Copyright::first()])

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Copyright Text</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif
            <div class="block boder">
                <form action="{{ route('capyright.update', $noteData->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" value="{{ $noteData->note }}" name="note" class="large" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
    Copyright-{{ date('Y') }}
@endsection
