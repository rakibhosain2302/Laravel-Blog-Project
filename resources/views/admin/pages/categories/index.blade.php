@extends('admin.layouts.header')

@prepend('style')
    <style>
        .category-index-shell {
            position: relative;
            padding: 18px 0 34px;
        }

        .category-index-shell::before,
        .category-index-shell::after {
            content: "";
            position: fixed;
            pointer-events: none;
            border-radius: 999px;
            filter: blur(24px);
            opacity: 0.9;
        }

        .category-index-shell::before {
            top: 86px;
            right: -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22), rgba(59, 130, 246, 0));
        }

        .category-index-shell::after {
            bottom: -90px;
            left: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.16), rgba(168, 85, 247, 0));
        }

        .category-index-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 20px;
        }

        .category-hero,
        .category-table-card,
        .category-mini-card {
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 22px 56px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .category-hero {
            padding: 30px;
            color: #fff;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.32), transparent 34%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.22), transparent 28%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        }

        .category-hero__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .category-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .category-kicker::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .category-create-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.12);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, background 0.18s ease;
        }

        .category-create-btn:hover {
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .category-hero h1 {
            margin: 18px 0 10px;
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .category-hero p {
            margin: 0;
            max-width: 62ch;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.8;
        }

        .category-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .category-stat {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.12);
        }

        .category-stat span {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .category-stat strong {
            display: block;
            color: #fff;
            font-size: 20px;
            letter-spacing: -0.03em;
        }

        .category-table-card__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 24px 24px 0;
        }

        .category-table-card__head h2 {
            margin: 0;
            color: #0f172a;
            font-size: 26px;
            letter-spacing: -0.04em;
        }

        .category-table-card__head p {
            margin: 6px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .category-pill {
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

        .category-table-wrap {
            padding: 20px 24px 24px;
        }

        .category-table-wrap .dataTables_wrapper {
            color: #334155;
        }

        .category-table-wrap .dataTables_length,
        .category-table-wrap .dataTables_filter {
            margin-bottom: 16px;
        }

        .category-table-wrap .dataTables_length label,
        .category-table-wrap .dataTables_filter label {
            color: #475569;
            font-weight: 700;
        }

        .category-table-wrap .dataTables_length select,
        .category-table-wrap .dataTables_filter input {
            border: 1px solid #dbe4f0;
            border-radius: 12px;
            padding: 8px 12px;
            background: #fff;
            color: #0f172a;
            outline: none;
        }

        .category-table-wrap .dataTables_filter input {
            min-width: 240px;
        }

        .category-table-wrap table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
        }

        .category-table-wrap table.dataTable thead th {
            border-bottom: 0;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 16px 10px;
        }

        .category-table-wrap table.dataTable tbody tr {
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.05);
        }

        .category-table-wrap table.dataTable tbody td {
            background: #fff;
            border-top: 1px solid #eef2f7;
            border-bottom: 1px solid #eef2f7;
            color: #0f172a;
            font-weight: 600;
            padding: 16px;
            vertical-align: middle;
        }

        .category-table-wrap table.dataTable tbody td:first-child {
            border-left: 1px solid #eef2f7;
            border-radius: 16px 0 0 16px;
            width: 88px;
            color: #64748b;
            font-weight: 800;
        }

        .category-table-wrap table.dataTable tbody td:last-child {
            border-right: 1px solid #eef2f7;
            border-radius: 0 16px 16px 0;
        }

        .category-name {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .category-name__dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.12);
            flex: 0 0 auto;
        }

        .category-count {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.03em;
        }

        .category-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .category-action:hover {
            transform: translateY(-1px);
        }

        .category-action--edit {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }

        .category-action--edit:hover {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.16);
        }

        .category-action--delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .actions-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .category-delete-form {
            display: inline-block;
            margin: 0;
        }

        .category-empty {
            padding: 24px;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            color: #475569;
            text-align: center;
        }

        .category-quick-links {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .category-mini-card {
            padding: 20px;
        }

        .category-mini-card h3 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 18px;
            letter-spacing: -0.03em;
        }

        .category-mini-card p {
            margin: 0;
            color: #64748b;
            line-height: 1.65;
            font-size: 14px;
        }

        @media (max-width: 991px) {

            .category-hero-stats,
            .category-quick-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767px) {
            .category-index-shell {
                padding-top: 14px;
            }

            .category-hero,
            .category-table-card__head,
            .category-table-wrap,
            .category-mini-card {
                padding-left: 18px;
                padding-right: 18px;
            }

            .category-create-btn {
                width: 100%;
                justify-content: center;
            }

            .category-table-wrap .dataTables_filter input {
                min-width: 0;
                width: 100%;
            }

            .category-table-wrap .dataTables_length,
            .category-table-wrap .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }

            .category-table-wrap .dataTables_filter {
                margin-top: 10px;
            }

        }

        /* Edit Category Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: #fff;
            border-radius: 20px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.2);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            margin-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 16px;
        }

        .modal-header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 24px;
            letter-spacing: -0.03em;
        }

        .modal-close {
            position: absolute;
            top: 24px;
            right: 24px;
            background: none;
            border: none;
            font-size: 28px;
            color: #64748b;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .modal-close:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .modal-body {
            margin-bottom: 24px;
        }

        .modal-form-group {
            margin-bottom: 18px;
        }

        .modal-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #0f172a;
            font-weight: 700;
            font-size: 14px;
        }

        .modal-form-group input {
            width: 95%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .modal-form-group input:focus {
            outline: none;
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid transparent;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            font-size: 14px;
        }

        .modal-btn:hover {
            transform: translateY(-1px);
        }

        .modal-btn--cancel {
            background: #f1f5f9;
            color: #475569;
            border-color: #cbd5e1;
        }

        .modal-btn--save {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.12);
        }

        .modal-btn--save:hover {
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.16);
        }

        .modal-loader {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }

        .modal-loader::after {
            content: "";
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e1;
            border-top-color: #0f172a;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')

    @php
        $totalCategories = $catData->count();
        $totalPosts = $catData->sum('posts_count');
        $topCategory = $catData->sortByDesc('posts_count')->first();
    @endphp

    <div class="grid_10">
        <div class="category-index-shell">
            <div class="category-index-grid">
                <section class="category-hero">
                    <div class="category-hero__top">
                        <div class="category-kicker">Category library</div>
                        <a class="category-create-btn" href="{{ route('categories.create') }}">+ Add New Category</a>


                    </div>
                    <h1>Manage your categories with a cleaner, faster workflow.</h1>
                    <p>
                        Keep your blog structure organized, track how many posts live inside each category, and manage
                        everything from one polished admin surface.
                    </p>

                    <div class="category-hero-stats">
                        <div class="category-stat">
                            <span>Total categories</span>
                            <strong>{{ $totalCategories }}</strong>


                        </div>
                        <div class="category-stat">
                            <span>Total posts</span>
                            <strong>{{ $totalPosts }}</strong>


                        </div>
                        <div class="category-stat">
                            <span>Top category</span>
                            <strong>{{ optional($topCategory)->name ?? 'N/A' }}</strong>


                        </div>


                    </div>
                </section>

                <div class="category-quick-links">
                    <div class="category-mini-card">
                        <div class="category-pill">Workflow tip</div>
                        <h3>Keep category names meaningful</h3>
                        <p>Short, clear labels make it easier to scan, filter, and reuse your category structure later.</p>


                    </div>

                    <div class="category-mini-card">
                        <div class="category-pill">Quick action</div>
                        <h3>Need a new category?</h3>
                        <p>Use the add button above to create a category without leaving this page’s context.</p>


                    </div>


                </div>

                <section class="category-table-card">
                    <div class="category-table-card__head">
                        <div>
                            <h2>Category List</h2>
                            <p>Review post counts and update or delete categories as needed.</p>


                        </div>
                        <div class="category-pill">{{ $totalCategories }} records</div>


                    </div>

                    <div class="category-table-wrap">
                        @if (session('success'))
                            <div class="category-pill" style="margin-bottom: 16px; background:#ecfdf5; color:#047857;">
                                {{ session('success') }}


                            </div>
                        @endif

                        @if ($catData->isEmpty())
                            <div class="category-empty">
                                No categories found yet. Add your first category to start organizing posts.


                            </div>
                        @else
                            <table class="data display datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Category Name</th>
                                        <th>Total Posts</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catData as $id => $category)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <div class="category-name">
                                                    <span class="category-name__dot"></span>
                                                    <span>{{ $category->name }}</span>


                                                </div>
                                            </td>
                                            <td>
                                                <span class="category-count">{{ $category->posts_count }}</span>
                                            </td>
                                            <td class="actions-btn">
                                                <button type="button" class="category-action category-action--edit"
                                                    onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')">Update</button>
                                                <form class="category-delete-form"
                                                    action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="category-action category-action--delete" type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this record?');">
                                                        Delete
                                                    </button>
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



            <!-- Edit Category Modal -->
            <div id="editModal" class="modal-overlay">
                <div class="modal-content">
                    <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
                    <div class="modal-header">
                        <h2>Edit Category</h2>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" id="categoryName" name="name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn modal-btn--cancel"
                            onclick="closeEditModal()">Cancel</button>
                        <button type="button" class="modal-btn modal-btn--save" onclick="saveCategory()">Save
                            Changes</button>
                    </div>
                </div>
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
        });

        // Modal Functions
        let currentCategoryId = null;

        function openEditModal(categoryId, categoryName) {
            currentCategoryId = categoryId;
            document.getElementById('categoryName').value = categoryName;
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
            currentCategoryId = null;
        }

        function saveCategory() {
            if (!currentCategoryId) return;

            const categoryName = document.getElementById('categoryName').value.trim();
            if (!categoryName) {
                alert('Please enter a category name');
                return;
            }

            const formData = new FormData();
            formData.append('name', categoryName);
            formData.append('_method', 'PUT');
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch(`/admin/categories/${currentCategoryId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Category updated successfully!');
                        location.reload();
                    } else {
                        alert('Error updating category. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating category. Please try again.');
                });
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('editModal').classList.contains('active')) {
                closeEditModal();
            }
        });
    </script>

    @include('admin.layouts.footer')
@endsection

@section('title')
    Category-List
@endsection
