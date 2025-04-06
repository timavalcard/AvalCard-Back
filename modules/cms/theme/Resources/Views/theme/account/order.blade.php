@extends(config("theme.theme_mainContent_path"))

@section("title")
    نمایش سفارش {{ $order->id }}
@endsection

@section("content")
        <div class="container">
            <div class="rows">
                <div class="woocommerce">
                    <div class="my-accountsss row">
                        @includeIf(config("theme.theme_path")."account.sidebar")
                        <div class="col-12 col-lg-9 fl">
                            @if(session()->get("order_message"))
                                <div class="billing_information_items">
                                    <div style="

    border-bottom: solid 1px #f4efef;
">
                                        <h2 class=" mb-0" style="
    font-size: 15px;
">
                                            <i class="fa text-success fa-check ml-2"></i>
                                            {{ session()->get("order_message") }}
                                        </h2>

                                    </div>

                                </div>
                                @php
                                    session()->forget("order_message");

                                @endphp
                            @endif
                                @if(in_array($order->status,$pay_statuses))
                                <div class="billing_information_items mb-3">
                                    <div style="
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: solid 1px #f4efef;
">
                                        <h2 class="text-danger mb-3">متاسفانه پرداخت شما ناموفق بود!
                                        </h2>
                                        <p class="">
                                            <i class="fa fa-info-circle ml-2"></i>
                                            این سفارش ثبت نهایی نشده است. جهت ثبت نهایی سفارش نسبت به پرداخت اقدام نمایید.
                                        </p>
                                    </div>
                                    <div class="my-4 text-center">
                                        <a href="{{ route("order.pay",["id"=>$order->id]) }}" class="btn btn-warning" style="
    background: #16c79a;
    color: #fff;
    border: #16c79a;
    margin-bottom: 10px;
">پرداخت مبلغ سفارش</a>
                                        <p class="mt-2">مجموع مبلغ این سفارش : {{ $order->formated_price }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(!in_array($order->status,$pay_statuses))
                                 <div class="col-12 mt-5 mb-5">
                                    <h5 class="mb-4">  وضعیت تحویل سفارش :
                                    </h5>
                                    <div class="billing_information_items pb-5">
                                        <div class="position-relative">
                                            @php($index=array_search($order->delivery_status,$delivery_statuses))
                                            <?php
                                            switch ($index){
                                                case 0:
                                                    $progress=25;
                                                    break;
                                                case 1:
                                                    $progress=50;
                                                    break;
                                                case 2:
                                                    $progress=75;
                                                    break;
                                                case 3:
                                                    $progress=100;
                                                    break;
                                            }
                                            ?>

                                            <div class="w3-light-grey">
                                                <div class="w3-green" style="height:24px;width:{{$progress}}%"></div>
                                            </div>
                                            <div class="delivery-label">



                                                <span class="d-sm-none" style="font-size: 14px;">وضعیت تحویل : </span>
                                                <span class="delivery_step delivery_step_1 {{ $index==0 ? "active" :"" }}">ارسال فاکتور به انبار</span>
                                                <span class="delivery_step delivery_step_2 {{ $index==1 ? "active" :"" }}">بسته بندی</span>
                                                <span class="delivery_step delivery_step_3 {{ $index==2 ? "active" :"" }}">ارسال به پست</span>
                                                <span class="delivery_step delivery_step_4 {{ $index==3 ? "active" :"" }}">تحویل به مشتری</span>
                                            </div>
                                            <div class="delivery_circle">
                                                <span class="delivery_circle_item delivery_circle_item_1 active">1</span>
                                                <span class="delivery_circle_item delivery_circle_item_2 {{ $index>=1 ? "active" :"" }}">2</span>
                                                <span class="delivery_circle_item delivery_circle_item_3 {{ $index>=2 ? "active" :"" }}">3</span>
                                                <span class="delivery_circle_item delivery_circle_item_4 {{ $index==3 ? "active" :"" }}">4</span>
                                            </div>
                                            @if($order->post_tracking_code)
                                                <span class="mt-5 d-block">کد پیگیری از پست :
                                                {{ $order->post_tracking_code }}
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                                @endif

                            <div class="woocommerce-MyAccount-content">

                                <div class="woocommerce-notices-wrapper"></div>
                                <h3 class="mt-3" id="order_review_heading">خلاصه سفارش شما</h3>
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">محصول</th>
                                        <th class="product-total">قیمت</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($order->products_id as $parent2_cart_product)
                                            @foreach($parent2_cart_product as $parent_cart_product)
                                                @php($product=$products->where("id",$parent_cart_product["id"])->first())

                                                <tr class="cart_item">
                                                        <td class="product-name">
                                                            <a href="{{ $product->url }}">
                                                                {{ $product->title }}
                                                            </a>
                                                            <strong class="product-quantity">×&nbsp;{{ $parent_cart_product["quantity"] }}</strong>
                                                            <br>
                                                            {!! $product->get_variation_by_value($parent_cart_product["variation"]) !!}
                                                        </td>
                                                        <td class="product-total">
                                                            {!! $product->product_price_with_quantity($parent_cart_product["quantity"],$parent_cart_product["variation"]) !!}
                                                        </td>
                                                    </tr>
                                            @endforeach
                                      @endforeach

                                    </tbody>
                                </table>
                                @if(!empty($order->address))
                                    <div class="col-12 mt-5">
                                        <h5 class="mb-4">     مشخصات ارسال بار :
                                        </h5>
                                        <div class="billing_information_items">

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    نام خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($order->address["billing_first_name"]) ?$order->address["billing_first_name"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    نام خانوادگی خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($order->address["billing_last_name"]) ?$order->address["billing_last_name"] :'' }}
                                                </div>
                                            </div>

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    ایمیل خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($order->address["billing_email"]) ?$order->address["billing_email"] :'' }}
                                                </div>
                                            </div>

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    تلفن :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($order->address["billing_phone"]) ?$order->address["billing_phone"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    استان :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($order->address["billing_state"]) ?$order->address["billing_state"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    شهر :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($order->address["billing_city"]) ?$order->address["billing_city"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    کد پستی :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($order->address["billing_postcode"]) ?$order->address["billing_postcode"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    آدرس :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($order->address["billing_address"]) ?$order->address["billing_address"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    تاریخ خرید :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ toShamsi($order->created_at) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @elseif(!empty($user_billing))
                                    <div class="col-12 mt-5">
                                        <h5 class="mb-4">     مشخصات ارسال بار :
                                        </h5>
                                        <div class="billing_information_items">

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    نام خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($user_billing["billing_first_name"]) ?$user_billing["billing_first_name"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    نام خانوادگی خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($user_billing["billing_last_name"]) ?$user_billing["billing_last_name"] :'' }}
                                                </div>
                                            </div>

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    ایمیل خریدار :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($user_billing["billing_email"]) ?$user_billing["billing_email"] :'' }}
                                                </div>
                                            </div>

                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    تلفن :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($user_billing["billing_phone"]) ?$user_billing["billing_phone"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    استان :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($user_billing["billing_state"]) ?$user_billing["billing_state"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    شهر :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($user_billing["billing_city"]) ?$user_billing["billing_city"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    کد پستی :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{  isset($user_billing["billing_postcode"]) ?$user_billing["billing_postcode"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    آدرس :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ isset($user_billing["billing_address"]) ?$user_billing["billing_address"] :'' }}
                                                </div>
                                            </div>
                                            <div class="billing_information_item">
                                                <div class="billing_information_item_title">
                                                    تاریخ خرید :
                                                </div>
                                                <div class="billing_information_item_value">
                                                    {{ toShamsi($order->created_at) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif



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


                        .ns-profile-content table.table {
                            background: #fff;
                            -webkit-box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                            box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                            border: 1px solid #dedede;
                            margin-bottom: 23px;
                            padding-bottom: 43px;
                        }address {
                             font-style: normal;
                             margin-bottom: 0;
                             border: 1px solid rgba(0,0,0,.1);
                             border-bottom-width: 2px;
                             border-left-width: 2px;
                             text-align: right;
                             width: 100%;
                             border-radius: 5px;
                             padding: 6px 12px;
                         }address {
                              font-size: 14px;
                              line-height: 28px;
                              height: 100%;
                          }.billing_information_items {
                               background: #ffff;
                               padding: 20px;
                               border-radius: 20px;
                           } .billing_information_item {
                                                                                                                                       margin-bottom: 15px;
                                                                                                           display: flex;
                                                                                                       }.billing_information_item_title {
                                                                                                            font-weight: 500;
                                                                                                            margin-left: 10px;
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
