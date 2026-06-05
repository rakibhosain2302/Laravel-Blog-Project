@extends('admin.layouts.header')

@prepend('style')
    <style>
        .page-edit-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .page-edit-shell::before,
        .page-edit-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .page-edit-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .page-edit-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .page-edit-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .page-hero,
        .page-form-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .page-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .page-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .page-kicker {
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

        .page-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .page-back-btn {
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

        .page-back-btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .page-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .page-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        .page-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .page-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .page-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .page-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .page-form-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .page-form-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .page-form-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .page-pill {
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

        .page-form-wrap {
            padding: 20px 24px 24px;
        }

        .page-form-grid {
            display: grid;
            gap: 24px;
        }

        .page-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .page-form-group label {
            color: #0f172a;
            font-weight: 700;
            font-size: 14px;
        }

        .page-form-input {
            padding: 12px 16px;
            border: 1px solid #dbe4f0;
            border-radius: 8px;
            font-size: 15px;
            background: #fff;
            color: #0f172a;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .page-form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .page-form-input.is-invalid {
            border-color: #ef4444;
        }

        .page-textarea {
            min-height: 120px;
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

        .page-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .page-textarea.is-invalid {
            border-color: #ef4444;
        }

        .page-error {
            color: #dc2626;
            font-size: 13px;
            font-weight: 500;
        }

        .page-submit-btn {
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

        .page-submit-btn:hover {
            transform: translateY(-1px);
            background: #1e293b;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.16);
        }

        .page-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s;
        }

        .page-back-link:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        @media (max-width: 991px) {
            .page-hero-stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .page-edit-shell {
                padding-top: 14px;
            }

            .page-hero,
            .page-form-card__head,
            .page-form-wrap {
                padding-left: 18px;
                padding-right: 18px;
            }

            .page-back-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="page-edit-shell">
            <div class="page-edit-grid">
                <section class="page-hero">
                    <div class="page-hero__top">
                        <div class="page-kicker">Edit page</div>
                        <a class="page-back-btn" href="{{ route('page.index') }}">← Back to Pages</a>
                    </div>
                    <h1>Update page information.</h1>
                    <p>
                        Modify the page details below and save your changes. Keep your static content organized.
                    </p>

                    <div class="page-hero-stats">
                        <div class="page-stat">
                            <span>Total pages</span>
                            <strong>{{ \App\Models\Page::count() ?? 0 }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Page ID</span>
                            <strong>#{{ $editPage->id }}</strong>
                        </div>
                    </div>
                </section>

                <section class="page-form-card">
                    <div class="page-form-card__head">
                        <div>
                            <h2>Edit Page</h2>
                            <p>Update your page details.</p>
                        </div>
                        <div class="page-pill">Editing</div>
                    </div>

                    <div class="page-form-wrap">
                        <form action="{{ route('page.update', $editPage->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="page-form-grid">
                                <div class="page-form-group">
                                    <label for="name">Page Name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter Page Name..."
                                        class="page-form-input @error('name') is-invalid @enderror" value="{{ old('name', $editPage->name) }}" />
                                    @error('name')
                                        <span class="page-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="page-form-group">
                                    <label for="body">Page Content</label>
                                    <textarea id="body" name="body" class="page-textarea @error('body') is-invalid @enderror"
                                        placeholder="Enter Page Content...">{{ old('body', $editPage->body) }}</textarea>
                                    @error('body')
                                        <span class="page-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                                    <a class="page-back-link" href="{{ route('page.index') }}">Cancel</a>
                                    <button class="page-submit-btn" type="submit">Save Changes</button>
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

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}'
                });
            });
        </script>
    @endif

    @include('admin.layouts.footer')
@endsection

@section('title')
    Update-Page
@endsection