@extends('admin.layouts.header')

@prepend('style')
    <style>
        .copyright-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .copyright-index-shell::before,
        .copyright-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .copyright-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .copyright-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .copyright-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .copyright-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .copyright-toolbar__text h3 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 4px;
        }

        .copyright-toolbar__text p {
            color: #cbd5e1;
            line-height: 1.7;
            max-width: 640px;
            margin: 0;
        }

        .btn-add {
            border: 0;
            border-radius: 999px;
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .btn-add:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .copyright-hero,
        .copyright-table-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .copyright-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .copyright-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .copyright-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .copyright-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .copyright-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .copyright-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .copyright-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .copyright-table-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .copyright-pill {
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

        .copyright-table-wrap {
            padding: 20px 24px 24px;
        }

        .copyright-table-wrap .dataTables_wrapper {
            color: #334155;
            overflow-x: auto;
        }

        .copyright-table-wrap .dataTables_length,
        .copyright-table-wrap .dataTables_filter {
            margin-bottom: 20px;
        }

        .copyright-table-wrap .dataTables_length label,
        .copyright-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .copyright-table-wrap .dataTables_length select,
        .copyright-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .copyright-table-wrap .dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 0 !important;
        }

        .copyright-table-wrap .dataTable thead th {
            border-bottom: 2px solid #eef2f7;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 16px;
            text-align: left;
        }

        .copyright-table-wrap .dataTable thead th:last-child {
            text-align: center;
        }

        .copyright-table-wrap .dataTable tbody tr:hover {
            background: #f8fafc;
        }

        .copyright-table-wrap .dataTable tbody td {
            background: #fff;
            color: #0f172a;
            font-weight: 500;
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #eef2f7;
            text-align: left;
        }

        .copyright-table-wrap .dataTable tbody td:first-child {
            font-weight: 700;
            color: #64748b;
            width: 70px;
        }

        .copyright-table-wrap .dataTable tbody td:last-child {
            text-align: center;
        }

        .copyright-action-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 8px 0 5px;
        }

        .copyright-action {
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

        .copyright-action--edit {
            background: #0f172a;
            color: #fff;
        }

        .copyright-action--edit:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .copyright-action--delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .copyright-action--delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .copyright-empty {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 18px;
            padding: 28px;
            text-align: center;
            color: #475569;
        }

        .copyright-create {
            border: 0;
            border-radius: 14px;
            background: #ffffff;
            padding: 24px;
            width: min(860px, calc(100vw - 40px));
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.25);
        }

        .copyright-create__head {
            margin-bottom: 18px;
        }

        .copyright-create__head h3 {
            font-size: 20px;
            color: #111827;
            margin-bottom: 6px;
        }

        .copyright-create__head p {
            color: #64748b;
            line-height: 1.5;
        }

        .copyright-create__field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .copyright-create__field label {
            font-weight: 700;
            color: #1f2937;
        }

        .copyright-create__field input[type="text"] {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
            color: #111827;
        }

        .copyright-create__field input[type="text"]:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
        }

        .field-error {
            color: #b91c1c;
            font-size: 13px;
            font-weight: 600;
        }

        .copyright-create__actions,
        .copyright-modal__actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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

        .copyright-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.62);
            z-index: 9999;
        }

        .copyright-modal.is-open {
            display: flex;
        }

        .copyright-modal__dialog {
            width: min(860px, calc(100vw - 40px));
            position: relative;
        }

        .copyright-modal__close {
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

        .copyright-modal__close:hover {
            background: #cbd5e1;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $canAdd = $data->isEmpty();
        $totalCopyrights = $data->count();
        $activeCopyright = $data->firstWhere('id', old('copyright_id', request('edit_id'))) ?? $data->first();
    @endphp

    <div class="grid_10">
        <div class="copyright-index-shell">
            <div class="copyright-index-grid">
                <section class="copyright-hero">
                    @if ($canAdd)
                        <div class="copyright-toolbar">
                            <div class="copyright-toolbar__text">
                                <h3>Manage Copyright Text</h3>
                                <p>Create the footer copyright note without leaving the list page.</p>
                            </div>
                            <button type="button" class="btn-add" id="openCopyrightModal">
                                + Add Copyright
                            </button>
                        </div>
                    @else
                        <div class="copyright-toolbar">
                            <div class="copyright-toolbar__text">
                                <h3>Copyright Already Set</h3>
                                <p>You can update or delete the existing copyright record from the action column.</p>
                            </div>
                        </div>
                    @endif

                    <div class="copyright-hero-stats">
                        <div class="copyright-stat">
                            <span>Configured copyright</span>
                            <strong>{{ $totalCopyrights }}</strong>
                        </div>
                         <div class="copyright-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="copyright-stat">
                            <span>Last updated</span>
                            <strong>{{ $totalCopyrights > 0 ? $data->first()->updated_at->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                    </div>
                </section>

                <section class="copyright-table-card">
                    <div class="copyright-table-card__head">
                        <div>
                            <h2>Copyright List</h2>
                            <p>Review and manage the footer copyright note for your site.</p>
                        </div>
                        <div class="copyright-pill">{{ $totalCopyrights }} record{{ $totalCopyrights !== 1 ? 's' : '' }}
                        </div>
                    </div>

                    <div class="copyright-table-wrap">
                        @if ($data->isEmpty())
                            <div class="copyright-empty">
                                <h3 style="margin-bottom: 10px;">No copyright text found</h3>
                                <p>Add a copyright note to show it in the public footer.</p>
                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Copyright Note</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $id => $copyright)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $copyright->note }}</td>
                                            <td>
                                                <div class="copyright-action-group">
                                                    <button type="button"
                                                        class="copyright-action copyright-action--edit js-open-copyright-edit"
                                                        data-action="{{ route('copyright.update', $copyright->id) }}"
                                                        data-id="{{ $copyright->id }}"
                                                        data-note="{{ e($copyright->note) }}">
                                                        Update
                                                    </button>
                                                    <form action="{{ route('copyright.destroy', $copyright->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="copyright-action copyright-action--delete"
                                                            type="submit"
                                                            onclick="event.preventDefault(); confirmDeleteCopyright(this);">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
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
                <div class="copyright-modal {{ $errors->any() ? 'is-open' : '' }}" id="copyrightModal"
                    aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
                    <div class="copyright-modal__dialog">
                        <button type="button" class="copyright-modal__close" id="closeCopyrightModal"
                            aria-label="Close modal">
                            &times;
                        </button>
                        @include('admin.pages.copyright.create')
                    </div>
                </div>
            @endif

            @include('admin.pages.copyright.edit')
        </div>
    </div>
@endsection

@section('title')
    Copyright-{{ date('Y') }}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
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

            @if ($data->isNotEmpty())
                var $editModal = $('#copyrightEditModal');
                var $editForm = $('#copyrightEditForm');
                var $editInput = $('#copyright_edit_note');
                var $editId = $('#copyrightEditId');

                function openEditModal(action, id, note) {
                    $editForm.attr('action', action);
                    $editId.val(id);
                    $editInput.val(note);
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                }

                function closeEditModal() {
                    $editModal.removeClass('is-open').attr('aria-hidden', 'true');
                    $('body').css('overflow', '');
                }

                $('.js-open-copyright-edit').click(function() {
                    openEditModal(
                        $(this).data('action'),
                        $(this).data('id'),
                        $(this).data('note')
                    );
                });

                $('#closeCopyrightEditModal, #cancelCopyrightEditModal').click(function() {
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
                @elseif (request('edit_id') && $activeCopyright)
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                @endif
            @endif

            @if ($canAdd)
                var $modal = $('#copyrightModal');

                function openModal() {
                    $modal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                }

                function closeModal() {
                    $modal.removeClass('is-open').attr('aria-hidden', 'true');
                    $('body').css('overflow', '');
                }

                $('#openCopyrightModal').click(function() {
                    openModal();
                    return false;
                });

                $('#closeCopyrightModal').click(function() {
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

                @if ($errors->any())
                    openModal();
                @endif
            @endif
        });

        function confirmDeleteCopyright(button) {
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
