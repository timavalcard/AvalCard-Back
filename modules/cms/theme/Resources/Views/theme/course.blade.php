@extends(config("theme.theme_mainContent_path"))

@section("title")
    {{ $course->title }}
@endsection

@section("meta")
    <meta name="description" content="{{ strip_tags($course->body) }}">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <link rel="canonical" href="{{ $course->url }}/">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="course">
    <meta property="og:title" content="{{ $course->title }}">
    <meta property="og:description" content="{{ strip_tags($course->body) }}">
    <meta property="og:url" content="{{ $course->url }}">
    <meta property="og:site_name" content="{{ get_site_title() }}">
    <meta property="og:updated_time" content="{{ $course->updated_at }}">
    <meta property="og:image" content="{{asset(store_image_link($course->media_id)) }}">
    <meta property="og:image:secure_url" content="{{asset(store_image_link($course->media_id)) }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="400">
    <meta property="og:image:alt" content="{{ $course->title }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $course->title }}">
    <meta name="twitter:description" content="{{ strip_tags($course->body) }}">
    <meta name="twitter:image" content="{{asset(store_image_link($course->media_id)) }}">


@endsection


@section("content")

    <div class="container">
        <div class="course-top-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-course-title">
                        <h1>{{ $course->title }}</h1>
                    </div>
                    <div class="course-item-content-price">
                        <div class="single-course-type">
                            @if($course->course_type == "video")
                                <span class="course-type course-video">
                        <svg id="Group_1451" data-name="Group 1451" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <path id="Exclusion_1" data-name="Exclusion 1" d="M6.476,12.952A6.477,6.477,0,0,1,1.9,1.9a6.476,6.476,0,0,1,9.159,9.159A6.435,6.435,0,0,1,6.476,12.952ZM4.882,3.773h0V9.18l4.392-2.7-4.392-2.7Z" transform="translate(1.524 1.524)" fill="#16c79a"/>
      <path id="Path_1153" data-name="Path 1153" d="M0,0H16V16H0Z" fill="none"/>
    </svg>

                        آموزش
                        @lang($course->course_type)
                    </span>
                            @elseif($course->course_type == "podcast")
                                <span class="course-type course-podcast">
                        <svg id="Group_1679" data-name="Group 1679" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <path id="Path_1156" data-name="Path 1156" d="M0,0H16V16H0Z" fill="none"/>
      <rect id="Rectangle_862" data-name="Rectangle 862" width="4" height="7.2" rx="2" transform="translate(6 1.6)" fill="#fed100" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <path id="Path_1157" data-name="Path 1157" d="M5,10a4.667,4.667,0,1,0,9.333,0" transform="translate(-1.667 -3.333)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_122" data-name="Line 122" x2="4.8" transform="translate(5.6 13.6)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_123" data-name="Line 123" y2="1.6" transform="translate(8 12)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
    </svg>
                           آموزش
                          @lang($course->course_type)
                     </span>
                            @elseif($course->course_type == "book")
                                <span class="course-type course-book">
                            <svg id="Group_1678" data-name="Group 1678" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <rect id="Rectangle_1064" data-name="Rectangle 1064" width="7" height="11" rx="1" transform="translate(3 2.5)" fill="#4688ea"/>
      <path id="Path_1200" data-name="Path 1200" d="M16,0H0V16H16Z" fill="none"/>
      <path id="Path_1201" data-name="Path 1201" d="M13.667,4H6.333A1.333,1.333,0,0,0,5,5.333v8a1.333,1.333,0,0,0,1.333,1.333h7.333A.667.667,0,0,0,14.333,14V4.667A.667.667,0,0,0,13.667,4m-2,0V16" transform="translate(-1.667 -1.333)" fill="none" stroke="#4688ea" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_145" data-name="Line 145" x1="1.032" transform="translate(6.194 5.161)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_146" data-name="Line 146" x1="1.032" transform="translate(6.194 8.258)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
    </svg>
                           آموزش
                          @lang($course->course_type)
                     </span>
                            @endif
                                <div class="time">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g  data-name="Group 28" transform="translate(-2 -2)">
                                            <circle  data-name="Ellipse 7" cx="9" cy="9" r="9" transform="translate(3 3)" fill="none" stroke="#f88825" stroke-width="2"/>
                                            <path  data-name="Path 54" d="M16.5,12H12.25a.25.25,0,0,1-.25-.25V8.5" fill="none" stroke="#f88825" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                    {{ $course->formattedDuration() }}

                                </div>
                        </div>
                        <div class="single-course-excerpt">
                            <p>{{ $course->post_excerpt }}</p>
                        </div>
                        <div class="price">
                        {{ format_price_with_currencySymbol($course->final_price) }}
                    </div>
                        <div class="course-top-btns">
                            @auth
                                @if(auth()->id() == $course->teacher_id)

                                    <a  class="course-top-btns-cart"> شما مدرس این دوره هستید</a>

                                @elseif(auth()->user()->can("download", $course))
                                    <a  class="course-top-btns-cart">شما این دوره رو خریداری کرده اید</a>

                                @else

                                    <a href="{{ route("course_add_to_cart",$course->id) }}" class="course-top-btns-cart">ثبت نام در دوره</a>
                                @endif
                            @endauth
                            @guest()
                                <a href="{{ route("course_add_to_cart",$course->id) }}" class="course-top-btns-cart">ثبت نام در دوره</a>
                            @endguest
                            <a href="#seassons" class="course-top-btns-seassons">
                                <svg id="Group_1715" data-name="Group 1715" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path id="Path_1211" data-name="Path 1211" d="M24,0H0V24H24Z" fill="none"/>
                                    <rect id="Rectangle_1176" data-name="Rectangle 1176" width="14" height="18" rx="2" transform="translate(5 3)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                    <line id="Line_153" data-name="Line 153" x1="6" transform="translate(9 7)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                    <line id="Line_154" data-name="Line 154" x1="6" transform="translate(9 11)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                    <line id="Line_155" data-name="Line 155" x1="4" transform="translate(11 15)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                </svg>
                                مشاهده سر فصل های دوره
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-top-image">
                        <img data-src="{{asset(store_image_link($course->media_id)) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="course-center-content">
            <div class="row">
                <div class="col-lg-9">
                    <div class="course-center-content-icons">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="course-center-content-icons-item">
                                    <div class="course-center-content-icons-item-top">
                                        <svg id="Group_1716" data-name="Group 1716" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                                            <defs>
                                                <linearGradient id="linear-gradient" x1="0.5" y1="0.239" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                                                    <stop offset="0" stop-color="#16c79a" stop-opacity="0"/>
                                                    <stop offset="1" stop-color="#16c79a"/>
                                                </linearGradient>
                                            </defs>
                                            <path id="Path_1227" data-name="Path 1227" d="M0,0H52V52H0Z" fill="none"/>
                                            <rect id="Rectangle_1295" data-name="Rectangle 1295" width="39" height="39" rx="19.5" transform="translate(7 7)" opacity="0.32" fill="url(#linear-gradient)"/>
                                            <circle id="Ellipse_1504" data-name="Ellipse 1504" cx="19.5" cy="19.5" r="19.5" transform="translate(7 7)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1228" data-name="Path 1228" d="M12,7V17.833l6.5,6.5" transform="translate(14 8.167)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        </svg>

                                    </div>
                                    <div class="course-center-content-icons-item-bottom">
                                        <strong>بیش از 50 ساعت</strong>
                                        <p>مدت دوره</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="course-center-content-icons-item">
                                    <div class="course-center-content-icons-item-top">
                                        <svg id="Group_1719" data-name="Group 1719" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                                            <defs>
                                                <linearGradient id="linear-gradient" x1="0.5" y1="0.761" x2="0.5" gradientUnits="objectBoundingBox">
                                                    <stop offset="0" stop-color="#16c79a" stop-opacity="0"/>
                                                    <stop offset="1" stop-color="#16c79a"/>
                                                </linearGradient>
                                            </defs>
                                            <path id="Path_1232" data-name="Path 1232" d="M0,0H52V52H0Z" fill="none"/>
                                            <rect id="Rectangle_1296" data-name="Rectangle 1296" width="39" height="28" rx="3" transform="translate(7 15)" opacity="0.32" fill="url(#linear-gradient)"/>
                                            <rect id="Rectangle_1289" data-name="Rectangle 1289" width="39" height="28" rx="5" transform="translate(7 15)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1233" data-name="Path 1233" d="M25.333,3l-8.667,8.667L8,3" transform="translate(9.333 3.3)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        </svg>


                                    </div>
                                    <div class="course-center-content-icons-item-bottom">
                                        <strong>‏16 جلسه</strong>
                                        <p>تعداد جلسات</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="course-center-content-icons-item">
                                    <div class="course-center-content-icons-item-top">
                                        <svg id="Group_1720" data-name="Group 1720" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                                            <defs>
                                                <linearGradient id="linear-gradient" x1="0.5" y1="0.239" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                                                    <stop offset="0" stop-color="#16c79a" stop-opacity="0"/>
                                                    <stop offset="1" stop-color="#16c79a"/>
                                                </linearGradient>
                                            </defs>
                                            <path id="Path_1234" data-name="Path 1234" d="M0,0H52V52H0Z" fill="none"/>
                                            <rect id="Rectangle_1297" data-name="Rectangle 1297" width="26" height="26" rx="13" transform="translate(13 7)" opacity="0.32" fill="url(#linear-gradient)"/>
                                            <circle id="Ellipse_1506" data-name="Ellipse 1506" cx="13" cy="13" r="13" transform="translate(13 7)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1235" data-name="Path 1235" d="M0,.564v14.17L6.5,10.4,13,14.733V.557" transform="translate(26.004 32.507) rotate(-30)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1236" data-name="Path 1236" d="M0,.557V14.733L6.5,10.4,13,14.733V1.113" transform="translate(14.738 26.007) rotate(30)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        </svg>

                                    </div>
                                    <div class="course-center-content-icons-item-bottom">
                                        <strong>ضمانت بازگشت وجه</strong>
                                        <p>به مدت 10 روز</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="course-center-content-icons-item">
                                    <div class="course-center-content-icons-item-top">
                                        <svg id="Group_1718" data-name="Group 1718" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                                            <defs>
                                                <linearGradient id="linear-gradient" x1="0.5" y1="0.761" x2="0.5" gradientUnits="objectBoundingBox">
                                                    <stop offset="0" stop-color="#16c79a" stop-opacity="0"/>
                                                    <stop offset="1" stop-color="#16c79a"/>
                                                </linearGradient>
                                            </defs>
                                            <path id="Path_1229" data-name="Path 1229" d="M0,0H52V52H0Z" fill="none"/>
                                            <rect id="Rectangle_1298" data-name="Rectangle 1298" width="40" height="30" rx="3" transform="translate(6 11)" opacity="0.32" fill="url(#linear-gradient)"/>
                                            <circle id="Ellipse_1505" data-name="Ellipse 1505" cx="6.5" cy="6.5" r="6.5" transform="translate(26 26)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1230" data-name="Path 1230" d="M13,17.5v9.75L17.333,24l4.333,3.25V17.5" transform="translate(15.167 20.417)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_1231" data-name="Path 1231" d="M18.167,35.333H7.333A4.333,4.333,0,0,1,3,31V9.333A4.346,4.346,0,0,1,7.333,5H37.667A4.333,4.333,0,0,1,42,9.333V31a4.333,4.333,0,0,1-2.167,3.748" transform="translate(3.5 5.833)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <line id="Line_165" data-name="Line 165" x2="26" transform="translate(13 20)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <line id="Line_166" data-name="Line 166" x2="7" transform="translate(13 26)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <line id="Line_167" data-name="Line 167" x2="4" transform="translate(13 33)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        </svg>


                                    </div>
                                    <div class="course-center-content-icons-item-bottom">
                                        <strong>مدرک رسمی</strong>
                                        <p>اختصاصی هیدی لیدی</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-center-nav">
                        <ul>
                            <li><a href="#des" class="active">توضیحات</a></li>
                            <li><a href="#faq">سوالات متداول</a></li>
                            <li><a href="#teacher">مدرس دوره</a></li>
                            <li><a href="#seassons">سرفصل ها</a></li>
                            <li><a href="#comments">نظرات شما</a></li>
                        </ul>
                    </div>
                    <div class="course-center-center-content">
                        <h2 class="related-title">توضیحات دوره</h2>
                        <div id="des" class="course-center-des course-center-box">

                            <p>
                                {!! $course->body !!}
                            </p>
                        </div>
                        <h2 class="related-title">سوالات متداول</h2>
                        <div id="faq" class="course-center-des course-center-box">
                            <div class="box-accourdions">
                                <div class="accourdion-item">
                                    <div class="accourdion-item-title">
                                        <div class="accourdion-item-title-right">
                                         <span>
                                           <svg id="Group_1724" data-name="Group 1724" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
  <path id="Path_1237" data-name="Path 1237" d="M0,0H24V24H0Z" fill="none"/>
  <path id="Path_1238" data-name="Path 1238" d="M8,8a3.279,3.279,0,0,1,3.5-3h1A3.279,3.279,0,0,1,16,8a3,3,0,0,1-2,3,4.166,4.166,0,0,0-2,4" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_168" data-name="Line 168" y2="0.01" transform="translate(12 19)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>


                                        </span>
                                            چرا این دوره داروهای گیاهی برای کرونا را باید یاد بگیریم؟
                                        </div>
                                        <div class="accourdion-item-title-left">
                                                 <span class="accourdion-item-title-left-arrow ac-close">
                                                     <svg id="Group_1727" data-name="Group 1727" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_1212" data-name="Path 1212" d="M0,0H20V20H0Z" fill="none"></path>
  <line id="Line_156" data-name="Line 156" y2="12" transform="translate(10 4)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_157" data-name="Line 157" x1="5" y2="5" transform="translate(10 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_158" data-name="Line 158" x2="5" y2="5" transform="translate(5 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
</svg>

                                                 </span>
                                        </div>
                                    </div>
                                    <div class="accourdion-item-content" style="display: none;">
                                        <div class="accourdion-item-content-item">
                                            <div class="accourdion-item-content-name">
                                                <p>اکثر افـرادی که به ویروس کرونا مبتلا می‌ شوند ، بیمــاری خفیف یا بدون علامت را تجــربه می‌ کنند که می‌ توانند از راه‌ های درمـان کـرونا در خانه سود ببرند. بـرخی از داروها و درمـان ‌هایی که ممکن است بـرای درمان
                                                    .سرماخوردگی و آنفولانزا استفاده شود کمک کنند</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="accourdion-item">
                                    <div class="accourdion-item-title">
                                        <div class="accourdion-item-title-right">
                                         <span>
                                           <svg id="Group_1724" data-name="Group 1724" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
  <path id="Path_1237" data-name="Path 1237" d="M0,0H24V24H0Z" fill="none"/>
  <path id="Path_1238" data-name="Path 1238" d="M8,8a3.279,3.279,0,0,1,3.5-3h1A3.279,3.279,0,0,1,16,8a3,3,0,0,1-2,3,4.166,4.166,0,0,0-2,4" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_168" data-name="Line 168" y2="0.01" transform="translate(12 19)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>


                                        </span>
                                            چرا این دوره داروهای گیاهی برای کرونا را باید یاد بگیریم؟
                                        </div>
                                        <div class="accourdion-item-title-left">
                                                 <span class="accourdion-item-title-left-arrow ac-close">
                                                     <svg id="Group_1727" data-name="Group 1727" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_1212" data-name="Path 1212" d="M0,0H20V20H0Z" fill="none"></path>
  <line id="Line_156" data-name="Line 156" y2="12" transform="translate(10 4)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_157" data-name="Line 157" x1="5" y2="5" transform="translate(10 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_158" data-name="Line 158" x2="5" y2="5" transform="translate(5 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
</svg>

                                                 </span>
                                        </div>
                                    </div>
                                    <div class="accourdion-item-content" style="display: none;">
                                        <div class="accourdion-item-content-item">
                                            <div class="accourdion-item-content-name">
                                                <p>اکثر افـرادی که به ویروس کرونا مبتلا می‌ شوند ، بیمــاری خفیف یا بدون علامت را تجــربه می‌ کنند که می‌ توانند از راه‌ های درمـان کـرونا در خانه سود ببرند. بـرخی از داروها و درمـان ‌هایی که ممکن است بـرای درمان
                                                    .سرماخوردگی و آنفولانزا استفاده شود کمک کنند</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="accourdion-item">
                                    <div class="accourdion-item-title">
                                        <div class="accourdion-item-title-right">
                                         <span>
                                           <svg id="Group_1724" data-name="Group 1724" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
  <path id="Path_1237" data-name="Path 1237" d="M0,0H24V24H0Z" fill="none"/>
  <path id="Path_1238" data-name="Path 1238" d="M8,8a3.279,3.279,0,0,1,3.5-3h1A3.279,3.279,0,0,1,16,8a3,3,0,0,1-2,3,4.166,4.166,0,0,0-2,4" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_168" data-name="Line 168" y2="0.01" transform="translate(12 19)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>


                                        </span>
                                            چرا این دوره داروهای گیاهی برای کرونا را باید یاد بگیریم؟
                                        </div>
                                        <div class="accourdion-item-title-left">
                                                 <span class="accourdion-item-title-left-arrow ac-close">
                                                     <svg id="Group_1727" data-name="Group 1727" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_1212" data-name="Path 1212" d="M0,0H20V20H0Z" fill="none"></path>
  <line id="Line_156" data-name="Line 156" y2="12" transform="translate(10 4)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_157" data-name="Line 157" x1="5" y2="5" transform="translate(10 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
  <line id="Line_158" data-name="Line 158" x2="5" y2="5" transform="translate(5 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
</svg>

                                                 </span>
                                        </div>
                                    </div>
                                    <div class="accourdion-item-content" style="display: none;">
                                        <div class="accourdion-item-content-item">
                                            <div class="accourdion-item-content-name">
                                                <p>اکثر افـرادی که به ویروس کرونا مبتلا می‌ شوند ، بیمــاری خفیف یا بدون علامت را تجــربه می‌ کنند که می‌ توانند از راه‌ های درمـان کـرونا در خانه سود ببرند. بـرخی از داروها و درمـان ‌هایی که ممکن است بـرای درمان
                                                    .سرماخوردگی و آنفولانزا استفاده شود کمک کنند</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h2 class="related-title">مدرس دوره</h2>
                        <div id="teacher" class="course-center-teacher course-center-box">

                            <div class="single-course-teacher">
                                <div class="single-course-teacher-top">
                                    <div class="single-course-teacher-top-image">
                                        <img data-src="{{ $course->teacher->profile_avatar }}">
                                    </div>
                                    <div class="single-course-teacher-left">
                                        <strong>{{ $course->teacher->name }}</strong>
                                        <p>{{ $course->teacher->description }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h2 class="related-title">سرفصل ها</h2>
                        <div id="seassons" class="course-center-seassons course-center-box">

                            <div class="box-accourdions">
                                @foreach($seasons as $season)
                                    <div class="accourdion-item">
                                        <div class="accourdion-item-title">
                                            <div class="accourdion-item-title-right">
                                         <span>
                                           <svg id="Group_1728" data-name="Group 1728" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
  <path id="Path_1239" data-name="Path 1239" d="M0,0H24V24H0Z" fill="none"/>
  <line id="Line_169" data-name="Line 169" x2="16" transform="translate(4 6)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_1244" data-name="Path 1244" d="M4,0H16" transform="translate(4 12)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-width="1.5"/>
  <path id="Path_1245" data-name="Path 1245" d="M8,0h8" transform="translate(4 18)" fill="none" stroke="#16c79a" stroke-linecap="round" stroke-width="1.5"/>
</svg>

                                        </span>
                                                {{ $season->title }}
                                            </div>
                                             <div class="accourdion-item-title-left">
                                                 <span class="accourdion-item-title-left-arrow ac-close">
                                                     <svg id="Group_1727" data-name="Group 1727" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_1212" data-name="Path 1212" d="M0,0H20V20H0Z" fill="none"/>
  <line id="Line_156" data-name="Line 156" y2="12" transform="translate(10 4)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_157" data-name="Line 157" x1="5" y2="5" transform="translate(10 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_158" data-name="Line 158" x2="5" y2="5" transform="translate(5 11)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                 </span>
                                             </div>
                                        </div>
                                        <div class="accourdion-item-content" >
                                            @foreach($season->lessons as $lesson)
                                                @can("download", [$course,$lesson])<a  href="{{ $lesson->downloadLink() }}" >@endcan
                                                    <div class="accourdion-item-content-item">
                                                        <div class="accourdion-item-content-name">
                                                            {{ $lesson->title }}
                                                        </div>
                                                        <div class="accourdion-item-content-link">
                                                            <div class="accourdion-item-content-link-icon @can("download" , [$course,$lesson]) accourdion-item-content-link-icon-download @else accourdion-item-content-link-icon-lock @endcan">
                                                                @can("download" , [$course,$lesson])
                                                                    <svg id="Group_1737" data-name="Group 1737" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                        <path id="Path_1240" data-name="Path 1240" d="M0,0H16V16H0Z" fill="none"/>
                                                                        <path id="Path_1241" data-name="Path 1241" d="M7,4V14.667l8.667-5.333Z" transform="translate(-2.333 -1.333)" fill="#fff"/>
                                                                    </svg>

                                                                    مشاهده

                                                                @else
                                                                    <div class="lock">
                                                                        <svg id="Group_1740" data-name="Group 1740" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                            <path id="Path_1242" data-name="Path 1242" d="M0,0H16V16H0Z" fill="none"/>
                                                                            <rect id="Rectangle_1324" data-name="Rectangle 1324" width="9.333" height="6.667" rx="2" transform="translate(3.333 7.333)" fill="#b4b4b6"/>
                                                                            <circle id="Ellipse_1513" data-name="Ellipse 1513" cx="0.667" cy="0.667" r="0.667" transform="translate(7.333 10)" fill="#dcdcdd" stroke="#e2e2e2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                                            <path id="Path_1243" data-name="Path 1243" d="M8,8.333V5.667a2.667,2.667,0,1,1,5.333,0V8.333" transform="translate(-2.667 -1)" fill="none" stroke="#b4b4b6" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                                                        </svg>
                                                                        قفل است
                                                                    </div>
                                                                @endcan
                                                            </div>
                                                            <time>
                                                                {{ $lesson->formattedDuration() }}
                                                            </time>


                                                        </div>
                                                    </div>
                                                    @can("download", [$course,$lesson])</a>@endcan
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <h2 class="related-title">نظرات شما</h2>
                        <div id="comments" class="course-center-comments course-center-box">

                            <div class="post-item-review">
                                @includeIf(config("theme.theme_comment_form_path"),["post_id"=>$course->id,"post_type"=>"course"])
                                @includeIf(config("theme.theme_comment_path"),["comments"=>$comments])

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-course-left">
                        <div class="course-detail">
                            <div class="single-course-title mb-3">
                                <strong>{{ $course->title }}</strong>
                            </div>
                            <div class="single-course-type">
                                @if($course->course_type == "video")
                                    <span class="course-type course-video">
                        <svg id="Group_1451" data-name="Group 1451" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <path id="Exclusion_1" data-name="Exclusion 1" d="M6.476,12.952A6.477,6.477,0,0,1,1.9,1.9a6.476,6.476,0,0,1,9.159,9.159A6.435,6.435,0,0,1,6.476,12.952ZM4.882,3.773h0V9.18l4.392-2.7-4.392-2.7Z" transform="translate(1.524 1.524)" fill="#16c79a"/>
      <path id="Path_1153" data-name="Path 1153" d="M0,0H16V16H0Z" fill="none"/>
    </svg>

                        آموزش
                        @lang($course->course_type)
                    </span>
                                @elseif($course->course_type == "podcast")
                                    <span class="course-type course-podcast">
                        <svg id="Group_1679" data-name="Group 1679" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <path id="Path_1156" data-name="Path 1156" d="M0,0H16V16H0Z" fill="none"/>
      <rect id="Rectangle_862" data-name="Rectangle 862" width="4" height="7.2" rx="2" transform="translate(6 1.6)" fill="#fed100" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <path id="Path_1157" data-name="Path 1157" d="M5,10a4.667,4.667,0,1,0,9.333,0" transform="translate(-1.667 -3.333)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_122" data-name="Line 122" x2="4.8" transform="translate(5.6 13.6)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_123" data-name="Line 123" y2="1.6" transform="translate(8 12)" fill="none" stroke="#fed100" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
    </svg>
                           آموزش
                          @lang($course->course_type)
                     </span>
                                @elseif($course->course_type == "book")
                                    <span class="course-type course-book">
                            <svg id="Group_1678" data-name="Group 1678" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <rect id="Rectangle_1064" data-name="Rectangle 1064" width="7" height="11" rx="1" transform="translate(3 2.5)" fill="#4688ea"/>
      <path id="Path_1200" data-name="Path 1200" d="M16,0H0V16H16Z" fill="none"/>
      <path id="Path_1201" data-name="Path 1201" d="M13.667,4H6.333A1.333,1.333,0,0,0,5,5.333v8a1.333,1.333,0,0,0,1.333,1.333h7.333A.667.667,0,0,0,14.333,14V4.667A.667.667,0,0,0,13.667,4m-2,0V16" transform="translate(-1.667 -1.333)" fill="none" stroke="#4688ea" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_145" data-name="Line 145" x1="1.032" transform="translate(6.194 5.161)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
      <line id="Line_146" data-name="Line 146" x1="1.032" transform="translate(6.194 8.258)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
    </svg>
                           آموزش
                          @lang($course->course_type)
                     </span>
                                @endif


                                <span class="course-users">
                                    <svg class="ml-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
  <g id="Group_1755" data-name="Group 1755" opacity="0.2">
    <path id="Path_1170" data-name="Path 1170" d="M0,0H18V18H0Z" fill="none"/>
    <ellipse id="Ellipse_1495" data-name="Ellipse 1495" cx="3" cy="3.5" rx="3" ry="3.5" transform="translate(4 1.875)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"/>
    <path id="Path_1171" data-name="Path 1171" d="M3,19.5V18a3,3,0,0,1,3-3H9a3,3,0,0,1,3,3v1.5" transform="translate(-0.75 -3.75)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"/>
    <path id="Path_1172" data-name="Path 1172" d="M16,3.13a3,3,0,0,1,0,5.812" transform="translate(-4 -0.783)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"/>
    <path id="Path_1173" data-name="Path 1173" d="M20.25,19.538v-1.5A3,3,0,0,0,18,15.15" transform="translate(-4.5 -3.788)" fill="none" stroke="#46484d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"/>
  </g>
</svg>
‏20 نفر ثبت نام کرده اند
                                </span>

                            </div>
                            <div class="price">
                                <strong class="d-block mb-2" style="
    font-size: 14px;
">قیمت دوره</strong>
                                {{ format_price_with_currencySymbol($course->final_price) }}
                            </div>
                            <div class="course-detail-cart">
                                @auth
                                    @if(auth()->id() == $course->teacher_id)

                                        <a  class="course-top-btns-cart"> شما مدرس این دوره هستید</a>

                                    @elseif(auth()->user()->can("download", $course))
                                        <a  class="course-top-btns-cart">شما این دوره رو خریداری کرده اید</a>

                                    @else

                                        <a href="{{ route("course_add_to_cart",$course->id) }}" class="course-top-btns-cart">ثبت نام در دوره</a>
                                    @endif
                                @endauth
                                @guest()
                                        <a href="{{ route("course_add_to_cart",$course->id) }}" class="course-top-btns-cart">ثبت نام در دوره</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @push("js")
        <script>
            jQuery(".accourdion-item-title").click(function(){
                jQuery(this).find("span.accourdion-item-title-left-arrow").toggleClass("ac-close")
                jQuery(this).parent(".accourdion-item").children(".accourdion-item-content").stop().slideToggle(500);
            })
            jQuery(".course-center-nav a").click(function (){
                jQuery(".course-center-nav a").removeClass("active")
                jQuery(this).addClass("active")
            })
        </script>
    @endpush
@endsection
