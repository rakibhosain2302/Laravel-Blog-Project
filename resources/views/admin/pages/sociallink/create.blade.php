<div class="social-create">
    <div class="social-create__head">
        <h3>Add Social Media Links</h3>
        <p>Set the public Facebook, Twitter, LinkedIn, and Google links for the site header/footer.</p>
    </div>

    <form action="{{ route('social.store') }}" method="POST">
        @csrf

        <div class="social-create__grid">
            <div class="social-create__field">
                <label for="social_fb">Facebook</label>
                <input id="social_fb" type="url" name="fblink" value="{{ old('fblink') }}" placeholder="https://facebook.com/your-page">
                @error('fblink')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="social-create__field">
                <label for="social_tw">Twitter</label>
                <input id="social_tw" type="url" name="twlink" value="{{ old('twlink') }}" placeholder="https://x.com/your-handle">
                @error('twlink')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="social-create__field">
                <label for="social_ln">LinkedIn</label>
                <input id="social_ln" type="url" name="lnlink" value="{{ old('lnlink') }}" placeholder="https://linkedin.com/in/your-profile">
                @error('lnlink')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="social-create__field">
                <label for="social_gg">Github</label>
                <input id="social_gg" type="url" name="gllink" value="{{ old('gllink') }}" placeholder="https://google.com/">
                @error('gllink')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="social-create__actions">
            <button type="submit" class="btn-save">Save Social Links</button>
        </div>
    </form>
</div>
