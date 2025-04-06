<!DOCTYPE html>

<html lang="fa" xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css">

    <title>@yield("title")</title>

    @yield("meta")


    <link href="{{ theme_asset("css/fonts.css?ver=2") }}" rel="stylesheet">
    <link rel="stylesheet" id="owl.carousel-css" href="{{ theme_asset("css/owl.carousel.min.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="owl-theme-css" href="{{ theme_asset("css/owl.theme.default.min.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="hidi-stylee-css" href="{{ theme_asset("css/style.css?ver=".time()) }}" type="text/css" media="all">
    <link rel="stylesheet" id="hidi-stylee-css" href="{{ theme_asset("css/cart_and_checkout.css?ver=".time()) }}" type="text/css" media="all">
    <link rel="stylesheet" id="responsivee-css" href="{{ theme_asset("css/responsive.css") }}" type="text/css" media="all">

    @stack("css")


    @yield("schema")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>



</head>
<body>
<script>
    function openMegaMenuFunc(e){let t=$(".mega_menu_container");for(let a=0;a<t.length;a++)t[a].id!="megaMenu"+`${e}`&&(t[a].style.display="none");$("#megaMenu"+`${e}`).stop().slideDown(400)}
    function closeMegaMenuFunc(e){let t=$(".mega_menu_container");for(let a=0;a<t.length;a++)t[a].id!="megaMenu"+`${e}`&&(t[a].style.display="none");$("#megaMenu"+`${e}`).stop().slideUp(400)}
    function activeCategory(e,t){let a=$(".cancelMouseEvent");
        a.on("mouseover mouseenter mouseleave mouseup mousedown",function(){return!1}),$(e.target).siblings().not(a).removeClass("activeParent"),e.target.classList.add("activeParent");let n=$("#subService"+`${t}`);n.removeClass("d_none_important"),n.siblings(".children").addClass("d_none_important")}
    function activeProductCategory(e,t){let a=$(".cancelMouseEvent");a.on("mouseover mouseenter mouseleave mouseup mousedown",function(){return!1}),$(e.target).siblings().not(a).removeClass("activeParent"),e.target.classList.add("activeParent");let n=$("#subProduct"+`${t}`);n.removeClass("d_none_important"),n.siblings(".children").addClass("d_none_important")}

</script>

@includeIf("Theme::hidi.admin_bar")

@if(!isset($header) || $header!=false)

@endif

