@extends('layouts.header')

@section('content')
    <section class="contentsection contemplete clear py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="post-card shadow-sm rounded-4 overflow-hidden border-0">
                        <div class="post-card-body p-4 p-lg-5">
                            <div class="d-flex flex-column">
                                <div class="post-header">
                                    <h1 class="display-6 fw-bold">{{ $post->title }}</h1>
                                    <div class="post-crated">
                                        {{ $post->created_at->format('d M, Y h:i A') }} · By <a href="#" class="text-decoration-none">{{ $post->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ratio ratio-16x9 mb-2 rounded-2 overflow-hidden border border-1 border-light">
                                <img src="{{ asset('storage/' . $post->images) }}" alt="{{ $post->title }}" class="img-fluid object-fit-cover" />
                            </div>

                            <div class="post-content fs-5 text-secondary" style="line-height: 1.85;">
                                <p>{{ $post->discription }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="relatedpost-card p-4 rounded-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h4 mb-0">Related articles</h2>
                            <span class="title-body">{{ isset($relatedPost) ? $relatedPost->count() : 0 }} found</span>
                        </div>

                        @if (isset($relatedPost) && $relatedPost->count() > 0)
                            <div class="row g-3">
                                @foreach ($relatedPost as $related)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <a href="{{ route('showPost', $related->id) }}" class="relatedpost-item d-block text-decoration-none text-dark">
                                            <div class="card h-100 border-1 shadow-sm overflow-hidden">
                                                <div class="ratio ratio-4x3">
                                                    <img src="{{ asset('storage/' . $related->images) }}" alt="{{ $related->title }}" class="card-img-top object-fit-cover" />
                                                </div>
                                                <div class="card-body p-3">
                                                    <h3 class="h6 card-title mb-2">{{ Str::limit($related->title, 60) }}</h3>
                                                    <p class="card-text text-muted mb-0">{{ Str::limit($related->discription, 85) }}</p>
                                                </div>
                                                <div class="card-footer border-0 p-3 pt-0">
                                                    <small class="text-muted">{{ $related->created_at->format('d M, Y') }}</small>
                                                    <a class="title-body" href="{{ route('showPost', $related->id) }}">read more</a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-4 text-center text-muted">
                                <h4 class="mb-2">No Related Post</h4>
                                <p class="mb-0">Try exploring other articles from the homepage.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('style')
        <style>
            .post-card {
                background: #ffffff;
            }

            .post-card-body {
                background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            }

            .relatedpost-card {
                min-height: 220px;
                border: 1px solid #ccc;
            }

            .relatedpost-item:hover .card {
                transform: translateY(-4px);
                box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
            }

            .relatedpost-item .card {
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .card-title {
                font-size: 20px;
                font-weight: 600;
            }

            /* .object-fit-cover {
                object-fit: cover;
            } */

            .card-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: none;
            }

            .card-footer .title-body {
                font-size: 14px;
                font-weight: 500;
                color: #2563eb;
                text-decoration: none;
            }

            @media (max-width: 767px) {
                .post-card-body {
                    padding: 1.75rem !important;
                }
            }
        </style>
    @endpush
@endsection

@section('title')
    Post Details
@endsection
