@if ($editCategory)
    <div class="category-modal {{ request('edit_id') ? 'is-open' : '' }}" id="categoryEditModal" aria-hidden="false">
        <div class="category-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="categoryEditTitle">
            <div class="category-modal__header">
                <div>
                    <div class="category-modal__kicker">Edit category</div>
                    <h2 id="categoryEditTitle">Update category name</h2>
                    <p>Keep the label short, clear, and easy to recognize across your blog structure.</p>
                </div>

                <a class="category-modal__close" href="{{ route('categories.index') }}" aria-label="Close modal">×</a>
            </div>

            <div class="category-modal__body">
                <div class="category-modal__form-panel">
                    <form action="{{ route('categories.update', $editCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="category-modal__field">
                            <label for="name">Category name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                placeholder="Enter category name..."
                                value="{{ old('name', $editCategory->name) }}"
                                autocomplete="off"
                            >
                            <div class="category-modal__helper">
                                Example: News, Tutorials, Reviews, Tips, Features.
                            </div>
                            @error('name')
                                <span class="category-modal__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="category-modal__actions">
                            <a class="category-modal__btn category-modal__btn--back" href="{{ route('categories.index') }}">Cancel</a>
                            <button class="category-modal__btn category-modal__btn--save" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>

                <aside class="category-modal__info">
                    <div class="category-modal__chip">Quick guide</div>
                    <h3>What makes a good category name?</h3>
                    <ul>
                        <li>Use short, descriptive words.</li>
                        <li>Avoid near-duplicate labels.</li>
                        <li>Keep naming consistent with your content tone.</li>
                    </ul>

                    <div class="category-modal__note">
                        A good category name improves search, filtering, and long-term maintenance.
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endif
