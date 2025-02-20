@extends('admin.layouts.header')

@prepend('style')
    <style>
        .left-side {
            float: left;
            width: 70%;
        }

        .right-side {
            margin-top: 20px;
            float: left;
            height: 150px;
            width: 150px;
            border: 2px solid #CCC;
            border-radius: 50%;
        }

        .right-side img {
            display: flex;
            margin: 18px 7px 1px 15px;
            height: 100px;
            width: 120px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar', ['socials' => \App\Models\Titleslogan::first()])

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Socials Links</h2>
            @if (session('success')) 
            <p class="successMsg">{{ session('success') }}</p> 
            @endif

            @if (session('error')) 
            <p class="errorMsg">{{ session('error') }}</p> 
            @endif
            <div class="block sloginblock">
                <div class="left-side">

                    <form action="{{ route('social.update', $socials->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="fblink" class="medium" value="{{ $socials->fblink }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="twlink" class="medium" value="{{ $socials->twlink }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Linkedin</label>
                                </td>
                                <td>
                                    <input type="text" name="lnlink" class="medium" value="{{ $socials->lnlink }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Google</label>
                                </td>
                                <td>
                                    <input type="text" name="gllink" class="medium" value="{{ $socials->gllink }}" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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
    Social
@endsection
