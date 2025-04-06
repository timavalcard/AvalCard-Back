
    <x-admin-panel-layout>
        <x-slot name="title">
            مشتری ها
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">مشتری ها</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                                <li class="breadcrumb-item active">مشتری ها</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <table class="admin-table final-table">
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>تعداد سفارشات پرداخت شده</th>
            <th>مجموع مبلغ پرداخت شده</th>
            <th>تاریخ آخرین خرید</th>
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td> {{ $customer->name}}</td>
            <td>{{ $customer->email}}</td>
            <td>
                {{ count($customer->orders) }}
            </td>
            <td>

                @if(isset($customer->orders[0])){{ format_price_with_currencySymbol($customer->orders->sum("price")) }}@endif
            </td>
            <td>
                @if(isset($customer->orders[0])){{ toShamsi($customer->orders[0]->created_at) }}@endif
            </td>

        </tr>
        @endforeach
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>تعداد سفارشات پرداخت شده</th>
            <th>مجموع مبلغ پرداخت شده</th>
            <th>تاریخ آخرین خرید</th>
        </tr>
    </table>
    <div class="admin-paginator">
        {{ $customers->links() }}
    </div>
   @includeIf('admin.partials.delete_modal')
        </x-slot>
    </x-admin-panel-layout>
