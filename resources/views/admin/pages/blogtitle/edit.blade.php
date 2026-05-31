@if ($data->isNotEmpty())
    <div class="blogtitle-modal {{ $errors->any() ? 'is-open' : '' }}" id="blogTitleEditModal"
        aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
        <div class="blogtitle-modal__dialog">
            <button type="button" class="blogtitle-modal__close" id="closeBlogTitleEditModal" aria-label="Close modal">
                &times;
            </button>

            <div class="blogtitle-create">
                <div class="blogtitle-create__head">
                    <h3>Update Blog Title</h3>
                    <p>Edit the site title, slogan, and logo without leaving the list page.</p>
                </div>

                <form action="{{ route('title.slogan.update', $activeTitle->id) }}" method="POST"
                    enctype="multipart/form-data" id="blogTitleEditForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title_id" id="blogTitleEditId" value="{{ old('title_id', $activeTitle->id) }}">

                    <div class="blogtitle-create__grid">
                        <div class="blogtitle-create__field">
                            <label for="blogtitle_edit_title">Website Title</label>
                            <input
                                id="blogtitle_edit_title"
                                type="text"
                                name="title"
                                value="{{ old('title', $activeTitle->title) }}"
                                placeholder="Enter website title"
                            />
                            @error('title')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="blogtitle-create__field">
                            <label for="blogtitle_edit_slogan">Website Slogan</label>
                            <input
                                id="blogtitle_edit_slogan"
                                type="text"
                                name="slogan"
                                value="{{ old('slogan', $activeTitle->slogan) }}"
                                placeholder="Enter website slogan"
                            />
                            @error('slogan')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="blogtitle-create__field blogtitle-create__field--full">
                            <label for="blogtitle_edit_logo">Website Logo</label>
                            <input
                                id="blogtitle_edit_logo"
                                type="file"
                                name="logo"
                                onchange="document.querySelector('#blogtitle_edit_preview').src = window.URL.createObjectURL(this.files[0]); document.querySelector('#blogtitle_edit_preview').style.display = 'block';"
                            />
                            @error('logo')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                            <div class="blogtitle-preview">
                                @if ($activeTitle->logo)
                                    <img
                                        id="blogtitle_edit_preview"
                                        class="blogtitle-preview__img"
                                        src="{{ asset('storage/' . $activeTitle->logo) }}"
                                        alt="Current logo"
                                    >
                                @else
                                    <img
                                        id="blogtitle_edit_preview"
                                        class="blogtitle-preview__img"
                                        src=""
                                        alt="Current logo"
                                        style="display: none;"
                                    >
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="blogtitle-modal__actions">
                        <button type="button" class="btn-cancel" id="cancelBlogTitleEditModal">Cancel</button>
                        <button type="submit" class="btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
