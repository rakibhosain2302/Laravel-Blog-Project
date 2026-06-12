@extends('admin.layouts.header')

@prepend('style')
    <style>
        .social-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .social-index-shell::before,
        .social-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .social-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .social-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .social-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .social-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .social-toolbar__text h3 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 4px;
        }

        .social-toolbar__text p {
            color: #64748b;
        }

        .btn-add {
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            background: linear-gradient(135deg, #0f172a, #334155);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .social-hero,
        .social-table-card,
        .social-mini-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .social-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .social-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .social-kicker {
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

        .social-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .social-create-btn {
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

        .social-create-btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .social-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .social-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        .social-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .social-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .social-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .social-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .social-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .social-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .social-table-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .social-pill {
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

        .social-table-wrap {
            padding: 20px 24px 24px;
        }

        .social-table-wrap .dataTables_wrapper {
            color: #334155;
            overflow-x: auto;
        }

        .social-table-wrap .dataTables_length,
        .social-table-wrap .dataTables_filter {
            margin-bottom: 20px;
        }

        .social-table-wrap .dataTables_length label,
        .social-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .social-table-wrap .dataTables_length select,
        .social-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .social-table-wrap .dataTables_filter input {
            min-width: 240px;
        }

        .social-table-wrap table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 0 !important;
        }

        .social-table-wrap table.dataTable thead th {
            border-bottom: 2px solid #eef2f7;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 16px;
            text-align: left;
        }

        .social-table-wrap table.dataTable thead th:last-child {
            text-align: center;
        }

        .social-table-wrap table.dataTable tbody tr {
            transition: all 0.2s ease;
        }

        .social-table-wrap table.dataTable tbody tr:hover {
            background: #f8fafc;
        }

        .social-table-wrap table.dataTable tbody td {
            background: #fff;
            color: #0f172a;
            font-weight: 500;
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #eef2f7;
            text-align: left;
        }

        .social-table-wrap table.dataTable tbody td:first-child {
            font-weight: 700;
            color: #64748b;
            width: 70px;
        }

        .social-table-wrap table.dataTable tbody td:last-child {
            text-align: center;
        }

        .social-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 8px 0 5px;
        }

        .social-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 0 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 0;
        }

        .social-action--edit {
            background: #0f172a;
            color: #fff;
        }

        .social-action--edit:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .social-action--delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .social-action--delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .social-empty {
            padding: 24px;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            color: #475569;
            text-align: center;
        }

        .social-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.62);
            z-index: 9999;
        }

        .social-modal.is-open {
            display: flex;
        }

        .social-modal__dialog {
            width: min(860px, calc(100vw - 40px));
            position: relative;
        }

        .social-modal__close {
            position: absolute;
            top: 14px;
            right: 20px;
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

        .social-modal__close:hover {
            background: #cbd5e1;
        }

        .social-modal__actions {
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

        .social-create {
            border: 0;
            border-radius: 14px;
            background: #ffffff;
            padding: 24px;
            width: min(860px, calc(100vw - 40px));
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.25);
        }

        .social-create__head {
            margin-bottom: 18px;
        }

        .social-create__head h3 {
            font-size: 20px;
            color: #111827;
            margin-bottom: 6px;
        }

        .social-create__head p {
            color: #64748b;
            line-height: 1.5;
        }

        .social-create__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .social-create__field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .social-create__field label {
            font-weight: 700;
            color: #1f2937;
        }

        .social-create__field input[type="url"] {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
            color: #111827;
        }

        .social-create__field input[type="url"]:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
        }

        .field-error {
            color: #b91c1c;
            font-size: 13px;
            font-weight: 600;
        }

        .social-create__actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-save {
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            background: #111827;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #1f2937;
        }

        @media (max-width: 991px) {

            .social-hero-stats,
            .social-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .social-index-shell {
                padding-top: 14px;
            }

            .social-hero,
            .social-table-card__head,
            .social-table-wrap,
            .social-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .social-table-wrap .dataTables_filter input {
                min-width: 0;
                width: 100%;
            }

            .social-table-wrap .dataTables_length,
            .social-table-wrap .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }

            .social-table-wrap .dataTables_filter {
                margin-top: 10px;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $totalLinks = $data->count();
        $canAdd = $data->isEmpty();
    @endphp

    <div class="grid_10">
        <div class="social-index-shell">
            <div class="social-index-grid">
                <section class="social-hero">
                    @if ($canAdd)
                        <div class="social-toolbar">
                            <div class="social-toolbar__text">
                                <h3>Manage Social Media Links</h3>
                                <p>Create your public social profiles without leaving the list page.</p>
                            </div>

                            <button type="button" class="btn-add" id="openSocialModal">
                                + Add Social Links
                            </button>
                        </div>
                    @else
                        <div class="social-toolbar">
                            <div class="social-toolbar__text">
                                <h3>Social Links Are Configured</h3>
                                <p>Update or remove your public social URLs from the actions below.</p>
                            </div>
                        </div>
                    @endif

                    <div class="social-hero-stats">
                        <div class="social-stat">
                            <span>Configured links</span>
                            <strong>{{ $totalLinks }}</strong>
                        </div>
                        <div class="social-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="social-stat">
                            <span>Last updated</span>
                            <strong>{{ $totalLinks > 0 ? $data->first()->updated_at->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                    </div>
                </section>

                <section class="social-table-card">
                    <div class="social-table-card__head">
                        <div>
                            <h2>Social Media List</h2>
                            <p>Review and manage your public social profiles.</p>
                        </div>
                        <div class="social-pill">{{ $totalLinks }} record{{ $totalLinks !== 1 ? 's' : '' }}</div>
                    </div>

                    <div class="social-table-wrap">
                        @if ($data->isEmpty())
                            <div class="social-empty">
                                <h3 style="margin-bottom: 10px;">No social media links found</h3>
                                <p>Add Facebook, Twitter, LinkedIn, and Google links to make them visible on the site.</p>
                            </div>
                        @else
                            <table class="data display datatable social-table" id="example">
                                <thead>
                                    <tr>
                                        <th width="6%">SL</th>
                                        <th width="19%">Facebook</th>
                                        <th width="19%">Twitter</th>
                                        <th width="19%">LinkedIn</th>
                                        <th width="19%">Google</th>
                                        <th width="18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $id => $social)
                                        <tr class="odd gradeX">
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $social->fblink }}</td>
                                            <td>{{ $social->twlink }}</td>
                                            <td>{{ $social->lnlink }}</td>
                                            <td>{{ $social->gllink }}</td>
                                            <td class="social-actions">
                                                <button type="button"
                                                    class="social-action social-action--edit js-open-social-edit"
                                                    data-action="{{ route('social.update', $social->id) }}"
                                                    data-id="{{ $social->id }}" data-fblink="{{ e($social->fblink) }}"
                                                    data-twlink="{{ e($social->twlink) }}"
                                                    data-lnlink="{{ e($social->lnlink) }}"
                                                    data-gllink="{{ e($social->gllink) }}">
                                                    Update
                                                </button>

                                                <form action="{{ route('social.destroy', $social->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="social-action social-action--delete" type="submit"
                                                        onclick="event.preventDefault(); confirmDeleteSocial(this);">
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
                <div class="social-modal {{ $errors->any() ? 'is-open' : '' }}" id="socialModal"
                    aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
                    <div class="social-modal__dialog">
                        <button type="button" class="social-modal__close" id="closeSocialModal" aria-label="Close modal">
                            &times;
                        </button>
                        @include('admin.pages.sociallink.create')
                    </div>
                </div>
            @endif

            @include('admin.pages.sociallink.edit')
        </div>
    </div>
@endsection

@section('title')
    Social Links Management
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

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'OK'
                });
            @endif

            var $modal = $('#socialModal');

            function openModal() {
                $modal.addClass('is-open').attr('aria-hidden', 'false');
                $('body').css('overflow', 'hidden');
            }

            function closeModal() {
                $modal.removeClass('is-open').attr('aria-hidden', 'true');
                $('body').css('overflow', '');
            }

            $('#openSocialModal').click(function() {
                openModal();
                return false;
            });

            $('#closeSocialModal').click(function() {
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
                var $editModal = $('#socialEditModal');
                var $editForm = $('#socialEditForm');
                var $editId = $('#socialEditId');
                var $fbInput = $('#social_edit_fb');
                var $twInput = $('#social_edit_tw');
                var $lnInput = $('#social_edit_ln');
                var $ggInput = $('#social_edit_gg');

                function openEditModal(action, id, fblink, twlink, lnlink, gllink) {
                    $editForm.attr('action', action);
                    $editId.val(id);
                    $fbInput.val(fblink);
                    $twInput.val(twlink);
                    $lnInput.val(lnlink);
                    $ggInput.val(gllink);

                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                }

                function closeEditModal() {
                    $editModal.removeClass('is-open').attr('aria-hidden', 'true');
                    $('body').css('overflow', '');
                }

                $('.js-open-social-edit').click(function() {
                    openEditModal(
                        $(this).data('action'),
                        $(this).data('id'),
                        $(this).data('fblink'),
                        $(this).data('twlink'),
                        $(this).data('lnlink'),
                        $(this).data('gllink')
                    );
                });

                $('#closeSocialEditModal, #cancelSocialEditModal').click(function() {
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
                @elseif (request('edit_id') && $data->firstWhere('id', request('edit_id')))
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                @endif
            @endif

            @if ($canAdd && $errors->any())
                openModal();
            @endif
        });

        function confirmDeleteSocial(button) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
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
