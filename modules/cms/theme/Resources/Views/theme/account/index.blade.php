@extends(config("theme.theme_mainContent_path"))

@section("title")
    حساب کاربری
@endsection

@section("content")
    <div class="container">
        <div class="rows">
            <div class="col-12">
                <div class="bread-crumb-box">
                    <div class="bread-crumb-box-item">
                        <a href="/">خانه</a>
                    </div>
                    <div class="bread-crumb-box-item current">
                        <a href="#">حساب کاربری</a>
                    </div>
                </div>
            </div>
            <div class="woocommerce">
                @if(!$user->name)
                    <div class="alert alert-warning" role="alert">
                        شما هنوز اطلاعات کاربری خود را تکمیل نکرده اید برای ثبت سفارش لطفا ابتدا اطلاعات خود را وارد کنید. برای تکمیل
                        <a  href="{{ route("user.edit") }}">
                            اینجا
                        </a>
                        کلیک کنید.
                    </div>
                @endif
                <div class="my-accountsss row">
                    @includeIf(config("theme.theme_path")."account.sidebar")
                    <div class="col-lg-9">
                        <div class="account-item">
                            <div class="row">
                                <div class="col-md-10 fl">

                                        <div class="woocommerce-MyAccount-content">
                                        <div class="woocommerce-notices-wrapper"></div>
                                        <div class="o-headline o-headline--profile"><span>اطلاعات کاربری</span></div>

                                        <div class="ns-profile-content">
                                            <table class="table">
                                                <tbody><tr>
                                                    <td class="w-50">
                                                        <div class="title">  نام و نام خانوادگی:</div>
                                                        <div class="value">{{ $user->name }} @if(isset($user_data["lastname"])){{ $user_data["lastname"] }}@endif</div>
                                                    </td>
                                                    <td>
                                                        <div class="title">پست الکترونیک :</div>
                                                        <div class="value">{{ $user->email }}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="title">شماره تلفن همراه:</div>
                                                        <div class="value">{{ $user->mobile }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="title">تاریخ عضویت:</div>
                                                        <div class="value time">{{ toShamsi($user->created_at) }}</div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <a class="btn-edit-account" href="{{ route("user.edit") }}">
                                        <svg class="ml-1" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.0517 4.23919L16.25 6.43752M15 12.1667V16.125C15 16.6223 14.8025 17.0992 14.4508 17.4508C14.0992 17.8025 13.6223 18 13.125 18H4.375C3.87772 18 3.40081 17.8025 3.04917 17.4508C2.69754 17.0992 2.5 16.6223 2.5 16.125V7.37502C2.5 6.87774 2.69754 6.40083 3.04917 6.0492C3.40081 5.69757 3.87772 5.50002 4.375 5.50002H8.33333M14.0517 4.23919L15.4575 2.83252C15.7506 2.53946 16.148 2.37482 16.5625 2.37482C16.977 2.37482 17.3744 2.53946 17.6675 2.83252C17.9606 3.12559 18.1252 3.52307 18.1252 3.93752C18.1252 4.35198 17.9606 4.74946 17.6675 5.04252L8.81833 13.8917C8.37777 14.332 7.83447 14.6556 7.2375 14.8334L5 15.5L5.66667 13.2625C5.8444 12.6656 6.16803 12.1223 6.60833 11.6817L14.0517 4.23919V4.23919Z" stroke="#fff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                        ویرایش
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12 fl">
                                <div class="account-item">
                                    <div class="woocommerce-MyAccount-content">
                                        <div class="o-headline o-headline--profile"><span>آخرین سفارشات</span></div>


                                        <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                            <thead>
                                            <tr>
                                                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">شماره سفارش</span></th>
                                                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">تاریخ ثبت سفارش</span></th>
                                                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">وضعیت</span></th>
                                                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total"><span class="nobr">مبلغ قابل پرداخت</span></th>
                                                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions"><span class="nobr">جزییات کالا</span></th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($orders as $order)
                                                <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-cancelled order">
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="سفارش">
                                                        <a href="{{ route("user.order",["id"=>$order->id]) }}">
                                                            {{ $order->id }}								</a>

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="تاریخ">
                                                        <time >{{ toShamsi($order->created_at) }}</time>

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="وضعیت">
                                                        {!! $order->status_html !!}
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="مجموع">
                                                        {{ $order->formated_price }}
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions" data-title="عملیات&zwnj;ها">
                                                        <a href="{{ route("user.order",["id"=>$order->id]) }}" class="woocommerce-button button view">
                                                            نمایش جزییات
                                                        </a>													</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>




                                    </div></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="icon-items mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="icon-item">
                                                <div class="icon-item-right">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_970_279)">
                                                            <path d="M19.9987 6.66666H22.6654C23.3726 6.66666 24.0509 6.94761 24.551 7.4477C25.0511 7.9478 25.332 8.62608 25.332 9.33332V25.3333C25.332 26.0406 25.0511 26.7188 24.551 27.2189C24.0509 27.719 23.3726 28 22.6654 28H9.33203C8.62479 28 7.94651 27.719 7.44641 27.2189C6.94632 26.7188 6.66536 26.0406 6.66536 25.3333V9.33332C6.66536 8.62608 6.94632 7.9478 7.44641 7.4477C7.94651 6.94761 8.62479 6.66666 9.33203 6.66666H11.9987" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M14.6667 4H17.3333C18.8061 4 20 5.19391 20 6.66667C20 8.13943 18.8061 9.33333 17.3333 9.33333H14.6667C13.1939 9.33333 12 8.13943 12 6.66667C12 5.19391 13.1939 4 14.6667 4Z" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M20 16H19.9867" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M14.668 16H12.0013" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M20 21.3333H19.9867" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M14.668 21.3333H12.0013" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_970_279">
                                                                <rect width="32" height="32" fill="rgb(54 100 255)" transform="matrix(-1 0 0 1 32 0)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                </div>
                                                <div class="icon-item-left">
                                                    <strong>تعداد سفارشات</strong>
                                                    <p>
                                                        {{ count($orders) }}
                                                        سفارش
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="icon-item">
                                                <div class="icon-item-right">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_970_352)">
                                                            <path d="M26.668 28V10.6667C26.668 9.60579 26.2465 8.58838 25.4964 7.83823C24.7463 7.08808 23.7288 6.66666 22.668 6.66666H9.33463C8.27377 6.66666 7.25635 7.08808 6.50621 7.83823C5.75606 8.58838 5.33463 9.60579 5.33463 10.6667V18.6667C5.33463 19.7275 5.75606 20.7449 6.50621 21.4951C7.25635 22.2452 8.27377 22.6667 9.33463 22.6667H21.3346L26.668 28Z" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M21.332 12H10.6654" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M21.332 17.3333H13.332" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_970_352">
                                                                <rect width="32" height="32" fill="rgb(54 100 255)" transform="matrix(-1 0 0 1 32 0)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                </div>
                                                <div class="icon-item-left">
                                                    <strong>نظرات داده شده</strong>
                                                    <p>
                                                        {{ count($comments) }}
                                                        نظر
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="icon-item">
                                                <div class="icon-item-right">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_970_349)">
                                                            <path d="M26.0017 18.096L16.0017 28L6.0017 18.096M6.0017 18.096C5.34211 17.4542 4.82256 16.6827 4.47577 15.8302C4.12897 14.9777 3.96245 14.0626 3.98669 13.1426C4.01092 12.2226 4.22539 11.3175 4.61658 10.4845C5.00777 9.65139 5.56722 8.90834 6.25969 8.30211C6.95215 7.69588 7.76264 7.23959 8.64012 6.96198C9.51759 6.68437 10.443 6.59145 11.3582 6.68907C12.2733 6.78669 13.1584 7.07274 13.9575 7.52921C14.7567 7.98568 15.4527 8.60267 16.0017 9.34133C16.5531 8.60803 17.2499 7.99643 18.0485 7.54481C18.8471 7.09319 19.7304 6.81127 20.6429 6.7167C21.5555 6.62212 22.4778 6.71693 23.3521 6.99519C24.2263 7.27345 25.0337 7.72917 25.7238 8.33382C26.4138 8.93847 26.9716 9.67905 27.3623 10.5092C27.7529 11.3393 27.968 12.2412 27.9941 13.1583C28.0202 14.0754 27.8567 14.988 27.5139 15.839C27.171 16.69 26.6562 17.4611 26.0017 18.104" stroke="rgb(54 100 255)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_970_349">
                                                                <rect width="32" height="32" fill="rgb(54 100 255)"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                </div>
                                                <div class="icon-item-left">
                                                    <strong>علاقه مندی ها</strong>
                                                    <p>
                                                        {{ count($wishlists) }}
                                                         علاقه مندی
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


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
            </div>
        </div>

@endsection
