@extends('admin.layouts.header')

@prepend('style')
    <style>
        .post-show-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .post-show-shell::before,
        .post-show-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .post-show-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .post-show-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .post-show-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .post-hero,
        .post-details-card,
        .post-mini-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .post-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .post-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .post-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .post-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .post-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .post-back-btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .post-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .post-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        .post-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .post-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .post-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .post-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .post-details-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .post-details-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .post-details-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .post-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .post-details-wrap {
            padding: 20px 24px 24px;
        }

        .post-details-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .post-details-table th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: 700;
            padding: 16px;
            width: 140px;
            text-align: left;
            border: 1px solid #eef2f7;
            border-right: 0;
        }

        .post-details-table td {
            background: #fff;
            color: #334155;
            padding: 16px;
            border: 1px solid #eef2f7;
            border-left: 0;
        }

        .post-details-table tr:first-child th,
        .post-details-table tr:first-child td {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .post-details-table tr:last-child th,
        .post-details-table tr:last-child td {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .post-image-preview {
            max-width: 240px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }

        .post-content-text {
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .post-tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .post-tag {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 13px;
            font-weight: 700;
        }

        .post-back-wrapper {
            margin-top: 24px;
            text-align: right;
        }

        .post-quick-links {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .post-mini-card {
            padding: 20px;
        }

        .post-mini-card h3 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 18px;
            letter-spacing: -0.03em;
        }

        .post-mini-card p {
            margin: 0;
            color: #64748b;
            line-height: 1.65;
            font-size: 14px;
        }

        @media (max-width: 991px) {
            .post-hero-stats,
            .post-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .post-show-shell {
                padding-top: 14px;
            }

            .post-hero,
            .post-details-card__head,
            .post-details-wrap,
            .post-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .post-back-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="post-show-shell">
            <div class="post-show-grid">
                <section class="post-hero">
                    <div class="post-hero__top">
                        <div class="post-kicker">Post details</div>
                        <a class="post-back-btn" href="{{ route('posts.index') }}">← Back to Posts</a>
                    </div>
                    <h1>{{ $viewPost->title }}</h1>
                    <p>
                        View the complete details of this post including title, category, content, and author information.
                    </p>

                    <div class="post-hero-stats">
                        <div class="post-stat">
                            <span>Category</span>
                            <strong>{{ $viewPost->category->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Author</span>
                            <strong>{{ $viewPost->user->name ?? 'Unknown' }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Post ID</span>
                            <strong>#{{ $viewPost->id }}</strong>
                        </div>
                    </div>
                </section>

                <div class="post-quick-links">
                    <div class="post-mini-card">
                        <div class="post-pill">Quick tip</div>
                        <h3>Want to make changes?</h3>
                        <p>Head to the edit page to update this post content or metadata.</p>
                    </div>

                    <div class="post-mini-card">
                        <div class="post-pill">Navigation</div>
                        <h3>Back to list</h3>
                        <p>Use the back button above to return to the posts overview.</p>
                    </div>
                </div>

                <section class="post-details-card">
                    <div class="post-details-card__head">
                        <div>
                            <h2>Post Information</h2>
                            <p>Detailed view of post properties.</p>
                        </div>
                        <div class="post-pill">Details view</div>
                    </div>

                    <div class="post-details-wrap">
                        <table class="post-details-table">
                            <tr>
                                <th>Title Name</th>
                                <td style="font-weight: 700; color: #0f172a;">{{ $viewPost->title }}</td>
                            </tr>
                            <tr>
                                <th>Category Name</th>
                                <td>{{ $viewPost->category->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Category ID</th>
                                <td>#{{ $viewPost->category_id }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: top; padding-top: 16px;">Images</th>
                                <td>
                                    <img class="post-image-preview" src="{{ asset('storage/' . $viewPost->images) }}" alt="Post Image">
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: top; padding-top: 16px;">Content</th>
                                <td class="post-content-text">{{ $viewPost->discription }}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>
                                    @if($viewPost->tags)
                                        <div class="post-tags-list">
                                            @foreach(explode(',', $viewPost->tags) as $tag)
                                                <span class="post-tag">{{ trim($tag) }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="color: #94a3b8;">No tags</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>{{ $viewPost->user->name ?? 'Unknown' }}</td>
                            </tr>
                        </table>

                        <div class="post-back-wrapper">
                            <a class="post-back-btn" href="{{ route('posts.index') }}">Back to List</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Post-Details
@endsection