<aside class="sidebar">
    <div class="widget widget-categories">
        <div class="widget-title"><span class="title-body">Categories</span></div>
        <ul class="category-list">
            @foreach ($categories as $category)
                <li><a href="{{ route('category.filter', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="widget widget-latest-posts">
        <div class="widget-title"><span class="title-body">Latest Articles</span></div>
        @foreach ($latestPosts as $post)
            <article class="recent-post">
                <div class="recent-post__body">
                    <h3 class="recent-post__title ms-1"><a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a></h3>
                </div>
                <a href="{{ route('showPost', $post->id) }}">
                    <img class="recent-post__thumb" src="{{ asset('storage/' . $post->images) }}" alt="{{ $post->title }}" loading="lazy" />
                </a>
            </article>
        @endforeach
    </div>
</aside>
