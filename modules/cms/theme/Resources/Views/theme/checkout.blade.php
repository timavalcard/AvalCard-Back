@extends(config("theme.theme_mainContent_path"))

@section("title")
    پرداخت
@endsection

@section("content")
    <div class="container">
        <div class="rows">

            <div class="row">
                <div class="col-12">
                    <div class="bread-crumb-box">
                        <div class="bread-crumb-box-item">
                            <a href="/">خانه</a>
                        </div>
                        <div class="bread-crumb-box-item current">
                            <a href="#">تکمیل اطلاعات کاربری</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-checkout-top">
                <div class="cart-checkout-top-item complete">
                    <a href="/cart">
                        <div class="cart-checkout-top-item-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.6065 8.50723L20.3524 8.42872L19.6065 8.50723ZM20.8697 20.5072L20.1238 20.5857L20.8697 20.5072ZM3.1313 20.5072L3.87718 20.5857L3.1313 20.5072ZM4.39446 8.50723L3.64858 8.42872V8.42872L4.39446 8.50723ZM15.0005 10.5C15.0005 10.9142 15.3363 11.25 15.7505 11.25C16.1647 11.25 16.5005 10.9142 16.5005 10.5H15.0005ZM7.50048 10.5C7.50048 10.9142 7.83627 11.25 8.25048 11.25C8.6647 11.25 9.00048 10.9142 9.00048 10.5H7.50048ZM18.8606 8.58574L20.1238 20.5857L21.6155 20.4287L20.3524 8.42872L18.8606 8.58574ZM19.7508 21H4.25012V22.5H19.7508V21ZM3.87718 20.5857L5.14034 8.58574L3.64858 8.42872L2.38542 20.4287L3.87718 20.5857ZM5.51328 8.25H18.4877V6.75H5.51328V8.25ZM4.25012 21C4.02748 21 3.85387 20.8072 3.87718 20.5857L2.38542 20.4287C2.26889 21.5358 3.13693 22.5 4.25012 22.5V21ZM20.1238 20.5857C20.1471 20.8072 19.9735 21 19.7508 21V22.5C20.864 22.5 21.7321 21.5358 21.6155 20.4287L20.1238 20.5857ZM20.3524 8.42872C20.2519 7.47444 19.4472 6.75 18.4877 6.75V8.25C18.6796 8.25 18.8405 8.39489 18.8606 8.58574L20.3524 8.42872ZM5.14034 8.58574C5.16043 8.39489 5.32137 8.25 5.51328 8.25V6.75C4.55373 6.75 3.74903 7.47444 3.64858 8.42872L5.14034 8.58574ZM7.87548 10.5C7.87548 10.2929 8.04338 10.125 8.25048 10.125V11.625C8.8718 11.625 9.37548 11.1213 9.37548 10.5H7.87548ZM8.25048 10.125C8.45759 10.125 8.62548 10.2929 8.62548 10.5H7.12548C7.12548 11.1213 7.62916 11.625 8.25048 11.625V10.125ZM8.62548 10.5C8.62548 10.7071 8.45759 10.875 8.25048 10.875V9.375C7.62916 9.375 7.12548 9.87868 7.12548 10.5H8.62548ZM8.25048 10.875C8.04338 10.875 7.87548 10.7071 7.87548 10.5H9.37548C9.37548 9.87868 8.8718 9.375 8.25048 9.375V10.875ZM15.3755 10.5C15.3755 10.2929 15.5434 10.125 15.7505 10.125V11.625C16.3718 11.625 16.8755 11.1213 16.8755 10.5H15.3755ZM15.7505 10.125C15.9576 10.125 16.1255 10.2929 16.1255 10.5H14.6255C14.6255 11.1213 15.1292 11.625 15.7505 11.625V10.125ZM16.1255 10.5C16.1255 10.7071 15.9576 10.875 15.7505 10.875V9.375C15.1292 9.375 14.6255 9.87868 14.6255 10.5H16.1255ZM15.7505 10.875C15.5434 10.875 15.3755 10.7071 15.3755 10.5H16.8755C16.8755 9.87868 16.3718 9.375 15.7505 9.375V10.875ZM9.00048 6C9.00048 4.34315 10.3436 3 12.0005 3V1.5C9.5152 1.5 7.50048 3.51472 7.50048 6H9.00048ZM12.0005 3C13.6573 3 15.0005 4.34315 15.0005 6H16.5005C16.5005 3.51472 14.4858 1.5 12.0005 1.5V3ZM15.0005 6V10.5H16.5005V6H15.0005ZM7.50048 6V10.5H9.00048V6H7.50048Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="cart-checkout-top-item-left">
                            <span>مرحله اول</span>
                            <strong>سبد خرید شما</strong>
                        </div>
                    </a>

                </div>
                <div class="cart-checkout-top-item current">
                    <a href="/checkout">
                        <div class="cart-checkout-top-item-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.9825 18.725C17.2838 17.7999 16.3798 17.0496 15.3417 16.5334C14.3036 16.0171 13.1599 15.749 12.0005 15.75C10.8411 15.749 9.69739 16.0171 8.65932 16.5334C7.62125 17.0496 6.71724 17.7999 6.0185 18.725M17.9815 18.725C19.345 17.5122 20.3076 15.9136 20.7417 14.1411C21.1758 12.3686 21.0608 10.5061 20.412 8.80049C19.7632 7.09488 18.6112 5.62679 17.1089 4.59091C15.6066 3.55503 13.8248 3.00031 12 3.00031C10.1752 3.00031 8.39343 3.55503 6.89111 4.59091C5.38878 5.62679 4.23683 7.09488 3.58804 8.80049C2.93924 10.5061 2.82425 12.3686 3.25832 14.1411C3.69239 15.9136 4.655 17.5122 6.0185 18.725M17.9815 18.725C16.3355 20.1932 14.2061 21.0032 12.0005 21C9.79453 21.0034 7.66474 20.1934 6.0185 18.725M15.0005 9.75001C15.0005 10.5457 14.6844 11.3087 14.1218 11.8713C13.5592 12.4339 12.7962 12.75 12.0005 12.75C11.2049 12.75 10.4418 12.4339 9.87918 11.8713C9.31657 11.3087 9.0005 10.5457 9.0005 9.75001C9.0005 8.95436 9.31657 8.1913 9.87918 7.62869C10.4418 7.06608 11.2049 6.75001 12.0005 6.75001C12.7962 6.75001 13.5592 7.06608 14.1218 7.62869C14.6844 8.1913 15.0005 8.95436 15.0005 9.75001V9.75001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div class="cart-checkout-top-item-left">
                            <span>مرحله دوم</span>
                            <strong>اطلاعات حساب</strong>
                        </div>
                    </a>

                </div>
                <div class="cart-checkout-top-item">
                    <a href="/checkout/address">
                        <div class="cart-checkout-top-item-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 10.5C15 11.2956 14.6839 12.0587 14.1213 12.6213C13.5587 13.1839 12.7956 13.5 12 13.5C11.2044 13.5 10.4413 13.1839 9.87868 12.6213C9.31607 12.0587 9 11.2956 9 10.5C9 9.70435 9.31607 8.94129 9.87868 8.37868C10.4413 7.81607 11.2044 7.5 12 7.5C12.7956 7.5 13.5587 7.81607 14.1213 8.37868C14.6839 8.94129 15 9.70435 15 10.5V10.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.5 10.5C19.5 17.642 12 21.75 12 21.75C12 21.75 4.5 17.642 4.5 10.5C4.5 8.51088 5.29018 6.60322 6.6967 5.1967C8.10322 3.79018 10.0109 3 12 3C13.9891 3 15.8968 3.79018 17.3033 5.1967C18.7098 6.60322 19.5 8.51088 19.5 10.5V10.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div class="cart-checkout-top-item-left">
                            <span>مرحله سوم</span>
                            <strong>اطلاعات ارسال</strong>
                        </div>
                    </a>

                </div>
                <div class="cart-checkout-top-item">
                    <a href="/checkout/bill">
                        <div class="cart-checkout-top-item-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 8.25H21.75M2.25 9H21.75M5.25 14.25H11.25M5.25 16.5H8.25M4.5 19.5H19.5C20.0967 19.5 20.669 19.2629 21.091 18.841C21.5129 18.419 21.75 17.8467 21.75 17.25V6.75C21.75 6.15326 21.5129 5.58097 21.091 5.15901C20.669 4.73705 20.0967 4.5 19.5 4.5H4.5C3.90326 4.5 3.33097 4.73705 2.90901 5.15901C2.48705 5.58097 2.25 6.15326 2.25 6.75V17.25C2.25 17.8467 2.48705 18.419 2.90901 18.841C3.33097 19.2629 3.90326 19.5 4.5 19.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div class="cart-checkout-top-item-left">
                            <span>مرحله چهارم</span>
                            <strong>تسویه حساب</strong>
                        </div>
                    </a>

                </div>
            </div>
            <svg class="w-100 mb-4" width="996" height="24" viewBox="0 0 996 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="996" y1="13" x2="535" y2="13" stroke="#8C8C8C" stroke-opacity="0.07" stroke-width="2"/>
                <line x1="463" y1="13" y2="13" stroke="#8C8C8C" stroke-opacity="0.07" stroke-width="2"/>
                <mask id="mask0_0_1" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="487" y="0" width="24" height="24">
                    <rect x="487" width="24" height="24" fill="white"/>
                </mask>
                <g mask="url(#mask0_0_1)">
                    <path d="M496.576 13.1548C496.005 12.3966 495.314 11.8637 494.788 11.0282C494.23 10.1403 493.792 9.26374 493.405 8.29316C492.908 7.04081 490.442 5.87263 492.259 4.58574C492.858 4.16033 493.753 4.23795 494.145 4.93325C494.467 5.50105 494.2 6.40812 494.174 6.97423C494.098 8.65104 495.804 10.7099 496.765 11.9747C497.029 11.8251 496.56 9.38926 496.513 8.91438C496.424 8.0002 496.547 6.72392 496.249 5.84375C495.989 5.07367 495.022 4.78504 495.057 3.9178C495.091 3.05486 496.033 2.57347 496.798 2.51577C497.703 2.45013 497.971 2.69549 498.102 3.48811C498.178 3.94051 498.234 4.53935 498.002 4.94715C497.828 5.24855 497.488 5.35734 497.357 5.72576C497.057 6.554 497.429 7.86877 497.516 8.69943C497.611 9.60556 497.488 10.9082 497.884 11.7091C499.35 9.91195 500.722 8.10244 501.45 5.89758C501.84 4.71311 500.985 4.96487 500.697 3.86709C500.512 3.15502 500.944 2.41416 501.686 2.23081C502.217 2.0987 503.086 2.50592 503.409 2.96006C504.141 3.98457 502.837 5.03637 502.419 5.87104C501.86 6.98519 501.457 8.03651 500.746 9.08688C500.476 9.48533 498.553 11.7792 498.675 12.0406C499.625 11.8625 500.537 11.2108 501.383 10.7343C502.172 10.2899 503.311 9.72917 503.875 8.97925C504.391 8.29322 503.791 8.0263 504.101 7.21266C504.427 6.35276 505.415 6.08764 506.164 6.64136C506.918 7.19995 507.127 8.19553 506.436 8.81929C505.805 9.38516 505.297 9.04704 504.621 9.32661C503.738 9.69299 502.859 10.5944 502.019 11.0935C501.599 11.3452 499.274 12.4212 499.301 12.7445C501.442 13.2393 502.96 12.8113 504.881 11.7922C505.55 11.4372 506.578 10.9977 506.98 10.3143C507.456 9.50471 507.494 8.71237 508.507 8.25772C508.877 8.09143 509.561 8.24669 509.919 8.40736C510.501 8.67634 510.385 10.2296 510.085 10.6634C509.552 11.4394 508.733 11.3847 507.947 11.2732C507.05 11.147 506.571 11.6846 505.766 12.1445C504.13 13.0826 502.347 13.936 500.424 13.737C499.493 13.6414 498.863 13.0991 498.44 14.0733C497.993 15.0969 497.538 15.9136 496.969 16.8731C494.871 20.4015 492.374 23.6936 488.945 26.0313C488.1 26.6042 487.254 27.1815 486.395 27.7263C485.66 28.1952 484.716 28.4573 484.309 29.3066C484.016 29.9167 484.111 30.319 483.454 30.6844C482.611 31.1479 481.892 31.2554 481.442 30.3379C481.081 29.6072 481.294 28.8771 481.943 28.3706C482.708 27.7784 483.395 28.2144 484.242 28.0579C485.192 27.8799 485.906 27.141 486.698 26.64C487.49 26.1433 488.292 25.6963 489.055 25.1521C492.369 22.7685 495.129 18.9281 496.94 15.2965C497.448 14.2764 497.199 14.349 496.235 14.131C495.146 13.8789 494.208 13.1341 493.383 12.3866C491.715 10.8759 490.913 9.42161 490.239 7.29183C489.95 6.37345 489.845 4.91397 489.171 4.24747C488.566 3.64704 487.728 3.10797 488.05 2.07672C488.303 1.27304 489.687 0.937108 490.434 1.10937C491.342 1.31583 491.323 2.82482 491.032 3.55343C490.805 4.12395 490.545 4.25199 490.603 4.87293C490.653 5.3877 490.936 5.91975 491.08 6.41612C491.393 7.48224 491.67 8.5525 492.203 9.53779C492.492 10.0882 496.243 13.8077 496.576 13.1548ZM489.961 3.7244C490.584 3.49037 490.528 2.05483 489.901 1.82388C489.581 1.70757 488.901 1.95156 488.826 2.29654C488.704 2.82394 489.581 3.53883 489.961 3.7244ZM509.265 9.54421C509.281 9.35787 509.297 9.16723 509.313 8.9809C508.667 8.99284 507.607 9.54639 508.209 10.3305C508.86 11.1779 509.537 10.3289 509.265 9.54421ZM497.175 3.22662C496.418 3.42121 495.307 3.898 496.607 4.60687C497.667 5.18365 497.271 3.88761 497.175 3.22662ZM502.019 2.90966C501.029 3.02554 501.722 4.38659 502.313 4.42017C502.78 4.44615 502.781 4.10027 502.699 3.73458C502.553 3.11968 502.094 3.46711 502.019 2.90966ZM483.329 29.8444C483.298 29.3496 483.107 28.2205 482.359 29.0778C481.781 29.7382 482.671 30.5863 483.329 29.8444ZM493.3 5.07676C491.982 5.11022 492.58 6.58612 493.434 6.40871C493.388 5.96454 493.342 5.52037 493.3 5.07676ZM505.431 8.38986C506.145 8.38256 506.123 7.49025 505.468 7.27318C504.531 6.95776 505.048 8.09437 505.431 8.38986Z" fill="url(#paint0_linear_0_1)"/>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_0_1" x1="499.56" y1="2.44195" x2="492.819" y2="29.2208" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#292929"/>
                        <stop offset="0.785297" stop-color="#292929" stop-opacity="0"/>
                    </linearGradient>
                </defs>
            </svg>
            <div class="hidi-title text-center">
                <strong>
                    تکمیل اطلاعات کاربری
                </strong>
                <span>
                  لطفا با جزئیات اطلاعات خود را وارد کنید.
                </span>

            </div>
                <div class="row">
                    <div class="col-12">

                                <form name="checkout" action="{{ route("shop.save_billing") }}" method="post" class="checkout woocommerce-checkout">
                                    @csrf
                                    <div class="row" id="customer_details">
                                        <div class="col-12">
                                            <div class="woocommerce-billing-fields">

                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-first validate-required" id="billing_first_name_field">
                                                        <label for="billing_first_name" class="">نام&nbsp;
                                                            <abbr class="required" title="ضروری">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                                <input required type="text" class="input-text " value="@if(isset($billing["billing_first_name"])) {{$billing["billing_first_name"]}} @endif" name="billing_first_name" id="billing_first_name" placeholder=""  >
                                                            </span>
                                                    </p>
                                                    <p class="form-row form-row-wide validate-required" id="billing_phone_field" >
                                                        <label for="billing_phone" class="">تلفن همراه&nbsp;
                                                            <abbr class="required" title="ضروری">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                                <input required type="tel" class="input-text " value="@if(isset($billing["billing_phone"])) {{$billing["billing_phone"]}} @endif" name="billing_phone" id="billing_phone" placeholder="">
                                                            </span>
                                                    </p>
                                                    <div class="form-row address-field validate-required" id="billing_state_field"  data-o_class="form-row form-row-wide ">
                                                        <label for="billing_state" class="">استان&nbsp;
                                                            <abbr class="required" title="ضروری">*</abbr>
                                                        </label>

                                                        <div class="woocommerce-input-wrapper">

                                                            <div class="ir-select">
                                                                <select required name="billing_state" class="ir-province"></select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="4">
                                                        <label for="billing_last_name" class="">نام خانوادگی&nbsp;
                                                            <abbr class="required" title="ضروری">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                                <input required type="text" class="input-text " value="@if(isset($billing["billing_last_name"])) {{$billing["billing_last_name"]}} @endif" name="billing_last_name" id="billing_last_name" placeholder="" autocomplete="family-name">
                                                            </span>
                                                    </p>
                                                    <p class="form-row form-row-wide validate-email" id="billing_email_field" data-priority="5">
                                                        <label for="billing_email" class="">آدرس ایمیل&nbsp;<span class="optional">(اختیاری)</span>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                                <input  type="email" class="input-text " value="@if(isset($billing["billing_email"])) {{$billing["billing_email"]}} @endif" name="billing_email" id="billing_email" placeholder=""  autocomplete="email username">
                                                            </span>
                                                    </p>
                                                    <div class="form-row address-field validate-required form-row-wide" id="billing_city_field" data-priority="6" data-o_class="form-row form-row-wide address-field validate-required">
                                                        <label for="billing_city" class="">شهر&nbsp;
                                                            <abbr class="required" title="ضروری">*</abbr>
                                                        </label>
                                                        <div class="woocommerce-input-wrapper">
                                                            <div class="ir-select">

                                                                <select required name="billing_city" class="ir-city"></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="form-row address-field validate-required form-row-wide" id="billing_address_2_field" data-priority="1">
                                                        <label for="billing_address" class="screen-reader-text">آدرس کامل خود را وارد کنید<abbr class="required" title="ضروری">*</abbr></label><span class="woocommerce-input-wrapper">
                                                                <input required type="text" class="input-text " value="@if(isset($billing["billing_address"])) {{$billing["billing_address"]}} @endif" name="billing_address" id="billing_address" placeholder="مثال : تهران - خیابان جمهوری - کوچه شهید ولایتی - پلاک 6 - واحد" autocomplete="address-line2" >
                                                            </span>
                                                    </p>
                                                    <p class="form-row address-field validate-postcode  form-row-wide" id="billing_postcode_field"  data-o_class="form-row form-row-wide address-field validate-postcode">
                                                        <label for="billing_postcode" class="">کدپستی (بدون فاصله و با اعداد انگلیسی)&nbsp;<abbr class="required" title="ضروری">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                                <input required type="text" class="input-text " name="billing_postcode" value="@if(isset($billing["billing_postcode"])) {{$billing["billing_postcode"]}} @endif" id="billing_postcode" placeholder="" autocomplete="postal-code">
                                                            </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="checkout-box-btn">
                                            <div>
                                                <a href="/cart" class="return_back">
                                                    <svg class="ml-2" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.25 1.25L19 5M19 5L15.25 8.75M19 5H1" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                    بازگشت به مرحله قبل

                                                </a>
                                            </div>
                                            <button type="submit" class="checkout-button">
                                                ثبت و ادامه فرایند خرید
                                            </button>
                                        </div>
                                    </div>
                                </form>

                    </div>

                </div>
                @push("js")
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

                    <script src="{{ theme_asset("js/ir-city-select.min.js") }}"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
                    <script>
                        jQuery(document).ready(function($){
                            $("input[required], select[required]").attr("oninvalid", "this.setCustomValidity('لطفا این بخش را پر کنید!')");
                            $("input[required], select[required]").attr("oninput", "setCustomValidity('')");
                        })
                        $("select.ir-province").select2({
                            tags: false,
                        });
                        $("select.ir-city").select2({
                            tags: false,
                        });

                    </script>
                @endpush

                @push("css")
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />

                @endpush
        </div>
    </div>

@endsection
