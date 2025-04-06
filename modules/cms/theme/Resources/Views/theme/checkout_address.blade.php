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
                            <a href="#">اطلاعات ارسال سفارش</a>
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
                <div class="cart-checkout-top-item complete ">
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
                <div class="cart-checkout-top-item current">
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


            <form method="post" action="{{ route("shop.checkout_save_address") }}">
                @csrf
                <div class="hidi-title text-center">
                    <strong>
                        اطلاعات ارسال سفارش
                    </strong>
                    <span>
                  اطلاعات شخص گیرنده را مشخص کنید.
                </span>

                </div>
                <div class="checkout_addresses">
                    <div class="row">
                        @if(is_array($address))
                            @foreach($address as $key=>$addres)
                                <div class="col-md-6 mb-4">
                                    <div class="address-box-item @if($loop->index==0) active @endif">
                                        <div class="address-box-item-top">
                                            <div class="address-box-item-top-right">
                                                <label>
                                                    <input @if($loop->index==0) checked="checked" @endif type="radio" name="selected_address" value="{{ $key }}">
                                                    <span class="checkmark"></span>
                                                </label>

                                                <strong>{{ $addres["billing_first_name"]??"" }}  {{ $addres["billing_last_name"]??"" }}</strong>
                                            </div>
                                            <div class="address-box-item-top-left">
                                                <a href="{{ route("user.delete_address",$key) }}">
                                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.2833 6.50001L9.995 14M6.005 14L5.71667 6.50001M14.0233 3.82501C14.3083 3.86834 14.5917 3.91417 14.875 3.96334M14.0233 3.82584L13.1333 15.3942C13.097 15.8652 12.8842 16.3051 12.5375 16.626C12.1908 16.9469 11.7358 17.1251 11.2633 17.125H4.73667C4.26425 17.1251 3.80919 16.9469 3.46248 16.626C3.11578 16.3051 2.90299 15.8652 2.86667 15.3942L1.97667 3.82501M14.0233 3.82501C13.0616 3.6796 12.0948 3.56925 11.125 3.49417M1.125 3.96251C1.40833 3.91334 1.69167 3.86751 1.97667 3.82501M1.97667 3.82501C2.93844 3.67961 3.9052 3.56926 4.875 3.49417M11.125 3.49417V2.73084C11.125 1.74751 10.3667 0.927507 9.38333 0.896674C8.46135 0.867206 7.53865 0.867206 6.61667 0.896674C5.63333 0.927507 4.875 1.74834 4.875 2.73084V3.49417M11.125 3.49417C9.04477 3.33341 6.95523 3.33341 4.875 3.49417" stroke="#29292940" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="address-box-item-bottom">
                                            <p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.16">
                                                        <path d="M8 9.33331C9.10457 9.33331 10 8.43788 10 7.33331C10 6.22874 9.10457 5.33331 8 5.33331C6.89543 5.33331 6 6.22874 6 7.33331C6 8.43788 6.89543 9.33331 8 9.33331Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M11.7726 11.1047L8.94397 13.9333C8.69396 14.1831 8.35503 14.3234 8.00164 14.3234C7.64825 14.3234 7.30931 14.1831 7.0593 13.9333L4.22997 11.1047C3.48412 10.3588 2.9762 9.40845 2.77043 8.3739C2.56466 7.33934 2.6703 6.267 3.07397 5.29247C3.47765 4.31795 4.16124 3.48501 5.03829 2.89899C5.91535 2.31297 6.94648 2.00018 8.0013 2.00018C9.05613 2.00018 10.0873 2.31297 10.9643 2.89899C11.8414 3.48501 12.525 4.31795 12.9286 5.29247C13.3323 6.267 13.4379 7.33934 13.2322 8.3739C13.0264 9.40845 12.5185 10.3588 11.7726 11.1047V11.1047Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                </svg>

                                                {{ $addres["billing_address"]??"" }}
                                            </p>

                                            <p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.16">
                                                        <path d="M3.33333 2.66669H6L7.33333 6.00002L5.66667 7.00002C6.38064 8.44771 7.55231 9.61938 9 10.3334L10 8.66669L13.3333 10V12.6667C13.3333 13.0203 13.1929 13.3594 12.9428 13.6095C12.6928 13.8595 12.3536 14 12 14C9.39951 13.842 6.94677 12.7377 5.10455 10.8955C3.26234 9.05325 2.15803 6.60051 2 4.00002C2 3.6464 2.14048 3.30726 2.39052 3.05721C2.64057 2.80716 2.97971 2.66669 3.33333 2.66669" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M10 4.66669C10.3536 4.66669 10.6928 4.80716 10.9428 5.05721C11.1929 5.30726 11.3333 5.6464 11.3333 6.00002" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M10 2C11.0609 2 12.0783 2.42143 12.8284 3.17157C13.5786 3.92172 14 4.93913 14 6" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                </svg>

                                                {{ $addres["billing_phone"]??"" }}
                                            </p>
                                            <p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.16" clip-path="url(#clip0_867_1203)">
                                                        <path d="M6.66667 14V9.66665C6.66667 9.04781 6.42083 8.45432 5.98325 8.01673C5.54566 7.57915 4.95217 7.33331 4.33333 7.33331C3.71449 7.33331 3.121 7.57915 2.68342 8.01673C2.24583 8.45432 2 9.04781 2 9.66665V14H14V9.99998C14 9.29274 13.719 8.61446 13.219 8.11436C12.7189 7.61426 12.0406 7.33331 11.3333 7.33331H4.33333" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M8 7.33333V2H10.6667L12 3.33333L10.6667 4.66667H8" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M4 10H4.66667" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_867_1203">
                                                            <rect width="16" height="16" fill="white"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>

                                                {{ $addres["billing_postcode"]??"" }}
                                            </p>


                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-6 mb-4">
                            <div class="address-add-new">
                                <a href="/checkout">
                                    <svg class="ml-1" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 1V11M11 6H1" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    افرودن آدرس جدید
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidi-title text-center">
                    <strong>
                        نحوه  ارسال سفارش
                    </strong>
                    <span>
                  زمان ارسال و نحوه تحویل محصول خود را انتخاب کنید.
                </span>

                </div>
                <div class="checkout_addresses">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="gateway-box-item active">
                                        <div class="address-box-item-top">
                                            <div class="address-box-item-top-right">
                                                <label>
                                                    <input checked  type="radio" name="selected_delivery" value="default">
                                                    <span class="checkmark"></span>
                                                </label>

                                                <strong>
                                                    <svg class="ml-1" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_893_212)">
                                                            <path d="M6.66602 22.6667H3.99935V17.3333M2.66602 6.66666H17.3327V22.6667M11.9993 22.6667H19.9993M25.3327 22.6667H27.9993V14.6667H17.3327M17.3327 7.99999H23.9993L27.9993 14.6667" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M9.33268 25.3333C10.8054 25.3333 11.9993 24.1394 11.9993 22.6667C11.9993 21.1939 10.8054 20 9.33268 20C7.85992 20 6.66602 21.1939 6.66602 22.6667C6.66602 24.1394 7.85992 25.3333 9.33268 25.3333Z" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M22.6667 25.3333C24.1394 25.3333 25.3333 24.1394 25.3333 22.6667C25.3333 21.1939 24.1394 20 22.6667 20C21.1939 20 20 21.1939 20 22.6667C20 24.1394 21.1939 25.3333 22.6667 25.3333Z" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M4 12H9.33333" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_893_212">
                                                                <rect width="32" height="32" fill="white"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    پست پیشتاز ( سراسر کشور )
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="address-box-item-bottom">
                                            <p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.16" clip-path="url(#clip0_893_241)">
                                                        <path d="M7.99935 2L13.3327 5V11L7.99935 14L2.66602 11V5L7.99935 2Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M8 8L13.3333 5" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M8 8V14" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M7.99935 8L2.66602 5" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M5.5 3.5L10.5 6.25" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_893_241">
                                                            <rect width="16" height="16" fill="white"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>


                                                زمان تقریبی ارسال سفارش بر اساس محدوده جغرافیایی ۵ الی ۷ روز کاری
                                            </p>

                                            <p>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.16">
                                                        <path d="M1.5 12.5C5.05707 12.4971 8.59867 12.9681 12.0313 13.9007C12.516 14.0327 13 13.6727 13 13.17V12.5M2.5 3V3.5C2.5 3.63261 2.44732 3.75979 2.35355 3.85355C2.25979 3.94732 2.13261 4 2 4H1.5M1.5 4V3.75C1.5 3.336 1.836 3 2.25 3H13.5M1.5 4V10M13.5 3V3.5C13.5 3.776 13.724 4 14 4H14.5M13.5 3H13.75C14.164 3 14.5 3.336 14.5 3.75V10.25C14.5 10.664 14.164 11 13.75 11H13.5M14.5 10H14C13.8674 10 13.7402 10.0527 13.6464 10.1464C13.5527 10.2402 13.5 10.3674 13.5 10.5V11M13.5 11H2.5M2.5 11H2.25C2.05109 11 1.86032 10.921 1.71967 10.7803C1.57902 10.6397 1.5 10.4489 1.5 10.25V10M2.5 11V10.5C2.5 10.3674 2.44732 10.2402 2.35355 10.1464C2.25979 10.0527 2.13261 10 2 10H1.5M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7V7ZM12 7H12.0053V7.00533H12V7ZM4 7H4.00533V7.00533H4V7Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                </svg>
                                                ۳۵,۰۰۰ تومان هزینه ارسال
                                            </p>
                                        </div>

                                    </div>
                        </div>
                        {{--<div class="col-md-6 mb-4">
                            <div class="gateway-box-item">
                                <div class="address-box-item-top">
                                    <div class="address-box-item-top-right">
                                        <label>
                                            <input  type="radio" name="selected_delivery" value="free">
                                            <span class="checkmark"></span>
                                        </label>

                                        <strong>
                                            <svg class="ml-1" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_893_207)">
                                                    <path d="M24.0007 25.3333C25.4734 25.3333 26.6673 24.1394 26.6673 22.6667C26.6673 21.1939 25.4734 20 24.0007 20C22.5279 20 21.334 21.1939 21.334 22.6667C21.334 24.1394 22.5279 25.3333 24.0007 25.3333Z" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M6.66667 21.3333V22.6667C6.66667 23.3739 6.94762 24.0522 7.44772 24.5523C7.94781 25.0524 8.62609 25.3333 9.33333 25.3333C10.0406 25.3333 10.7189 25.0524 11.219 24.5523C11.719 24.0522 12 23.3739 12 22.6667V16H8C6.93913 16 5.92172 16.4214 5.17157 17.1716C4.42143 17.9217 4 18.9391 4 20V21.3333H17.3333C17.8275 19.9055 18.7159 18.6469 19.8957 17.703C21.0756 16.7592 22.4985 16.1687 24 16V9.33332C24 8.62608 23.719 7.9478 23.219 7.4477C22.7189 6.94761 22.0406 6.66666 21.3333 6.66666H20" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M8 12H12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_893_207">
                                                        <rect width="32" height="32" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            پست رایگان و سریع به ساوجی ها
                                        </strong>
                                    </div>
                                </div>
                                <div class="address-box-item-bottom">
                                    <p>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.16" clip-path="url(#clip0_893_241)">
                                                <path d="M7.99935 2L13.3327 5V11L7.99935 14L2.66602 11V5L7.99935 2Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 8L13.3333 5" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 8V14" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.99935 8L2.66602 5" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.5 3.5L10.5 6.25" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_893_241">
                                                    <rect width="16" height="16" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>


                                        زمان تقریبی ارسال سفارش ۲۴ ساعت کاری
                                    </p>

                                    <p>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.16">
                                                <path d="M1.5 12.5C5.05707 12.4971 8.59867 12.9681 12.0313 13.9007C12.516 14.0327 13 13.6727 13 13.17V12.5M2.5 3V3.5C2.5 3.63261 2.44732 3.75979 2.35355 3.85355C2.25979 3.94732 2.13261 4 2 4H1.5M1.5 4V3.75C1.5 3.336 1.836 3 2.25 3H13.5M1.5 4V10M13.5 3V3.5C13.5 3.776 13.724 4 14 4H14.5M13.5 3H13.75C14.164 3 14.5 3.336 14.5 3.75V10.25C14.5 10.664 14.164 11 13.75 11H13.5M14.5 10H14C13.8674 10 13.7402 10.0527 13.6464 10.1464C13.5527 10.2402 13.5 10.3674 13.5 10.5V11M13.5 11H2.5M2.5 11H2.25C2.05109 11 1.86032 10.921 1.71967 10.7803C1.57902 10.6397 1.5 10.4489 1.5 10.25V10M2.5 11V10.5C2.5 10.3674 2.44732 10.2402 2.35355 10.1464C2.25979 10.0527 2.13261 10 2 10H1.5M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7V7ZM12 7H12.0053V7.00533H12V7ZM4 7H4.00533V7.00533H4V7Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                        </svg>
                                        رایگان
                                    </p>
                                </div>

                            </div>
                        </div>--}}
                    </div>
                </div>
                <div class="checkout-box-btn">
                        <div>
                            <a href="/checkout" class="return_back">
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
            </form>


                @push("js")
                <script>
                    jQuery(document).ready(function (){
                        jQuery(".address-box-item").click(function(){
                            jQuery(".address-box-item").removeClass("active")
                            jQuery(this).addClass("active")
                            jQuery(".address-box-item").find("input").prop("checked",false)
                            jQuery(this).find("input").prop("checked",true)
                        })

                        jQuery(".gateway-box-item").click(function(){
                            jQuery(".gateway-box-item").removeClass("active")
                            jQuery(this).addClass("active")
                            jQuery(".gateway-box-item").find("input").prop("checked",false)
                            jQuery(this).find("input").prop("checked",true)
                        })

                    })
                </script>
                @endpush

                @push("css")

                @endpush
        </div>
    </div>

@endsection
