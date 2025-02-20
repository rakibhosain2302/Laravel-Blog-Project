@extends('admin.layouts.header')

@prepend('style')
    <style>
        .slider td {
            text-align: left;
            vertical-align: top;
            padding-top: 18px;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Post List </h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="10%">SL</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th width="2%">Update</th>
                            <th width="2%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliderData as $id => $slider)
                            <tr class="odd slider gradeX">
                                <td>{{ ++$id }}</td>
                                <td style="font-weight: 600;">
                                    {{ $slider->title }}</td>
                                <td style="padding-top: 5px;"><img style="border: 1px solid #000; padding: 2px;" width="200px"
                                        height="60px" src="{{ asset('storage/' . $slider->image) }}" alt="Slider-image">
                                </td>
                                <td class="edit-btn"><a href="{{ route('slider.edit', $slider->id) }}">Update</a></td>
                                <td>
                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('admin.layouts.footer')

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
@endsection

@section('title')
    Post-List
@endsection
