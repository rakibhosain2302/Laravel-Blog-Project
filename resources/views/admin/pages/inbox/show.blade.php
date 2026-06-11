@extends('admin.layouts.header')

@push('style')
    <style>
        .message-view-card {
            background: #0f172a;
            border-radius: 20px !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 24px;
        }

        .box {
            margin-left: 0px;
        }

        .box h2 {
            background: none;
            margin: 0 !important;
            padding: 0 !important;
            border-bottom: None !important;
        }


        .message-view-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            padding: 28px 30px 16px;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.88));
            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        }

        .message-view-header h2 {
            margin: 0;
            font-size: 1.75rem;
            color: #f8fafc;
            letter-spacing: -0.02em;
        }

        .message-view-header p {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .message-view-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .message-view-action .btn {
            background: #e2e8f0;
            color: #0f172a;
            border: none;
            padding: 11px 18px;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease;
            line-height: 1 !important;
        }

        .message-view-action .btn:hover {
            transform: translateY(-1px);
        }

        .message-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            padding: 26px 30px 0;
        }

        .message-meta-item {
            background: rgba(148, 163, 184, 0.05);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 16px;
            padding: 18px 20px;
        }

        .message-meta-item .label {
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 0.9rem;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .message-meta-item .value {
            color: #e2e8f0;
            font-size: 1rem;
            font-weight: 600;
        }

        .message-body-panel {
            margin: 24px 30px 30px;
            padding: 26px 28px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 20px;
        }

        .message-body-panel h3 {
            margin: 0 0 16px;
            font-size: 1.2rem;
            color: #f8fafc;
        }

        .message-body-panel p {
            margin: 0;
            line-height: 1.8;
            color: #cbd5e1;
            white-space: pre-line;
        }

        @media (max-width: 768px) {
            .message-meta-grid {
                grid-template-columns: 1fr;
            }

            .message-view-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .message-view-action {
                width: 100%;
                justify-content: flex-start;
            }

            .message-view-action .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid message-view-card">
            <div class="message-view-header">
                <div>
                    <p>Inbox Message</p>
                    <h2>Message Details</h2>
                </div>
                <div class="message-view-action">
                    <a href="{{ route('message.index') }}" class="btn">Back to Inbox</a>
                </div>
            </div>

            <div class="message-meta-grid">
                <div class="message-meta-item">
                    <span class="label">Sender</span>
                    <span class="value">{{ $viweMsg->firstname }} {{ $viweMsg->lastname }}</span>
                </div>
                <div class="message-meta-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $viweMsg->email }}</span>
                </div>
                <div class="message-meta-item">
                    <span class="label">Received</span>
                    <span class="value">{{ $viweMsg->created_at->format('d M, Y h:i A') }}</span>
                </div>
                <div class="message-meta-item">
                    <span class="label">Status</span>
                    <span class="value">Seen</span>
                </div>
            </div>

            <div class="message-body-panel">
                <h3>Message</h3>
                <p>{{ $viweMsg->message }}</p>
            </div>
        </div>
    </div>
@endsection

@section('title')
    View Message
@endsection
