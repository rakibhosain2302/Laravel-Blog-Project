@extends('admin.layouts.header')

@prepend('style')
    <style>
        .blogtitle-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .blogtitle-index-shell::before,
        .blogtitle-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .blogtitle-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .blogtitle-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .blogtitle-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .blogtitle-hero,
        .blogtitle-table-card,
        .blogtitle-mini-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .blogtitle-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .blogtitle-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .blogtitle-kicker {
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

        .blogtitle-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .blogtitle-create-btn {
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
            cursor: pointer;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .blogtitle-create-btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .blogtitle-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .blogtitle-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        .blogtitle-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .blogtitle-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .blogtitle-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .blogtitle-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .blogtitle-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .blogtitle-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .blogtitle-table-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .blogtitle-pill {
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

        .blogtitle-table-wrap {
            padding: 20px 24px 24px;
        }

        .blogtitle-table-wrap .dataTables_wrapper {
            color: #334155;
        }

        .blogtitle-table-wrap .dataTables_length,
        .blogtitle-table-wrap .dataTables_filter {
            margin-bottom: 16px;
        }

        .blogtitle-table-wrap .dataTables_length label,
        .blogtitle-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .blogtitle-table-wrap .dataTables_length select,
        .blogtitle-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .blogtitle-table-wrap .dataTables_filter input {
            min-width: 240px;
        }

        .blogtitle-table-wrap table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
        }

        .blogtitle-table-wrap table.dataTable thead th {
            border-bottom: 0;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 16px 10px;
        }

        .blogtitle-table-wrap table.dataTable tbody tr {
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.05);
        }

        .blogtitle-table-wrap table.dataTable tbody td {
            background: #fff;
            border-top: 1px solid #eef2f7;
            border-bottom: 1px solid #eef2f7;
            color: #0f172a;
            font-weight: 600;
            padding: 16px;
            vertical-align: middle;
        }

        .blogtitle-table-wrap table.dataTable tbody td:first-child {
            border-left: 1px solid #eef2f7;
            border-radius: 16px 0 0 16px;
            width: 88px;
            color: #64748b;
            font-weight: 800;
        }

        .blogtitle-table-wrap table.dataTable tbody td:last-child {
            border-right: 1px solid #eef2f7;
            border-radius: 0 16px 16px 0;
        }

        .blogtitle-logo-cell {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blogtitle-logo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .blogtitle-slogan {
            max-width: 100%;
            line-height: 1.6;
            color: #64748b;
            font-size: 14px;
        }

        .blogtitle-action {
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
            cursor: pointer;
            border: 0;
        }

        .blogtitle-action:hover {
            transform: translateY(-1px);
        }

        .blogtitle-action--edit {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }

        .blogtitle-action--edit:hover {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.16);
        }

        .blogtitle-action--delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .blogtitle-actions-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 8px
        }

        .blogtitle-delete-form {
            display: inline-block;
            margin: 0;
        }

        .blogtitle-empty {
            padding: 24px;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            color: #475569;
            text-align: center;
        }

        .blogtitle-quick-links {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .blogtitle-mini-card {
            padding: 20px;
        }

        .blogtitle-mini-card h3 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 18px;
            letter-spacing: -0.03em;
        }

        .blogtitle-mini-card p {
            margin: 0;
            color: #64748b;
            line-height: 1.65;
            font-size: 14px;
        }

        .blogtitle-create {}

        .blogtitle-create__head {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .blogtitle-create__head h3 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 24px;
            letter-spacing: -0.03em;
        }

        .blogtitle-create__head p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
            font-size: 14px;
        }

        .blogtitle-create__grid {
            display: grid;
            gap: 16px;
            margin-bottom: 24px;
        }

        .blogtitle-create__field {
            display: grid;
            gap: 8px;
        }

        .blogtitle-create__field--full {
            grid-column: 1 / -1;
        }

        .blogtitle-create__field label {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.02em;
        }

        .blogtitle-create__field input {
            min-height: 15px;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid #dbe4f0;
            background: linear-gradient(180deg, #ffffff, #fbfdff);
            color: #0f172a;
            font-size: 15px;
            font-weight: 600;
            transition: border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
        }

        .blogtitle-create__field input::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .blogtitle-create__field input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            transform: translateY(-1px);
        }

        .field-error {
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
            margin-top: 4px;
        }

        .blogtitle-preview {
            margin-top: 12px;
            display: flex;
            align-items: center;
        }

        .blogtitle-preview__img {
            max-width: 120px;
            max-height: 80px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            padding: 4px;
        }

        .blogtitle-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .blogtitle-modal.is-open {
            display: flex;
        }

        .blogtitle-modal__content {
            background: #fff;
            border-radius: 20px;
            padding: 32px;
            max-width: 700px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.2);
            animation: slideIn 0.3s ease;
            position: relative;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blogtitle-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.62);
            z-index: 9999;
        }

        .blogtitle-modal.is-open {
            display: flex;
        }

        .blogtitle-modal__dialog {
            width: min(760px, calc(100vw - 40px));
            position: relative;
        }

        .blogtitle-modal__close {
            position: absolute;
            top: 14px;
            right: 24px;
            width: 38px;
            height: 38px;
            border-radius: 999px;
            border: 0;
            background: #e2e8f0;
            color: #0f172a;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            z-index: 2;
        }

        .blogtitle-modal__close:hover {
            background: #cbd5e1;
        }

        .blogtitle-modal__actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-cancel {
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            background: #e2e8f0;
            color: #0f172a;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
        }

        .blogtitle-preview {
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .blogtitle-preview__img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            background: #fff;
            padding: 4px;
        }

        .blogtitle-modal__footer{
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .blogtitle-modal__btn--cancel{
            border: 0;
            border-radius: 12px;
            padding: 12px 20px;
            background: #e2e8f0;
            color: #0f172a;
            font-weight: 700;
            cursor: pointer;
        }

        .blogtitle-modal__btn--save{
            border: 0;
            border-radius: 12px;
            padding: 12px 20px;
            background: #0f172a;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .blogtitle-create__actions{
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-save{
            border: 0;
            border-radius: 12px;
            padding: 12px 20px;
            background: #0f172a;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 991px) {

            .blogtitle-hero-stats,
            .blogtitle-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .blogtitle-index-shell {
                padding-top: 14px;
            }

            .blogtitle-hero,
            .blogtitle-table-card__head,
            .blogtitle-table-wrap,
            .blogtitle-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .blogtitle-create-btn {
                width: 100%;
                justify-content: center;
            }

            .blogtitle-table-wrap .dataTables_filter input {
                min-width: 0;
                width: 100%;
            }

            .blogtitle-table-wrap .dataTables_length,
            .blogtitle-table-wrap .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }

            .blogtitle-table-wrap .dataTables_filter {
                margin-top: 10px;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $totalTitles = $data->count();
        $canAdd = $data->isEmpty();
    @endphp

    <div class="grid_10">
        <div class="blogtitle-index-shell">
            <div class="blogtitle-index-grid">
                <section class="blogtitle-hero">
                    <div class="blogtitle-hero__top">
                        <div class="blogtitle-kicker">Blog branding</div>
                        <button type="button" class="blogtitle-create-btn" id="openBlogTitleModal">
                            @if ($canAdd)
                                + Add Blog Title
                            @else
                                + Add New Title
                            @endif
                        </button>
                    </div>
                    <h1>Configure and manage your blog's branding.</h1>
                    <p>
                        Set your blog title, slogan, and logo to create a professional first impression. Keep your branding
                        consistent and manage everything from one polished admin surface.
                    </p>

                    <div class="blogtitle-hero-stats">
                        <div class="blogtitle-stat">
                            <span>Configured titles</span>
                            <strong>{{ $totalTitles }}</strong>
                        </div>
                        <div class="blogtitle-stat">
                            <span>Status</span>
                            <strong>{{ $canAdd ? 'Pending' : 'Active' }}</strong>
                        </div>
                        <div class="blogtitle-stat">
                            <span>Last updated</span>
                            <strong>{{ $totalTitles > 0 ? $data->first()->updated_at->format('M d') : 'N/A' }}</strong>
                        </div>
                    </div>
                </section>

                <div class="blogtitle-quick-links">
                    <div class="blogtitle-mini-card">
                        <div class="blogtitle-pill">Tip</div>
                        <h3>Make it memorable</h3>
                        <p>Use a clear, concise title that reflects your blog's purpose. Your visitors will see this first.
                        </p>
                    </div>

                    <div class="blogtitle-mini-card">
                        <div class="blogtitle-pill">Quick action</div>
                        <h3>Add a professional logo</h3>
                        <p>Upload a high-quality logo image to complement your blog's visual identity.</p>
                    </div>
                </div>

                <section class="blogtitle-table-card">
                    <div class="blogtitle-table-card__head">
                        <div>
                            <h2>Blog Title List</h2>
                            <p>Review and manage your blog branding details.</p>
                        </div>
                        <div class="blogtitle-pill">{{ $totalTitles }} record{{ $totalTitles !== 1 ? 's' : '' }}</div>
                    </div>

                    <div class="blogtitle-table-wrap">
                        @if (session('success'))
                            <div class="blogtitle-pill" style="margin-bottom: 16px; background:#ecfdf5; color:#047857;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="blogtitle-pill" style="margin-bottom: 16px; background:#fee2e2; color:#b91c1c;">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($data->isEmpty())
                            <div class="blogtitle-empty">
                                No blog title configured yet. Add your first title to personalize your blog.
                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Logo</th>
                                        <th>Title</th>
                                        <th>Slogan</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $id => $titleSlogan)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td class="blogtitle-logo-cell">
                                                @if ($titleSlogan->logo)
                                                    <img class="blogtitle-logo"
                                                        src="{{ asset('storage/' . $titleSlogan->logo) }}" alt="Site logo">
                                                @else
                                                    <span style="color: #94a3b8; font-size: 13px;">No Logo</span>
                                                @endif
                                            </td>
                                            <td style="font-weight: 700; color: #0f172a;">
                                                {{ $titleSlogan->title }}
                                            </td>
                                            <td class="blogtitle-slogan">
                                                {{ $titleSlogan->slogan }}
                                            </td>
                                            <td class="blogtitle-actions-btn">
                                                <button type="button"
                                                    class="blogtitle-action blogtitle-action--edit js-open-blogtitle-edit"
                                                    data-action="{{ route('title.slogan.update', $titleSlogan->id) }}"
                                                    data-id="{{ $titleSlogan->id }}"
                                                    data-title="{{ e($titleSlogan->title) }}"
                                                    data-slogan="{{ e($titleSlogan->slogan) }}"
                                                    data-logo="{{ $titleSlogan->logo }}">
                                                    Update
                                                </button>

                                                <form class="blogtitle-delete-form"
                                                    action="{{ route('blog.title.destroy', $titleSlogan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="blogtitle-action blogtitle-action--delete" type="submit"
                                                        onclick="event.preventDefault(); confirmDeleteBlogTitle(this);">
                                                        Delete
                                                    </button>
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

            @if ($canAdd)
                <div class="blogtitle-modal {{ $errors->any() ? 'is-open' : '' }}" id="blogTitleModal"
                    aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
                    <div class="blogtitle-modal__content">
                        <button type="button" class="blogtitle-modal__close" id="closeBlogTitleModal"
                            aria-label="Close modal">
                            &times;
                        </button>
                        @include('admin.pages.blogtitle.create')
                    </div>
                </div>
            @else
                <div class="blogtitle-modal {{ $errors->any() ? 'is-open' : '' }}" id="blogTitleModal"
                    aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
                    <div class="blogtitle-modal__content">
                        <button type="button" class="blogtitle-modal__close" id="closeBlogTitleModal"
                            aria-label="Close modal">
                            &times;
                        </button>
                        @include('admin.pages.blogtitle.create')
                    </div>
                </div>
            @endif

            @include('admin.pages.blogtitle.edit')
        </div>
    </div>

@endsection

@section('title')
    Blog Title Management
@endsection

@section('scripts')
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

            var $modal = $('#blogTitleModal');

            function openModal() {
                $modal.addClass('is-open').attr('aria-hidden', 'false');
                $('body').css('overflow', 'hidden');
            }

            function closeModal() {
                $modal.removeClass('is-open').attr('aria-hidden', 'true');
                $('body').css('overflow', '');
            }

            $('#openBlogTitleModal').click(function() {
                openModal();
                return false;
            });

            $('#closeBlogTitleModal').click(function() {
                closeModal();
                return false;
            });

            $modal.bind('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            $(document).bind('keydown', function(e) {
                if (e.keyCode === 27) {
                    closeModal();
                }
            });

            @if ($data->isNotEmpty())
                var $editModal = $('#blogTitleEditModal');
                var $editForm = $('#blogTitleEditForm');
                var $editId = $('#blogTitleEditId');
                var $titleInput = $('#blogtitle_edit_title');
                var $sloganInput = $('#blogtitle_edit_slogan');
                var $logoPreview = $('#blogtitle_edit_preview');

                function openEditModal(action, id, title, slogan, logo) {
                    $editForm.attr('action', action);
                    $editId.val(id);
                    $titleInput.val(title);
                    $sloganInput.val(slogan);
                    if (logo) {
                        $logoPreview.attr('src', "{{ asset('storage') }}/" + logo).show();
                    } else {
                        $logoPreview.hide();
                    }
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                }

                function closeEditModal() {
                    $editModal.removeClass('is-open').attr('aria-hidden', 'true');
                    $('body').css('overflow', '');
                }

                $('.js-open-blogtitle-edit').click(function() {
                    openEditModal(
                        $(this).data('action'),
                        $(this).data('id'),
                        $(this).data('title'),
                        $(this).data('slogan'),
                        $(this).data('logo')
                    );
                });

                $('#closeBlogTitleEditModal, #cancelBlogTitleEditModal').click(function() {
                    closeEditModal();
                    return false;
                });

                $editModal.bind('click', function(e) {
                    if (e.target === this) {
                        closeEditModal();
                    }
                });

                $(document).bind('keydown', function(e) {
                    if (e.keyCode === 27) {
                        closeEditModal();
                    }
                });

                @if ($errors->any())
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                @endif
            @endif

            @if ($errors->any())
                openModal();
            @endif
        });

        function confirmDeleteBlogTitle(button) {
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
