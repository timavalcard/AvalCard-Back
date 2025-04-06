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
        <div class="admin-table-content">
            <form action="{{ route("admin_orders_group_action") }}" method="post">
                <div class="admin-page-top">
                    <p class="">تعداد کل : {{ $orders_count }} عدد </p>
                    <div class="admin-filter-search mb-3">
                        <form action="" class="d-flex align-items-center">
                            <input style="border-radius: 10px;" type="text" name="name" placeholder="نام مورد نظر را وارد کنید...">
                            <button class="btn-blue mr-2">
                                <svg id="Group_126" data-name="Group 126" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path id="Path_143" data-name="Path 143" d="M0,0H24V24H0Z" fill="none"/>
                                    <circle id="Ellipse_11" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(3 3)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line id="Line_58" data-name="Line 58" x1="6" y1="6" transform="translate(15 15)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>

                            </button>
                        </form>
                    </div>
                </div>
                <div class="admin-order-select-box mt-3 justify-content-center">
                    <div class="admin-select-all-checkbox">
                        <select name="action">
                            <option value="delete" selected="selected">حذف</option>
                            <option value="completed" >تکمیل شده</option>
                            <option value="cancelled" >لفو شده</option>
                            <option value="processing" >در حال انجام</option>
                        </select>
                        <button class="btn-outline-primary mr-3">اجرا</button>
                    </div>
                </div>
                <div class="admin-order-by-box mt-3 mb-3">

                    <label>فیلتر بر اساس وضعیت : </label>
                    <a class=" btn btn-sm     @if(!isset(request()->status)) text-white  btn-dark @else btn-outline-dark @endif" href="{{ route("admin_orders") }}">همه سفارشات</a>
                    @foreach($statuses as $status)
                        <a class=" btn btn-sm     @if($status==request()->status) text-white btn-dark @else btn-outline-dark @endif" href="{{ route("admin_orders",["status"=>$status]) }}">{{ __($status) }}</a>
                    @endforeach
                </div>

            @csrf

                <table class="admin-table final-table">
                <tr>
                    <th>
                        <input type="checkbox" class="admin-select-all-checkbox-btn">
                    </th>

                    <th>خریدار</th>
                    <th>قیمت</th>
                    <th>وضعیت</th>
                    <th>تاریخ خرید</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)

                    <tr>
                        <td>{{ $order->id }}
                            <input type="checkbox" name="checkbox_item[]" value="{{ $order->id }}">

                        </td>
                        <td>
                            @if($order->address["billing_first_name"])
                                {{ $order->address["billing_first_name"] ." ". $order->address["billing_last_name"] }}
                            @else
                                {{ $order->user->name }}

                            @endif

                        </td>
                        <td>{{ $order->formated_price}}</td>
                        <td>{!!   $order->status_html !!}</td>
                        <td>{{ toShamsi($order->created_at) }}</td>
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
                                <a title="حذف" class="admin-table-actions-delete" href="{{ route("admin_delete_order",["id"=>$order->id]) }}">
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
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>

        </form>
        </div>
        <div class="admin-paginator">
            {{ $orders->links() }}
        </div>
        @includeIf("admin.partials.delete_modal")
    </x-slot>
</x-admin-panel-layout>
