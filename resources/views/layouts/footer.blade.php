<div class="footersection templete clear">
    <div class="footermenu clear">
      <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          @foreach ($navPage as $nav)
          <li>
              <a href="{{ Route('single.page', $nav->id) }}">
                  {{ $nav->name }}
              </a>
          </li>
      @endforeach
          <li><a href="{{ route('contract') }}">Contact</a></li>
      </ul>
    </div>
    @foreach ( $copyright as $noteData)
      
    @endforeach
    <p>&copy; Copyright- {{ $noteData->note. date('Y') }}.</p>
  </div>
  <div class="fixedicon clear">
    @foreach ($socialslink as $link)
    <a href="{{ $link->fblink }}"><img src="{{ asset('assets/images/fb.png') }}" alt="Facebook"/></a>
    <a href="{{ $link->twlink }}"><img src="{{asset('assets/images/tw.png')}}" alt="Twitter"/></a>
    <a href="{{ $link->lnlink }}"><img src="{{ asset('assets/images/in.png') }}" alt="LinkedIn"/></a>
    <a href="{{ $link->gllink }}"><img src="{{ asset('assets/images/gl.png') }}" alt="GooglePlus"/></a>
    @endforeach
  </div>
<script type="text/javascript" src=" {{ asset('assets/js/scrolltop.js') }}"></script>
</body>
</html>