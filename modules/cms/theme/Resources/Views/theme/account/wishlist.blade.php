@extends(config("theme.theme_mainContent_path"))

@section("title")
    مورد علاقه های من
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

                                <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                    <thead>
                                    <tr>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">عکس محصول</span></th>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">نام و توضیحات محصول</span></th>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">قیمت محصول</span></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($wishlists as $wishlist)
                                        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-cancelled order">
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="سفارش">

                                                <a href="{{ $wishlist->product->url }}"><img data-src="{{ asset(store_image_link($wishlist->product->media_id)) }}" style="width: 120px"></a>

                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="تاریخ">
                                                <a href="{{ $wishlist->product->url }}">{{ $wishlist->product->title }}</a>
                                                <div class="mt-3">
                                                    {!! $wishlist->product->post_excerpt !!}
                                                </div>
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="تاریخ">
                                                <p class="price">{!! $wishlist->product->product_price() !!}</p>

                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>




                            </div></div>
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
