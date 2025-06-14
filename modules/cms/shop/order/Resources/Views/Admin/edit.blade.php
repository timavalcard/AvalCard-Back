
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
            @if($order->user)
                <a class="btn-blue" href="{{route("tickets.add",["user_id"=>$order->user->id])}}">
                    ارسال تیکت به خریدار
                </a>
            @endif
            <h5 class="mb-4 mt-4">     مشخصات  سفارش :  {{ $order->id }}
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
                @if($order->factor)
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            ارزش افزوده :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor["ten_percent"]?? ""}}
                        </div>
                    </div>
                    @if(isset($order->factor["fee"]))
                        <div class="billing_information_item">
                            <div class="billing_information_item_title">
                                کارمزد :
                            </div>
                            <div class="billing_information_item_value">
                                {{ $order->factor["fee"]?? ""}}
                            </div>
                        </div>
                    @endif
                @endif

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
                        نوع پرداخت :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->payment_type}}
                    </div>
                </div>
                @if($order->payed_at)
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            تاریخ پرداخت :
                        </div>
                        <div class="billing_information_item_value">
                            {{ toShamsi($order->payed_at,"Y/m/d H:i")}}
                        </div>
                    </div>
                @endif
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                         موبایل حساب کاربری :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->user? $order->user->mobile : "کاربر پاک شده است"}}
                    </div>
                </div>





                {{--<div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نحوه پرداخت :
                    </div>
                    <div class="billing_information_item_value">
                        {{ __($order->payment_type)}}
                    </div>
                </div>--}}
                @if($order->factor && $order->order_type=="buy_product")
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            لینک محصول  :
                        </div>
                        <div class="billing_information_item_value">
                            <a target="_blank" href="{{ $order->factor? $order->factor["link"] : "" }}">مشاهده</a>
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            نوع ارز  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["currency"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            مبلغ
                            ({{ $order->factor? $order->factor["currency"] : "" }})
                            :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["currency_amount"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            قیمت هر
                            ({{ $order->factor? $order->factor["currency"] : "" }})
                            موقع ثبت سفارش
                            :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["unit_price"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            هزینه ارسال برحسب وزن (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? format_price_with_currencySymbol($order->factor["shipping"]) : ""}}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            قیمت محصولات (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? format_price_with_currencySymbol($order->factor["product_price"]) : ""}}

                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            کارمزد (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ isset($order->factor["fee_amount"])? format_price_with_currencySymbol($order->factor["fee_amount"]) : ""}}

                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            مالیات و ارزش افزوده (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ isset($order->factor["ten_percent"])? format_price_with_currencySymbol($order->factor["ten_percent"]) : ""}}

                        </div>
                    </div>

                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            مبلغ کل (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->FormatedPrice}}
                        </div>
                    </div>

                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            وزن  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["weight"]." ". $order->factor["weightUnit"]  : "" }}

                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            تعداد  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["quantity"]  : "" }}

                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            توضیحات  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["des"]  : "" }}

                        </div>
                    </div>
                @endif



                @if($order->factor && $order->order_type=="inter_payment")
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            نام محصول  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["product_name"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            پاسخگویی در ساعت نامناسب :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["isAvailableAtNight"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            نوع ارز  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["currency"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            مبلغ
                            ({{ $order->factor? $order->factor["currency"] : "" }})
                            :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["currency_amount"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            قیمت هر
                            ({{ $order->factor? $order->factor["currency"] : "" }})
                            موقع ثبت سفارش
                            :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["unit_price"] : "" }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            مبلغ  (تومان)  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->FormatedPrice}}
                        </div>
                    </div>




                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            توضیحات  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["des"]  : "" }}

                        </div>
                    </div>
                @endif





            @if(is_array($order->comment))
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            امتیاز کاربر :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->comment["rate"] }}
                        </div>
                    </div>
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            متن کاربر :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->comment["text"] }}
                        </div>
                    </div>
                    @endif
            </div>

        </div>


            @if($order->order_type=="inter_payment")
                <div class="col-12 mt-5">
                    <h5 class="mb-4">اطلاعات وارد شده توسط کاربر</h5>
                    <div class="billing_information_items">
                        @php($user_info = json_decode($order->factor["factor_user_info"], true))
                        @if(is_array($user_info))
                            @foreach($user_info as $value)
                                <div class="billing_information_item">
                                    <div class="billing_information_item_title">
                                        {{ $value["label"]??"" }} :
                                    </div>
                                    <div class="billing_information_item_value">
                                        {{ $value["value"]??"" }}
                                    </div>
                                </div>
                            @endforeach

                        @endif
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

                {{--<p>
                    <label>ایدی کاربر</label>
                    <input type="text" placeholder="ایدی کاربر" name="user_id"
                           value="@if(old("user_id")){{old("user_id")}}@else{{ $order->user_id }}@endif"></p>
--}}
                {{--<p>
                    <label>ایدی محصول</label>
                    <input type="text" placeholder="ایدی محصول" name="products_id"
                          value="@if(old("products_id")){{old("products_id")}}@else{{ $parent_cart_product }}@endif">
                </p>--}}

                <p>
                    <label>وضعیت</label>
                    <select name="status">
                        @if($order->status == "processing")
                            <option  selected  value="processing">{{ __("processing") }}</option>
                            <option    value="completed">{{ __("completed") }}</option>
                        @elseif($order->status == "completed")
                            <option  selected  value="completed">{{ __("completed") }}</option>
                        @elseif($order->status == "pending")
                            <option selected value="pending">{{ __("pending") }}</option>
                            {{--<option  value="processing">{{ __("processing") }}</option>--}}
                          {{--  <option  value="cancelled">{{ __("cancelled") }}</option>--}}
                            {{--<option  value="on-hold">{{ __("on-hold") }}</option>--}}

                        @elseif($order->status == "on-hold")
                            <option selected value="on-hold">{{ __("on-hold") }}</option>
                            <option  value="pending">{{ __("pending") }}</option>

                            <option  value="cancelled">{{ __("cancelled") }}</option>

                        @elseif($order->status == "cancelled")
                            <option selected value="cancelled">{{ __("cancelled") }}</option>
                            {{--<option  value="pending">{{ __("pending") }}</option>
                            <option  value="on-hold">{{ __("on-hold") }}</option>--}}
                        @endif

                    </select>
                </p>
                @if($order->order_type == "buy_product")
                    <p>
                        <label>پیام برای کاربر</label>
                        <input type="text" placeholder="پیام را وارد کنید" name="order_comment"
                               value="@if(old("order_comment")){{old("order_comment")}}@else{{ $order->comment }}@endif">
                    </p>
                @endif
                {{--<p>
                    <label>وضعیت تحویل به مشتری</label>
                    <select name="delivery_status">
                        @foreach($delivery_statuses as $status)
                            <option @if($status==$order->delivery_status) selected @endif value="{{ $status }}">{{ __($status) }}</option>
                        @endforeach
                    </select>
                </p>--}}
                @if($order->order_type == "gift_cart" && ($order->status == "processing" || $order->status == "completed"))
                    <p>
                        <label>کد گیفت کارت</label>
                        <textarea  required placeholder="کد ها را وارد کنید" name="post_tracking_code"
                               >@if(old("post_tracking_code")){{old("post_tracking_code")}}@else{{ $order->post_tracking_code }}@endif</textarea>
                    </p>
                    @endif
                <p>
                    <label>قیمت</label>
                    <input @if($order->status == "completed" || $order->status == "processing") disabled @endif type="text" placeholder="قیمت" name="price"
                           value="@if(old("price")){{old("price")}}@else{{ $order->price }}@endif">
                </p>


                @if($order->order_type == "buy_product")
                <div class="woocommerce-billing-fields__field-wrapper">
                    <p class=" validate-required" id="billing_phone_field" >
                        <label for="phone" class="">تلفن همراه&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->factor["phone"])) {{$order->factor["phone"]}} @endif" name="phone" id="phone" placeholder="">
                                                            </span>
                    </p>
                  {{--  <p class=" address-field validate-required" id="billing_state_field"  data-o_class=" ">
                        <label for="billing_state" class="">استان&nbsp;

                        </label>

                        <span class="woocommerce-input-wrapper">
                                                               <input type="text" class="input-text " value="@if(isset($order->address["billing_state"])) {{$order->address["billing_state"]}} @endif" name="billing_state" id="billing_state" placeholder=""  >
                                                            </span>
                    </p>

                    <p class=" address-field validate-required" id="billing_city_field" data-priority="6" data-o_class=" address-field validate-required">
                        <label for="billing_city" class="">شهر&nbsp;

                        </label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="billing_city" value="@if(isset($order->address["billing_city"])) {{$order->address["billing_city"]}} @endif" id="billing_city" placeholder=""  autocomplete="address-level2">
                                                            </span>
                    </p>--}}
                    <p class=" address-field validate-required" id="billing_address_2_field" data-priority="1">
                        <label for="address" >آدرس کامل</label><span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " value="@if(isset($order->factor["address"])) {{$order->factor["address"]}} @endif" name="address" id="address" placeholder="مثال : تهران - خیابان جمهوری - کوچه شهید ولایتی - پلاک 6 - واحد" autocomplete="address-line2" >
                                                            </span>
                    </p>
                    <p class=" address-field validate-postcode " id="billing_postcode_field"  data-o_class=" address-field validate-postcode">
                        <label for="billing_postcode" class="">کدپستی (بدون فاصله و با اعداد انگلیسی)&nbsp;</label>
                        <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text " name="postal_code" value="@if(isset($order->factor["postal_code"])) {{$order->factor["postal_code"]}} @endif" id="factor" placeholder="" autocomplete="postal-code">
                                                            </span>
                    </p>

                </div>
                    @endif


            </div>
        </div>
        <p>
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>


            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">تاریخچه سفارش</h5>
                </div>
                <div class="card-body">
                    @forelse($order->log()->orderByDesc("created_at")->get() as $log)
                        <div class="mb-3 p-3 border rounded bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>{{ $log->user ? $log->user->name . " " . $log->user->last_name  :'نامشخص' }}</strong>
                                <small class="text-muted">{{ jdate($log->created_at)->format('Y/m/d H:i') }}</small>
                            </div>
                            <div class="text-muted">
                                {{ $log->text }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">هیچ لاگی برای این سفارش ثبت نشده است.</p>
                    @endforelse
                </div>
            </div>



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
