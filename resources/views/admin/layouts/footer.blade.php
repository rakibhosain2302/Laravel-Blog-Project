<style>
    .modern-footer {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.92));
        border-top: 1px solid rgba(148, 163, 184, 0.12);
        padding: 20px 0;
        margin-top: 40px;
    }

    .modern-footer p {
        color: #cbd5e1;
        font-size: 14px;
        text-align: center;
        margin: 0;
    }

    .modern-footer a {
        color: #60a5fa;
        text-decoration: none;
        font-weight: 600;
    }

    .modern-footer a:hover {
        color: #93c5fd;
        text-decoration: underline;
    }
</style>

<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="site_info" class="modern-footer">
    @php
        $noteData = \App\Models\Copyright::first();
    @endphp
    <p>
        &copy; Copyright
        <a href="{{ route('home') }}">
            {{ optional($noteData)->note ?? 'Your Website' }} {{ date('Y') }}
        </a>.
        All Rights Reserved.
    </p>
</div>
@yield('scripts')
</body>

</html>
