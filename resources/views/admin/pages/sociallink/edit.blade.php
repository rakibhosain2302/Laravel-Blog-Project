@php
    $activeSocial = $data->first();
@endphp

@if ($data->isNotEmpty())
    <div
        class="social-modal {{ $errors->any() ? 'is-open' : '' }}"
        id="socialEditModal"
        aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
    >
        <div class="social-modal__dialog">
            <button
                type="button"
                class="social-modal__close"
                id="closeSocialEditModal"
                aria-label="Close modal"
            >&times;</button>

            <div class="social-create">
                <div class="social-create__head">
                    <h3>Update Social Media Links</h3>
                    <p>Edit the public social links without leaving the list page.</p>
                </div>

                <form action="{{ route('social.update', $activeSocial->id) }}" method="POST" id="socialEditForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="social_id" id="socialEditId" value="{{ old('social_id', $activeSocial->id) }}">

                    <div class="social-create__grid">
                        <div class="social-create__field">
                            <label for="social_edit_fb">Facebook</label>
                            <input
                                id="social_edit_fb"
                                type="url"
                                name="fblink"
                                value="{{ old('fblink', $activeSocial->fblink) }}"
                                placeholder="https://facebook.com/your-page"
                            >
                            @error('fblink')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="social-create__field">
                            <label for="social_edit_tw">Twitter</label>
                            <input
                                id="social_edit_tw"
                                type="url"
                                name="twlink"
                                value="{{ old('twlink', $activeSocial->twlink) }}"
                                placeholder="https://x.com/your-handle"
                            >
                            @error('twlink')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="social-create__field">
                            <label for="social_edit_ln">LinkedIn</label>
                            <input
                                id="social_edit_ln"
                                type="url"
                                name="lnlink"
                                value="{{ old('lnlink', $activeSocial->lnlink) }}"
                                placeholder="https://linkedin.com/in/your-profile"
                            >
                            @error('lnlink')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="social-create__field">
                            <label for="social_edit_gg">Github</label>
                            <input
                                id="social_edit_gg"
                                type="url"
                                name="gllink"
                                value="{{ old('gllink', $activeSocial->gllink) }}"
                                placeholder="https://github.com/your-username"
                            >
                            @error('gllink')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="social-modal__actions">
                        <button type="button" class="btn-cancel" id="cancelSocialEditModal">Cancel</button>
                        <button type="submit" class="btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
