@extends('admin.layouts.header')

@prepend('style')
    <style>
        .blogtitle-create {
            border: 0;
            border-radius: 14px;
            background: #ffffff;
            padding: 24px;
            width: min(760px, calc(100vw - 40px));
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.25);
        }

        .blogtitle-create__head {
            margin-bottom: 18px;
        }

        .blogtitle-create__head h3 {
            font-size: 20px;
            color: #111827;
            margin-bottom: 6px;
        }

        .blogtitle-create__head p {
            color: #64748b;
            line-height: 1.5;
        }

        .blogtitle-create__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .blogtitle-create__field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .blogtitle-create__field--full {
            grid-column: 1 / -1;
        }

        .blogtitle-create__field label {
            font-weight: 700;
            color: #1f2937;
        }

        .blogtitle-create__field input[type="text"],
        .blogtitle-create__field input[type="file"] {
            width: 350px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
            color: #111827;
        }

        .blogtitle-create__field input[type="text"]:focus,
        .blogtitle-create__field input[type="file"]:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
        }

        .field-error {
            color: #b91c1c;
            font-size: 13px;
            font-weight: 600;
        }

        .blogtitle-create__actions {
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

        .blogtitle-summary {
            display: flex;
            gap: 18px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .blogtitle-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .blogtitle-toolbar__text h3 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 4px;
        }

        .blogtitle-toolbar__text p {
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

        .blogtitle-card {
            flex: 1 1 220px;
            border: 1px solid #d8dee9;
            border-radius: 10px;
            background: #f8fafc;
            padding: 18px 20px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .blogtitle-card h4 {
            margin-bottom: 8px;
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .blogtitle-card strong {
            font-size: 26px;
            color: #111827;
            display: block;
            line-height: 1.1;
        }

        .blogtitle-logo {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            background: #fff;
            padding: 4px;
        }

        .blogtitle-slogan {
            max-width: 620px;
            line-height: 1.6;
        }

        .blogtitle-table td {
            vertical-align: middle;
        }

        .blogtitle-actions {
            white-space: nowrap;
        }

        .blogtitle-empty {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 10px;
            padding: 28px;
            text-align: center;
            color: #475569;
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

        .blogtitle-modal__close:hover {
            background: #cbd5e1;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Blog Title List</h2>

            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif

            <div class="block">
                <div class="blogtitle-toolbar">
                    <div class="blogtitle-toolbar__text">
                        <h3>Manage Blog Title</h3>
                        <p>Create a new site title, slogan, and logo without leaving the list page.</p>
                    </div>

                    <button type="button" class="btn-add" id="openBlogTitleModal">
                        + Add Blog Title
                    </button>
                </div>

                @php
                    $totalTitles = $data->count();
                    $activeTitle = $data->first();
                @endphp

                <div class="blogtitle-summary">
                    <div class="blogtitle-card">
                        <h4>Total Records</h4>
                        <strong>{{ $totalTitles }}</strong>
                    </div>

                    <div class="blogtitle-card">
                        <h4>Current Title</h4>
                        <strong>{{ optional($activeTitle)->title ?? 'No title found' }}</strong>
                    </div>

                    <div class="blogtitle-card">
                        <h4>Current Slogan</h4>
                        <div class="blogtitle-slogan">
                            {{ optional($activeTitle)->slogan ?? 'No slogan found' }}
                        </div>
                    </div>
                </div>

                @if ($data->isEmpty())
                    <div class="blogtitle-empty">
                        <h3 style="margin-bottom: 10px;">No blog title data found</h3>
                        <p>Add a title, slogan, and logo first so the header can show site branding properly.</p>
                    </div>
                @else
                    <table class="data display datatable blogtitle-table" id="example">
                        <thead>
                            <tr>
                                <th width="8%">SL</th>
                                <th width="15%">Logo</th>
                                <th width="25%">Title</th>
                                <th width="37%">Slogan</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $id => $titleSlogan)
                                <tr class="odd gradeX">
                                    <td>{{ ++$id }}</td>
                                    <td>
                                        @if ($titleSlogan->logo)
                                            <img class="blogtitle-logo" src="{{ asset('storage/' . $titleSlogan->logo) }}" alt="Site logo">
                                        @else
                                            <span class="text-muted">No Logo</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 600;">
                                        {{ $titleSlogan->title }}
                                    </td>
                                    <td class="blogtitle-slogan">
                                        {{ $titleSlogan->slogan }}
                                    </td>
                                    <td class="blogtitle-actions edit-btn">
                                        <a href="{{ route('title.slogan', $titleSlogan->id) }}">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="blogtitle-modal {{ $errors->any() ? 'is-open' : '' }}" id="blogTitleModal" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
        <div class="blogtitle-modal__dialog">
            <button type="button" class="blogtitle-modal__close" id="closeBlogTitleModal" aria-label="Close modal">
                &times;
            </button>
            @include('admin.pages.blogtitle.add')
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Blog-Title-List
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
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

            @if ($errors->any())
                openModal();
            @endif
        });
    </script>
@endsection
