@extends(config("theme.theme_mainContent_path"))

@section("title")
    @if(isset($article->post_meta_array["meta_title"]) && !is_null($article->post_meta_array["meta_title"])){{ $article->post_meta_array["meta_title"] }}@else{{ $article->title }}@endif
@endsection

@section("meta")
    <meta name="description" content="@if(isset($article->post_meta_array["meta_description"]) && !is_null($article->post_meta_array["meta_description"])){{ $article->post_meta_array["meta_description"] }}@else{{ strip_tags($article->post_excerpt_limited) }}@endif">
    <meta name="robots" content="@if(isset($article->post_meta_array["meta_follow"]) && !is_null($article->post_meta_array["meta_follow"])){{ $article->post_meta_array["meta_follow"] }}@endif, @if(isset($article->post_meta_array["meta_index"]) && !is_null($article->post_meta_array["meta_index"])){{ $article->post_meta_array["meta_index"] }}@endif">
    <link rel="canonical" href="{{ $article->url }}/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="@if(isset($article->post_meta_array["meta_title"]) && !is_null($article->post_meta_array["meta_title"])){{ $article->post_meta_array["meta_title"] }}@else{{ $article->title }}@endif">
    <meta property="og:description" content="@if(isset($article->post_meta_array["meta_description"]) && !is_null($article->post_meta_array["meta_description"])){{ $article->post_meta_array["meta_description"] }}@else{{ strip_tags($article->post_excerpt_limited) }}@endif">
    <meta property="og:url" content="{{ $article->url }}">
    <meta property="og:site_name" content="{{ get_site_title() }}">
    <meta property="og:updated_time" content="{{ $article->updated_at }}">
    <meta property="og:image" content="{{asset(store_image_link($article->media_id)) }}">
    <meta property="og:image:secure_url" content="{{asset(store_image_link($article->media_id)) }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="400">
    <meta property="og:image:alt" content="{{ $article->title }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@if(isset($article->post_meta_array["meta_title"]) && !is_null($article->post_meta_array["meta_title"])){{ $article->post_meta_array["meta_title"] }}@else{{ $article->title }}@endif">
    <meta name="twitter:description" content="@if(isset($article->post_meta_array["meta_description"]) && !is_null($article->post_meta_array["meta_description"])){{ $article->post_meta_array["meta_description"] }}@else{{ strip_tags($article->post_excerpt_limited) }}@endif">
    <meta name="twitter:image" content="{{asset(store_image_link($article->media_id)) }}">


@endsection
@section("schema")

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ $article->url }}/"
  },
  "headline": "@if(isset($article->post_meta_array["meta_title"]) && !is_null($article->post_meta_array["meta_title"])){{ $article->post_meta_array["meta_title"] }}@else{{ $article->title }}@endif",
  "description": "@if(isset($article->post_meta_array["meta_description"]) && !is_null($article->post_meta_array["meta_description"])){{ $article->post_meta_array["meta_description"] }}@else{{ strip_tags($article->post_excerpt_limited) }}@endif",
  "image": "{{asset(store_image_link($article->media_id)) }}",
"author": {
    "@type": "Person",
    "name": "hidi team"
  },
  "publisher": {
    "@type": "Organization",
    "name": "hidi team",
    "logo": {
      "@type": "ImageObject",
      "url": "https://hidilady.com/hidi/img/logo.png"
    }
  },
  "datePublished": "{{ $article->created_at }}",
  "dateModified": "{{ $article->updated_at }}"
}
</script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,

            "name": "mag",
            "item": "https://hidilady.com/mag"
        },
@if(isset($article->category[0]))
            {
              "@type": "ListItem",
              "position": 2,
              "name": "{{ $article->category[0]->name }}",
    "item": "{{ $article->category[0]->url }}"
  },
  @endif
        {
          "@type": "ListItem",
          "position": @if(isset($article->category[0])) 3 @else 2 @endif,
    "name": "{{ $article->title }}",
     "item": "{{ $article->url }}"
  }
         ]
       }
</script>
@endsection
@section("content")


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-crumb-box">
                    <div class="bread-crumb-box-item">
                        <a href="/">خانه</a>
                    </div>
                    <div class="bread-crumb-box-item">
                        <a href="{{ route("page.index","blog") }}">وبلاگ</a>
                    </div>
                    @if(isset($article->category[0]))
                        <div class="bread-crumb-box-item">
                            <a href="{{ $article->category[0]->url }}">{{ $article->category[0]->name }}</a>
                        </div>
                    @endif
                    <div class="bread-crumb-box-item current">
                        <a href="#">{{ $article->title }}</a>
                    </div>
                </div>
            </div>



            <div class="col-lg-9">
                <div class="page-post-content">
                    <div class="page-post-img">
                        <h1 style="    font-size: 25px;margin-bottom: 25px;">{{ $article->title }}</h1>
                        <div>
                            <img data-src="{{asset(store_image_link($article->media_id)) }}" alt="{{ !empty($article->media->alt) ?$article->media->alt: $article->title }}" >
                        </div>
                    </div>
                    <article>

                        <div class="page-post-content-content">
                            {!! $article->content !!}
                        </div>
                    </article>
                </div>
                <div class="hidi-title">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>
                                <svg class="ml-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 0L13.3214 7.67864L21 12.5L13.3214 13.3214L8.5 21L7.67864 13.3214L0 8.5L7.67864 7.67864L12.5 0Z" fill="rgb(54 100 255)"/>
                                </svg>

                                مقالات مرتبط
                            </h2>
                        </div>
                        <div class="col-md-9">
                            <svg class="w-100" width="941" height="2" viewBox="0 0 941 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="0.75" y1="1.25" x2="940.25" y2="1.25008" stroke="#EAEAEA" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="5 5"/>
                            </svg>

                        </div>

                    </div>
                </div>
                <div class="">
                    <div class="owl-carousel owl-rtl owl-post2 owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @foreach($related_articles as $article)
                                    <div class="owl-item">
                                        @include("Theme::hidi.article_item",["article"=>$article])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="post-item-review">
                    <div class="hidi-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>
                                    <svg class="ml-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5 0L13.3214 7.67864L21 12.5L13.3214 13.3214L8.5 21L7.67864 13.3214L0 8.5L7.67864 7.67864L12.5 0Z" fill="rgb(54 100 255)"/>
                                    </svg>

                                    نظرات کاربران
                                </h2>
                            </div>
                            <div class="col-md-9">
                                <svg class="w-100" width="941" height="2" viewBox="0 0 941 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0.75" y1="1.25" x2="940.25" y2="1.25008" stroke="#EAEAEA" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="5 5"/>
                                </svg>

                            </div>

                        </div>
                    </div>

                    <div>
                        @includeIf(config("theme.theme_comment_path"),["comments"=>$comments])
                        @includeIf(config("theme.theme_comment_form_path"),["post_id"=>$article->id,"post_type"=>"article"])
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 page-blog-left-box sticky-sidebar">
                <style>
                    .sticky-sidebar .price del span.woocommerce-Price-currencySymbol {
                        display: none;
                    }
                    .sticky-sidebar .price {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        min-width: 100%;
                    }
                    .page-blog-left-box-item-content {
                        width: 55%;
                    }
                </style>
                <div class="theiaStickySidebar">
                    <div class="hidi-title">
                        <strong>
                            مقالات پیشنهادی
                        </strong>

                    </div>
                    <div class="most-viewed-articles">
                        @foreach($random_articles as $article)
                            <div class="page-blog-left-box-item">
                                @include("Theme::hidi.article_item",["article"=>$article])
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="theiaStickySidebar-social">
                    <img data-src="{{ theme_asset("img/instagram.png") }}" alt="">
                    <img  data-src="{{ theme_asset("img/tel.png") }}" alt="">
                </div>


                <div class="blog-section-offer section-offer-product mt-4">
                    <div class="container">
                        <div class="hidi-title  hidi-title-center mb-2">
                            <strong>
                                محصولات پیشنهادی
                            </strong>
                        </div>
                        <div class="row ">
                            <div class="owl-carousel owl-rtl owl-product3 owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                        @foreach($products as $product)
                                            <div class="owl-item">
                                                @include("Theme::hidi.product_item",["product"=>$product])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
