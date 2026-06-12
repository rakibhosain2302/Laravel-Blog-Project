@extends('admin.layouts.header')

@prepend('style')
    <style>
        .page-show-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .page-show-shell::before,
        .page-show-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .page-show-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .page-show-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .page-show-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .page-hero,
        .page-details-card,
        .page-mini-card {
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

        .page-details-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .page-details-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .page-details-card__head p {
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

        .page-details-wrap {
            padding: 20px 24px 24px;
        }

        .page-details-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .page-details-table th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: 700;
            padding: 16px;
            width: 140px;
            text-align: left;
            border: 1px solid #eef2f7;
            border-right: 0;
        }

        .page-details-table td {
            background: #fff;
            color: #334155;
            padding: 16px;
            border: 1px solid #eef2f7;
            border-left: 0;
        }

        .page-details-table tr:first-child th,
        .page-details-table tr:first-child td {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .page-details-table tr:last-child th,
        .page-details-table tr:last-child td {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .page-content-text {
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .page-back-wrapper {
            margin-top: 24px;
            text-align: right;
        }


        .page-mini-card {
            padding: 20px;
        }

        .page-mini-card h3 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 18px;
            letter-spacing: -0.03em;
        }

        .page-mini-card p {
            margin: 0;
            color: #64748b;
            line-height: 1.65;
            font-size: 14px;
        }

        @media (max-width: 991px) {
            .page-hero-stats,{
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .page-show-shell {
                padding-top: 14px;
            }

            .page-hero,
            .page-details-card__head,
            .page-details-wrap,
            .page-mini-card {
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
        <div class="page-show-shell">
            <div class="page-show-grid">
                <section class="page-hero">
                    <div class="page-hero__top">
                        <div class="page-kicker">Page details</div>
                        <a class="page-back-btn" href="{{ route('page.index') }}">← Back to Pages</a>
                    </div>
                    <h1>{{ $showData->name }}</h1>
                    <p>
                        View the complete details of this page including name, content, and other information.
                    </p>

                    <div class="page-hero-stats">
                        <div class="page-stat">
                            <span>Page ID</span>
                            <strong>#{{ $showData->id }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Last updated</span>
                            <strong>{{ $showData->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </section>


                <section class="page-details-card">
                    <div class="page-details-card__head">
                        <div>
                            <h2>Page Information</h2>
                            <p>Detailed view of page properties.</p>
                        </div>
                        <div class="page-pill">Details view</div>
                    </div>

                    <div class="page-details-wrap">
                        <table class="page-details-table">
                            <tr>
                                <th>Page Name</th>
                                <td style="font-weight: 700; color: #0f172a;">{{ $showData->name }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: top; padding-top: 16px;">Content</th>
                                <td class="page-content-text">{{ $showData->body }}</td>
                            </tr>
                        </table>

                        <div class="page-back-wrapper">
                            <a class="page-back-btn" href="{{ route('page.index') }}">Back to List</a>
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

@endsection

@section('title')
    Page-Details
@endsection