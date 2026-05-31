@extends('admin.layouts.header')

@prepend('style')
    <style>
        .copyright-edit-wrap {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .copyright-create {
            border: 0;
            border-radius: 14px;
            background: #ffffff;
            padding: 24px;
            width: min(860px, calc(100vw - 40px));
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

        .btn-back {
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            background: #e2e8f0;
            color: #0f172a;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #cbd5e1;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Copyright Text</h2>

            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="errorMsg">{{ session('error') }}</p>
            @endif

            <div class="copyright-edit-wrap">
                <div class="copyright-create">
                    <div class="copyright-create__head">
                        <h3>Edit Copyright Text</h3>
                        <p>Use this page only if you open the update route directly. On the list page, update now works in a modal.</p>
                    </div>

                    <form action="{{ route('copyright.update', $noteData->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="copyright-create__field">
                            <label for="copyright_note">Copyright Note</label>
                            <input id="copyright_note" type="text" name="note" value="{{ old('note', $noteData->note) }}">
                            @error('note')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="copyright-create__actions">
                            <a href="{{ route('copyright.index') }}" class="btn-back">Back</a>
                            <button type="submit" class="btn-save">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Copyright
@endsection
