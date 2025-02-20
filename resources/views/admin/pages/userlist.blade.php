@extends('admin.layouts.header')


@section('content')
@include('admin.layouts.sidebar')
<div class="grid_10">
    <div class="box round first grid">
        <h2>User-List ({{ $userCount ?? 0 }})</h2>
        @if (session('success'))
            <p class="successMsg">{{ session('success') }}</p>
        @endif
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th style="width: 2%;">SL No.</th>
                        <th style="width: 10%;">User-Name</th>
                        <th style="width: 10%;">Email</th>
                        <th style="width: 10%;">Role</th>
                        <th style="width: 10%;">Role-Descriptions</th>
                        <th style="width: 1%;">Update</th>
                    @if (auth()->user()->role->name === 'Admin')
                    <th style="width: 1%;">Delete</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $id => $user)
                        <tr class="odd gradeX">
                            <td>{{ ++$id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ optional($user->role)->name ?? 'No Role' }}</td>
                            <td>{{ optional($user->role)->description ?? 'No Descriptions' }}</td>
                            <td class="update-btn">
                                <a href="{{ route('users.edit', $user->id) }}">Update</a>
                            </td>
                            @if (auth()->user()->role->name === 'Admin')
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                </form>
                            </td>
                            @endif
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

@if (session('userdelete'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "Success!",
            text: "{{ session('userdelete') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('admin.layouts.footer')
@endsection
@section('title')
    User-list
@endsection