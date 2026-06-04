@extends('admin.layouts.header')

@prepend('style')
    <style>
        .post-edit-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .post-edit-shell::before,
        .post-edit-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .post-edit-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .post-edit-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .post-edit-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .post-hero,
        .post-form-card,
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

        .post-form-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .post-form-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .post-form-card__head p {
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

        .post-form-wrap {
            padding: 20px 24px 24px;
        }

        .post-form-grid {
            display: grid;
            gap: 24px;
        }

        .post-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .post-form-group label {
            color: #0f172a;
            font-weight: 700;
            font-size: 14px;
        }

        .post-form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #dbe4f0;
            border-radius: 14px;
            font-size: 15px;
            background: #fff;
            color: #0f172a;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .post-form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .post-form-input.is-invalid {
            border-color: #ef4444;
        }

        .post-textarea {
            width: 100%;
            min-height: 180px;
            padding: 14px 16px;
            border: 1px solid #dbe4f0;
            border-radius: 14px;
            font-size: 15px;
            background: #fff;
            color: #0f172a;
            resize: vertical;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .post-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .post-textarea.is-invalid {
            border-color: #ef4444;
        }

        .post-form-file {
            padding: 12px;
            border: 1px solid #dbe4f0;
            border-radius: 14px;
            background: #fff;
            cursor: pointer;
        }

        .post-form-file.is-invalid {
            border-color: #ef4444;
        }

        .post-error {
            color: #dc2626;
            font-size: 13px;
            font-weight: 500;
        }

        .post-submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border-radius: 999px;
            background: #0f172a;
            border: 1px solid transparent;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .post-submit-btn:hover {
            transform: translateY(-1px);
            background: #1e293b;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.16);
        }

        .post-author-display {
            padding: 12px 16px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
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

        .post-image-preview {
            margin-top: 12px;
            max-width: 200px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }

        @media (max-width: 991px) {
            .post-hero-stats,
            .post-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .post-edit-shell {
                padding-top: 14px;
            }

            .post-hero,
            .post-form-card__head,
            .post-form-wrap,
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

    @php
        $totalCategories = $categories->count();
    @endphp

    <div class="grid_10">
        <div class="post-edit-shell">
            <div class="post-edit-grid">
                <section class="post-hero">
                    <div class="post-hero__top">
                        <div class="post-kicker">Edit post</div>
                        <a class="post-back-btn" href="{{ route('posts.index') }}">← Back to Posts</a>
                    </div>
                    <h1>Update your post content.</h1>
                    <p>
                        Modify the details below to keep your content fresh and accurate. Save changes when you're done.
                    </p>

                    <div class="post-hero-stats">
                        <div class="post-stat">
                            <span>Total categories</span>
                            <strong>{{ $totalCategories }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Post ID</span>
                            <strong>#{{ $updatePost->id }}</strong>
                        </div>
                    </div>
                </section>

                <div class="post-quick-links">
                    <div class="post-mini-card">
                        <div class="post-pill">Editing tip</div>
                        <h3>Make it better</h3>
                        <p>Review your post title and content before hitting save to ensure quality.</p>
                    </div>

                    <div class="post-mini-card">
                        <div class="post-pill">Need help?</div>
                        <h3>New category needed?</h3>
                        <p>Visit the categories page if you need to create one for this post.</p>
                    </div>
                </div>

                <section class="post-form-card">
                    <div class="post-form-card__head">
                        <div>
                            <h2>Update Post</h2>
                            <p>Modify and save your changes.</p>
                        </div>
                        <div class="post-pill">Editing #{{ $updatePost->id }}</div>
                    </div>

                    <div class="post-form-wrap">
                        <form action="{{ route('posts.update', $updatePost->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="post-form-grid">
                                <div class="post-form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" placeholder="Enter Post Title..."
                                        class="post-form-input @error('title') is-invalid @enderror" value="{{ $updatePost->title }}" />
                                    @error('title')
                                        <span class="post-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="post-form-group">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id"
                                        class="post-form-input @error('category_id') is-invalid @enderror">
                                        <option disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $updatePost->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="post-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="post-form-group">
                                    <label for="images">Upload Image</label>
                                    <input type="file" id="images" name="images"
                                        class="post-form-file @error('images') is-invalid @enderror"
                                        onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" />
                                    @if ($updatePost->images)
                                        <img id="output" class="post-image-preview"
                                            src="{{ asset('storage/' . $updatePost->images) }}" alt="Post Image">
                                    @endif
                                    @error('images')
                                        <span class="post-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="post-form-group">
                                    <label for="discription">Content</label>
                                    <textarea id="discription" name="discription" class="post-textarea @error('discription') is-invalid @enderror"
                                        placeholder="What's on your mind?">{{ old('discription', $updatePost->discription) }}</textarea>
                                    @error('discription')
                                        <span class="post-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="post-form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" id="tags" name="tags" placeholder="Enter Tags (comma separated)"
                                        class="post-form-input @error('tags') is-invalid @enderror" value="{{ $updatePost->tags }}" />
                                    @error('tags')
                                        <span class="post-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="post-form-group">
                                    <label>Author</label>
                                    <div class="post-author-display">
                                        {{ Auth::user()->name }} ({{ Auth::user()->role->name ?? 'User' }})
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                                </div>

                                <div style="display: flex; gap: 12px;">
                                    <a class="post-back-btn" href="{{ route('posts.index') }}">Cancel</a>
                                    <button class="post-submit-btn" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
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
    Update-Post
@endsection