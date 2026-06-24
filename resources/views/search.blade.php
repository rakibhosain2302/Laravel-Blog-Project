@extends('layouts.header')

@section('content')
    @include('layouts.slider')

    <div class="contentsection contemplete clear">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="maincontent clear">
                    <div class="searchresults samepost clear">
                        <div class="search-results">
                            <h3>Search results for: "<span class="search-term">{{ $search }}</span>"</h3>
                            <span class="title-body">
                                {{ $posts->count() }} found
                            </span>
                        </div>


                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <div class="card card-bdy mb-3 p-4">
                                    <div class="post-header">
                                        <h2>
                                            <a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a>
                                        </h2>
                                        <h4 class="post-crated">
                                            {{ $post->created_at->format('d M, Y h:i A') }},
                                            By <a href="#">{{ $post->user->name }}</a>
                                        </h4>
                                    </div>
                                    <a class="post-img" href="{{ route('showPost', $post->id) }}">
                                        <img src="{{ asset('storage/' . $post->images) }}" alt="post image"
                                            class="img-fluid mb-3" />
                                    </a>
                                    <p>{{ Str::words($post->discription, 60, '.....') }}</p>
                                    <div class="readmore clear">
                                        <a href="{{ route('showPost', $post->id) }}" class="btn btn-primary btn-sm">Read
                                            More</a>
                                    </div>
                                </div>
                            @endforeach
                            @if ($posts->lastPage() > 1)
                                <nav class="pagination">
                                    <ul>
                                        {{-- Previous Button --}}
                                        <li class="{{ $posts->onFirstPage() ? 'disabled' : '' }}">
                                            @if (!$posts->onFirstPage())
                                                <a href="{{ $posts->previousPageUrl() }}">« Previous</a>
                                            @else
                                                <span>« Previous</span>
                                            @endif
                                        </li>

                                        {{-- Page Numbers --}}
                                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                            <li class="{{ $i == $posts->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Next Button --}}
                                        <li class="{{ $posts->hasMorePages() ? '' : 'disabled' }}">
                                            @if ($posts->hasMorePages())
                                                <a href="{{ $posts->nextPageUrl() }}">Next »</a>
                                            @else
                                                <span>Next »</span>
                                            @endif
                                        </li>
                                    </ul>
                                </nav>
                            @endif
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
