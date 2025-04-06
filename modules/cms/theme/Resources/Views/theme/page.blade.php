@extends(config("theme.theme_mainContent_path"))

@section("title")
    @if(isset($page->post_meta_array["meta_title"])  && !is_null($page->post_meta_array["meta_title"])){{ $page->post_meta_array["meta_title"] }}@else{{ $page->title }}@endif
@endsection

@section("meta")
    <meta name="description" content="@if(isset($page->post_meta_array["meta_description"]) && !is_null($page->post_meta_array["meta_description"])){{ $page->post_meta_array["meta_description"] }}@endif" />
    <meta name="robots" content="@if(isset($page->post_meta_array["meta_index"])){{ $page->post_meta_array["meta_index"] }}@endif,@if(isset($page->post_meta_array["meta_follow"]) && !is_null($page->post_meta_array["meta_follow"])){{ $page->post_meta_array["meta_follow"] }}@endif">
    <link rel="canonical" href="{{ url()->current() }}/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="page">
    <meta property="og:title" content="@if(isset($page->post_meta_array["meta_title"]) && !is_null($page->post_meta_array["meta_title"])){{ $page->post_meta_array["meta_title"] }}@else{{ $page->title }}@endif">
    <meta property="og:url" content="{{ $page->url }}">
    <meta property="og:site_name" content="{{ get_site_title() }}">
    <meta property="og:updated_time" content="{{ $page->updated_at }}">
    <meta name="twitter:title" content="@if(isset($page->post_meta_array["meta_title"]) && !is_null($page->post_meta_array["meta_title"])){{ $page->post_meta_array["meta_title"] }}@else{{ $page->title }}@endif">
@endsection

@section("schema")

    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "{{ $page->title }}",
    "item": "{{ $page->url }}"
  }]
       }
</script>
@endsection
@section("content")
        <div class="container">
            <div class="rows">
             {!! $page->content !!}
            </div>
        </div>

@endsection
