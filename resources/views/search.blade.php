@extends('layouts.header')

@section('content')
    @include('layouts.slider')

    <div class="contentsection contemplete clear">
        <div class="maincontent clear">
            <div class="samepost clear">
                <h3>Search results for: "{{ $search }}"</h3>

                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                        <h2><a href="{{ route('showPost',$post->id) }}">{{ $post->title }}</a></h2>
                        <h4>{{ $post->created_at->format('d M, Y h:i A') }}, By <a href="#">{{ $post->user->name }}</a>
                        </h4>
                        <a href="{{ route('showPost',$post->id) }}"><img src="{{ asset('storage/' . $post->images) }}" alt="post image" /></a>
                        <p>{{ Str::words($post->discription, 60, '.....') }}</p>
                        <div class="readmore clear">
                            <a href="{{ route('showPost', $post->id) }}">Read More</a>
                        </div>
                    @endforeach
                @else
                    <p>No results found.</p>
                @endif
            </div>
        </div>

        @include('layouts.sidebar')

        @include('layouts.footer')
    @endsection

    @section('title')
    Search results for {{ $search }}
    @endsection
