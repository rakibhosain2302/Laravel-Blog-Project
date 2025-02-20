@extends('layouts.header')

@section('content')
    <div class="contentsection contemplete clear">
        <div class="maincontent clear">

            <div class="about">
                <h2>{{ $post->title }}</h2>
                <img src="{{ asset('storage/' . $post->images) }}" alt="MyImage" />
                <h4>{{ $post->created_at->format('d M, Y h:i A') }}, By <a href="#">{{ $post->user->name }}</a></h4>
                <hr>
                <p>{{ $post->discription }}</p>

                <div class="relatedpost clear">
                    <h2>Related articles</h2>
                    @if (isset($relatedPost) && $relatedPost->count() > 0)
                        @foreach ($relatedPost as $related)
                            <a href="{{ route('showPost', $related->id) }}">
                                <img src="{{ asset('storage/' . $related->images) }}" alt="{{ $related->title }}" />
                            </a>
                        @endforeach
                    @else
                        <h4>No Related Post</h4>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.sidebar')

        @include('layouts.footer')
    @endsection
    @section('title')
    Post-Details
    @endsection
