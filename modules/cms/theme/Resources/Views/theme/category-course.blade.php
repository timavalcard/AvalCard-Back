@extends(config("theme.theme_mainContent_path"))

@section("title")
    @if(isset($category->post_meta_array["meta_title"])  && !is_null($category->post_meta_array["meta_title"])){{ $category->post_meta_array["meta_title"] }}@else{{ $category->name }}@endif
@endsection

@section("meta")
    @php
        $content=strip_tags($category->contents)
    @endphp
    <meta name="description" content="@if(isset($category->post_meta_array["meta_description"]) && !is_null($category->post_meta_array["meta_description"])){{ $category->post_meta_array["meta_description"] }}@else{{ substrwords($content,200) }}@endif">
    <meta name="robots" content="@if(isset($category->post_meta_array["meta_follow"]) && !is_null($category->post_meta_array["meta_follow"])){{ $category->post_meta_array["meta_follow"] }}@endif, @if(isset($category->post_meta_array["meta_index"]) && !is_null($category->post_meta_array["meta_index"])){{ $category->post_meta_array["meta_index"] }}@endif">
    <link rel="canonical" href="{{ $category->url }}/">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="article">
    <meta property="og:title" content="@if(isset($category->post_meta_array["meta_title"]) && !is_null($category->post_meta_array["meta_title"])){{ $category->post_meta_array["meta_title"] }}@else{{ $category->name }}@endif">
    <meta property="og:description" content="@if(isset($category->post_meta_array["meta_description"]) && !is_null($category->post_meta_array["meta_description"])){{ $category->post_meta_array["meta_description"] }}@else{{ substrwords($content,200) }}@endif">
    <meta property="og:url" content="{{ $category->url }}">
    <meta property="og:site_name" content="{{ get_site_title() }}">
    <meta property="og:updated_time" content="{{ $category->updated_at }}">
    <meta property="og:image" content="{{asset(store_image_link($category->media_id)) }}">
    <meta property="og:image:secure_url" content="{{asset(store_image_link($category->media_id)) }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="400">
    <meta property="og:image:alt" content="{{ $category->name }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@if(isset($category->post_meta_array["meta_title"]) && !is_null($category->post_meta_array["meta_title"])){{ $category->post_meta_array["meta_title"] }}@else{{ $category->name }}@endif">
    <meta name="twitter:description" content="@if(isset($category->post_meta_array["meta_description"]) && !is_null($category->post_meta_array["meta_description"])){{ $category->post_meta_array["meta_description"] }}@else{{ substrwords($content,200) }}@endif">
    <meta name="twitter:image" content="{{asset(store_image_link($category->media_id)) }}">
@endsection

@section("content")
        <div class="container">
            <div class="category-course-content">
                <div class="category-course-title">
                    <h1>{{ $category->name }}</h1>
                </div>
                <div class="category-course-text" >
                    {!! $category->contents !!}

                </div>
            </div>
            <div class="category-course-courses">
                <div class="row">
                    @foreach($category->courses as $course )
                        <div class="col-md-4">
                            @include("Theme::hidi.course_item",["course"=>$course])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

@endsection
