@extends('layouts.header')

@prepend('style')
    <style>
        .contentsection.modern-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 20px;
            padding: 24px 0;
        }

        .maincontent.modern {
            background: transparent;
            border: none;
            float: none;
            margin: 0;
            width: auto;
            padding: 0;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .page-header .eyebrow {
            display: inline-flex;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .page-header h1 {
            margin: 0;
            font-size: clamp(2rem, 2.5vw, 2.8rem);
            line-height: 1.05;
            color: #0f172a;
        }

        .page-header .secondary-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.9rem 1.3rem;
            border-radius: 999px;
            background: #f8fafc;
            color: #111827;
            text-decoration: none;
            border: 1px solid #d1d5db;
            font-weight: 700;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .page-header .secondary-link:hover {
            background: #eef2ff;
            transform: translateY(-1px);
        }

        /* .post-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 22px;
            } */

        .post-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 750px;
            padding: 20px;
            border-radius: 24px;
            margin-bottom: 20px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: #ffffff;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .post-card-image {
            position: relative;
            width: 100%;
            min-height: 220px;
            overflow: hidden;
            background: #e2e8f0;
        }

        .post-card-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .post-card:hover .post-card-image img {
            transform: scale(1.03);
        }

        .post-card-body {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding-top: 20px;
        }

        .post-category {
            display: inline-flex;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            width: fit-content;
        }

        .post-card h2 {
            margin: 0;
            font-size: 1.45rem;
            line-height: 1.2;
            color: #0f172a;
        }

        .post-card h2 a {
            color: inherit;
            text-decoration: none;
        }

        .post-card h2 a:hover {
            color: #2563eb;
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.95rem;
            color: #64748b;
            align-items: center;
        }

        .post-card p {
            margin: 0;
            color: #475569;
            line-height: 1.75;
            min-height: 4.5rem;
            font-size: 0.98rem;
        }

        .post-actions {
            margin-top: auto;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 20px;
            border-radius: 999px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid transparent;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .pagination {
            margin-top: 34px;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .pagination ul {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination li {
            border-radius: 999px;
            overflow: hidden;
            border: 1px solid #d1d5db;
        }

        .pagination li a,
        .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 46px;
            height: 44px;
            padding: 0 14px;
            color: #334155;
            text-decoration: none;
            background: #ffffff;
            font-weight: 600;
        }

        .pagination li.active a {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
        }

        .pagination li.disabled span {
            color: #94a3b8;
            background: #f8fafc;
        }

        @media (max-width: 1080px) {
            .contentsection.modern-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 740px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .post-card-image {
                min-height: 180px;
            }
        }
    </style>
@endprepend

@section('content')
    @include('layouts.slider')

    <div class="contentsection contemplete clear modern-layout">
        <div class="maincontent clear modern">
            <div class="page-header">
                <div>
                    <span class="eyebrow">{{ isset($category) ? 'Category' : 'Latest Posts' }}</span>
                    <h1>{{ isset($category) ? 'Posts in "' . $category->name . '"' : '' }}</h1>
                </div>

                @if (isset($category))
                    <a href="{{ route('home') }}" class="secondary-link">View All Posts</a>
                @endif
            </div>

            <div class="post-grid">
                @php
                    $items = $posts;
                @endphp

                @foreach ($items as $post)
                    <article class="post-card">
                        <div class="post-card-image">
                            <img src="{{ asset('storage/' . $post->images) }}" alt="{{ $post->title }}" />
                        </div>
                        <div class="post-card-body">
                            <span class="post-category">{{ optional($post->category)->name ?? 'Blog' }}</span>
                            <h2><a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a></h2>
                            <div class="post-meta">
                                <span>{{ $post->created_at->format('d M, Y') }}</span>
                                <span>•</span>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <p>{{ Str::words($post->discription, 70, '...') }}</p>
                            <div class="post-actions">
                                <a href="{{ route('showPost', $post->id) }}" class="btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($posts->lastPage() > 1)
                <nav class="pagination">
                    <ul>
                        <li class="{{ $posts->onFirstPage() ? 'disabled' : '' }}">
                            @if (!$posts->onFirstPage())
                                <a href="{{ $posts->previousPageUrl() }}">Previous</a>
                            @else
                                <span>Previous</span>
                            @endif
                        </li>

                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            <li class="{{ $i == $posts->currentPage() ? 'active' : '' }}">
                                <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="{{ $posts->hasMorePages() ? '' : 'disabled' }}">
                            @if ($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}">Next</a>
                            @else
                                <span>Next</span>
                            @endif
                        </li>
                    </ul>
                </nav>
            @endif
        </div>


        @include('layouts.sidebar')

    </div>

@endsection

@section('title')
    Home
@endsection
