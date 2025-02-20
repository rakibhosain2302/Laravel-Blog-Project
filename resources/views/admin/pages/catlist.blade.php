@extends('admin.layouts.header')


@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Category List</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th style="width: 500px;">Category Name</th>
                            <th style="width: 420px;">Total-Post</th>
                            <th style="width: 80px;">Update</th>
                            <th style="width: 100px;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catData as $id => $category)
                            <tr class="odd gradeX">
                                <td>{{ ++$id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->posts->count() }}</td>
                                <td class="update-btn">
                                    <a href="{{ route('categories.edit', $category->id) }}">Update</a>
                                </td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Category-List
@endsection
