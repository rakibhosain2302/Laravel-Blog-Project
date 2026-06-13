@extends('admin.layouts.header')

@prepend('style')
    <style>
        .category-create-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .category-create-shell::before,
        .category-create-shell::after {
            content: "";
            position: fixed;
            border-radius: 999px;
            pointer-events: none;
            filter: blur(24px);
            opacity: 0.9;
        }

        .category-create-shell::before {
            top: 88px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .category-create-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .category-create-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 22px;
            align-items: start;
        }

        .category-hero-panel,
        .category-form-panel,
        .category-note,
        .category-tip-panel {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .category-hero-panel {
            width: 100%;
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .category-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .category-kicker {
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

        .category-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .category-backlink {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .category-backlink:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .category-hero-panel h1 {
            margin: 18px 0 12px;
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.04;
            letter-spacing: -0.05em;
        }

        .category-hero-panel p {
            margin: 0;
            max-width: 58ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        

        .category-hero-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .category-metric {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .category-metric span {
            display: block;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .category-metric strong {
            display: block;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .category-form-head {
            padding: 26px 26px 0;
        }

        .category-form-head h2 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .category-form-head p {
            margin: 0;
            color: #64748b;
            line-height: 1.65;
        }

        .category-form {
            padding: 22px 26px 26px;
        }

        .category-field {
            display: grid;
            gap: 10px;
        }

        .category-field label {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.02em;
        }

        .category-input-wrap {
            position: relative;
        }

        .category-field input {
            width: 97%;
            min-height: 15px;
            padding: 16px;
            border-radius: 18px;
            border: 1px solid #dbe4f0;
            background: linear-gradient(180deg, #ffffff, #fbfdff);
            color: #0f172a;
            font-size: 15px;
            font-weight: 600;
            transition: border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
        }

        .category-field input::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .category-field input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            transform: translateY(-1px);
        }

        .category-helper {
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .category-error {
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        .category-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .category-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border: 0;
            border-radius: 15px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .category-btn:hover {
            transform: translateY(-1px);
        }

        .category-btn--back {
            background: #e2e8f0;
            color: #0f172a;
        }

        .category-btn--save {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #fff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.18);
        }

        .category-note,
        .category-tip-panel {
            padding: 22px;
        }

        .category-note h3,
        .category-tip-panel h3 {
            margin: 0 0 10px;
            color: #0f172a;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .category-note p,
        .category-note li,
        .category-tip-panel p,
        .category-tip-panel li {
            color: #475569;
            line-height: 1.7;
            font-size: 14px;
        }

        .category-note ul,
        .category-tip-panel ul {
            margin: 0;
            padding-left: 18px;
            display: grid;
            gap: 8px;
        }

        .category-chip {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        @media (max-width: 991px) {
            .category-create-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .category-create-shell {
                padding-top: 14px;
            }

            .category-hero-panel,
            .category-form,
            .category-form-head,
            .category-note,
            .category-tip-panel {
                padding-left: 18px;
                padding-right: 18px;
            }

            .category-hero-metrics {
                grid-template-columns: 1fr;
            }

            .category-field input {
                padding-left: 16px;
            }

            .category-input-wrap::before {
                display: none;
            }

            .category-actions {
                justify-content: stretch;
            }

            .category-btn {
                width: 100%;
            }

            .category-backlink {
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
        <div class="category-create-shell">
            <div class="category-create-grid">
                <section class="category-hero-panel">
                    <div class="category-hero-top">
                        <div class="category-kicker">Category setup</div>
                        <a class="category-backlink" href="{{ route('categories.index') }}">Back to list</a>
                    </div>
                    <h1>Create a category that feels clean, modern, and easy to manage.</h1>
                    <p>
                        A good category name keeps your blog organized, your admin panel easy to scan, and your workflow
                        fast as content grows.
                    </p>

                    <div class="category-hero-metrics">
                        <div class="category-metric">
                            <span>Total categories</span>
                            <strong>{{ $totalCategories }}</strong>
                        </div>
                        <div class="category-metric">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="category-metric">
                            <span>Author</span>
                            <strong>{{ Auth::user()->name }}</strong>
                        </div>
                    </div>
                </section>


                <section class="category-form-panel" style="grid-column: 1 / -1;">
                    <div class="category-form-head">
                        <h2>Create New Category</h2>
                        <p>Enter a simple category name and save it into your content structure.</p>
                    </div>

                    <div class="category-form">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            <div class="category-field">
                                <label for="name">Category Name</label>
                                <div class="category-input-wrap">
                                    <input id="name" type="text" name="name" placeholder="Enter category name..."
                                        value="{{ old('name') }}" autocomplete="off">
                                </div>
                                <div class="category-helper">Example: News, Tutorials, Reviews, Tips, Features.</div>
                                @error('name')
                                    <span class="category-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="category-actions">
                                <a class="category-btn category-btn--back" href="{{ route('categories.index') }}">Back to
                                    List</a>
                                <button class="category-btn category-btn--save" type="submit">Save Category</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Add-Category
@endsection
