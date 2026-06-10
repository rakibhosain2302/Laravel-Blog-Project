@extends('admin.layouts.header')

@prepend('style')
    <style>
        .slider-create-shell {
            padding: 24px 0;
        }

        .slider-create-card {
            background: rgba(15, 23, 42, 0.92);
            border: 1px solid rgba(148, 163, 184, 0.16);
            border-radius: 28px;
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.24);
            padding: 32px;
        }

        .slider-create-head {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .slider-create-head h2 {
            margin: 0;
            font-size: 1.85rem;
            font-weight: 800;
            color: #f8fafc;
            line-height: 1.1;
        }

        .slider-create-head p {
            margin: 0;
            max-width: 620px;
            color: #94a3b8;
            font-size: 0.98rem;
            line-height: 1.8;
        }

        .slider-create-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .slider-create-field {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .slider-create-field--full {
            grid-column: 1 / -1;
        }

        .slider-create-field label {
            color: #cbd5e1;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .slider-create-field input[type="text"],
        .slider-create-field input[type="file"] {
            width: 100%;
            min-height: 50px;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.04);
            color: #f8fafc;
            font-size: 0.96rem;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .slider-create-field input[type="text"]:focus,
        .slider-create-field input[type="file"]:focus {
            border-color: rgba(59, 130, 246, 0.8);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            outline: none;
        }

        .slider-create-field .field-error {
            color: #fca5a5;
            font-size: 0.88rem;
            margin-top: 4px;
        }

        .form-alert {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 16px;
            background: rgba(248, 113, 113, 0.12);
            border: 1px solid rgba(248, 113, 113, 0.22);
            color: #fee2e2;
        }

        .slider-create-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-start;
            margin-top: 24px;
        }

        .slider-create-actions .btn-save,
        .slider-create-actions .btn-cancel {
            min-width: 140px;
            border-radius: 999px;
            padding: 14px 24px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .slider-create-actions .btn-save {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: #ffffff;
        }

        .slider-create-actions .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(59, 130, 246, 0.24);
        }

        .slider-create-actions .btn-cancel {
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.24);
            text-decoration: none;
        }

        .slider-create-actions .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        @media (max-width: 900px) {
            .slider-create-grid {
                grid-template-columns: 1fr;
            }

            .slider-create-head {
                flex-direction: column;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="slider-create-shell">
            <div class="slider-create-card">
                <div class="slider-create-head">
                    <div>
                        <h2>Add New Slider</h2>
                        <p>Use this form to create a fresh slider item for your homepage. Upload a strong image and add a concise title for the slide.</p>
                    </div>
                </div>

                @if (session('error'))
                    <div class="form-alert">{{ session('error') }}</div>
                @endif

                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="slider-create-grid">
                        <div class="slider-create-field">
                            <label for="slider_title">Slider Title</label>
                            <input id="slider_title" type="text" name="title" placeholder="Enter slider title..." value="{{ old('title') }}" />
                            @error('title')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="slider-create-field slider-create-field--full">
                            <label for="slider_image">Upload Image</label>
                            <input id="slider_image" type="file" name="image" accept="image/png, image/jpeg, image/jpg" />
                            @error('image')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="slider-create-actions">
                        <a href="{{ route('slider.index') }}" class="btn-cancel">Cancel</a>
                        <button type="submit" class="btn-save">Save Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Add Slider
@endsection
