
    <x-admin-panel-layout>
        <x-slot name="title">
            ویرایش سفارش {{ $order->id }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">  سفارش {{ $order->id }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_orders") }}">سفارشات</a></li>
                                <li class="breadcrumb-item active">  سفارش {{ $order->id }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
        <div class="col-12 mt-5">
            <h5 class="mb-4">     مشخصات  سفارش :  {{ $order->id }}
            </h5>
            <div class="billing_information_items">

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        وضعیت سفارش :
                    </div>
                    <div class="billing_information_item_value">
                        {!! $order->statusHtml !!}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        مبلغ قابل پرداخت :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->FormatedPrice}}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نحوه پرداخت :
                    </div>
                    <div class="billing_information_item_value">
                        {{ __($order->payment_type)}}
                    </div>
                </div>
            </div>

        </div>


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

    @if(!empty($order_products))
        <div class="col-12 mt-5">
            <h5 class="mb-4">     محصولات سفارش :  {{ $order->id }}
            </h5>
            <table class="admin-table final-table">
                <tr>
                    <th>شناسه محصول</th>
                    <th>عکس محصول</th>
                    <th>نام محصول</th>
                    <th>تعداد</th>
                </tr>
                @foreach($order->products_id as $parent2_cart_product)
                    @foreach($parent2_cart_product as $parent_cart_product)
                        @php($order_product=$order_products->where("id",$parent_cart_product["id"])->first())
                        @if($order_product)
                        <tr>
                            <td>{{ $order_product->id}}</td>
                            <td><img src="{{ asset(store_image_link($order_product->media_id,100)) }}" ></td>
                            <td><a href="{{ $order_product->url}}">{{ $order_product->title}}</a> <br> {!! $order_product->get_variation_by_value($parent_cart_product["variation"]) !!}</td>
                            <td>{{ $parent_cart_product["quantity"]}}</td>

                        </tr>
                        @endif

                     @endforeach
                @endforeach



            </table>

        </div>
    @endif

    <form  action="{{ route("admin_order_edit",["id"=>$order->id])}}" method="post" class="mt-5 w-100">
        @csrf
        @method("put")
        <div class="row">
            <div class="col-lg-9"><h3>     ویرایش سفارش {{ $order->id }}
                </h3>

                <p>
                    <label>ایدی کاربر</label>
                    <input type="text" placeholder="ایدی کاربر" name="user_id"
                           value="@if(old("user_id")){{old("user_id")}}@else{{ $order->user_id }}@endif"></p>

                {{--<p>
                    <label>ایدی محصول</label>
                    <input type="text" placeholder="ایدی محصول" name="products_id"
                          value="@if(old("products_id")){{old("products_id")}}@else{{ $parent_cart_product }}@endif">
                </p>--}}

                <p>
                    <label>وضعیت</label>
                    <select name="status">
                        @foreach($statuses as $status)
                            <option @if($status==$order->status) selected @endif value="{{ $status }}">{{ __($status) }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>وضعیت تحویل به مشتری</label>
                    <select name="delivery_status">
                        @foreach($delivery_statuses as $status)
                            <option @if($status==$order->delivery_status) selected @endif value="{{ $status }}">{{ __($status) }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>کد پیگیری از پست</label>
                    <input type="text" placeholder="کد را وارد کنید" name="post_tracking_code"
                           value="@if(old("post_tracking_code")){{old("post_tracking_code")}}@else{{ $order->post_tracking_code }}@endif">
                </p>
                <p>
                    <label>قیمت</label>
                    <input type="text" placeholder="قیمت" name="price"
                           value="@if(old("price")){{old("price")}}@else{{ $order->price }}@endif">
                </p>


                <div class="woocommerce-billing-fields__field-wrapper">
                    <p class=" validate-required" id="billing_first_name_field">
                        <label for="billing_first_name" class="">نام&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->address["billing_first_name"])) {{$order->address["billing_first_name"]}} @endif" name="billing_first_name" id="billing_first_name" placeholder=""  >
                                                            </span>
                    </p>
                    <p class=" validate-required" id="billing_phone_field" >
                        <label for="billing_phone" class="">تلفن همراه&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->address["billing_phone"])) {{$order->address["billing_phone"]}} @endif" name="billing_phone" id="billing_phone" placeholder="">
                                                            </span>
                    </p>
                    <p class=" address-field validate-required" id="billing_state_field"  data-o_class=" ">
                        <label for="billing_state" class="">استان&nbsp;

                        </label>

                        <span class="woocommerce-input-wrapper">
                                                               <input type="text" class="input-text " value="@if(isset($order->address["billing_state"])) {{$order->address["billing_state"]}} @endif" name="billing_state" id="billing_state" placeholder=""  >
                                                            </span>
                    </p>
                    <p class=" -last validate-required" id="billing_last_name_field" data-priority="4">
                        <label for="billing_last_name" class="">نام خانوادگی&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->address["billing_last_name"])) {{$order->address["billing_last_name"]}} @endif" name="billing_last_name" id="billing_last_name" placeholder="" autocomplete="family-name">
                                                            </span>
                    </p>
                    <p class=" validate-email" id="billing_email_field" data-priority="5">
                        <label for="billing_email" class="">آدرس ایمیل&nbsp;<span class="optional">(اختیاری)</span>
                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="email" class="input-text " value="@if(isset($order->address["billing_email"])) {{$order->address["billing_email"]}} @endif" name="billing_email" id="billing_email" placeholder=""  autocomplete="email username">
                                                            </span>
                    </p>
                    <p class=" address-field validate-required" id="billing_city_field" data-priority="6" data-o_class=" address-field validate-required">
                        <label for="billing_city" class="">شهر&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="billing_city" value="@if(isset($order->address["billing_city"])) {{$order->address["billing_city"]}} @endif" id="billing_city" placeholder=""  autocomplete="address-level2">
                                                            </span>
                    </p>
                    <p class=" address-field validate-required" id="billing_address_2_field" data-priority="1">
                        <label for="billing_address" >آدرس کامل</label><span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->address["billing_address"])) {{$order->address["billing_address"]}} @endif" name="billing_address" id="billing_address" placeholder="مثال : تهران - خیابان جمهوری - کوچه شهید ولایتی - پلاک 6 - واحد" autocomplete="address-line2" >
                                                            </span>
                    </p>
                    <p class=" address-field validate-postcode " id="billing_postcode_field"  data-o_class=" address-field validate-postcode">
                        <label for="billing_postcode" class="">کدپستی (بدون فاصله و با اعداد انگلیسی)&nbsp;</label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="billing_postcode" value="@if(isset($order->address["billing_postcode"])) {{$order->address["billing_postcode"]}} @endif" id="billing_postcode" placeholder="" autocomplete="postal-code">
                                                            </span>
                    </p>

                </div>

            </div>
        </div>
        <p>
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>


    @push("admin-scripts")
        <script>
            function printDiv(divName) {

                var printContents = document.getElementById(divName).innerHTML;
                w = window.open();

                w.document.write(printContents);
                w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');

                w.document.close(); // necessary for IE >= 10
                w.focus(); // necessary for IE >= 10

                return true;
            }
        </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
