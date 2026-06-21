<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-brand">
            @if (!empty($titleslogan) && count($titleslogan) > 0)
                @foreach ($titleslogan as $footerData)
                    <h2>{{ $footerData->title }}</h2>
                    <p>{{ $footerData->slogan }}</p>
                @endforeach
            @else
                <h2>{{ config('app.name') }}</h2>
                <p>Your blog subtitle goes here.</p>
            @endif
        </div>
        <div class="footer-socials" aria-label="Social links">
            @foreach ($socialslink as $link)
                <a href="{{ $link->fblink }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <img src="{{ asset('assets/images/fb.png') }}" alt="Facebook" />
                </a>
                <a href="{{ $link->twlink }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                    <img src="{{ asset('assets/images/tw.png') }}" alt="Twitter" />
                </a>
                <a href="{{ $link->lnlink }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <img src="{{ asset('assets/images/in.png') }}" alt="LinkedIn" />
                </a>
                <a href="{{ $link->gllink }}" target="_blank" rel="noopener noreferrer" aria-label="Google Plus">
                    <img src="{{ asset('assets/images/gl.png') }}" alt="Google Plus" />
                </a>
            @endforeach
        </div>
    </div>
    @php
        $copyrightNote = '';
        if (!empty($copyright) && count($copyright) > 0) {
            $copyrightNote = $copyright->first()->note ?? '';
        }
    @endphp
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ trim($copyrightNote) ? $copyrightNote : 'Your Blog Name' }}. All rights reserved.</p>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('assets/js/scrolltop.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
