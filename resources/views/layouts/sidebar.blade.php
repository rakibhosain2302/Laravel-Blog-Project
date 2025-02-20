<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('category.filter', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        @foreach ($latestPosts as $post)
            <div class="popular clear">
                <h3><a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a></h3>
                <a href="{{ route('showPost', $post->id) }}"><img src=" {{ asset('storage/'. $post->images) }} " alt="post image" /></a>
                <p style="text-align: justify">{{ Str::limit($post->discription, 135) }}</p>
            </div>
        @endforeach
    </div>

</div>
</div>
