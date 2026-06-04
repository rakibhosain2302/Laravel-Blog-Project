@extends('admin.layouts.header')

@prepend('style')
    <style>
        .view-btn a {
            padding: 0px 16px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: gainsboro;
            color: #000;
            border-color: black;
        }
    </style>
@endprepend


@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Page List</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th style="width: 5%">Serial No.</th>
                            <th style="width: 8%;">Page Name</th>
                            <th style="width: 30%;">Description</th>
                            <th style="width: 2%;">View</th>
                            <th style="width: 2%">Update</th>
                            <th style="width: 2%;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $id => $pageList)
                            <tr class="odd gradeX">
                                <td>{{ ++$id }}</td>
                                <td>{{ $pageList->name }}</td>
                                <td>{{ Str::limit($pageList->body, 80, '...') }}</td>
                                <td class="view-btn">
                                    <a href="{{ route('page.show', $pageList->id) }}">View</a>
                                </td>
                                <td class="update-btn">
                                    <a href="{{ route('page.edit', $pageList->id) }}">Update</a>
                                </td>
                                <td>
                                    <form action="{{ route('page.destroy', $pageList->id) }}" method="POST">
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
    Page-List
@endsection
