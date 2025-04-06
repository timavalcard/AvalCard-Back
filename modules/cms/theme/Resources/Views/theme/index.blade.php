@extends(config("theme.theme_mainContent_path"))

@section("title",get_site_title())


@section("meta")
    <meta name="description" content="{{ get_site_description() }}" />
    <meta name="robots" content="follow, index">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:image" content="https://hidi.com/hidi/img/logo.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ get_site_title() }}">
    <meta property="og:description" content="{{ get_site_description() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{get_site_title() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ get_site_title() }}">
    <meta name="twitter:description" content="{{ get_site_description()  }}">
@endsection

@section("content")

@endsection



