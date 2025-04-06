@extends(config("theme.theme_mainContent_path"))

@section("title")
کیف پول
@endsection

@section("content")
    <div class="container">
        <div class="rows">
            <div class="woocommerce">
                <div class="my-accountsss row">
                    @includeIf(config("theme.theme_path")."account.sidebar")
                    <div class="col-12 col-lg-9 fl">
                        <div class="woocommerce-MyAccount-content">
                            <div class="fsww-meke-deposit-sc">

                                <div class="fsww-meke-deposit-sc-top">
                                    <div class="right">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="167" height="167" viewBox="0 0 167 167">
                                            <defs>
                                                <filter id="Rectangle_256" x="0" y="0" width="167" height="167" filterUnits="userSpaceOnUse">
                                                    <feOffset dy="4" input="SourceAlpha"/>
                                                    <feGaussianBlur stdDeviation="12.5" result="blur"/>
                                                    <feFlood flood-color="#f2f2f2" flood-opacity="0.239"/>
                                                    <feComposite operator="in" in2="blur"/>
                                                    <feComposite in="SourceGraphic"/>
                                                </filter>
                                            </defs>
                                            <g id="Group_901" data-name="Group 901" transform="translate(-1402.5 -139)">
                                                <g transform="matrix(1, 0, 0, 1, 1402.5, 139)" filter="url(#Rectangle_256)">
                                                    <rect id="Rectangle_256-2" data-name="Rectangle 256" width="92" height="92" rx="15" transform="translate(37.5 33.5)" fill="#f2f2f2"/>
                                                </g>
                                                <g id="Group_185" data-name="Group 185" transform="translate(1460.131 192.5)">
                                                    <rect id="Rectangle_67" data-name="Rectangle 67" width="52" height="52" transform="translate(-0.131)" fill="#fff" opacity="0"/>
                                                    <g id="wallet" transform="translate(9.252 9.382)">
                                                        <path id="Rectangle_1335" data-name="Rectangle 1335" d="M0,11.425V0H7.27M29.081,5.712V0h-7.27" transform="translate(0 4.154)" fill="none" stroke="#2c3e50" stroke-width="3"/>
                                                        <path id="Vector_479" data-name="Vector 479" d="M0,9.347,3.116,0h13.5L14.54,7.27,13.5,10.386" transform="translate(6.232)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-width="3"/>
                                                        <path id="Rectangle_1332" data-name="Rectangle 1332" d="M21.811,22.849H0V0H33.235V22.849H21.216" transform="translate(0 10.386)" fill="none" stroke="#2c3e50" stroke-width="3"/>
                                                        <path id="Rectangle_1334" data-name="Rectangle 1334" d="M0,0H5.484A2.742,2.742,0,0,1,8.226,2.742v0A2.742,2.742,0,0,1,5.484,5.484H0a0,0,0,0,1,0,0V0A0,0,0,0,1,0,0Z" transform="translate(0.33 19.195)" fill="none" stroke="#2c3e50" stroke-width="3"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>

                                        اعتبار کیف من
                                    </div>
                                <div class="left">
                                    @if(is_object($wallet))
                                        {{ format_price_with_currencySymbol($wallet->price) }}
                                    @else
                                        فاقد اعتبار مالی
                                    @endif
                                </div>
                                </div>
                                <div class="fsww-meke-deposit-sc-bottom">
                                    <h5>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="135" height="135" viewBox="0 0 135 135">
                                            <defs>
                                                <filter id="Rectangle_295" x="0" y="0" width="135" height="135" filterUnits="userSpaceOnUse">
                                                    <feOffset dy="4" input="SourceAlpha"/>
                                                    <feGaussianBlur stdDeviation="12.5" result="blur"/>
                                                    <feFlood flood-color="rgb(54 100 255)" flood-opacity="0.239"/>
                                                    <feComposite operator="in" in2="blur"/>
                                                    <feComposite in="SourceGraphic"/>
                                                </filter>
                                            </defs>
                                            <g id="Group_902" data-name="Group 902" transform="translate(-1434.5 -394)">
                                                <g transform="matrix(1, 0, 0, 1, 1434.5, 394)" filter="url(#Rectangle_295)">
                                                    <rect id="Rectangle_295-2" data-name="Rectangle 295" width="60" height="60" rx="15" transform="translate(37.5 33.5)" fill="rgb(54 100 255)"/>
                                                </g>
                                                <g id="Group_848" data-name="Group 848" transform="translate(1482.667 438.5)">
                                                    <rect id="Rectangle_67" data-name="Rectangle 67" width="38" height="38" transform="translate(0.333)" fill="#fff" opacity="0"/>
                                                    <g id="credit_card" data-name="credit card" transform="translate(6.192 8.178)">
                                                        <rect id="Rectangle_1298" data-name="Rectangle 1298" width="26.283" height="21.645" rx="2.8" fill="none" stroke="#fff" stroke-width="2"/>
                                                        <path id="Vector_1" data-name="Vector 1" d="M0,0H3.865" transform="translate(4.706 16.774)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2"/>
                                                        <g id="Ellipse_129" data-name="Ellipse 129" transform="translate(18.62 2.859)" fill="none" stroke="#fff" stroke-width="2">
                                                            <circle cx="1.546" cy="1.546" r="1.546" stroke="none"/>
                                                            <circle cx="1.546" cy="1.546" r="0.546" fill="none"/>
                                                        </g>
                                                        <g id="Ellipse_128" data-name="Ellipse 128" transform="translate(16.478 2.859)" fill="none" stroke="#fff" stroke-width="2">
                                                            <circle cx="1.546" cy="1.546" r="1.546" stroke="none"/>
                                                            <circle cx="1.546" cy="1.546" r="0.546" fill="none"/>
                                                        </g>
                                                        <path id="Vector_467" data-name="Vector 467" d="M0,0,23.963.225" transform="translate(0.773 9.276) rotate(-0.537)" fill="none" stroke="#fff" stroke-linecap="square" stroke-width="2"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>

                                        افزایش موجودی کیف پول</h5>
                                    <form method="post" action="{{ route("wallet.increase") }}">
                                    @csrf
                                    <div class="woo-wallet-add-amount">
                                        <input type="number" style="-webkit-appearance: none;appearance: none" step="1000"  min="20000" max="9999999" name="price" id="fsww_balance_to_add" class="input-text fsww-input" placeholder=" مبلغی را وارد کنید">
                                        <label for="woo_wallet_balance_to_add" class="mr-2"> تومان</label>

                                        <input type="submit" name="fsww_add_to_wallet" class="button" value="افزودن موجودی">
                                    </div>
                                </form>
                                </div>
                                <div class="transactions">
                                    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                        <thead>
                                        <tr>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">شناسه</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">تاریخ</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">وضعیت</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total"><span class="nobr">قیمت</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($transactions as $transaction)
                                            <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-cancelled order">
                                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="سفارش">
                                                    #{{ $transaction->id }}
                                                </td>
                                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="تاریخ">
                                                    <time >{{ toShamsi($transaction->created_at) }}</time>

                                                </td>
                                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="وضعیت">
                                                    {!! $transaction->status_html !!}
                                                </td>
                                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="مجموع">
                                                    {{ $transaction->formated_price }}
                                                </td>


                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                           </div>
                        </div>
                    </div>
                </div>

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




                    .c-profile-box__section+.c-profile-box__section {
                        border-top: 1px solid #ededed;
                    }
                    .c-profile-menu li:last-child {
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
                        justify-content: space-between;
                    }
                    .o-headline {
                        margin: 26px 0 20px;
                        padding: 0 30px;
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
                        color: inherit;
                        font-size: 18px;
                        line-height: 31px;
                        font-weight: 700;
                    }
                    .ns-profile-content table.table {
                        background: #fff;
                        -webkit-box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                        box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                        border: 1px solid #dedede;
                        margin-bottom: 23px;
                        padding-bottom: 43px;
                    }
                    .ns-profile-content table.table .title {
                        display: block;
                        font-size: 13px;
                        line-height: 1.692;
                        letter-spacing: -.3px;
                        margin-bottom: 4px;
                        color: #bababa;
                    }
                    .ns-profile-content table.table .value {
                        font-size: 17px;
                        /* font-size: 1.357rem; */
                        line-height: 1.158;
                        direction: ltr;
                        text-align: right;
                        letter-spacing: -.5px;
                        color: #939393;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                    }
                    .woocommerce-MyAccount-content .btn{


                        color: #1ca2bd !important;
                        padding: 0;
                        line-height: 2;
                        background: transparent;
                        font-weight: 400;    position: relative;

                    }

                    .woocommerce-MyAccount-content .btn::after {
                        left: 0;
                        right: 0;
                        top: 50%;
                        margin-top: .85em;
                        content: "";
                        position: absolute;
                        border-bottom: 1px dashed #1ca2bd;
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
                       }
                </style>

            </div>
        </div>

@endsection
