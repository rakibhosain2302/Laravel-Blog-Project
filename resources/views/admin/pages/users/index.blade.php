@extends('admin.layouts.header')

@prepend('style')
    <style>
        .userlist-shell {
            position: relative;
            padding: 18px 0 28px;
        }

        .userlist-shell::before {
            content: "";
            position: fixed;
            top: 110px;
            right: -80px;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
            filter: blur(18px);
            pointer-events: none;
        }

        .userlist-shell::after {
            content: "";
            position: fixed;
            bottom: 10px;
            left: -90px;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
            filter: blur(18px);
            pointer-events: none;
        }

        .userlist-hero {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(280px, 0.9fr);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 20px;
        }

        .userlist-hero__main,
        .userlist-hero__panel,
        .userlist-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .userlist-hero__main {
            padding: 28px;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.97), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(59, 130, 246, 0.16), rgba(168, 85, 247, 0.12));
            color: #fff;
        }

        .userlist-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #e2e8f0;
        }

        .userlist-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .userlist-hero h1 {
            margin: 16px 0 10px;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .userlist-hero p {
            margin: 0;
            max-width: 58ch;
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
        }

        .userlist-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .userlist-mini {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .userlist-mini span {
            display: block;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .userlist-mini strong {
            font-size: 24px;
            letter-spacing: -0.03em;
        }

        .userlist-hero__panel {
            padding: 22px;
            display: grid;
            gap: 14px;
        }

        .userlist-panel__stat {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            padding: 16px 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, #f8fafc, #eef2ff);
            border: 1px solid #e2e8f0;
        }

        .userlist-panel__stat span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .userlist-panel__stat strong {
            color: #0f172a;
            font-size: 18px;
        }

        .userlist-panel__stat em {
            font-style: normal;
            color: #475569;
            font-size: 13px;
            text-align: right;
            line-height: 1.4;
        }

        .userlist-card {
            position: relative;
            z-index: 1;
        }

        .userlist-card__head {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
            padding: 22px 24px 18px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
        }

        .userlist-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 22px;
            letter-spacing: -0.03em;
        }

        .userlist-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .userlist-toolbar {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .userlist-search {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 16px;
            border: 1px solid #cbd5e1;
            background: #fff;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
        }

        .userlist-search input {
            border: 0;
            outline: none;
            background: transparent;
            color: #0f172a;
            font-size: 14px;
        }

        .userlist-search svg {
            width: 18px;
            height: 18px;
            color: #64748b;
            flex-shrink: 0;
        }

        .userlist-body {
            padding: 22px 24px 24px;
        }

        .success-banner {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.14), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(34, 197, 94, 0.18);
            color: #065f46;
            font-weight: 700;
        }

        .user-table-wrap {
            overflow-x: auto;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
        }

        .dataTables_wrapper {
            min-height: 250px;
        }

        table.user-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 860px;
        }

        table.user-table thead th {
            background: #0f172a;
            color: #e2e8f0;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 16px 14px;
            border-bottom: 0;
            white-space: nowrap;
        }

        table.user-table tbody td {
            padding: 16px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #0f172a;
            vertical-align: middle;
        }

        table.user-table tbody tr:hover {
            background: #f8fafc;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            object-fit: cover;
            background: #f8fafc;
            border: 1px solid #dbe4f0;
            flex-shrink: 0;
        }

        .user-cell__meta {
            min-width: 0;
        }

        .user-cell__meta strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.3;
        }

        .user-cell__meta span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
        }

        .user-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .user-badge--muted {
            background: #f1f5f9;
            color: #475569;
        }

        .user-actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .user-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            border: 1px solid transparent;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .user-btn:hover {
            transform: translateY(-1px);
        }

        .user-btn--edit {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.16);
        }

        .user-btn--edit:hover {
            color: #fff;
        }

        .user-btn--delete {
            background: #fff;
            color: #b91c1c;
            border-color: rgba(185, 28, 28, 0.22);
        }

        .user-empty {
            padding: 34px 24px;
            text-align: center;
            color: #64748b;
        }

        .user-empty strong {
            display: block;
            color: #0f172a;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .user-edit-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 9999;
        }

        .user-edit-modal.is-open {
            display: flex;
        }

        .user-edit-modal__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.62);
            backdrop-filter: blur(6px);
        }

        .user-edit-modal__dialog {
            position: relative;
            z-index: 1;
            width: min(100%, 720px);
            max-height: calc(100vh - 40px);
            overflow: auto;
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 30px 90px rgba(15, 23, 42, 0.3);
        }

        .user-edit-modal__head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            padding: 22px 24px 18px;
            border-bottom: 1px solid #e2e8f0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.03), rgba(59, 130, 246, 0.04));
        }

        .user-edit-modal__eyebrow {
            display: inline-flex;
            margin-bottom: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .user-edit-modal__head h3 {
            margin: 0;
            color: #0f172a;
            font-size: 24px;
            letter-spacing: -0.03em;
        }

        .user-edit-modal__head p {
            margin: 8px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .user-edit-modal__close {
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 14px;
            background: #f1f5f9;
            color: #0f172a;
            font-size: 24px;
            line-height: 1;
            cursor: pointer;
        }

        .user-edit-modal__body {
            padding: 24px;
        }

        .user-edit-form {
            display: grid;
            gap: 16px;
        }

        .user-edit-form__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .user-edit-field {
            display: grid;
            gap: 8px;
        }

        .user-edit-field--full {
            grid-column: 1 / -1;
        }

        .user-edit-field label {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
        }

        .user-edit-field input,
        .user-edit-field select {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 14px;
            background: #fff;
            color: #0f172a;
        }

        .user-edit-field input[readonly] {
            background: #f8fafc;
            color: #475569;
        }

        .user-edit-field input:focus,
        .user-edit-field select:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .user-edit-error {
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        .user-edit-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 8px;
        }

        .user-edit-actions .btn-back,
        .user-edit-actions .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 14px;
            border: 0;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }

        .user-edit-actions .btn-back {
            background: #e2e8f0;
            color: #0f172a;
        }

        .user-edit-actions .btn-save {
            background: #0f172a;
            color: #fff;
        }

        @media (max-width: 991px) {
            .userlist-hero {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .userlist-mini-grid {
                grid-template-columns: 1fr;
            }

            .userlist-card__head {
                flex-direction: column;
                align-items: flex-start;
            }

            .userlist-search {
                min-width: 100%;
            }

            .user-edit-modal__dialog {
                max-height: calc(100vh - 24px);
            }

            .user-edit-form__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $roleCounts = $users->groupBy(fn($user) => optional($user->role)->name ?? 'No Role')->map->count();
        $adminCount = $roleCounts->get('Admin', 0);
        $editorCount = $roleCounts->get('Editor', 0);
        $rolelessCount = $roleCounts->get('No Role', 0);
    @endphp

    <div class="grid_10">
        <div class="userlist-shell">
            <div class="userlist-hero">
                <div class="userlist-hero__main">
                    <div class="userlist-badge">User directory</div>
                    <h1>Manage every account from one polished workspace.</h1>
                    <p>
                        Review users, check their roles and descriptions, jump into editing when needed, and keep admin
                        operations tidy with a cleaner overview.
                    </p>

                    <div class="userlist-mini-grid">
                        <div class="userlist-mini">
                            <span>Total users</span>
                            <strong>{{ $userCount ?? 0 }}</strong>
                        </div>
                        <div class="userlist-mini">
                            <span>Role gaps</span>
                            <strong>{{ $rolelessCount }}</strong>
                        </div>
                    </div>
                </div>

                <div class="userlist-hero__panel">
                    <div class="userlist-panel__stat">
                        <div>
                            <span>Admins</span>
                            <strong>{{ $adminCount }}</strong>
                        </div>
                        <em>Full access <br>accounts</em>
                    </div>
                    <div class="userlist-panel__stat">
                        <div>
                            <span>Editors</span>
                            <strong>{{ $editorCount }}</strong>
                        </div>
                        <em>Content and <br>publishing access</em>
                    </div>
                    <div class="userlist-panel__stat">
                        <div>
                            <span>Need attention</span>
                            <strong>{{ $rolelessCount }}</strong>
                        </div>
                        <em>Users without <br>assigned roles</em>
                    </div>
                </div>
            </div>

            <div class="userlist-card">
                <div class="userlist-card__head">
                    <div>
                        <h2>User List ({{ $userCount ?? 0 }})</h2>
                        <p>Search, update, or remove registered users with a more focused interface.</p>
                    </div>
                </div>

                <div class="userlist-body">
                    
                    <div class="user-table-wrap">
                        <table class="user-table data display datatable" id="example">
                            <thead>
                                <tr>
                                    <th style="width: 6%;">#</th>
                                    <th style="width: 22%;">User</th>
                                    <th style="width: 18%;">Email</th>
                                    <th style="width: 14%;">Role</th>
                                    <th style="width: 28%;">Role Description</th>
                                    <th style="width: 6%;">Edit</th>
                                    @if (auth()->user()->role->name === 'Admin')
                                        <th style="width: 6%;">Delete</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $id => $user)
                                    @php
                                        $roleName = optional($user->role)->name ?? 'No Role';
                                        $roleDescription =
                                            optional($user->role)->description ?? 'No description available';
                                        $avatar = $user->image
                                            ? asset('storage/' . $user->image)
                                            : asset('assets/admin/img/img-profile.jpg');
                                    @endphp
                                    <tr class="odd gradeX">
                                        <td>{{ ++$id }}</td>
                                        <td>
                                            <div class="user-cell">
                                                <img class="user-avatar" src="{{ $avatar }}"
                                                    alt="{{ $user->name }}">
                                                <div class="user-cell__meta">
                                                    <strong>{{ $user->name }}</strong>
                                                    <span>ID #{{ $user->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="user-badge {{ $roleName === 'No Role' ? 'user-badge--muted' : '' }}">
                                                {{ $roleName }}
                                            </span>
                                        </td>
                                        <td>{{ $roleDescription }}</td>
                                        <td>
                                            <div class="user-actions">
                                                <a class="user-btn user-btn--edit"
                                                    href="{{ route('users.edit', $user->id) }}">
                                                    Update
                                                </a>
                                            </div>
                                        </td>
                                        @if (auth()->user()->role->name === 'Admin')
                                            <td>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="user-delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="user-btn user-btn--delete" type="submit"
                                                        onclick="event.preventDefault(); confirmDelete(this);">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->role->name === 'Admin' ? 7 : 6 }}">
                                            <div class="user-empty">
                                                <strong>No users found</strong>
                                                There are no registered users to display right now.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.pages.users.edit')
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            const table = $('.datatable').dataTable({
                dom: 'rtip'
            });
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

    @if (session('userdelete'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('userdelete') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif
@endsection

@section('title')
    User-list
@endsection
