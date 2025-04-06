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
    <link rel="canonical" href="{{ $category->url }}/@if(Request::except('orderby'))?@endif{{ http_build_query(Request::except('orderby')) }}">
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
            <div class="row row-product">
                <div class="col-12 col-md-12">
                    <div class="bread-crumb-box">
                        <div class="bread-crumb-box-item">
                            <a href="/">خانه</a>
                        </div>
                        <div class="bread-crumb-box-item">
                            <a href="{{ route("page.index","shop") }}">محصولات</a>
                        </div>
                        @if(isset($category->parent2))
                            <div class="bread-crumb-box-item">
                                <a href="{{ $category->parent2->url }}">{{ $category->parent2->name }}</a>
                            </div>
                        @endif
                        <div class="bread-crumb-box-item current">
                            <a >{{ $category->name }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  d-none d-md-block">
                    <div class="filter-box mb-4">
                        <div class="filter-title">
                            <span>  جستجو  :</span>
                        </div>
                        <div class="filter-item header-right-search">
                            <form action="/search">
                                <input type="text" value="{{ request()->s }}" name="s" placeholder="جستجو در بین محصولات...">
                                <button>
                                    <svg id="Group_54" data-name="Group 54" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path id="Path_46" data-name="Path 46" d="M0,0H24V24H0Z" fill="none"/>
                                        <circle id="Ellipse_8" data-name="Ellipse 8" cx="8" cy="8" r="8" transform="translate(3 3)" fill="none" stroke="#2F2F2F69" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                        <path id="Path_47" data-name="Path 47" d="M6,6,1.875,1.875" transform="translate(15 15)" fill="none" stroke="#2F2F2F69" stroke-linecap="round" stroke-width="2"/>
                                    </svg>

                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="filter-box mb-4">
                        <div class="filter-title">
                            <span>دسته بندی نتایج :</span>
                        </div>
                        <div class="filter-item">
                            @foreach($categories as $all_category_item)
                                <div class="category-page-list-item">
                                    <a href="{{ $all_category_item->url }}">{{ $all_category_item->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-box mb-4">
                        <div class="filter-title">
                            <span>محدوده قیمت</span>
                        </div>
                        <div class="filter-item header-right-search">
                            <div class="box">
                                <div class="values" style="
    direction: ltr;    display: flex;
    justify-content: space-between;
">
                                    <div style="    direction: ltr;">

                                        <span id="first"></span>
                                        <small style="
    float: left;
    margin-right: 5px;
">
                                            تومان
                                        </small>
                                    </div>
                                    <div style="    direction: ltr;">

                                        <span id="second"></span>
                                        <small style="
    float: left;
    margin-right:5px;
">
                                            تومان
                                        </small>
                                    </div>
                                </div>


                                <div class="slider" data-value-0="#first" data-value-1="#second" data-range="#third"></div>

                            </div>
                        </div>
                    </div>
                    <div class="filter-box">
                        <div class="filter-title filter-title-not d-flex justify-content-between">
                            <span>فقط کالاهای موجود</span>
                            <div class="filter-enable-disable-button filter-btn">
                                <div class="radio-btn"></div>
                                <div class="circle">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-9  ddd">
                    <div class="orderby_page_cat w-100">
                        @php
                            //todo  product orderby
                        @endphp
                        <span>مرتب سازی بر اساس : </span>
                        <a href="?orderby=new" class="@if(!request()->orderby || request()->orderby=="new") active @endif">جدیدترین</a>
                        <a href="?orderby=popularity" class="@if(request()->orderby=="popularity") active @endif">پر فروش ترین</a>
                        <a href="?orderby=price" class="@if(request()->orderby=="price") active @endif">قیمت کم به زیاد</a>
                        <a href="?orderby=price-desc" class="@if(request()->orderby=="price-desc") active @endif">قیمت زیاد به کم</a>
                    </div>

                    <div class="row">
                        @if(!$products->isEmpty())
                            @foreach($products as $product)
                                <div class="col-lg-3 col-6" style="margin-bottom:20px">
                                    @includeIf(config("theme.theme_product_item_path"),["product"=>$product])
                                </div>
                            @endforeach
                                {{ $products->setPath(request()->url()) }}
                        @else
                            <p class="text-center mt-5 w-100 mb-5">محصولی برای نمایش وجود ندارد</p>
                        @endif
                    </div>
                    <div class="product-category-description " >
                        <div class="hidi-title">
                            <strong>{{ $category->name }}</strong>
                        </div>

                        <div class="product-category-content page-post-content">
                            {!! $category->contents !!}
                        </div>

                    </div>
                </div>


            </div>
        </div>
    <style>
       .product-category-description span {
                 font-size: 20px;
                 margin: 27px 0px !important;
                 display: block;
             }.product-category-description p {
                  line-height: 36px;
                  color: #424242;
                  font-weight: 300;
              }.product-category-description p span{ font-size: 15px;
                   margin: 0 !important;
                   display: inline;}.product-category-description {
                                        margin-top: 28px;

                                        transition: .6s;

                                    }
    </style>
        <style>

            .box {
                --primary: rgb(54 100 255);
                --headline: #3F4656;
                --text: #99A3BA;
                width: 100%;
                max-width: 312px;


            }
            .box h3 {
                font-family: inherit;
                font-size: 32px;
                font-weight: 700;
                margin: 0 0 20px 0;
                color: var(--headline);
            }
            .box h3 span {
                font-weight: 500;
            }
            .box .values div,
            .box small div {
                display: inline-block;
                vertical-align: top;
            }
            .box .values {
                margin: 0;
                font-weight: 500;

            }
            .box .values > div:first-child {
                margin-right: 2px;
            }
            .box .values > div:last-child {
                margin-left: 2px;
            }

            .box .slider {
                margin-top: 13px;
            }

            .slider {
                --primary: rgb(54 100 255);
                --handle: #fff;
                --handle-active: #becfff;
                --handle-hover: #e9efff;
                --handle-border: 2px solid rgb(54 100 255);
                --line: #cdd9ed;
                --line-active: rgb(54 100 255);
                height: 23px;
                width: 100%;
                position: relative;
                pointer-events: none;
            }
            .slider .ui-slider-handle {
                --y: 0;
                --background: var(--handle);
                cursor: -webkit-grab;
                cursor: grab;
                -webkit-tap-highlight-color: transparent;
                top: 0;
                width: 23px;
                height: 23px;
                transform: translateX(-50%);
                position: absolute;
                outline: none;
                display: block;
                pointer-events: auto;
            }
            .slider .ui-slider-handle div {
                width: 23px;
                height: 23px;
                border-radius: 50%;
                transition: background 0.4s ease;
                transform: translateY(calc(var(--y) * 1px));
                border: var(--handle-border);
                background: var(--background);
            }
            .slider .ui-slider-handle:hover {
                --background: var(--handle-hover);
            }
            .slider .ui-slider-handle:active {
                --background: var(--handle-active);
                cursor: -webkit-grabbing;
                cursor: grabbing;
            }
            .slider svg {
                --stroke: var(--line);
                display: block;
                height: 83px;
            }
            .slider svg path {
                fill: none;
                stroke: var(--stroke);
                stroke-width: 1;
            }
            .slider .active, .slider > svg {
                position: absolute;
                top: -30px;
                height: 83px;
            }
            .slider > svg {
                left: 0;
                width: 100%;
            }
            .slider .active {
                position: absolute;
                overflow: hidden;
                left: calc(var(--l) * 1px);
                right: calc(var(--r) * 1px);
            }
            .slider .active svg {
                --stroke: var(--line-active);
                position: relative;
                left: calc(var(--l) * -1px);
                right: calc(var(--r) * -1px);
            }
            .slider .active svg path {
                stroke-width: 2;
            }



            body .dribbble {
                position: fixed;
                display: block;
                right: 20px;
                bottom: 20px;
            }
            body .dribbble img {
                display: block;
                height: 28px;
            }
        </style>
@push("js")
    <script>
        var open=true;
        if(jQuery(".product-category-description").height()<340){
            document.querySelector(".open-product-desc").style.cssText="display:none";
            jQuery(".product-category-description").addClass("open");
        }
        jQuery(".open-product-desc").click(function(){
            if(open){
                document.querySelector(".product-category-description").style.cssText="height:"+jQuery(".product-category-description >div").height()+"px";
                jQuery(".product-category-description").addClass("open");
                document.querySelector(".open-product-desc").innerHTML="بستن";
            } else{
                document.querySelector(".product-category-description").style.cssText="height:327px";
                document.querySelector(".open-product-desc").innerHTML="ادامه مطلب";

                jQuery(".product-category-description").removeClass("open");
            }
            open=!open;
        })
    </script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script>
        jQuery(document).ready(function ($){
            $('.slider').each(function(e) {

                var slider = $(this),
                    width = slider.width(),
                    handle,
                    handleObj;

                let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                svg.setAttribute('viewBox', '0 0 ' + width + ' 83');

                slider.html(svg);
                slider.append($('<div>').addClass('active').html(svg.cloneNode(true)));

                slider.slider({
                    range: true,
                    values: [{{ $cheapest_product?$cheapest_product->regular_price:0 }}, {{ $expensive_product?$expensive_product->regular_price:0 }}],
                    min: {{ $cheapest_product?$cheapest_product->regular_price:0 }},
                    step: 5,
                    minRange: 1000,
                    max: {{ $expensive_product?$expensive_product->regular_price:0 }},
                    create(event, ui) {

                        slider.find('.ui-slider-handle').append($('<div />'));

                        $(slider.data('value-0')).html(slider.slider('values', 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                        $(slider.data('value-1')).html(slider.slider('values', 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                        $(slider.data('range')).html((slider.slider('values', 1) - slider.slider('values', 0)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));

                        setCSSVars(slider);

                    },
                    start(event, ui) {

                        $('body').addClass('ui-slider-active');

                        handle = $(ui.handle).data('index', ui.handleIndex);
                        handleObj = slider.find('.ui-slider-handle');

                    },
                    change(event, ui) {
                        setCSSVars(slider);
                    },
                    slide(event, ui) {

                        let min = slider.slider('option', 'min'),
                            minRange = slider.slider('option', 'minRange'),
                            max = slider.slider('option', 'max');

                        if(ui.handleIndex == 0) {
                            if((ui.values[0] + minRange) >= ui.values[1]) {
                                slider.slider('values', 1, ui.values[0] + minRange);
                            }
                            if(ui.values[0] > max - minRange) {
                                return false;
                            }
                        } else if(ui.handleIndex == 1) {
                            if((ui.values[1] - minRange) <= ui.values[0]) {
                                slider.slider('values', 0, ui.values[1] - minRange);
                            }
                            if(ui.values[1] < min + minRange) {
                                return false;
                            }
                        }

                        $(slider.data('value-0')).html(ui.values[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                        $(slider.data('value-1')).html(ui.values[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                        $(slider.data('range')).html((slider.slider('values', 1) - slider.slider('values', 0)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));

                        setCSSVars(slider);

                    },
                    stop(event, ui) {

                        $('body').removeClass('ui-slider-active');

                        let duration = .6,
                            ease = Elastic.easeOut.config(1.08, .44);

                        TweenMax.to(handle, duration, {
                            '--y': 0,
                            ease: ease
                        });

                        TweenMax.to(svgPath, duration, {
                            y: 42,
                            ease: ease
                        });

                        handle = null;

                    }
                });

                var svgPath = new Proxy({
                    x: null,
                    y: null,
                    b: null,
                    a: null
                }, {
                    set(target, key, value) {
                        target[key] = value;
                        if(target.x !== null && target.y !== null && target.b !== null && target.a !== null) {
                            slider.find('svg').html(getPath([target.x, target.y], target.b, target.a, width));
                        }
                        return true;
                    },
                    get(target, key) {
                        return target[key];
                    }
                });

                svgPath.x = width / 2;
                svgPath.y = 42;
                svgPath.b = 0;
                svgPath.a = width;

                $(document).on('mousemove touchmove', e => {
                    if(handle) {

                        let laziness = 4,
                            max = 24,
                            edge = 52,
                            other = handleObj.eq(handle.data('index') == 0 ? 1 : 0),
                            currentLeft = handle.position().left,
                            otherLeft = other.position().left,
                            handleWidth = handle.outerWidth(),
                            handleHalf = handleWidth / 2,
                            y = e.pageY - handle.offset().top - handle.outerHeight() / 2,
                            moveY = (y - laziness >= 0) ? y - laziness : (y + laziness <= 0) ? y + laziness : 0,
                            modify = 1;

                        moveY = (moveY > max) ? max : (moveY < -max) ? -max : moveY;
                        modify = handle.data('index') == 0 ? ((currentLeft + handleHalf <= edge ? (currentLeft + handleHalf) / edge : 1) * (otherLeft - currentLeft - handleWidth <= edge ? (otherLeft - currentLeft - handleWidth) / edge : 1)) : ((currentLeft - (otherLeft + handleHalf * 2) <= edge ? (currentLeft - (otherLeft + handleWidth)) / edge : 1) * (slider.outerWidth() - (currentLeft + handleHalf) <= edge ? (slider.outerWidth() - (currentLeft + handleHalf)) / edge : 1));
                        modify = modify > 1 ? 1 : modify < 0 ? 0 : modify;

                        if(handle.data('index') == 0) {
                            svgPath.b = currentLeft / 2  * modify;
                            svgPath.a = otherLeft;
                        } else {
                            svgPath.b = otherLeft + handleHalf;
                            svgPath.a = (slider.outerWidth() - currentLeft) / 2 + currentLeft + handleHalf + ((slider.outerWidth() - currentLeft) / 2) * (1 - modify);
                        }

                        svgPath.x = currentLeft + handleHalf;
                        svgPath.y = moveY * modify + 42;

                        handle.css('--y', moveY * modify);

                    }
                });

            });

            function getPoint(point, i, a, smoothing) {
                let cp = (current, previous, next, reverse) => {
                        let p = previous || current,
                            n = next || current,
                            o = {
                                length: Math.sqrt(Math.pow(n[0] - p[0], 2) + Math.pow(n[1] - p[1], 2)),
                                angle: Math.atan2(n[1] - p[1], n[0] - p[0])
                            },
                            angle = o.angle + (reverse ? Math.PI : 0),
                            length = o.length * smoothing;
                        return [current[0] + Math.cos(angle) * length, current[1] + Math.sin(angle) * length];
                    },
                    cps = cp(a[i - 1], a[i - 2], point, false),
                    cpe = cp(point, a[i - 1], a[i + 1], true);
                return `C ${cps[0]},${cps[1]} ${cpe[0]},${cpe[1]} ${point[0]},${point[1]}`;
            }

            function getPath(update, before, after, width) {
                let smoothing = .16,
                    points = [
                        [0, 42],
                        [before <= 0 ? 0 : before, 42],
                        update,
                        [after >= width ? width : after, 42],
                        [width, 42]
                    ],
                    d = points.reduce((acc, point, i, a) => i === 0 ? `M ${point[0]},${point[1]}` : `${acc} ${getPoint(point, i, a, smoothing)}`, '');
                return `<path d="${d}" />`;
            }

            function setCSSVars(slider) {
                let handle = slider.find('.ui-slider-handle');
                slider.css({
                    '--l': handle.eq(0).position().left + handle.eq(0).outerWidth() / 2,
                    '--r': slider.outerWidth() - (handle.eq(1).position().left + handle.eq(1).outerWidth() / 2)
                });
            }
        })
    </script>
    <script>

        jQuery(".filter-btn").click(function (){
            if(this.classList.contains("filter-enable-disable-button")){
                jQuery(this).toggleClass("open")
            }
        })

        var open=true;
        if(jQuery(".product-category-description >.product-category-content").height()<340){
            document.querySelector(".open-product-desc").style.cssText="display:none";
            jQuery(".product-category-description").addClass("open");
        }
        jQuery(".open-product-desc").click(function(){
            if(open){
                document.querySelector(".product-category-description").style.cssText="height:"+jQuery(".product-category-description >.product-category-content").height()+"px";
                jQuery(".product-category-description").addClass("open");
                document.querySelector(".open-product-desc").innerHTML="بستن";
            } else{
                document.querySelector(".product-category-description").style.cssText="height:320px";
                document.querySelector(".open-product-desc").innerHTML="ادامه مطلب";

                jQuery(".product-category-description").removeClass("open");
            }
            open=!open;
        })
    </script>
@endpush
@endsection
