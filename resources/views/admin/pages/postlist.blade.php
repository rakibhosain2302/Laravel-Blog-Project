@extends('admin.layouts.header')

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Post List  ({{ $postCount ?? 0 }})</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="40px">SL</th>
                            <th>Post-Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th width="315px">Description</th>
                            <th style="text-align: center">Post-By</th>
                            <th width="60px">Show</th>
                            <th width="60px">Update</th>
                            <th width="60px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $id => $postData)
                           @can('view', $postData)
                               
                           <tr class="odd gradeX">
                               <td>{{ ++$id }}</td>
                               <td style="font-weight: 600;">{{ $postData->title }}</td>
                               <td>{{ $postData->category->name }}</td>
                               <td style="padding-top: 5px;"><img style="border: 1px solid #000;" width="60px"
                                height="40px" src="{{ asset('storage/' . $postData->images) }}" alt="">
                            </td>
                            <td>{{ Str::limit($postData->discription, 60, '...') }}</td>
                            <td style="text-align: center; font-style: oblique; font-weight: 600;">
                                {{ $postData->user->name }}</td>
                                <td class="show-btn"><a href="{{ Route('posts.show', $postData->id) }}">Show</a></td>
                                
                                <td class="edit-btn"><a href="{{ route('posts.edit', $postData->id) }}">Update</a></td>
                                <td>
                                    <form action="{{ route('posts.destroy', $postData->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endcan
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
