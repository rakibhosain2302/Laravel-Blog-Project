@extends('admin.layouts.header')

@prepend('style')
    <style>
        .post-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .post-index-shell::before,
        .post-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .post-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .post-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .post-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .post-hero,
        .post-table-card,
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

        .post-create-btn {
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

        .post-create-btn:hover {
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

        .post-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .post-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .post-table-card__head p {
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

        .post-table-wrap {
            padding: 20px 24px 24px;
        }

        .post-table-wrap .dataTables_wrapper {
            color: #334155;
        }

        .post-table-wrap .dataTables_length,
        .post-table-wrap .dataTables_filter {
            margin-bottom: 16px;
        }

        .post-table-wrap .dataTables_length label,
        .post-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .post-table-wrap .dataTables_length select,
        .post-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .post-table-wrap .dataTables_filter input {
            min-width: 240px;
        }

        .post-table-wrap table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
        }

        .post-table-wrap table.dataTable thead th {
            border-bottom: 0;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 16px 10px;
        }

        .post-table-wrap table.dataTable tbody tr {
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.05);
        }

        .post-table-wrap table.dataTable tbody td {
            background: #fff;
            border-top: 1px solid #eef2f7;
            border-bottom: 1px solid #eef2f7;
            color: #0f172a;
            font-weight: 600;
            padding: 16px;
            vertical-align: middle;
        }

        .post-table-wrap table.dataTable tbody td:first-child {
            border-left: 1px solid #eef2f7;
            border-radius: 16px 0 0 16px;
            width: 88px;
            color: #64748b;
            font-weight: 800;
        }

        .post-table-wrap table.dataTable tbody td:last-child {
            border-right: 1px solid #eef2f7;
            border-radius: 0 16px 16px 0;
        }

        .post-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .post-title__dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.12);
            flex: 0 0 auto;
        }

        .post-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .post-action:hover {
            transform: translateY(-1px);
        }

        .post-action--show {
            background: #f0fdf4;
            color: #166534;
        }

        .post-action--edit {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }

        .post-action--edit:hover {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.16);
        }

        .post-action--delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .actions-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 8px
        }

        .post-delete-form {
            display: inline-block;
            margin: 0;
        }

        .post-empty {
            padding: 24px;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            color: #475569;
            text-align: center;
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

        .post-image-thumb {
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            object-fit: cover;
            margin-top: 10px;
            margin-bottom: -15px;
        }

        @media (max-width: 991px) {

            .post-hero-stats,
            .post-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .post-index-shell {
                padding-top: 14px;
            }

            .post-hero,
            .post-table-card__head,
            .post-table-wrap,
            .post-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .post-create-btn {
                width: 100%;
                justify-content: center;
            }

            .post-table-wrap .dataTables_filter input {
                min-width: 0;
                width: 100%;
            }

            .post-table-wrap .dataTables_length,
            .post-table-wrap .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }

            .post-table-wrap .dataTables_filter {
                margin-top: 10px;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $totalPosts = $posts->count();
        $totalAuthors = $posts->pluck('user_id')->unique()->count();
    @endphp

    <div class="grid_10">
        <div class="post-index-shell">
            <div class="post-index-grid">
                <section class="post-hero">
                    <div class="post-hero__top">
                        <div class="post-kicker">Post library</div>
                        <a class="post-create-btn" href="{{ route('posts.create') }}">+ Add New Post</a>
                    </div>
                    <h1>Manage all your posts from one place.</h1>
                    <p>
                        Browse, update, or remove posts. Keep your content fresh and organized with an intuitive interface.
                    </p>

                    <div class="post-hero-stats">
                        <div class="post-stat">
                            <span>Total posts</span>
                            <strong>{{ $totalPosts }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Total authors</span>
                            <strong>{{ $totalAuthors }}</strong>
                        </div>
                        <div class="post-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                    </div>
                </section>

                <div class="post-quick-links">
                    <div class="post-mini-card">
                        <div class="post-pill">Writing tip</div>
                        <h3>Engage your readers</h3>
                        <p>Start with a strong headline and keep paragraphs focused on one main idea each.</p>
                    </div>

                    <div class="post-mini-card">
                        <div class="post-pill">Quick action</div>
                        <h3>Create new content?</h3>
                        <p>Use the add button above to create a post without leaving this page's context.</p>
                    </div>
                </div>

                <section class="post-table-card">
                    <div class="post-table-card__head">
                        <div>
                            <h2>Post List</h2>
                            <p>Review and manage all published posts.</p>
                        </div>
                        <div class="post-pill">{{ $totalPosts }} records</div>
                    </div>

                    <div class="post-table-wrap">
                        @if ($posts->isEmpty())
                            <div class="post-empty">
                                No posts found yet. Add your first post to start building content.
                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Post Title</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th style="text-align: center">Post By</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $id => $postData)
                                        @can('view', $postData)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>
                                                    <div class="post-title">
                                                        <span class="post-title__dot"></span>
                                                        <span>{{ Str::limit($postData->title, 40, '...') }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $postData->category->name ?? 'N/A' }}</td>
                                                <td>
                                                    <img class="post-image-thumb" width="60" height="40"
                                                        src="{{ asset('storage/' . $postData->images) }}" alt="Post Image">
                                                </td>
                                                <td>{{ Str::limit($postData->discription, 60, '...') }}</td>
                                                <td style="text-align: center;">
                                                    {{ $postData->user->name ?? 'Unknown' }}
                                                </td>
                                                <td class="actions-btn">
                                                    <a class="post-action post-action--show"
                                                        href="{{ route('posts.show', $postData->id) }}">Show</a>
                                                    <a class="post-action post-action--edit"
                                                        href="{{ route('posts.edit', $postData->id) }}">Update</a>
                                                    <form class="post-delete-form"
                                                        action="{{ route('posts.destroy', $postData->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="post-action post-action--delete" type="submit"
                                                            onclick="event.preventDefault(); confirmDelete(this);">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endcan
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            if ($('#example').length) {
                $('#example').dataTable({
                    sDom: 'lfrtip',
                    iDisplayLength: 10
                });
            }
            setSidebarHeight();

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}'
                });
            @endif
        });

        function confirmDelete(button) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Post-List
@endsection
