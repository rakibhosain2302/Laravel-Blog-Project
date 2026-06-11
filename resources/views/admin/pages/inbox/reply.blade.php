@extends('admin.layouts.header')

@prepend('style')
    <style>
        .reply-page {
            padding: 24px 0;
        }

        .reply-page .grid_10 {
            max-width: 1120px;
            margin: 0 auto;
        }

        .reply-card {
            background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 28px;
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.25);
            overflow: hidden;
        }

        .reply-header {
            padding: 28px 34px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        }

        .reply-header h2 {
            margin: 0;
            font-size: 1.95rem;
            color: #f8fafc;
            letter-spacing: -0.03em;
        }

        .reply-header p {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .reply-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            padding: 30px 34px 0;
        }

        .reply-info .info-box {
            background: rgba(148, 163, 184, 0.04);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 20px;
            padding: 18px 20px;
        }

        .reply-info .info-box .label {
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .reply-info .info-box .value {
            color: #f8fafc;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .reply-form {
            padding: 28px 34px 36px;
        }

        .reply-form form {
            display: grid;
            gap: 22px;
        }

        .form-group {
            display: grid;
            gap: 10px;
        }

        .form-group label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #cbd5e1;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.14);
            color: #e2e8f0;
            border-radius: 16px;
            padding: 16px 18px;
            font-size: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.75);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            transform: translateY(-1px);
        }

        .form-group textarea {
            min-height: 280px;
            resize: vertical;
        }

        input[readonly] {
            opacity: 0.85;
            background: rgba(255, 255, 255, 0.04);
            cursor: not-allowed;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            justify-content: flex-end;
            margin-top: 4px;
        }

        .actions .btn,
        .actions button {
            min-width: 145px;
            border-radius: 999px;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            cursor: pointer;
            text-align: center;
        }

        .actions .btn {
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.06);
            color: #f8fafc;
            text-decoration: none;
        }

        .actions .btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.12);
        }

        .actions button {
            border: none;
            background: #e2e8f0;
            color: #000;
            box-shadow: 0 18px 35px rgba(20, 184, 166, 0.22);
            padding: 8px;
        }

        .actions button:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .reply-info {
                grid-template-columns: 1fr;
            }

            .reply-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                width: 100%;
            }

            .actions .btn,
            .actions button {
                width: 100%;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10 reply-page">
        <div class="reply-card">
            <div class="reply-header">
                <div>
                    <p>Inbox Reply</p>
                    <h2>Reply to Message</h2>
                </div>
                <div class="actions">
                    <a href="{{ route('message.index') }}" class="btn">Back to Inbox</a>
                </div>
            </div>

            <div class="reply-info">
                <div class="info-box">
                    <span class="label">Recipient</span>
                    <span class="value">{{ $replyMsg->firstname }} {{ $replyMsg->lastname ?? '' }}</span>
                </div>
                <div class="info-box">
                    <span class="label">Email</span>
                    <span class="value">{{ $replyMsg->email }}</span>
                </div>
                <div class="info-box">
                    <span class="label">Received</span>
                    <span class="value">{{ $replyMsg->created_at->format('d M, Y h:i A') }}</span>
                </div>
            </div>

            <div class="reply-form">
                <form action="" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="toemail">To</label>
                        <input type="email" id="toemail" name="toemail" value="{{ $replyMsg->email }}" readonly />
                    </div>

                    <div class="form-group">
                        <label for="fromemail">From</label>
                        <input type="email" id="fromemail" name="fromemail"
                            value="{{ old('fromemail', auth()->user()->email ?? '') }}" readonly />
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter message subject" />
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message here..."></textarea>
                    </div>

                    <div class="actions">
                        <a href="{{ route('message.index') }}" class="btn">Cancel</a>
                        <button type="submit">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupTinyMCE();
        });
    </script>
@endsection

@section('title')
    Reply Message
@endsection
