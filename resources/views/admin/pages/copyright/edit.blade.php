@if ($data->isNotEmpty())
    <div class="copyright-modal {{ $errors->any() ? 'is-open' : '' }}" id="copyrightEditModal"
        aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
        <div class="copyright-modal__dialog">
            <button type="button" class="copyright-modal__close" id="closeCopyrightEditModal" aria-label="Close modal">
                &times;
            </button>
            <div class="copyright-create">
                <div class="copyright-create__head">
                    <h3>Update Copyright Note</h3>
                    <p>Edit the footer copyright note without leaving the list page.</p>
                </div>

                <form action="{{ route('copyright.update', $activeCopyright->id) }}" method="POST" id="copyrightEditForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="copyright_id" id="copyrightEditId" value="{{ old('copyright_id', $activeCopyright->id) }}">

                    <div class="copyright-create__field">
                        <label for="copyright_edit_note">Copyright Note</label>
                        <input
                            id="copyright_edit_note"
                            type="text"
                            name="note"
                            value="{{ old('note', $activeCopyright->note) }}"
                            placeholder="All rights reserved. Demo content for"
                        >
                        @error('note')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="copyright-modal__actions">
                        <button type="button" class="btn-cancel" id="cancelCopyrightEditModal">Cancel</button>
                        <button type="submit" class="btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
