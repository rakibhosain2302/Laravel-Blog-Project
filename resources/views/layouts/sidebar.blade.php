<aside class="sidebar">
    <div class="widget widget-categories">
        <div class="widget-title">Categories</div>
        <ul class="category-list">
            @foreach ($categories as $category)
                <li><a href="{{ route('category.filter', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="widget widget-latest-posts">
        <div class="widget-title">Latest Articles</div>
        @foreach ($latestPosts as $post)
            <article class="recent-post">
                <a href="{{ route('showPost', $post->id) }}">
                    <img class="recent-post__thumb" src="{{ asset('storage/' . $post->images) }}" alt="{{ $post->title }}" loading="lazy" />
                </a>
                <div class="recent-post__body">
                    <h3 class="recent-post__title"><a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a></h3>
                    <p class="recent-post__excerpt">{{ Str::limit($post->discription, 135) }}</p>
                </div>
            </article>
        @endforeach
    </div>
</aside>
