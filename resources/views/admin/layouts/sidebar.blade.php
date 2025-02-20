<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                @if (in_array(auth()->user()->role->name, ['Admin', 'Editor']))
                <li><a class="menuitem">Site Option</a>
                    @php
                        $data = \App\Models\Titleslogan::first();
                        $socials = \App\Models\Social::first();
                        $copyright = \App\Models\Copyright::first();
                    @endphp

                    <ul class="submenu">
                        <li><a href="{{ route('title.slogan', $data->id) }}">Title & Slogan</a></li>
                        <li><a href="{{ route('social', $socials->id) }}">Social Media</a></li>
                        <li><a href="{{ route('copyright', $copyright->id) }}">Copyright</a></li>
                    </ul>
                </li>
                @endif

                @if (in_array(auth()->user()->role->name, ['Admin', 'Editor']))
                    <li><a class="menuitem">Pages Option</a>
                        <ul class="submenu">
                            <li><a href="{{ route('page.create') }}">Add New Page</a></li>
                            <li><a href="{{ route('page.index') }}">Page List</a></li>
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role->name, ['Admin', 'Editor']))
                <li><a class="menuitem">Slider Option</a>
                    <ul class="submenu">
                        <li><a href="{{ route('slider.create') }}">Add New Slider</a></li>
                        <li><a href="{{ route('slider.index') }}">Slider List</a></li>
                    </ul>
                </li>
                @endif
                @if (in_array(auth()->user()->role->name, ['Admin', 'Editor']))
                <li><a class="menuitem">Category Option</a>
                    <ul class="submenu">
                        <li><a href="{{ route('categories.create') }}">Add Category</a> </li>
                        <li><a href="{{ route('categories.index') }}">Category List</a> </li>
                    </ul>
                </li>
                @endif
                <li><a class="menuitem">Post Option</a>
                    <ul class="submenu">
                        <li><a href="{{ Route('posts.create') }}">Add Post</a> </li>
                        <li><a href="{{ Route('posts.index') }}">Post List</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
