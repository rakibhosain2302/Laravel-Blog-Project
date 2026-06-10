@extends('admin.layouts.header')

@prepend('style')
    <style>
        .page-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .page-index-shell::before,
        .page-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .page-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .page-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .page-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .page-hero,
        .page-table-card,
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

        .page-create-btn {
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

        .page-create-btn:hover {
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

        .page-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .page-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .page-table-card__head p {
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

        .page-table-wrap {
            padding: 20px 24px 24px;
        }

        .page-table-wrap .dataTables_wrapper {
            color: #334155;
        }

        .page-table-wrap .dataTables_length,
        .page-table-wrap .dataTables_filter {
            margin-bottom: 16px;
        }

        .page-table-wrap .dataTables_length label,
        .page-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .page-table-wrap .dataTables_length select,
        .page-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .page-table-wrap .dataTables_filter input {
            min-width: 240px;
        }

        .page-table-wrap table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
        }

        .page-table-wrap table.dataTable thead th {
            border-bottom: 0;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 16px 10px;
        }

        .page-table-wrap table.dataTable tbody tr {
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.05);
        }

        .page-table-wrap table.dataTable tbody td {
            background: #fff;
            border-top: 1px solid #eef2f7;
            border-bottom: 1px solid #eef2f7;
            color: #0f172a;
            font-weight: 600;
            padding: 16px;
            vertical-align: middle;
        }

        .page-table-wrap table.dataTable tbody td:first-child {
            border-left: 1px solid #eef2f7;
            border-radius: 16px 0 0 16px;
            width: 88px;
            color: #64748b;
            font-weight: 800;
        }

        .page-table-wrap table.dataTable tbody td:last-child {
            border-right: 1px solid #eef2f7;
            border-radius: 0 16px 16px 0;
        }

        .page-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .page-title__dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.12);
            flex: 0 0 auto;
        }

        .page-action {
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

        .page-action:hover {
            transform: translateY(-1px);
        }

        .page-action--show {
            background: #f0fdf4;
            color: #166534;
        }

        .page-action--edit {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }

        .page-action--edit:hover {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.16);
        }

        .page-action--delete {
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

        .page-delete-form {
            display: inline-block;
            margin: 0;
        }

        .page-empty {
            padding: 24px;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            color: #475569;
            text-align: center;
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

            .page-hero-stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .page-index-shell {
                padding-top: 14px;
            }

            .page-hero,
            .page-table-card__head,
            .page-table-wrap,
            .page-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .page-create-btn {
                width: 100%;
                justify-content: center;
            }

            .page-table-wrap .dataTables_filter input {
                min-width: 0;
                width: 100%;
            }

            .page-table-wrap .dataTables_length,
            .page-table-wrap .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }

            .page-table-wrap .dataTables_filter {
                margin-top: 10px;
            }
        }

        .slider-image {
            display: block;
            max-width: 220px;
            max-height: 84px;
            width: auto;
            height: auto;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.24);
            object-fit: cover;
        }

        .page-action--edit,
        .page-action--delete {
            min-width: 92px;
            text-align: center;
        }

        .page-table-wrap table.dataTable tbody td {
            white-space: normal;
        }

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        font,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td {
            vertical-align: middle;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="page-index-shell">
            <div class="page-index-grid">
                <section class="page-hero">
                    <div class="page-hero__top">
                        <div class="page-kicker">Slider library</div>
                        <a class="page-create-btn" href="{{ route('slider.create') }}">+ Add New Slider</a>
                    </div>
                    <h1>Manage your sliders with a clear, modern interface.</h1>
                    <p>
                        Add, update, or remove slider items and keep your homepage content looking fresh.
                    </p>

                    <div class="page-hero-stats">
                        <div class="page-stat">
                            <span>Total sliders</span>
                            <strong>{{ $sliderData->count() }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Status</span>
                            <strong>Active</strong>
                        </div>
                    </div>
                </section>

                <section class="page-table-card">
                    <div class="page-table-card__head">
                        <div>
                            <h2>Slider List</h2>
                            <p>Review and manage all slider entries in one centralized dashboard.</p>
                        </div>
                        <div class="page-pill">{{ $sliderData->count() }} records</div>
                    </div>

                    <div class="page-table-wrap">
                        @if ($sliderData->isEmpty())
                            <div class="page-empty">
                                No sliders found yet. Add a new slide to make your homepage shine.
                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliderData as $id => $slider)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <div class="page-title">
                                                    <span class="page-title__dot"></span>
                                                    <span>{{ $slider->title }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <img class="slider-image" src="{{ asset('storage/' . $slider->image) }}"
                                                    alt="Slider image">
                                            </td>
                                            <td class="actions-btn">
                                                <a class="page-action page-action--edit"
                                                    href="{{ route('slider.edit', $slider->id) }}">Update</a>
                                                <form class="page-delete-form"
                                                    action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="page-action page-action--delete" type="submit"
                                                        onclick="event.preventDefault(); confirmDelete(this);">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
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
@endsection

@section('title')
    Slider-List
@endsection
