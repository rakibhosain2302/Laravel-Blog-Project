<div class="blogtitle-create">
    <div class="blogtitle-create__head">
        <h3>Add New Blog Title</h3>
        <p>Create a new site title, slogan, and logo that will be displayed in your public header and branding.</p>
    </div>

    <form action="{{ route('blog.title.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="blogtitle-create__grid">
            <div class="blogtitle-create__field">
                <label for="blog_title">Website Title</label>
                <input id="blog_title" type="text" name="title" value="{{ old('title') }}" placeholder="e.g., My Awesome Blog">
                @error('title')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="blogtitle-create__field">
                <label for="blog_slogan">Website Slogan</label>
                <input id="blog_slogan" type="text" name="slogan" value="{{ old('slogan') }}" placeholder="e.g., Your daily insights and stories">
                @error('slogan')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="blogtitle-create__field blogtitle-create__field--full">
                <label for="blog_logo">Website Logo</label>
                <input id="blog_logo" type="file" name="logo" accept="image/png,image/jpeg,image/jpg">
                @error('logo')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="blogtitle-create__actions">
            <button type="button" class="btn-cancel" onclick="document.getElementById('closeBlogTitleModal').click()">Cancel</button>
            <button type="submit" class="btn-save">Save</button>
        </div>
    </form>
</div>

