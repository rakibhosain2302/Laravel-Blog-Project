@extends('admin.layouts.header')

@prepend('style')
    <style>
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
            width: 100%;
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

        .copyright-create__actions {
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

        .copyright-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .copyright-toolbar__text h3 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 4px;
        }

        .copyright-toolbar__text p {
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

        .btn-add:hover {
            background: linear-gradient(135deg, #111827, #475569);
        }

        .copyright-table td {
            vertical-align: middle;
            word-break: break-word;
        }

        .copyright-actions {
            white-space: nowrap;
        }

        .copyright-action-group {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .edit-btn {
            border: 0;
            border-radius: 6px;
            padding: 3px 12px;
            background: #2563eb;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
        }

        .edit-btn:hover {
            background: #1d4ed8;
            color: #fff;
        }

        .btn-delete {
            border: 0;
            border-radius: 6px;
            padding: 10px 14px;
            background: #b91c1c;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #991b1b;
        }

        .copyright-empty {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 10px;
            padding: 28px;
            text-align: center;
            color: #475569;
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
            right: 14px;
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

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Copyright List</h2>

            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif

            @php
                $canAdd = $data->isEmpty();
            @endphp

            <div class="block">
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

                @if ($data->isEmpty())
                    <div class="copyright-empty">
                        <h3 style="margin-bottom: 10px;">No copyright text found</h3>
                        <p>Add a copyright note to show it in the public footer.</p>
                    </div>
                @else
                    <table class="data display datatable copyright-table" id="example">
                        <thead>
                            <tr>
                                <th width="10%">SL</th>
                                <th width="62%">Copyright Note</th>
                                <th width="28%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $id => $copyright)
                                <tr class="odd gradeX">
                                    <td>{{ ++$id }}</td>
                                    <td>{{ $copyright->note }}</td>
                                    <td class="copyright-actions">
                                        <div class="copyright-action-group">
                                            <a class="edit-btn" href="{{ route('copyright.edit', $copyright->id) }}">Update</a>
                                            <form action="{{ route('copyright.destroy', $copyright->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this copyright text?');">
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
        </div>
    </div>

    @if ($canAdd)
        <div class="copyright-modal {{ $errors->any() ? 'is-open' : '' }}" id="copyrightModal"
            aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
            <div class="copyright-modal__dialog">
                <button type="button" class="copyright-modal__close" id="closeCopyrightModal" aria-label="Close modal">
                    &times;
                </button>
                @include('admin.pages.copyright.create')
            </div>
        </div>
    @endif

    @include('admin.layouts.footer')
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
    </script>
@endsection
