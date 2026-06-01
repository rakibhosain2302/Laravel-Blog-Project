@extends('admin.layouts.header')

@prepend('style')
    <style>
        .inbox-shell {
            position: relative;
            padding: 18px 0 28px;
        }

        .inbox-shell::before {
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

        .inbox-shell::after {
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

        .inbox-hero {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(280px, 0.9fr);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 20px;
        }

        .inbox-hero__main,
        .inbox-hero__panel,
        .inbox-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .inbox-hero__main {
            padding: 28px;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.97), rgba(30, 41, 59, 0.92)),
                linear-gradient(135deg, rgba(59, 130, 246, 0.16), rgba(168, 85, 247, 0.12));
        }

        .inbox-badge {
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

        .inbox-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .inbox-hero h1 {
            margin: 16px 0 10px;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .inbox-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
        }

        .inbox-mini-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .inbox-mini {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .inbox-mini span {
            display: block;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .inbox-mini strong {
            display: block;
            font-size: 22px;
            letter-spacing: -0.03em;
        }

        .inbox-hero__panel {
            padding: 22px;
            display: grid;
            gap: 14px;
        }

        .inbox-panel__stat {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            padding: 16px 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, #f8fafc, #eef2ff);
            border: 1px solid #e2e8f0;
        }

        .inbox-panel__stat span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .inbox-panel__stat strong {
            color: #0f172a;
            font-size: 18px;
        }

        .inbox-panel__stat em {
            font-style: normal;
            color: #475569;
            font-size: 13px;
            text-align: right;
            line-height: 1.4;
        }

        .inbox-card {
            margin-bottom: 20px;
        }

        .inbox-card__head {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
            padding: 22px 24px 18px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
        }

        .inbox-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 22px;
            letter-spacing: -0.03em;
        }

        .inbox-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .inbox-toolbar {
            min-width: min(360px, 100%);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 16px;
            border: 1px solid #cbd5e1;
            background: #fff;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
        }

        .inbox-toolbar svg {
            width: 18px;
            height: 18px;
            color: #64748b;
            flex-shrink: 0;
        }

        .inbox-toolbar input {
            width: 100%;
            border: 0;
            outline: none;
            background: transparent;
            color: #0f172a;
            font-size: 14px;
        }

        .inbox-body {
            padding: 22px 24px 24px;
        }

        .inbox-success {
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

        .inbox-table-wrap {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            padding: 15px;
        }

        table.inbox-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 940px;
        }

        table.inbox-table thead th {
            background: #0f172a;
            color: #e2e8f0;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 16px 14px;
            white-space: nowrap;
        }

        table.inbox-table tbody td {
            padding: 16px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #0f172a;
            vertical-align: middle;
        }

        table.inbox-table tbody tr:hover {
            background: #f8fafc;
        }

        .message-name {
            font-weight: 800;
        }

        .message-email {
            color: #64748b;
            font-size: 13px;
        }

        .message-preview {
            color: #475569;
            line-height: 1.6;
        }

        .message-chip {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        .message-chip--unread {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .message-chip--seen {
            background: #f1f5f9;
            color: #475569;
        }

        .message-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .message-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            border: 1px solid transparent;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .message-btn:hover {
            transform: translateY(-1px);
        }

        .message-btn--view {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.16);
        }

        .message-btn--seen {
            background: #16a34a;
            color: #fff;
        }

        .message-btn--reply {
            background: #7c3aed;
            color: #fff;
        }

        .message-btn--undo {
            background: #fff;
            color: #1d4ed8;
            border-color: rgba(29, 78, 216, 0.2);
        }

        .message-btn--delete {
            background: #fff;
            color: #b91c1c;
            border-color: rgba(185, 28, 28, 0.22);
        }

        .inbox-empty {
            padding: 34px 24px;
            text-align: center;
            color: #64748b;
        }

        .inbox-empty strong {
            display: block;
            color: #0f172a;
            font-size: 18px;
            margin-bottom: 8px;
        }

        @media (max-width: 991px) {
            .inbox-hero {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .inbox-mini-grid {
                grid-template-columns: 1fr;
            }

            .inbox-card__head {
                flex-direction: column;
                align-items: flex-start;
            }

            .inbox-toolbar {
                min-width: 100%;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $allMessages = $messages->count() + $seenMessages->count();
        $unreadRatio = $allMessages ? round(($unreadCount / $allMessages) * 100) : 0;
    @endphp

    <div class="grid_10">
        <div class="inbox-shell">
            <div class="inbox-hero">
                <div class="inbox-hero__main">
                    <div class="inbox-badge">Inbox center</div>
                    <h1>Manage messages from a cleaner, calmer workspace.</h1>
                    <p>
                        Review incoming messages, mark them seen, reply when needed, and keep the inbox tidy without
                        jumping through old-school table layouts.
                    </p>

                    <div class="inbox-mini-grid">
                        <div class="inbox-mini">
                            <span>Unread</span>
                            <strong>{{ $unreadCount ?? 0 }}</strong>
                        </div>
                        <div class="inbox-mini">
                            <span>Seen</span>
                            <strong>{{ $seenCount ?? 0 }}</strong>
                        </div>
                        <div class="inbox-mini">
                            <span>Unread rate</span>
                            <strong>{{ $unreadRatio }}%</strong>
                        </div>
                    </div>
                </div>

                <div class="inbox-hero__panel">
                    <div class="inbox-panel__stat">
                        <div>
                            <span>Inbox total</span>
                            <strong>{{ $allMessages }}</strong>
                        </div>
                        <em>All message<br>records</em>
                    </div>
                    <div class="inbox-panel__stat">
                        <div>
                            <span>Needs attention</span>
                            <strong>{{ $unreadCount ?? 0 }}</strong>
                        </div>
                        <em>Messages waiting<br>for review</em>
                    </div>
                    <div class="inbox-panel__stat">
                        <div>
                            <span>Processed</span>
                            <strong>{{ $seenCount ?? 0 }}</strong>
                        </div>
                        <em>Messages already<br>handled</em>
                    </div>
                </div>
            </div>

            <div class="inbox-card">
                <div class="inbox-card__head">
                    <div>
                        <h2>Unread Messages ({{ $unreadCount ?? 0 }})</h2>
                        <p>New messages that still need a quick review.</p>
                    </div>
                </div>

                <div class="inbox-body">
                    @if (session('mtoseen'))
                        <div class="inbox-success">{{ session('mtoseen') }}</div>
                    @endif

                    <div class="inbox-table-wrap">
                        <table class="inbox-table data display datatable" data-table-id="unreadTable">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">SL</th>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 20%;">Email</th>
                                    <th style="width: 34%;">Message</th>
                                    <th style="width: 7%;">Status</th>
                                    <th style="width: 7%;">View</th>
                                    <th style="width: 7%;">Seen</th>
                                    <th style="width: 7%;">Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($messages as $id => $message)
                                    <tr>
                                        <td>{{ ++$id }}</td>
                                        <td>
                                            <div class="message-name">{{ $message->firstname }} {{ $message->lastname }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="message-email">{{ $message->email }}</div>
                                        </td>
                                        <td>
                                            <div class="message-preview">
                                                {{ \Illuminate\Support\Str::limit($message->message, 90, '...') }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="message-chip message-chip--unread">Unread</span>
                                        </td>
                                        <td>
                                            <a class="message-btn message-btn--view"
                                                href="{{ route('message.show', $message->id) }}">View</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('messages.seen', $message->id) }}" method="POST">
                                                @csrf
                                                <button class="message-btn message-btn--seen" type="submit">Seen</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="message-btn message-btn--reply"
                                                href="{{ route('message.edit', $message->id) }}">Reply</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="inbox-empty">
                                                <strong>No unread messages</strong>
                                                Everything is up to date in the inbox.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="inbox-card">
                <div class="inbox-card__head">
                    <div>
                        <h2>Seen Messages ({{ $seenCount ?? 0 }})</h2>
                        <p>Reviewed messages that you can undo or remove anytime.</p>
                    </div>

                    <label class="inbox-toolbar" for="seenSearch">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.2-5.15a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                        </svg>
                        <input id="seenSearch" type="search" placeholder="Search seen messages...">
                    </label>
                </div>

                <div class="inbox-body">
                    @if (session('success'))
                        <div class="inbox-success">{{ session('success') }}</div>
                    @endif

                    <div class="inbox-table-wrap">
                        <table class="inbox-table data display datatable" data-table-id="seenTable">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">SL</th>
                                    <th style="width: 22%;">Name</th>
                                    <th style="width: 22%;">Email</th>
                                    <th style="width: 36%;">Message</th>
                                    <th style="width: 7%;">Status</th>
                                    <th style="width: 8%;">Undo</th>
                                    <th style="width: 8%;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($seenMessages as $id => $msg)
                                    <tr>
                                        <td>{{ ++$id }}</td>
                                        <td>
                                            <div class="message-name">{{ $msg->firstname }} {{ $msg->lastname }}</div>
                                        </td>
                                        <td>
                                            <div class="message-email">{{ $msg->email }}</div>
                                        </td>
                                        <td>
                                            <div class="message-preview">
                                                {{ \Illuminate\Support\Str::limit($msg->message, 90, '...') }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="message-chip message-chip--seen">Seen</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('messages.undo', $msg->id) }}" method="POST">
                                                @csrf
                                                <button class="message-btn message-btn--undo" type="submit">Undo</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('message.destroy', $msg->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="message-btn message-btn--delete" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this record?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="inbox-empty">
                                                <strong>No seen messages</strong>
                                                Seen messages will appear here after you mark them reviewed.
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
    </div>

    @include('admin.layouts.footer')

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            const unreadTable = $('[data-table-id="unreadTable"]').dataTable({
                dom: 'rtip'
            });
            const seenTable = $('[data-table-id="seenTable"]').dataTable({
                dom: 'rtip'
            });

            setSidebarHeight();

            $('#unreadSearch').on('keyup change', function() {
                if (unreadTable.fnFilter) {
                    unreadTable.fnFilter(this.value);
                }
            });

            $('#seenSearch').on('keyup change', function() {
                if (seenTable.fnFilter) {
                    seenTable.fnFilter(this.value);
                }
            });
        });
    </script>
@endsection

@section('title')
    inbox
@endsection
