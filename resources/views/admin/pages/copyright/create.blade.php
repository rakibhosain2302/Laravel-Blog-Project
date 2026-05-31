<div class="copyright-create">
    <div class="copyright-create__head">
        <h3>Add Copyright Text</h3>
        <p>Set the footer copyright note for the public site.</p>
    </div>

    <form action="{{ route('copyright.store') }}" method="POST">
        @csrf

        <div class="copyright-create__field">
            <label for="copyright_note">Copyright Note</label>
            <input id="copyright_note" type="text" name="note" value="{{ old('note') }}" placeholder="All rights reserved. Demo content for">
            @error('note')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="copyright-create__actions">
            <button type="submit" class="btn-save">Save Copyright</button>
        </div>
    </form>
</div>
