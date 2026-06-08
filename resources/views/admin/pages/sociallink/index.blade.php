@extends('admin.layouts.header')

@prepend('style')
    <style>
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

        .social-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .social-toolbar__text h3 {
            font-size: 18px;
            color: #111827;
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

        .btn-add:hover {
            background: linear-gradient(135deg, #111827, #475569);
        }


        .social-table td {
            vertical-align: middle;
            word-break: break-word;
        }

        .social-actions {
            white-space: nowrap;
        }

        .social-action-group {
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

        .btn-edit-open {
            border: 0;
            border-radius: 6px;
            padding: 10px 14px;
            background: #2563eb;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-edit-open:hover {
            background: #1d4ed8;
        }

        .social-empty {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 10px;
            padding: 28px;
            text-align: center;
            color: #475569;
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
            right: -24px;
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
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Social Media List</h2>

            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif

            @php
                $canAdd = $data->isEmpty();
                $selectedSocialId = old('social_id', request('edit_id'));
                $activeSocial = $data->firstWhere('id', $selectedSocialId) ?? $data->first();
            @endphp

            <div class="block">
                @if ($canAdd)
                    <div class="social-toolbar">
                        <div class="social-toolbar__text">
                            <h3>Manage Social Media Links</h3>
                            <p>Create the public social links without leaving the list page.</p>
                        </div>

                        <button type="button" class="btn-add" id="openSocialModal">
                            + Add Social Links
                        </button>
                    </div>
                @else
                    <div class="social-toolbar">
                        <div class="social-toolbar__text">
                            <h3>Social Links Already Set</h3>
                            <p>You can update or delete the existing social record from the action column.</p>
                        </div>
                    </div>
                @endif

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
                                        <div class="social-action-group">
                                            <button
                                                type="button"
                                                class="btn-edit-open js-open-social-edit"
                                                data-action="{{ route('social.update', $social->id) }}"
                                                data-id="{{ $social->id }}"
                                                data-fblink="{{ e($social->fblink) }}"
                                                data-twlink="{{ e($social->twlink) }}"
                                                data-lnlink="{{ e($social->lnlink) }}"
                                                data-gllink="{{ e($social->gllink) }}"
                                            >
                                                Update
                                            </button>
                                            <form action="{{ route('social.destroy', $social->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this social record?');">
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
        <div class="social-modal {{ $errors->any() ? 'is-open' : '' }}" id="socialModal" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
            <div class="social-modal__dialog">
                <button type="button" class="social-modal__close" id="closeSocialModal" aria-label="Close modal">
                    &times;
                </button>
                @include('admin.pages.sociallink.create')
            </div>
        </div>
    @endif

    @include('admin.pages.sociallink.edit')

@endsection

@section('title')
    Social-List
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();

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
                @elseif(request('edit_id') && $activeSocial)
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                @endif
            @endif

            @if ($canAdd)
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

                @if ($errors->any())
                    openModal();
                @endif
            @endif
        });
    </script>
@endsection
