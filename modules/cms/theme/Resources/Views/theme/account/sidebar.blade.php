<div class="col-12 col-lg-3">
    <form method="post" action="{{ route("user.edit_avatar") }}" enctype="multipart/form-data" style="display:none">
        @csrf
        <input type="file" name="user_image" class="file">
        <input type="submit" name="btn" class="btn">
    </form>
    <section class="o-page__aside">
        <div class="c-profile-aside">
            <div class=" c-profile-box">
                <div class="c-profile-box__section">
                    <div class="c-profile-box__header">
                        <div class="c-profile-box__avatar js-user-avatar js-change-avatar">
                            <img data-src="{{ theme_asset("img/user_avatar.png") }}" alt="">

                        </div>
                        <div class="c-profile-box__header-content">
                            <div class="c-profile-box__name">
                                <strong>
                                    @if(auth()->user()->name)
                                    {{ auth()->user()->name }} @if(isset($user_data["lastname"])){{ $user_data["lastname"] }}@endif
                                    @else
                                        {{ auth()->user()->mobile??auth()->user()->email }}
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="c-profile-wallet">
                        موجودی کیف پول شما : <span>
                            @if(is_object($wallet))
                                {{ format_price_with_currencySymbol($wallet->price) }}
                            @else
                                فاقد اعتبار
                            @endif
                        </span>
                    </div>


                    <svg class="w-100" width="234" height="24" viewBox="0 0 234 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="234" y1="13" x2="141" y2="13" stroke="#8C8C8C" stroke-opacity="0.07" stroke-width="2"/>
                        <line x1="93" y1="13" y2="13" stroke="#8C8C8C" stroke-opacity="0.07" stroke-width="2"/>
                        <mask id="mask0_0_1" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="105" y="0" width="24" height="24">
                            <rect x="105" width="24" height="24" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_0_1)">
                            <path d="M114.578 13.1548C114.007 12.3966 113.316 11.8637 112.79 11.0282C112.232 10.1403 111.794 9.26374 111.407 8.29316C110.91 7.04081 108.444 5.87263 110.261 4.58574C110.86 4.16033 111.755 4.23795 112.147 4.93325C112.469 5.50105 112.202 6.40812 112.176 6.97423C112.1 8.65104 113.806 10.7099 114.767 11.9747C115.031 11.8251 114.562 9.38926 114.515 8.91438C114.426 8.0002 114.549 6.72392 114.251 5.84375C113.991 5.07367 113.024 4.78504 113.059 3.9178C113.093 3.05486 114.035 2.57347 114.8 2.51577C115.705 2.45013 115.973 2.69549 116.104 3.48811C116.18 3.94051 116.236 4.53935 116.004 4.94715C115.83 5.24855 115.49 5.35734 115.359 5.72576C115.059 6.554 115.431 7.86877 115.518 8.69943C115.612 9.60556 115.49 10.9082 115.885 11.7091C117.352 9.91195 118.724 8.10244 119.452 5.89758C119.842 4.71311 118.987 4.96487 118.699 3.86709C118.514 3.15502 118.946 2.41416 119.688 2.23081C120.219 2.0987 121.088 2.50592 121.411 2.96006C122.143 3.98457 120.839 5.03637 120.421 5.87104C119.862 6.98519 119.459 8.03651 118.748 9.08688C118.478 9.48533 116.555 11.7792 116.677 12.0406C117.627 11.8625 118.539 11.2108 119.385 10.7343C120.174 10.2899 121.313 9.72917 121.877 8.97925C122.393 8.29322 121.792 8.0263 122.103 7.21266C122.429 6.35276 123.417 6.08764 124.166 6.64136C124.92 7.19995 125.129 8.19553 124.438 8.81929C123.807 9.38516 123.299 9.04704 122.623 9.32661C121.74 9.69299 120.86 10.5944 120.021 11.0935C119.601 11.3452 117.276 12.4212 117.303 12.7445C119.444 13.2393 120.962 12.8113 122.883 11.7922C123.552 11.4372 124.58 10.9977 124.982 10.3143C125.458 9.50471 125.496 8.71237 126.509 8.25772C126.879 8.09143 127.563 8.24669 127.92 8.40736C128.503 8.67634 128.387 10.2296 128.087 10.6634C127.554 11.4394 126.735 11.3847 125.949 11.2732C125.052 11.147 124.573 11.6846 123.768 12.1445C122.132 13.0826 120.349 13.936 118.426 13.737C117.495 13.6414 116.865 13.0991 116.442 14.0733C115.995 15.0969 115.54 15.9136 114.971 16.8731C112.873 20.4015 110.376 23.6936 106.947 26.0313C106.102 26.6042 105.256 27.1815 104.397 27.7263C103.662 28.1952 102.718 28.4573 102.311 29.3066C102.018 29.9167 102.113 30.319 101.456 30.6844C100.613 31.1479 99.8938 31.2554 99.4439 30.3379C99.0827 29.6072 99.2957 28.8771 99.9449 28.3706C100.71 27.7784 101.397 28.2144 102.244 28.0579C103.194 27.8799 103.908 27.141 104.7 26.64C105.492 26.1433 106.294 25.6963 107.057 25.1521C110.371 22.7685 113.131 18.9281 114.942 15.2965C115.45 14.2764 115.201 14.349 114.237 14.131C113.148 13.8789 112.21 13.1341 111.385 12.3866C109.717 10.8759 108.915 9.42161 108.241 7.29183C107.952 6.37345 107.847 4.91397 107.173 4.24747C106.568 3.64704 105.73 3.10797 106.051 2.07672C106.305 1.27304 107.688 0.937108 108.436 1.10937C109.344 1.31583 109.325 2.82482 109.034 3.55343C108.807 4.12395 108.547 4.25199 108.605 4.87293C108.655 5.3877 108.938 5.91975 109.082 6.41612C109.395 7.48224 109.672 8.5525 110.205 9.53779C110.494 10.0882 114.245 13.8077 114.578 13.1548ZM107.963 3.7244C108.586 3.49037 108.53 2.05483 107.903 1.82388C107.583 1.70757 106.903 1.95156 106.828 2.29654C106.706 2.82394 107.583 3.53883 107.963 3.7244ZM127.267 9.54421C127.283 9.35787 127.299 9.16723 127.315 8.9809C126.669 8.99284 125.609 9.54639 126.211 10.3305C126.862 11.1779 127.539 10.3289 127.267 9.54421ZM115.177 3.22662C114.42 3.42121 113.309 3.898 114.609 4.60687C115.669 5.18365 115.273 3.88761 115.177 3.22662ZM120.021 2.90966C119.031 3.02554 119.723 4.38659 120.315 4.42017C120.782 4.44615 120.783 4.10027 120.701 3.73458C120.555 3.11968 120.096 3.46711 120.021 2.90966ZM101.331 29.8444C101.3 29.3496 101.109 28.2205 100.361 29.0778C99.7834 29.7382 100.673 30.5863 101.331 29.8444ZM111.302 5.07676C109.984 5.11022 110.582 6.58612 111.436 6.40871C111.39 5.96454 111.344 5.52037 111.302 5.07676ZM123.433 8.38986C124.147 8.38256 124.125 7.49025 123.47 7.27318C122.533 6.95776 123.05 8.09437 123.433 8.38986Z" fill="url(#paint0_linear_0_1)"/>
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_0_1" x1="117.562" y1="2.44195" x2="110.821" y2="29.2208" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#292929"/>
                                <stop offset="0.785297" stop-color="#292929" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg>



                    <div class="c-profile-box__section"><ul class="c-profile-menu">

                            <nav class="woocommerce-MyAccount-navigation">
                                <ul>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard {{  request()->route()->getName() == "user.account" ? 'is-active' : '' }} ">
                                        <a href="{{ route("user.account") }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_958_547)">
                                                    <path d="M9 4H5C4.44772 4 4 4.44772 4 5V9C4 9.55228 4.44772 10 5 10H9C9.55228 10 10 9.55228 10 9V5C10 4.44772 9.55228 4 9 4Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M19 4H15C14.4477 4 14 4.44772 14 5V9C14 9.55228 14.4477 10 15 10H19C19.5523 10 20 9.55228 20 9V5C20 4.44772 19.5523 4 19 4Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 14H5C4.44772 14 4 14.4477 4 15V19C4 19.5523 4.44772 20 5 20H9C9.55228 20 10 19.5523 10 19V15C10 14.4477 9.55228 14 9 14Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M19 14H15C14.4477 14 14 14.4477 14 15V19C14 19.5523 14.4477 20 15 20H19C19.5523 20 20 19.5523 20 19V15C20 14.4477 19.5523 14 19 14Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_958_547">
                                                        <rect width="24" height="24" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            پنل کاربری
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders {{ request()->route()->getName() == "user.orders" ? 'is-active' : '' }}">
                                        <a href="{{ route("user.orders") }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g  clip-path="url(#clip0_961_607)">
                                                    <path d="M15 5H17C17.5304 5 18.0391 5.21071 18.4142 5.58579C18.7893 5.96086 19 6.46957 19 7V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21H7C6.46957 21 5.96086 20.7893 5.58579 20.4142C5.21071 20.0391 5 19.5304 5 19V7C5 6.46957 5.21071 5.96086 5.58579 5.58579C5.96086 5.21071 6.46957 5 7 5H9" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M11 3H13C14.1046 3 15 3.89543 15 5C15 6.10457 14.1046 7 13 7H11C9.89543 7 9 6.10457 9 5C9 3.89543 9.89543 3 11 3Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M15 12H14.99" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M11 12H9" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M15 16H14.99" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M11 16H9" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_961_607">
                                                        <rect width="24" height="24" fill="white" transform="matrix(-1 0 0 1 24 0)"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            سفارشات
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--address {{ request()->route()->getName() == "user.address" ? 'is-active' : '' }}">
                                        <a href="{{ route("user.address") }}">

                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g  clip-path="url(#clip0_961_641)">
                                                    <path d="M12 14C13.6569 14 15 12.6569 15 11C15 9.34315 13.6569 8 12 8C10.3431 8 9 9.34315 9 11C9 12.6569 10.3431 14 12 14Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M17.657 16.657L13.414 20.9C13.039 21.2746 12.5306 21.4851 12.0005 21.4851C11.4704 21.4851 10.962 21.2746 10.587 20.9L6.343 16.657C5.22422 15.5382 4.46234 14.1127 4.15369 12.5609C3.84504 11.009 4.00349 9.40053 4.60901 7.93874C5.21452 6.47696 6.2399 5.22755 7.55548 4.34852C8.87107 3.46949 10.4178 3.00031 12 3.00031C13.5822 3.00031 15.1289 3.46949 16.4445 4.34852C17.7601 5.22755 18.7855 6.47696 19.391 7.93874C19.9965 9.40053 20.155 11.009 19.8463 12.5609C19.5377 14.1127 18.7758 15.5382 17.657 16.657V16.657Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_961_641">
                                                        <rect width="24" height="24" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>



                                            آدرس ها
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders {{ request()->route()->getName() == "user.comments" ? 'is-active' : '' }}">
                                        <a href="{{ route("user.comments") }}">

                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g  clip-path="url(#clip0_961_661)">
                                                    <path d="M20 21V8C20 7.20435 19.6839 6.44129 19.1213 5.87868C18.5587 5.31607 17.7956 5 17 5H7C6.20435 5 5.44129 5.31607 4.87868 5.87868C4.31607 6.44129 4 7.20435 4 8V14C4 14.7956 4.31607 15.5587 4.87868 16.1213C5.44129 16.6839 6.20435 17 7 17H16L20 21Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M16 9H8" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M16 13H10" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_961_661">
                                                        <rect width="24" height="24" fill="white" transform="matrix(-1 0 0 1 24 0)"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>


                                            نظرات
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders {{ request()->route()->getName() == "user.wishlist" ? 'is-active' : '' }}">
                                        <a href="{{ route("user.wishlist") }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g  clip-path="url(#clip0_961_635)">
                                                    <path d="M19.5013 13.572L12.0013 21L4.50128 13.572M4.50128 13.572C4.00658 13.0906 3.61692 12.512 3.35683 11.8726C3.09673 11.2333 2.97184 10.5469 2.99002 9.85693C3.00819 9.16691 3.16904 8.48813 3.46244 7.86333C3.75583 7.23853 4.17541 6.68125 4.69476 6.22657C5.21411 5.7719 5.82198 5.42968 6.48009 5.22147C7.1382 5.01327 7.83228 4.94358 8.51865 5.0168C9.20501 5.09001 9.86878 5.30455 10.4682 5.6469C11.0675 5.98925 11.5895 6.45199 12.0013 7.00599C12.4148 6.45602 12.9374 5.99731 13.5364 5.6586C14.1353 5.31988 14.7978 5.10844 15.4822 5.03751C16.1666 4.96658 16.8584 5.03769 17.5141 5.24639C18.1697 5.45508 18.7753 5.79687 19.2928 6.25036C19.8104 6.70385 20.2287 7.25928 20.5217 7.88189C20.8147 8.50449 20.976 9.18088 20.9956 9.8687C21.0152 10.5565 20.8925 11.241 20.6354 11.8792C20.3783 12.5175 19.9922 13.0958 19.5013 13.578" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_961_635">
                                                        <rect width="24" height="24" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            علاقه مندی ها
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account {{ request()->route()->getName() == "user.edit" ? 'is-active' : '' }}" >
                                        <a href="{{ route("user.edit") }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22.071" viewBox="0 0 17.5 22.071">
                                                <g  id="User-1" transform="translate(-4.25 -2.25)">
                                                    <path id="Path_145" data-name="Path 145" d="M5,19.842A5.56,5.56,0,0,1,9.576,14.3l.237-.039a19.582,19.582,0,0,1,6.373,0l.237.039A5.56,5.56,0,0,1,21,19.842,2.125,2.125,0,0,1,18.911,22H7.089A2.125,2.125,0,0,1,5,19.842Z" transform="translate(0 1.571)" fill="none" stroke="#4a5057" stroke-width="1.5"/>
                                                    <path id="Path_146" data-name="Path 146" d="M17.25,7.5A4.586,4.586,0,0,1,12.583,12,4.586,4.586,0,0,1,7.917,7.5,4.586,4.586,0,0,1,12.583,3,4.586,4.586,0,0,1,17.25,7.5Z" transform="translate(0.417 0)" fill="none" stroke="#4a5057" stroke-width="1.5"/>
                                                </g>
                                            </svg>

                                            اطلاعات حساب کاربری
                                        </a>
                                    </li>
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account {{ request()->route()->getName() == "user.wallet" ? 'is-active' : '' }}" >
                                        <a href="{{ route("user.wallet") }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g  clip-path="url(#clip0_958_535)">
                                                    <path d="M17 8V5C17 4.73478 16.8946 4.48043 16.7071 4.29289C16.5196 4.10536 16.2652 4 16 4H6C5.46957 4 4.96086 4.21071 4.58579 4.58579C4.21071 4.96086 4 5.46957 4 6C4 6.53043 4.21071 7.03914 4.58579 7.41421C4.96086 7.78929 5.46957 8 6 8H18C18.2652 8 18.5196 8.10536 18.7071 8.29289C18.8946 8.48043 19 8.73478 19 9V12M19 16V19C19 19.2652 18.8946 19.5196 18.7071 19.7071C18.5196 19.8946 18.2652 20 18 20H6C5.46957 20 4.96086 19.7893 4.58579 19.4142C4.21071 19.0391 4 18.5304 4 18V6" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M20 12V16H16C15.4696 16 14.9609 15.7893 14.5858 15.4142C14.2107 15.0391 14 14.5304 14 14C14 13.4696 14.2107 12.9609 14.5858 12.5858C14.9609 12.2107 15.4696 12 16 12H20Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_958_535">
                                                        <rect width="24" height="24" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            کیف پول
                                        </a>
                                    </li>
                                    @if(auth()->user()->hasPermissionTo(CMS\RolePermissions\Models\Permission::PERMISSION_AFFILIATE))
                                        <li class="goto_bazaryab-panel">

                                                <a href="{{ route("affiliate.index") }}">ورود به پنل بازاریابی</a>

                                        </li>
                                    @endif
                                    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g  clip-path="url(#clip0_962_672)">
                                                <path d="M14 8V6C14 5.46957 13.7893 4.96086 13.4142 4.58579C13.0391 4.21071 12.5304 4 12 4H5C4.46957 4 3.96086 4.21071 3.58579 4.58579C3.21071 4.96086 3 5.46957 3 6V18C3 18.5304 3.21071 19.0391 3.58579 19.4142C3.96086 19.7893 4.46957 20 5 20H12C12.5304 20 13.0391 19.7893 13.4142 19.4142C13.7893 19.0391 14 18.5304 14 18V16" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 12H21L18 9M18 15L21 12" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_962_672">
                                                    <rect width="24" height="24" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>


                                        <form action="{{ route("logout") }}" method="post">
                                            @csrf
                                            <button type="submit" style="
    text-align: right;
    display: block;
    -webkit-transition: .2s;
    -o-transition: .2s;
    transition: .2s;
    font-size: 14px;
    border-radius: 20px;

    color: #29292980;
    border: 0;
    background: transparent;
">خروج از حساب</button>
                                        </form>
                                    </li>


                                </ul>
                            </nav>
                        </ul>
                    </div>
                </div></div></div></section>



</div>
@push("js")
    <script>
        jQuery(document).ready(function($) {

            $(".openImage").click(function(){

                $(".file").click();
            })
            $(".file").change(function(){
                $(".btn").click();
            })
        })
    </script>
@endpush
@push("css")
    <style>
        @media(min-width:1200px) {
            .mainarticlecontetngm {
                height:565px;
            }
        }
        @media(max-width:992px) {
            .fr,.fl{
                float:none
            }
            .dsdss{display:none !important;}
        }

        /*    body >header {display:none;}
        */

        .c-profile-box {
            border-radius:10px;
            border:2px solid rgba(140, 140, 140, 0.17);
            background-color: #fff;
            padding: 16px;
        }.invite-friend-box {
                     margin-top: 50px;
                     color: #fff;
                     border-radius: 20px;
                     padding: 20px;
                     direction: ltr;
                     background-size: cover;
                     height: 208px;
         }.invite-friend-box-content span {
              font-size: 12px;
          }.invite-friend-box-content p {
               line-height: 34px;

           }.invite-friend-box-content a {
                background: #FFFFFF;
                border-radius: 8px;
                padding: 4px 17px;
                border: 0;
                transition: .4s;
                font-size: 14px;
                color: #117765;
            }
        .c-profile-box__header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;

            align-items: center;
            position: relative;
        }
        .c-profile-box__avatar {
            width: 55px;
            height: 55px;
            background: #fff;
            background-size: contain;
            border-radius: 50%;
            background-repeat: no-repeat;
            background-position: 50%;
            position: relative;
            left: 0;
            top: 0;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .c-profile-box__avatar img {
            width:55px;height:55px;border-radius: 10px;

        }.c-profile-box__name strong {
             font-weight: 800;
             font-size: 15px;
         }tr.woocommerce-orders-table__row.woocommerce-orders-table__row--status-cancelled.order {
              border-bottom: 2px solid rgba(140, 140, 140, 0.07);
          }
        .c-profile-box__header-content {
            height: 48px;
            margin-right: 16px;
        }
        .c-profile-box__username {
            font-size: 16px;
            line-height: 1.375;
            vertical-align: center;
            color: #232933;
            font-weight: 700;
        }
        .c-profile-box__phone {
            font-size: 12px;
            line-height: 1.833;
            color: #81858b;
        }
        .c-profile-box__section+.c-profile-box__section {
            border-top: 1px solid #ededed;
        }
        .c-profile-menu li {
            list-style: none;
        }
        .c-profile-menu li a {
            font-size: 14px;
            line-height: 1.571;
            color: #424750;
            cursor: pointer;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 12px 0;
        }
        .c-profile-menu li svg {
            margin-left: 10px;opacity: .24;
        }
        .c-profile-box__section+.c-profile-box__section {
            border-top: 1px solid #ededed;
        }



        .o-headline--profile {
            padding-left: 0;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            color: #858585;
            margin: 10px 0 15px;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;    margin-top: 0 !important;
        }.c-profile-menu li:last-child form {
             margin: 0;
         }
        .c-profile-menu li:last-child {
            display: flex;padding: 12px 10px
        ;
            align-items: center;
        }
        .o-headline {
            margin: 26px 0 20px;
            padding: 0 0px;
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .o-headline--profile>span {
            color: inherit;
            font-weight: 400;
        }
        .o-headline>h2, .o-headline>span {
            color: #292929;
            font-size: 18px;
            line-height: 31px;
            font-weight: 800;
        }
        .ns-profile-content table.table {
            background: #fff;
            margin-bottom: 23px;
            padding-bottom: 43px;
            border-radius: 20px;
        }.ns-profile-content table.table td {
             border: 0;
         }.ns-profile-content table.table a {
              border: solid 1.5px #117765;
              color: #117765 !important;
              padding: 4px 10px;
              border-radius: 10px;
              font-size: 14px;
          }
        .ns-profile-content table.table .title {
            display: block;
            font-size: 13px;
            line-height: 1.692;
            letter-spacing: -.3px;
            margin-bottom: 4px;
            color: #4A5057;
        }
        .ns-profile-content table.table .value {
            font-size: 16px;
            /* font-size: 1.357rem; */
            line-height: 1.158;
            direction: ltr;
            text-align: right;
            letter-spacing: -.5px;
            color: #4A5057;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table th {
             text-align: center;
             font-size: 14px;
         }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table {
              border-collapse: collapse;
          }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table {
               border-radius: 20px;
               overflow: hidden;
           }
        .woocommerce-MyAccount-content .btn{


            color: #1ca2bd !important;
            padding: 0;
            line-height: 2;
            background: transparent;
            font-weight: 400;    position: relative;

        }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table thead {
             background: #4a505729;

         }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table th {
              padding: 12px 12px
          ;
          }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table td {
               font-size: 14px;    padding: 20px 0;
           }.pending {
                color: #FEC212
                                                  ;
            }.failed {
                 color:#EF394E
                                                               ;
             }.processing {
                  color: #28D5C2
                                                                             ;
              }td.woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-actions i {
                   color: #C9CBCE;
                   font-size: 18px;
                   font-weight: 400;
               }td.woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-number a {
                    color: #4A5057;
                }td.woocommerce-orders-table__cell {
                     text-align: center !important;
                 }table.shop_table.woocommerce-checkout-review-order-table td {
                      text-align: center;
                  }
        .c-table-orders__head .c-table-orders__row {
            border-bottom: none;
        }
        .c-table-orders__row {
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            border-bottom: 1px solid #f2f2f2;
        }
        .c-table-orders__head--highlighted .c-table-orders__cell {
            background-color: #85b3be;
            border-right-color: #85b3be;
            border-bottom: none;
            font-weight: 700;
            letter-spacing: .2px;
            font-size: 13px;
            line-height: 1.692;
            color: #fff;
            padding-top: 12px;
            padding-bottom: 12px;
            min-height: 45px;
        }
        .c-table-orders__cell--id {
            -ms-flex-preferred-size: 12%;
            flex-basis: 12%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .c-table-orders__cell {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            padding: 15px 10px;
            min-height: 104px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-right: 1px solid #ebebeb;
            font-size: 15px;
            line-height: 1.467;
            letter-spacing: -.5px;
            color: #7e7e7e;justify-content: center;
        }
        .c-table-orders__head .c-table-orders__cell {
            font-size: 13px !important;
            line-height: 1.692;
            font-weight: 700 !important;;
            letter-spacing: .2px !important;;
            color: #fff !important;;
            min-height: 64px !important;
            border-bottom: 1px solid #f2f2f2 !important;
        }
        .c-table-orders__cell:first-child {
            border-right: none;
        }

        .c-table-orders__cell:first-child {
            border-right: none;
        }
        .c-table-orders__cell--hash {
            -ms-flex-preferred-size: 6%;
            flex-basis: 6%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .c-table-orders__cell {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            padding: 15px 10px;
            min-height: 104px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-right: 1px solid #ebebeb;
            font-size: 15px !important;
            line-height: 1.467;
            letter-spacing: -.5px;
            color: #7e7e7e;
        }.c-table-orders__row {
             width: 100%;
             display: -webkit-box;
             display: -ms-flexbox;
             display: flex;
             -webkit-box-orient: horizontal;
             -webkit-box-direction: normal;
             -ms-flex-flow: row nowrap;
             flex-flow: row nowrap;
             border-bottom: 1px solid #f2f2f2;
         }.woocommerce .form-my-account-content form span.show-password-input {
              left: .7em !important;
              right: auto !important;
          }.woocommerce .form-my-account-content form .form-row input.input-text {
               direction: rtl;
               text-align: right !important;
           }.c-profile-box__header {

                padding-bottom: 20px;
            }p.woocommerce-form-row.woocommerce-form-row--wide.form-row.form-row-wide {
                 display: block;
             }form.woocommerce-EditAccountForm .form-row input.input-text, form.woocommerce-EditAccountForm .form-row textarea {
                  width: 100%;
              }form.woocommerce-EditAccountForm span.required {
                   display: none!important;
               }form.woocommerce-EditAccountForm  .form-row label {
                    font-size: 14px;
                }.woocommerce-billing-fields{background:#fff;border-top-left-radius:4px;border-top-right-radius:4px;padding:0 0 10px}.etelat-check{margin-bottom:33px}.etelat-check p{padding:0 80px;font-size:13px}.etelat-check span{text-align:center;display:inline-block;padding:24px 80px 10px;border-bottom-left-radius:6px;border-bottom-right-radius:6px}.woocommerce-billing-fields__field-wrapper .form-row:nth-child(1),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(2),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(3),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(4),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(5),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(6){width:33%;display:inline-block;padding:0 15px;float:none}form .form-row label{line-height:2;margin-bottom:12px;font-size:17px}form .form-row input.input-text,form .form-row textarea{border-radius:5px;border:solid 3px #ff9800;padding:9px 10px}.woocommerce-billing-fields__field-wrapper .form-row:nth-child(7),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(9),.woocommerce-billing-fields__field-wrapper .form-row:nth-child(10){padding:0;margin:0 15px;margin-top:40px}#order_review{background:#ebe9eb;padding:17px 60px}#order_review_heading{margin:0;margin-bottom:10px}#order_review table.shop_table{border:0;border:solid 2px #a3a7a6!important}table.shop_table th{font-weight:700;padding:9px 12px;line-height:1.5em}table.shop_table td{position:relative}table.shop_table td{text-align:right}.checkout-nav{border-bottom:0}p#billing_country_field{display:none}form .form-row input.input-text,form .form-row textarea{border-radius:5px;border:solid 3px #ff9800;padding:9px 10px}span.woocommerce-input-wrapper{width:100%}.woocommerce-billing-fields__field-wrapper .form-row:nth-child(8){margin:0 15px}.select2-container--default .select2-selection--single{justify-content:flex-end;border-radius:5px;border:1px solid #e0e0e2!important;padding:10px 12px 10px 36px;width:100%;text-align:right;font-size:14px;line-height:24px;height:48px;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center}ul.nav li::after{width:361px!important;top:148%!important;right:-52%!important}.messangers-block .messanger p,.messangers-block .messanger .arcu-item-label,.arcontactus-message-button p{font-family:iranSans!important}.owl-carousel.owl-product2 .owl-item img,.owl-product.owl-carousel .owl-item img{height:auto}.kksr-stars{direction:ltr}.page-post-img>img{-webkit-box-shadow:0 0 10px #ccc;box-shadow:0 0 10px #ccc}.page-post-content ol,.page-post-content ul{padding:18px}.page-post-content p:last-child{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap}.woocommerce-ordering,.woocommerce-result-count{display:none!important}.orderby_page_cat a{display:inline-block;padding:7px 21px;margin:0 10px 20px;background:#c0ffb3;min-width:92px;text-align:center;color:#2c7873;border-radius:5px}.orderby_page_cat a.active{background:#2c7873;color:#fff}.section-category{margin-top:39px}.wpulike-heart .wp_ulike_general_class{-webkit-box-shadow:none;box-shadow:none;border-radius:.25em;padding:0 5px 5px 0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.page-post-img-icons-like{margin-left:-10px}.page-post-content .wpulike{display:none}.section-category>.row>div{padding-left:0}.eksir-post-item-content-excerpt::before{content:"...";position:absolute;left:3px;bottom:3px}.eksir-post-item-content-excerpt{text-align:justify;position:relative}.owl-product .owl-item{padding:1px}.page-post-img-icons{position:absolute;left:15px;top:8%}.the_champ_sharing_container.the_champ_horizontal_sharing{display:none}.page-post-img-icons i{cursor:pointer;margin-bottom:11px;font-size:11px}.page-post-img-icons-share{position:absolute;left:-12px;background:#fff;padding:10px 2px;border-bottom-left-radius:35px;border-bottom-right-radius:35px;border-top-left-radius:10px;border-top-right-radius:10px;margin-top:0;padding-top:15px;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center;height:50px;overflow:hidden;-webkit-transition:.6s;-o-transition:.6s;transition:.6s;background:transparent}.eksir-post-item a{color:#404040}.the_champ_vertical_sharing{display:none!important}div.heateor_ss_mobile_footer{display:none!important;height:40px}.col-md-6.col-lg-4.footer-item{padding-left:90px}.eksirsabz-product-item-content{min-height:145px}form.woocommerce-EditAccountForm .form-row-first,form.woocommerce-EditAccountForm .form-row-last,form.woocommerce-EditAccountForm .form-row-first,form.woocommerce-EditAccountForm .form-row-last{width:100%}.woocommerce-EditAccountForm p.woocommerce-form-row.form-row{margin-bottom:35px!important}.woocommerce-EditAccountForm em{color:#999;margin-top:8px;display:block;font-size:15px}.woocommerce-EditAccountForm #respond input#submit:hover,.woocommerce-EditAccountForm a.button:hover,.woocommerce-EditAccountForm button.button:hover,.woocommerce-EditAccountForm input.button:hover{font-size:16px;font-size:1.143rem;line-height:1.375;border-radius:8px;background-color:#00bfd6;border:1px solid #41a7b4;padding:14px 31px;color:#fff}div.slider-home.adsasad .owl-dots{position:absolute;top:88%;right:auto;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.woocommerce-EditAccountForm #respond input#submit,.woocommerce-EditAccountForm a.button,.woocommerce-EditAccountForm button.button,input.button{cursor:pointer;font-size:16px;font-size:1.143rem;line-height:1.375;border-radius:8px;background-color:#00bfd6;border:1px solid #41a7b4;padding:14px 31px;color:#fff}.woocommerce-EditAccountForm>p{text-align:center;margin-top:23px;margin-bottom:18px}.woocommerce-EditAccountForm h4{display:block;width:100%;max-width:100%;padding:0;margin-bottom:.5rem;font-size:18px;line-height:inherit;color:inherit;white-space:normal;font-weight:400}.woocommerce-EditAccountForm legend{font-size:18px}form.woocommerce-EditAccountForm .form-row input.input-text,form.woocommerce-EditAccountForm .form-row textarea{border:1px solid #c8c8c8!important;line-height:1.571;padding:11px 12px}
        .page-editForm{
            background: #fff;
            padding: 30px 30px 1px;
            border-radius: 20px;
        }li.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link--customer-logout {
             display: flex !important;
             align-items: center;
         }.c-profile-box__header {
              align-items: center !important;
          }.c-profile-wallet {
               background: rgba(40, 213, 194, 0.05);
               border: 1.5px solid #28D5C2;
               border-radius: 12px;
               padding: 12px;
               text-align: center;
               color: #28D5C2;
               font-weight: 800;
                                          margin-bottom: 20px;
           }.icon-item-left p {
                font-size: 13px;
                margin-top: 0;
            }
        .icon-item-left strong {
            font-size: 15px;
            font-weight: 800;
        }.icon-items {
               background: #fff;
               padding: 20px;
               border-radius: 20px;
           }.icon-item {
                display: flex;
                align-items: center;
            }.woocommerce nav.woocommerce-MyAccount-navigation ul li.is-active a svg path {
                   stroke: rgb(54 100 255)
                                                        ;
                   fill: #FFF !important;
               }.woocommerce nav.woocommerce-MyAccount-navigation ul li.is-active.woocommerce-MyAccount-navigation-link--dashboard a svg path {
                    fill: transparent !important;
                }.woocommerce nav.woocommerce-MyAccount-navigation ul li.is-active.woocommerce-MyAccount-navigation-link--address a svg path {
                     fill: transparent !important;
                 }.woocommerce nav.woocommerce-MyAccount-navigation ul li.is-active.woocommerce-MyAccount-navigation-link--address a circle {
                      stroke: rgb(54 100 255)
                      !important;
                  }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table thead {
                       background: #2929290a;
                   }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table th {
                        font-weight: 800 !important;
                    }td.woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-status {
                         font-weight: 800;
                     }.account-item {
                          background: #FFFFFF;
                          border: 2px solid rgba(140, 140, 140, 0.17);
                          border-radius: 16px;
                          margin-bottom: 26px;
            padding:30px;
                      }li.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link--customer-logout {
                           border-top: 2px solid rgba(140, 140, 140, 0.07);
                           padding-right: 0;
                           margin-top: 10px;
                       }.icon-item-right {
                            margin-left: 11px;
                        }table.woocommerce-orders-table.woocommerce-MyAccount-orders.shop_table.shop_table_responsive.my_account_orders.account-orders-table {
                             width: 100%;
                         }.icon-item {
                            background: #FFFFFF;
                            border: 2px solid rgba(140, 140, 140, 0.17);
                            border-radius: 16px;       padding: 20px;
                        }.ns-profile-content table.table .title {
                             color: #bbb;
                         }.ns-profile-content table.table .value {
                              font-weight: 700;
                              margin-top: 7px;
                          }.c-profile-menu li.is-active svg {
                               opacity: 1;
                           }.c-profile-menu li.is-active a {
                                color: rgb(54 100 255);
                            }
    </style>
@endpush

