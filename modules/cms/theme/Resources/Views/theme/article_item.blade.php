<a href="{{ $article->url }}">
    <div class="blog-item post">
        <div class="blog-item-img">
            <img src="{{asset(store_image_link($article->media_id)) }}" data-src="{{asset(store_image_link($article->media_id)) }}" alt="{{ !empty($article->media->alt) ?$article->media->alt: $article->title }}" >
        </div>
        <div class="blog-item-content">
            <strong>
                {{ $article->title }}
            </strong>

            {{--{!! $article->post_excerpt !!}--}}



            <div class="blog-item-content-bottom">
                <div class="blog-item-icons">
                    <span>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->format('Y/m/d')  }}</span>
                </div>
            </div>
        </div>
    </div>
</a>
