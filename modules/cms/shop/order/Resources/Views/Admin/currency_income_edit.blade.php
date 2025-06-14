
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
                    ارسال تیکت به کاربر
                </a>

            <h5 class="mb-4 mt-4 ">     مشخصات  کاربر :  {{ $order->id }}
            </h5>
            <div class="billing_information_items">
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        شناسه کاربر :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->user ? $order->user->id : "پاک شده است" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نام کاربر :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->user ? $order->user->name : "پاک شده است" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        شماره تماس :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->user ? $order->user->mobile : "پاک شده است" }}
                    </div>
                </div>

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        <a href="{{ route("admin_check_authorized",["id"=>$order->user->id]) }}}" target="_blank" class="btn btn-primary">نمایش تمام اطلاعات احراز هویت</a>
                    </div>

                </div>
            </div>

            @endif



            <h5 class="mb-4 mt-5">     مشخصات  سفارش :  {{ $order->id }}
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
                        کشور مبدا واریز  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? $order->factor["country"] : "" }}
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
                        {{ $order->factor? $order->factor["price"] : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        مبلغ قبل از کثر کارمزد (تومان)  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? format_price_with_currencySymbol($order->factor["before_fee_price"]) : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        درصد کارمز کم شده  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? $order->factor["fee_percent"] : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        مبلغ کارمز کم شده  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? format_price_with_currencySymbol($order->factor["fee_amount"]) : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        مبلغ نهایی (تومان)  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->FormatedPrice}}
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
                        {{ $order->factor? format_price_with_currencySymbol($order->factor["unit_price"]) : "" }}
                    </div>
                </div>

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نام صاحب حساب  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? $order->factor["name"] : "" }}
                    </div>
                </div>

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        بابت ارائه  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? $order->factor["for"] : "" }}
                    </div>
                </div>

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نحوه دریافت  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? __($order->factor["receive_type"]) : "" }}
                    </div>
                </div>

                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        نام بانک  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor && isset($order->factor["bank_name"])? $order->factor["bank_name"] : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        شماره کارت  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor&& isset($order->factor["cart_number"])? $order->factor["cart_number"] : "" }}
                    </div>
                </div>
                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        شماره شبا  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor&& isset($order->factor["shaba_number"])? $order->factor["shaba_number"] : "" }}
                    </div>
                </div>





                <div class="billing_information_item">
                    <div class="billing_information_item_title">
                        توضیحات بیشتر  :
                    </div>
                    <div class="billing_information_item_value">
                        {{ $order->factor? $order->factor["description"] : "-" }}
                    </div>
                </div>
                @if($order->factor && isset($order->factor["whatsapp"]))
                    <div class="billing_information_item">
                        <div class="billing_information_item_title">
                            شماره واتساپ  :
                        </div>
                        <div class="billing_information_item_value">
                            {{ $order->factor? $order->factor["whatsapp"] : "-" }}
                        </div>
                    </div>
                @endif

                @if($order->comment)
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
    <form  action="{{ route("admin_order_edit",["id"=>$order->id])}}" method="post" class="mt-5 w-100">
        @csrf
        @method("put")
        <div class="row">
            <div class="col-lg-9"><h3>     ویرایش سفارش {{ $order->id }}
                </h3>



                <p>
                    <label>وضعیت</label>
                    <select name="status">
                        @if($order->status == "processing")
                            <option  selected  value="processing">{{ __("processing") }}</option>
                            <option    value="completed">{{ __("completed") }}</option>
                        @elseif($order->status == "completed")
                            <option  selected  value="completed">{{ __("completed") }}</option>
                        @elseif($order->status == "on-hold")
                            <option selected value="on-hold">{{ __("on-hold") }}</option>
                            <option  value="cancelled">{{ __("cancelled") }}</option>
                            <option  value="processing">{{ __("processing") }}</option>
                        @elseif($order->status == "cancelled")
                            <option selected  value="cancelled">{{ __("cancelled") }}</option>
                            {{--<option  value="on-hold">{{ __("on-hold") }}</option>
                            <option  value="processing">{{ __("processing") }}</option>--}}


                        @else
                            @foreach($statuses as $status)
                                @if($status!="pending")
                                    <option @if($status==$order->status) selected @endif value="{{ $status }}">{{ __($status) }}</option>

                                @endif
                            @endforeach

                        @endif

                    </select>
                </p>

                <p>
                    <label>قیمت</label>
                    <input @if($order->status == "completed") disabled @endif type="text" placeholder="قیمت" name="price"
                           value="@if(old("price")){{old("price")}}@else{{ $order->price }}@endif">
                </p>
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
