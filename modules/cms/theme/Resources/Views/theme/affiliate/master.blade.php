@extends(config("theme.theme_mainContent_path"))

@push("css")
    <link rel="stylesheet" href="{{theme_asset('css/affiliate.css')}}" />
    <style>
        header {
            display: none;
        }.main-content {
             padding-top: 54px;
             padding-bottom: 100px;
         }
    </style>
@endpush

@section("content")
    <div class="container">
        <div class="uap-user-page-wrapper">
            <div class="uap-user-page-top-wrapper  uap-ap-top-theme-2" >

                <div class="uap-left-side">
                    <div class="uap-user-page-details">
                        <div class="uap-user-page-avatar">
                            <img  data-src="{{ theme_asset("img/user_avatar.png") }}"  class="uap-member-photo"/>
                        </div>
                    </div>
                </div>
                <div class="uap-middle-side">
                    <div class="uap-account-page-top-mess"><div class="uap-user-page-name">  </div>
                        <div class="uap-user-page-mess"><span></span>{{auth()->user()->name ?? ''}} {{auth()->user()->lname ?? ''}}  {{ toShamsi(auth()->user()->created_at) }}</div></div>

                </div>
                <div class="uap-right-side">
                    <div class="uap-top-earnings">
                        <div class="uap-stats-label">موجودی حساب</div>
                        <div class="uap-stats-content">{{ format_price_with_currencySymbol(auth()->user()->inventory) }}</div>
                    </div>
                    <div class="uap-top-referrals">
                        <div class="uap-stats-label">بازدید ها</div>
                        <div class="uap-stats-content">@if($entrances->isNotEmpty()) {{ count($entrances) }} @else 0 @endif</div>
                    </div>


                    <div class="uap-clear uap-special-clear"></div>

                    <div class="uap-clear uap-special-clear"></div>

                    <div class="uap-clear"></div>
                </div>
                <div class="uap-clear"></div>
                <div class="uap-user-page-top-background"  data-banner="">
                    <div class="uap-edit-top-ap-banner" id="js_uap_edit_top_ap_banner"></div>
                </div>
            </div>
            <div class="uap-user-page-content-wrapper uap-ap-theme-4">



                <div class="uap-ap-menu">
                    <ul>

                        <li class="uap-ap-menu-tab-item "><a href="{{ route("affiliate.index") }}"><i class="fa-uap fa-overview-account-uap"></i>داشبورد</a></li>


                        <li class="uap-ap-submenu-item">
                            <div class="uap-ap-menu-tab-item"  ><a href="{{ route("affiliate.bank") }}"><i class=" fa-uap fa-payments_settings-account-uap" id="uap_fa_sign-profile"></i>اطلاعات حساب بانکی</a></div>
                        </li>


                        <li class="uap-ap-submenu-item">
                            <div class="uap-ap-menu-tab-item"  ><a href="{{ route("affiliate.links") }}"><i class=" fa-uap fa-affiliate_link-account-uap" id="uap_fa_sign-marketing"></i>لینک های بازاریابی</a></div>
                        </li>

                        <li class="uap-ap-menu-tab-item"><a href="{{ route("affiliate.settlements") }}"><i class="fa-uap fa-payments-account-uap"></i>پرداختها</a></li>


                        <li class="uap-ap-menu-tab-item "><a href="{{ route("user.account") }}"><i class="fa-uap fa-logout-account-uap"></i>بازگشت به حساب کاربری</a></li>


                    </ul>
                </div>
                @if(!$bank_cart_number && auth()->user()->inventory >=$setting["affiliate_min_inventory"])
                    <div class="uap-warning-box">
                        وجودی حساب شما به حد اقل موجودی مورد نیاز برای برداشت رسیده است اما شما  اطلاعات حساب بانکی خود را برای دریافت مبلع وارد نکرده اید برای تکمیل اطلاعات حساب بانکی
                        <a href="{{ route("affiliate.bank") }}">اینجا</a>
                        کلیک کنید
                    </div>
                    @elseif(auth()->user()->inventory >=$setting["affiliate_min_inventory"])
                    <div class="uap-success-box">
                        موجودی حساب شما
                        {{ format_price_with_currencySymbol(auth()->user()->inventory) }}
                        است برای درخواست تسویه حساب
                        <a href="{{ route("affiliate.settled") }}">اینجا</a>
                        کلیک کنید
                    </div>
                    @endif

                @yield("affiliate-content")

            </div>
        </div>

    </div>
    @push("css")
        <link rel="stylesheet" id="affiliate" href="{{ theme_asset("css/affiliate.css") }}" type="text/css" media="all">
    @endpush
    <style>
        footer {
            display: none;
        }
    </style>
@endsection
