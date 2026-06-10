@extends('admin.layouts.header')

@prepend('style')
    <style>
        .slider-edit-shell {
            position: relative;
            padding: 24px 0 36px;
        }

        .slider-edit-shell::before,
        .slider-edit-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.8;
        }

        .slider-edit-shell::before {
            top: 90px;
            right: -80px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.24), rgba(59, 130, 246, 0));
        }

        .slider-edit-shell::after {
            bottom: -90px;
            left: -70px;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.18), rgba(168, 85, 247, 0));
        }

        .slider-edit-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .slider-hero,
        .slider-form-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .slider-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .slider-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .slider-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.12);
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .slider-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(148, 163, 184, 0.16);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .slider-back-btn:hover {
            transform: translateY(-1px);
            background: rgba(15, 23, 42, 0.12);
            color: #fff;
        }

        .slider-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(32px, 4vw, 44px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .slider-hero p {
            margin: 0;
            max-width: 64ch;
            color: #CCC;
            font-size: 15px;
            line-height: 1.8;
        }

        .slider-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 24px;
        }

        .slider-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(226, 232, 240, 0.9);
        }

        .slider-stat span {
            display: block;
            margin-bottom: 8px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .slider-stat strong {
            display: block;
            color: #0f172a;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .slider-form-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .slider-form-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .slider-form-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .slider-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .slider-form-wrap {
            padding: 20px 24px 24px;
        }

        .slider-form-grid {
            display: grid;
            gap: 22px;
        }

        .slider-form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .slider-form-group label {
            color: #0f172a;
            font-weight: 700;
            font-size: 14px;
        }

        .slider-form-input,
        .slider-form-file,
        .slider-form-textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #dbe4f0;
            border-radius: 14px;
            font-size: 15px;
            background: #fff;
            color: #0f172a;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .slider-form-input:focus,
        .slider-form-file:focus,
        .slider-form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .slider-form-file {
            cursor: pointer;
            padding: 12px 14px;
        }

        .slider-preview {
            overflow: hidden;
        }

        .slider-preview img {
            width: 400px;
            display: block;
            object-fit: cover;
            border-radius: 12px;
        }

        .slider-error {
            color: #dc2626;
            font-size: 13px;
        }

        .slider-form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border-radius: 999px;
            background: #0f172a;
            border: 1px solid transparent;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }


        .slider-form-actions .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(59, 130, 246, 0.24);
            color: #fff;
        }


        @media (max-width: 991px) {
            .slider-hero-stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .slider-edit-shell {
                padding-top: 14px;
            }

            .slider-hero,
            .slider-form-card__head,
            .slider-form-wrap {
                padding-left: 18px;
                padding-right: 18px;
            }

            .slider-back-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="slider-edit-shell">
            <div class="slider-edit-grid">
                <section class="slider-hero">
                    <div class="slider-hero__top">
                        <div class="slider-kicker">Edit Slider</div>
                        <a class="slider-back-btn" href="{{ route('slider.index') }}">← Back to Sliders</a>
                    </div>

                    <h1>Update your slider item.</h1>
                    <p>Change the slide title or upload a new image to refresh the homepage slider effortlessly.</p>

                    <div class="slider-hero-stats">
                        <div class="slider-stat">
                            <span>Slide ID</span>
                            <strong>#{{ $updateSlider->id }}</strong>
                        </div>
                        <div class="slider-stat">
                            <span>Your role</span>
                            <strong>{{ auth()->user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="slider-stat">
                            <span>Last updated</span>
                            <strong>{{ $updateSlider->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </section>

                <section class="slider-form-card">
                    <div class="slider-form-card__head">
                        <div>
                            <h2>Edit Slider</h2>
                            <p>Update the title and image for this slider entry, then save your changes.</p>
                        </div>
                        <div class="slider-pill">Updating</div>
                    </div>

                    <div class="slider-form-wrap">
                        <form action="{{ route('slider.update', $updateSlider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="slider-form-grid">
                                <div class="slider-form-group">
                                    <label for="slider_title">Slider Title</label>
                                    <input id="slider_title" type="text" name="title"
                                        placeholder="Enter slider title..."
                                        class="slider-form-input @error('title') is-invalid @enderror"
                                        value="{{ old('title', $updateSlider->title) }}" />
                                    @error('title')
                                        <span class="slider-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="slider-form-group slider-form-group--full">
                                    <label for="slider_image">Upload Image</label>
                                    <input id="slider_image" type="file" name="image"
                                        accept="image/png, image/jpeg, image/jpg"
                                        class="slider-form-file @error('image') is-invalid @enderror"
                                        onchange="document.querySelector('#slider_preview').src = window.URL.createObjectURL(this.files[0]); document.querySelector('#slider_preview').style.display = 'block';" />
                                    @error('image')
                                        <span class="slider-error">{{ $message }}</span>
                                    @enderror

                                    <div class="slider-preview">
                                        <img id="slider_preview"
                                            src="{{ $updateSlider->image ? asset('storage/' . $updateSlider->image) : '' }}"
                                            alt="Current slider image"
                                            style="{{ $updateSlider->image ? '' : 'display: none;' }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="slider-form-actions">
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
@endsection

@section('title')
    Update Slider
@endsection
