@extends('layouts.header')

@prepend('style')
    <link rel="stylesheet" href="{{ asset('assets/custom-css/paginated.css') }}">
@endprepend

@section('content')
    @include('layouts.slider')

    <div class="contentsection contemplete clear">
        <div class="maincontent clear">

            @if (isset($category))
                <h2>Posts in "{{ $category->name }}"</h2>
                
                @foreach ($category->posts as $post)
                <div class="samepost clear">
                    <h2><a href="">{{ $post->title }}</a></h2>
                    <h4>{{ $post->created_at->format('d M, Y h:i A') }}, By <a href="#">{{ $post->user->name }}</a>
                    </h4>
                    <a href="#"><img src="{{ asset('storage/'. $post->images) }}" alt="post image" /></a>
                    <p>{{ Str::words($post->discription, 60, '.....') }}</p>
                    <div class="readmore clear">
                        <a href="{{ route('showPost', $post->id) }}">Read More</a>
                    </div>
                </div>
            @endforeach
            @else
                <h2>All Posts</h2>
                @foreach ($posts as $post)
                    <div class="samepost clear">
                        <h2><a href="">{{ $post->title }}</a></h2>
                        <h4>{{ $post->created_at->format('d M, Y h:i A') }}, By <a href="#">{{ $post->user->name }}</a>
                        </h4>
                        <a href="#"><img src="{{ asset('storage/'. $post->images ) }}" alt="post image" /></a>
                        <p>{{ Str::words($post->discription, 60, '.....') }}</p>
                        <div class="readmore clear">
                            <a href="{{ route('showPost', $post->id) }}">Read More</a>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Custom Pagination -->
            @php
                $totalPages = ceil($totalPosts / $perPage); // মোট কতগুলো পেজ হবে
            @endphp

            @if ($totalPages > 1)
                <nav class="pagination">
                    <ul>
                        <!-- Previous Button -->
                        <li class="{{ $page > 1 ? '' : 'disabled' }}">
                            @if ($page > 1)
                                <a href="?page={{ $page - 1 }}">Previous</a>
                            @else
                                <span>Previous</span>
                            @endif
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="{{ $i == $page ? 'active' : '' }}">
                                <a href="?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="{{ $page < $totalPages ? '' : 'disabled' }}">
                            @if ($page < $totalPages)
                                <a href="?page={{ $page + 1 }}">Next</a>
                            @else
                                <span>Next</span>
                            @endif
                        </li>
                    </ul>
                </nav>
            @endif
        </div>

        @include('layouts.sidebar')

        @include('layouts.footer')
    @endsection

    @section('title')
        Home
    @endsection
