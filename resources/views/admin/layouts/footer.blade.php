<div class="clear">
</div>
</div>
<div class="clear">
</div>
<div id="site_info">
    @php
        $noteData = \App\Models\Copyright::first();
    @endphp
    <p>
        &copy; Copyright <a href="{{ route('home') }}">{{ $noteData->note . date('Y') }}</a>. All Rights
        Reserved.
    </p>
</div>
</body>

</html>
