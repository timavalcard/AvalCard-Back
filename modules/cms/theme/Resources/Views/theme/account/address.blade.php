@extends(config("theme.theme_mainContent_path"))

@section("title")
    آدرس ها
@endsection

@section("content")
        <div class="container">
            <div class="rows">

                <div class="woocommerce">
                    <div class="my-accountsss row">
                        @includeIf(config("theme.theme_path")."account.sidebar")
                        <div class="col-12 col-lg-9 fl">
                            <div class="woocommerce-MyAccount-content">
                                <div class="woocommerce-notices-wrapper"></div>

                                <div class="address-box">
                                    @if(is_array($address))
                                        @foreach($address as $key=>$addres)
                                            <div class="address-box-item">
                                                <div class="right">
                                                    <div class="address-box-item-right">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="135" height="135" viewBox="0 0 135 135">
                                                            <defs>
                                                                <filter id="Rectangle_256" x="0" y="0" width="135" height="135" filterUnits="userSpaceOnUse">
                                                                    <feOffset dy="4" input="SourceAlpha"/>
                                                                    <feGaussianBlur stdDeviation="12.5" result="blur"/>
                                                                    <feFlood flood-color="#227cb4" flood-opacity="0.239"/>
                                                                    <feComposite operator="in" in2="blur"/>
                                                                    <feComposite in="SourceGraphic"/>
                                                                </filter>
                                                            </defs>
                                                            <g id="Group_901" data-name="Group 901" transform="translate(-1434.5 -159)">
                                                                <g transform="matrix(1, 0, 0, 1, 1434.5, 159)" filter="url(#Rectangle_256)">
                                                                    <rect id="Rectangle_256-2" data-name="Rectangle 256" width="60" height="60" rx="15" transform="translate(37.5 33.5)" fill="#227cb4"/>
                                                                </g>
                                                                <g id="Group_872" data-name="Group 872" transform="translate(1481.167 202)">
                                                                    <rect id="Rectangle_67" data-name="Rectangle 67" width="38" height="39" transform="translate(1.833 1)" fill="#fff" opacity="0"/>
                                                                    <g id="location" transform="translate(10.064 7.902)">
                                                                        <path id="Ellipse_140" data-name="Ellipse 140" d="M19.5.765a2.507,2.507,0,0,1-1.082,1.882,8.8,8.8,0,0,1-3.005,1.464,19.043,19.043,0,0,1-4.262.722,22.614,22.614,0,0,1-4.573-.181A15.159,15.159,0,0,1,2.709,3.608,5.478,5.478,0,0,1,.4,1.934,1.874,1.874,0,0,1,.17,0" transform="translate(0 19.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2"/>
                                                                        <g id="Rectangle_1322" data-name="Rectangle 1322" transform="translate(1.219)" fill="none">
                                                                            <path d="M.679,11.369C-1.691,5.972,2.434,0,8.531,0s10.222,5.972,7.852,11.369L12.991,19.1a4.848,4.848,0,0,1-4.459,2.842A4.848,4.848,0,0,1,4.072,19.1Z" stroke="none"/>
                                                                            <path d="M 8.531211853027344 19.93739891052246 C 9.688541412353516 19.93739891052246 10.72018146514893 19.29109954833984 11.15942192077637 18.29088020324707 L 14.55206203460693 10.56527900695801 C 15.37077140808105 8.700949668884277 15.1978816986084 6.647899627685547 14.077712059021 4.93256950378418 C 12.87856197357178 3.096289396286011 10.80510139465332 1.999999403953552 8.531211853027344 1.999999403953552 C 6.257321834564209 1.999999403953552 4.18386173248291 3.096289396286011 2.984711885452271 4.932579517364502 C 1.864541888237 6.647899627685547 1.691651821136475 8.700939178466797 2.510361909866333 10.56526947021484 L 5.90300178527832 18.29088020324707 C 6.342241764068604 19.29109954833984 7.373871803283691 19.93739891052246 8.531211853027344 19.93739891052246 M 8.531211853027344 21.93739891052246 C 6.585092067718506 21.93739891052246 4.828251838684082 20.81761932373047 4.071791648864746 19.09503936767578 L 0.6791518330574036 11.36942958831787 C -1.690938115119934 5.972359657287598 2.433751821517944 -5.447387820822769e-07 8.531211853027344 -5.447387820822769e-07 C 14.62867164611816 -5.447387820822769e-07 18.75336265563965 5.972359657287598 16.38327217102051 11.36943912506104 L 12.99063205718994 19.09503936767578 C 12.23417186737061 20.8176097869873 10.47733211517334 21.93739891052246 8.531211853027344 21.93739891052246 Z" stroke="none" fill="#fff"/>
                                                                        </g>
                                                                        <circle id="Ellipse_138" data-name="Ellipse 138" cx="2.437" cy="2.437" r="2.437" transform="translate(7.312 4.875)" fill="none" stroke="#fff" stroke-width="2"/>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>

                                                    </div>
                                                    <div class="address-box-item-left">
                                                        <strong>{{ $addres["billing_first_name"]??"" }}</strong>
                                                        <p>{{ $addres["billing_address"]??"" }}</p>
                                                    </div>
                                                </div>
                                                <div class="left">
                                                    <a href="{{ route("user.delete_address",$key) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="width: 30px;height: 30px;" viewBox="0 0 38 39">
                                                            <g id="Group_873" data-name="Group 873" transform="translate(-1.833 -1)">
                                                                <rect id="Rectangle_67" data-name="Rectangle 67" width="38" height="39" transform="translate(1.833 1)" fill="#fff" opacity="0"/>
                                                                <g id="Recycle_Bin" data-name="Recycle Bin" transform="translate(3.675 4)">
                                                                    <path id="Vector" d="M2.428.418l.984,16.128A3.371,3.371,0,0,0,6.8,19.684H16.98a3.376,3.376,0,0,0,3.384-3.038L21.849.418M2.428.418C.967.518,0,.6,0,.6M2.428.418C4.994.242,9.084,0,12.138,0s7.145.242,9.711.418m0,0C23.31.518,24.277.6,24.277.6" transform="translate(4 8.593)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Vector_524" data-name="Vector 524" d="M0,3.937V0H7.283V3.937" transform="translate(12.497 4)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Vector_525" data-name="Vector 525" d="M0,0H2.428" transform="matrix(1, 0, 0, 1, 11.283, 7.937)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Vector_526" data-name="Vector 526" d="M0,0H2.428" transform="translate(18.566 7.937)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Line_20" data-name="Line 20" d="M0,0H7.874" transform="matrix(0, 1, -1, 0, 16.138, 14.498)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Line_21" data-name="Line 21" d="M0,0H5.249" transform="matrix(0, 1, -1, 0, 11.283, 15.81)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                    <path id="Line_22" data-name="Line 22" d="M0,0H5.249" transform="matrix(0, 1, -1, 0, 20.994, 15.81)" fill="none" stroke="#ff3e4d" stroke-linecap="round" stroke-width="2"/>
                                                                </g>
                                                            </g>
                                                        </svg>

                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="address-box-empty">
                                            <p>شما در حال حاظر هیچ آدرسی ثبت نکرده اید</p>
                                        </div>
                                    @endif
                                    <div class="add-address">
                                        <a href="#" class="exampleModalCenter" data-toggle="modal" data-target="#exampleModalCenter">
                                            ثبت آدرس جدید
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
        </div>
            <div class="modal fade" style="overflow-x: hidden;
    overflow-y: auto;    z-index: 999999;" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">افزودن آدرس</h5>
                            <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            @csrf

                            <div class="modal-body">
                                <div class="woocommerce-billing-fields__field-wrapper">
                                    <p class="form-row form-row-first validate-required" id="billing_first_name_field">
                                        <label for="billing_first_name" class="">نام&nbsp;
                                            <abbr class="required" title="ضروری">*</abbr>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($billing["billing_first_name"])) {{$billing["billing_first_name"]}} @endif" name="billing_first_name" id="billing_first_name" placeholder=""  >
                                                            </span>
                                    </p>
                                    <p class="form-row form-row-wide validate-required" id="billing_phone_field" >
                                        <label for="billing_phone" class="">تلفن همراه&nbsp;
                                            <abbr class="required" title="ضروری">*</abbr>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="tel" class="input-text " value="@if(isset($billing["billing_phone"])) {{$billing["billing_phone"]}} @endif" name="billing_phone" id="billing_phone" placeholder="">
                                                            </span>
                                    </p>
                                    <p class="form-row address-field validate-required" id="billing_state_field"  data-o_class="form-row form-row-wide ">
                                        <label for="billing_state" class="">استان&nbsp;
                                            <abbr class="required" title="ضروری">*</abbr>
                                        </label>

                                        <span class="woocommerce-input-wrapper">
                                                               <input type="text" class="input-text " value="@if(isset($billing["billing_state"])) {{$billing["billing_state"]}} @endif" name="billing_state" id="billing_state" placeholder=""  >
                                                            </span>
                                    </p>
                                    <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="4">
                                        <label for="billing_last_name" class="">نام خانوادگی&nbsp;
                                            <abbr class="required" title="ضروری">*</abbr>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($billing["billing_last_name"])) {{$billing["billing_last_name"]}} @endif" name="billing_last_name" id="billing_last_name" placeholder="" autocomplete="family-name">
                                                            </span>
                                    </p>
                                    <p class="form-row form-row-wide validate-email" id="billing_email_field" data-priority="5">
                                        <label for="billing_email" class="">آدرس ایمیل&nbsp;<span class="optional">(اختیاری)</span>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="email" class="input-text " value="@if(isset($billing["billing_email"])) {{$billing["billing_email"]}} @endif" name="billing_email" id="billing_email" placeholder=""  autocomplete="email username">
                                                            </span>
                                    </p>
                                    <p class="form-row address-field validate-required form-row-wide" id="billing_city_field" data-priority="6" data-o_class="form-row form-row-wide address-field validate-required">
                                        <label for="billing_city" class="">شهر&nbsp;
                                            <abbr class="required" title="ضروری">*</abbr>
                                        </label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="billing_city" value="@if(isset($billing["billing_city"])) {{$billing["billing_city"]}} @endif" id="billing_city" placeholder=""  autocomplete="address-level2">
                                                            </span>
                                    </p>
                                    <p class="form-row address-field validate-required form-row-wide" id="billing_address_2_field" data-priority="1">
                                        <label for="billing_address" class="screen-reader-text">آدرس کامل خود را وارد کنید<abbr class="required" title="ضروری">*</abbr></label><span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($billing["billing_address"])) {{$billing["billing_address"]}} @endif" name="billing_address" id="billing_address" placeholder="مثال : تهران - خیابان جمهوری - کوچه شهید ولایتی - پلاک 6 - واحد" autocomplete="address-line2" >
                                                            </span>
                                    </p>
                                    <p class="form-row address-field validate-postcode  form-row-wide" id="billing_postcode_field"  data-o_class="form-row form-row-wide address-field validate-postcode">
                                        <label for="billing_postcode" class="">کدپستی (بدون فاصله و با اعداد انگلیسی)&nbsp;<abbr class="required" title="ضروری">*</abbr></label>
                                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="billing_postcode" value="@if(isset($billing["billing_postcode"])) {{$billing["billing_postcode"]}} @endif" id="billing_postcode" placeholder="" autocomplete="postal-code">
                                                            </span>
                                    </p>
                                    <div id="mapid" class="col-12 mt-4"></div>
                                    <input type="hidden" id="lat"/>
                                    <input type="hidden" id="long"/>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                <button type="submit" class="btn-blue">ذخیره آدرس</button>
                            </div>
                        </form>

                    </div>
            </div>
                </div>
        <style>
            .woocommerce-billing-fields__field-wrapper .form-row:nth-child(1), .woocommerce-billing-fields__field-wrapper .form-row:nth-child(2), .woocommerce-billing-fields__field-wrapper .form-row:nth-child(3), .woocommerce-billing-fields__field-wrapper .form-row:nth-child(4), .woocommerce-billing-fields__field-wrapper .form-row:nth-child(5), .woocommerce-billing-fields__field-wrapper .form-row:nth-child(6) {
                width: 100%;
                margin-bottom: 20px;
            }form .form-row label {
                 display: block;
                 margin-bottom: 8px;
             }form .form-row input.input-text, form .form-row textarea {
                  width: 100%;
                  border: solid 1px #d2d2d2;
              }
        </style>
    @push("css")
                <link rel="stylesheet" href="{{ theme_asset("css/leaflet.css") }}">
    @endpush
    @push("js")
                <script src="{{ theme_asset("js/leaflet.js") }}"></script>
                <script>

                    jQuery(".exampleModalCenter").click(function (){
                        setTimeout(function (){
                            var mymap=L.map("mapid",{center:[200,0],zoom:13}).setView([35.7,51.35],10.5);
                            L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png",{attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(mymap);
                            mymap.on("geosearch_showlocation",function(e){L.marker([e.x,e.y]).addTo(mymap),console.log(e)}),mymap.on("click",function(e){
                                $(".leaflet-marker-icon").each(function(){$(this).hide()
                                });
                                $("#lat").val(e.latlng.lat);
                                $("#long").val(e.latlng.lng);
                                L.marker([e.latlng.lat,e.latlng.lng]).addTo(mymap)
                            })
                        },1000)
                    })
                </script>
    @endpush

@endsection
