<x-admin-panel-layout>
    <x-slot name="title">
        لیست سفارشات
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">سفارشات</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('admin_orders', ['order_type' => request()->order_type]) }}" class="mb-4">
            <div class="row align-items-end">
                {{-- تاریخ از --}}
                <div class="col-md-3">
                    <label for="from_date" class="form-label">از تاریخ</label>
                    <input value="{{request()->from_date}}"  type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="مثلاً 1403/01/01"  autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label for="to_date" class="form-label">تا تاریخ</label>
                    <input value="{{request()->to_date}}" type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="مثلاً 1403/01/30"  autocomplete="off">
                </div>


                <div class="col-md-3">
                    <label for="mobile" class="form-label">موبایل خریدار</label>
                    <input value="{{request()->mobile}}" style="border-radius: 10px;" type="text" name="mobile" placeholder="جستجو بر اساس موبایل خریدار">
                </div>

                {{-- دکمه فیلتر --}}
                <div class="col-md-3 d-grid">
                    <input type="hidden" name="order_type" value="{{ request()->order_type }}">

                    <button type="submit" class="btn btn-primary text-sm">اعمال فیلتر</button>
                </div>
            </div>
        </form>


        <div class="admin-table-content">
            <div class="admin-page-top">
                {{--<p class="">تعداد کل : {{ $orders_count }} عدد </p>--}}
                <div class="admin-filter-search mb-3">

                </div>
            </div>
            <form action="{{ route("admin_orders_group_action") }}" method="post">

                {{--<div class="admin-order-select-box mt-3 justify-content-center">
                    <div class="admin-select-all-checkbox">
                        <select name="action">
                           --}}{{-- <option value="delete" selected="selected">حذف</option>--}}{{--
                            <option value="completed" >تکمیل شده</option>
                            <option value="cancelled" >لفو شده</option>
                            <option value="processing" >در حال انجام</option>
                        </select>
                        <button class="btn-outline-primary mr-3">اجرا</button>
                    </div>
                </div>--}}
                <div class="admin-order-by-box mt-3 mb-3">
                    <label>فیلتر بر اساس وضعیت :</label>

                    {{-- لینک همه سفارشات (بدون status ولی با حفظ بقیه فیلترها) --}}
                    <a class="btn btn-sm @if(!request()->has('status')) text-white btn-dark @else btn-outline-dark @endif"
                       href="{{ request()->fullUrlWithQuery(['status' => null]) }}">
                        همه سفارشات
                    </a>

                    {{-- لینک وضعیت‌های دیگر --}}
                    @foreach($statuses as $status)
                        <a class="btn btn-sm @if(request()->status == $status) text-white btn-dark @else btn-outline-dark @endif"
                           href="{{ request()->fullUrlWithQuery(['status' => $status]) }}">
                            {{ __($status) }}
                        </a>
                    @endforeach
                </div>


                <div>
                    <a class="btn btn-sm btn-success text-white mb-3"
                       href="{{ route('exportOrders') . '?' . http_build_query(request()->query()) }}">
                       گرفتن خروجی اکسل
                    </a>

                </div>


                @csrf

                <table class="admin-table final-table">
                <tr>
                    {{--<th>
                        <input type="checkbox" class="admin-select-all-checkbox-btn">
                    </th>--}}

                    <th>شناسه</th>
                    <th>خریدار</th>
                    <th>قیمت</th>
                    <th>وضعیت</th>
                    <th>نوع پرداخت</th>
                    <th>تاریخ خرید</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)

                    <tr>
                        <td>{{ $order->id }}
                            {{--<input type="checkbox" name="checkbox_item[]" value="{{ $order->id }}">
--}}
                        </td>
                        <td>
                            @if(isset($order->address["billing_first_name"]))
                                {{ $order->address["billing_first_name"] ." ". $order->address["billing_last_name"] }}
                            @else
                                {{ $order->user->name }}

                            @endif

                        </td>
                        <td>{{ $order->formated_price}}</td>
                        <td>{!!   $order->status_html !!}</td>
                        <td>{{ $order->payment_type }}</td>
                        <td>{{ toShamsi($order->created_at,"Y/m/d H:i") }}</td>
                        <td class="icons">
                            <div class="admin-table-actions">
                                <a title="نمایش و ویرایش" href="{{ route("admin_order_edit",["id"=>$order->id]) }}">
                                                    <span>
                                                        <svg id="Component_9_1" data-name="Component 9 – 1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_71" data-name="Path 71" d="M0,0H20V20H0Z" fill="none"/>
  <path id="Path_72" data-name="Path 72" d="M8.167,7h-2.5A1.667,1.667,0,0,0,4,8.667v7.5a1.667,1.667,0,0,0,1.667,1.667h7.5a1.667,1.667,0,0,0,1.667-1.667v-2.5" transform="translate(-0.667 -1.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_73" data-name="Path 73" d="M9,12.98h2.5L18.583,5.9a1.768,1.768,0,1,0-2.5-2.5L9,10.48v2.5" transform="translate(-1.5 -0.48)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_21" data-name="Line 21" x2="2.5" y2="2.5" transform="translate(13.333 4.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                    </span>
                                </a>
                               {{-- <a title="حذف" class="admin-table-actions-delete" href="{{ route("admin_delete_order",["id"=>$order->id]) }}">
                                                    <span>
                                                        <svg id="Group_69" data-name="Group 69" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_74" data-name="Path 74" d="M0,0H20V20H0Z" fill="none"/>
  <line id="Line_22" data-name="Line 22" x2="13.333" transform="translate(3.333 5.833)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_23" data-name="Line 23" y2="5" transform="translate(8.333 9.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_24" data-name="Line 24" y2="5" transform="translate(11.667 9.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_75" data-name="Path 75" d="M5,7l.833,10A1.667,1.667,0,0,0,7.5,18.667h6.667A1.667,1.667,0,0,0,15.833,17l.833-10" transform="translate(-0.833 -1.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_76" data-name="Path 76" d="M9,6.333v-2.5A.833.833,0,0,1,9.833,3h3.333A.833.833,0,0,1,14,3.833v2.5" transform="translate(-1.5 -0.5)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                    </span>
                                </a>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>

        </form>
        </div>
        <div class="admin-paginator">

            {{ $orders->appends(request()->query())->links() }}

        </div>

        @push("admin-scripts")
            <script src="https://cdn.jsdelivr.net/npm/persian-date@latest/dist/persian-date.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>

            <script>
                jQuery(".datepicker").persianDatepicker({
                    format: 'YYYY/MM/DD',
                    initialValue: false
                });
            </script>
        @endpush


        @includeIf("admin.partials.delete_modal")
    </x-slot>
</x-admin-panel-layout>
