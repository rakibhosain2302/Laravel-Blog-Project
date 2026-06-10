@extends('admin.layouts.header')

@prepend('style')
    <style>
        .slider-image {
            display: block;
            max-width: 220px;
            max-height: 84px;
            width: auto;
            height: auto;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.24);
            object-fit: cover;
        }

        .page-action--edit,
        .page-action--delete {
            min-width: 92px;
            text-align: center;
        }

        .page-table-wrap table.dataTable tbody td {
            white-space: normal;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    <div class="grid_10">
        <div class="page-index-shell">
            <div class="page-index-grid">
                <section class="page-hero">
                    <div class="page-hero__top">
                        <div class="page-kicker">Slider library</div>
                        <a class="page-create-btn" href="{{ route('slider.create') }}">+ Add New Slider</a>
                    </div>
                    <h1>Manage your sliders with a clear, modern interface.</h1>
                    <p>
                        Add, update, or remove slider items and keep your homepage content looking fresh.
                    </p>

                    <div class="page-hero-stats">
                        <div class="page-stat">
                            <span>Total sliders</span>
                            <strong>{{ $sliderData->count() }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Your role</span>
                            <strong>{{ Auth::user()->role->name ?? 'User' }}</strong>
                        </div>
                        <div class="page-stat">
                            <span>Status</span>
                            <strong>Active</strong>
                        </div>
                    </div>
                </section>

                <div class="page-quick-links">
                    <div class="page-mini-card">
                        <div class="page-pill">Slider tip</div>
                        <h3>Use strong imagery</h3>
                        <p>Choose slide images that tell a story and support your brand message.</p>
                    </div>

                    <div class="page-mini-card">
                        <div class="page-pill">Quick action</div>
                        <h3>Update slides quickly</h3>
                        <p>Edit titles, replace images, or remove old items with one click.</p>
                    </div>
                </div>

                <section class="page-table-card">
                    <div class="page-table-card__head">
                        <div>
                            <h2>Slider List</h2>
                            <p>Review and manage all slider entries in one centralized dashboard.</p>
                        </div>
                        <div class="page-pill">{{ $sliderData->count() }} records</div>
                    </div>

                    <div class="page-table-wrap">
                        @if ($sliderData->isEmpty())
                            <div class="page-empty">
                                No sliders found yet. Add a new slide to make your homepage shine.
                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliderData as $id => $slider)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <div class="page-title">
                                                    <span class="page-title__dot"></span>
                                                    <span>{{ $slider->title }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <img class="slider-image" src="{{ asset('storage/' . $slider->image) }}" alt="Slider image">
                                            </td>
                                            <td class="actions-btn">
                                                <a class="page-action page-action--edit" href="{{ route('slider.edit', $slider->id) }}">Update</a>
                                                <form class="page-delete-form" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="page-action page-action--delete" type="submit" onclick="event.preventDefault(); confirmDelete(this);">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            if ($('#example').length) {
                $('#example').dataTable({
                    sDom: 'lfrtip',
                    iDisplayLength: 10
                });
            }
            setSidebarHeight();

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}'
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
@endsection

@section('title')
    Slider-List
@endsection
