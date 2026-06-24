@extends('layouts.header')

@section('content')
    @include('layouts.slider')

    <div class="contentsection contemplete clear">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="maincontent clear">
                    <div class="samepost clear">
                        <div class="search-results">
                            <h3>Search results for: "{{ $search }}"</h3>
                            <span class="title-body">
                                {{ $posts->count() }} found
                            </span>
                        </div>


                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <h2>
                                    <a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a>
                                </h2>
                                <h4>
                                    {{ $post->created_at->format('d M, Y h:i A') }},
                                    By <a href="#">{{ $post->user->name }}</a>
                                </h4>
                                <a href="{{ route('showPost', $post->id) }}">
                                    <img src="{{ asset('storage/' . $post->images) }}" alt="post image"
                                        class="img-fluid mb-3" />
                                </a>
                                <p>{{ Str::words($post->discription, 60, '.....') }}</p>
                                <div class="readmore clear">
                                    <a href="{{ route('showPost', $post->id) }}" class="btn btn-primary btn-sm">Read
                                        More</a>
                                </div>
                            @endforeach
                        @else
                            <div class="py-4 text-center text-muted">
                                <h4 class="mb-2">No {{ $search }} Content</h4>
                                <p class="mb-0 text-center">Try exploring other articles from the homepage.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
@endsection

@section('title')
    Search results for {{ $search }}
@endsection
