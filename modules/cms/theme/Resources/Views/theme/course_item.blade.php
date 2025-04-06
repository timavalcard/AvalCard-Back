<a href="{{ $course->url }}">
    <div class="course-item">
        <div class="course-item-img">
            <img  data-src="{{ $course->banner->url?? "" }}">
        </div>
        <div class="course-item-content">
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
            <h3>{{ $course->title }}</h3>
            <p>{{ $course->post_excerpt }}</p>
            <div class="course-item-content-price">
                <div class="time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <g  data-name="Group 28" transform="translate(-2 -2)">
                            <circle  data-name="Ellipse 7" cx="9" cy="9" r="9" transform="translate(3 3)" fill="none" stroke="#f88825" stroke-width="2"/>
                            <path  data-name="Path 54" d="M16.5,12H12.25a.25.25,0,0,1-.25-.25V8.5" fill="none" stroke="#f88825" stroke-linecap="round" stroke-width="2"/>
                        </g>
                    </svg>
                    {{ $course->formattedDuration() }}

                </div>
                <div class="price">
                    {{ format_price_with_currencySymbol($course->final_price) }}
                </div>
            </div>
        </div>
    </div>
</a>
