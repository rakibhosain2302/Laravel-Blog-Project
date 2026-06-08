@extends('admin.layouts.header')

@prepend('style')
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Modern scrollbar */
        .social-create::-webkit-scrollbar {
            width: 6px;
        }

        .social-create::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .social-create::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .grid_10 .box {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .box.round.first.grid {
            background: transparent;
        }

        .block {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            padding: 28px 32px;
            transition: all 0.2s ease;
        }

        /* Modern toolbar */
        .social-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f5f9;
        }

        .social-toolbar__text h3 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #0f172a, #334155);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 6px;
        }

        .social-toolbar__text p {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Modern buttons */
        .btn-add {
            border: none;
            border-radius: 40px;
            padding: 10px 24px;
            background: linear-gradient(105deg, #0f172a 0%, #1e293b 100%);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 12px 20px -12px rgba(15, 23, 42, 0.3);
        }

        /* Modern table */
        .dataTable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }

        .dataTable thead th {
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            padding: 16px 12px;
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        .dataTable tbody td {
            padding: 16px 12px;
            font-size: 0.9rem;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            word-break: break-word;
        }

        .dataTable tbody tr:hover {
            background-color: #fefce8;
            transition: background 0.2s;
        }

        /* Action buttons */
        .social-action-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-edit-open {
            background: #eef2ff;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            color: #4f46e5;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit-open i {
            font-size: 0.8rem;
        }

        .btn-edit-open:hover {
            background: #4f46e5;
            color: white;
            transform: scale(0.96);
        }

        .btn-delete {
            background: #fef2f2;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            color: #dc2626;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete i {
            font-size: 0.8rem;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
            transform: scale(0.96);
        }

        /* Modern modal */
        .social-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(8px);
            z-index: 9999;
            padding: 20px;
        }

        .social-modal.is-open {
            display: flex;
        }

        .social-modal__dialog {
            width: min(580px, 100%);
            position: relative;
            animation: modalPop 0.25s ease-out;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .social-create {
            background: #ffffff;
            border-radius: 32px;
            padding: 28px 32px;
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.25);
        }

        .social-create__head {
            margin-bottom: 24px;
        }

        .social-create__head h3 {
            font-size: 1.6rem;
            font-weight: 700;
            background: linear-gradient(135deg, #0f172a, #334155);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 6px;
        }

        .social-create__head p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .social-create__grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 28px;
        }

        .social-create__field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .social-create__field label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #334155;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .social-create__field label i {
            width: 20px;
            color: #4f46e5;
        }

        .social-create__field input {
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: 12px 18px;
            font-size: 0.9rem;
            background: #ffffff;
            transition: all 0.2s;
        }

        .social-create__field input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .social-modal__actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 12px;
        }

        .btn-save {
            background: linear-gradient(105deg, #0f172a, #1e293b);
            border: none;
            border-radius: 40px;
            padding: 12px 28px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px -8px #0f172a;
        }

        .btn-cancel {
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            padding: 12px 24px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .social-empty {
            background: #fefce8;
            border-radius: 36px;
            padding: 52px 28px;
            text-align: center;
            border: 2px dashed #fde047;
        }

        .social-empty h3 {
            color: #0f172a;
            margin-bottom: 12px;
        }

        .social-modal__close {
            position: absolute;
            top: -14px;
            right: -14px;
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 60px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            color: #475569;
        }

        .social-modal__close:hover {
            background: #f8fafc;
            transform: scale(1.05);
        }

        /* status msgs */
        .successMsg,
        .errorMsg {
            padding: 14px 20px;
            border-radius: 40px;
            font-weight: 600;
            margin-bottom: 24px;
            font-size: 0.85rem;
        }

        .successMsg {
            background: #dcfce7;
            color: #15803d;
            border-left: 4px solid #22c55e;
        }

        .errorMsg {
            background: #fee2e2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2 style="display: none;">Social Media</h2>

            @if (session('success'))
                <p class="successMsg"><i class="fas fa-check-circle"></i> {{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</p>
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
                            <h3>Connect social presence</h3>
                            <p>Add your official profiles — Facebook, X, LinkedIn & Google</p>
                        </div>
                        <button type="button" class="btn-add" id="openSocialModal">
                            <i class="fas fa-plus-circle"></i> Add links
                        </button>
                    </div>
                @else
                    <div class="social-toolbar">
                        <div class="social-toolbar__text">
                            <h3>⚡ Social links active</h3>
                            <p>Your social networks are visible. Modify or remove them from the table.</p>
                        </div>
                    </div>
                @endif

                @if ($data->isEmpty())
                    <div class="social-empty">
                        <i class="fas fa-share-alt"
                            style="font-size: 48px; color: #facc15; margin-bottom: 16px; display: inline-block;"></i>
                        <h3>No social links added yet</h3>
                        <p>Click “Add links” and connect Facebook, Twitter, LinkedIn & Google to let visitors reach you.</p>
                    </div>
                @else
                    <table class="data display datatable" id="example">
                        <thead>
                            <tr>
                                <th width="6%"><i class="fas fa-hashtag"></i> SL</th>
                                <th width="19%"><i class="fab fa-facebook"></i> Facebook</th>
                                <th width="19%"><i class="fab fa-twitter"></i> Twitter</th>
                                <th width="19%"><i class="fab fa-linkedin"></i> LinkedIn</th>
                                <th width="19%"><i class="fab fa-google"></i> Google</th>
                                <th width="18%"><i class="fas fa-cog"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $id => $social)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td><a href="{{ $social->fblink }}" target="_blank"
                                            style="color:#2563eb; text-decoration: none;">{{ Str::limit($social->fblink, 35) }}</a>
                                    </td>
                                    <td><a href="{{ $social->twlink }}" target="_blank"
                                            style="color:#2563eb; text-decoration: none;">{{ Str::limit($social->twlink, 35) }}</a>
                                    </td>
                                    <td><a href="{{ $social->lnlink }}" target="_blank"
                                            style="color:#2563eb; text-decoration: none;">{{ Str::limit($social->lnlink, 35) }}</a>
                                    </td>
                                    <td><a href="{{ $social->gllink }}" target="_blank"
                                            style="color:#2563eb; text-decoration: none;">{{ Str::limit($social->gllink, 35) }}</a>
                                    </td>
                                    <td class="social-actions">
                                        <div class="social-action-group">
                                            <button type="button" class="btn-edit-open js-open-social-edit"
                                                data-action="{{ route('social.update', $social->id) }}"
                                                data-id="{{ $social->id }}" data-fblink="{{ e($social->fblink) }}"
                                                data-twlink="{{ e($social->twlink) }}"
                                                data-lnlink="{{ e($social->lnlink) }}"
                                                data-gllink="{{ e($social->gllink) }}">
                                                <i class="fas fa-pen"></i> Update
                                            </button>
                                            <form action="{{ route('social.destroy', $social->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" type="submit"
                                                    onclick="return confirm('⚠️ Permanently delete these social links?');">
                                                    <i class="fas fa-trash-alt"></i> Delete
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
        <div class="social-modal {{ $errors->any() ? 'is-open' : '' }}" id="socialModal">
            <div class="social-modal__dialog">
                <button type="button" class="social-modal__close" id="closeSocialModal" aria-label="Close modal">
                    <i class="fas fa-times"></i>
                </button>
                @include('admin.pages.sociallink.create')
            </div>
        </div>
    @endif

    @include('admin.pages.sociallink.edit')

@endsection

@section('title')
    Modern Social Links
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            if ($.fn.dataTable) {
                $('.datatable').dataTable({
                    "pageLength": 10,
                    "language": {
                        "search": "🔍 Search:",
                        "lengthMenu": "Show _MENU_ entries",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "paginate": {
                            "previous": "<",
                            "next": ">"
                        }
                    }
                });
            }
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

                $editModal.on('click', function(e) {
                    if (e.target === this) {
                        closeEditModal();
                    }
                });

                $(document).on('keydown', function(e) {
                    if (e.keyCode === 27) {
                        closeEditModal();
                    }
                });

                @if ($errors->any())
                    $editModal.addClass('is-open').attr('aria-hidden', 'false');
                    $('body').css('overflow', 'hidden');
                @elseif (request('edit_id') && $activeSocial)
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

                $('#openSocialModal').on('click', function() {
                    openModal();
                    return false;
                });

                $('#closeSocialModal').on('click', function() {
                    closeModal();
                    return false;
                });

                $modal.on('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });

                $(document).on('keydown', function(e) {
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
