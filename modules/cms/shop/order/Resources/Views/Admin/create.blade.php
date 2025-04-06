<x-admin-panel-layout>
        <x-slot name="title">
            افزودن سفارش
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">افزوذن سفارش</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_orders") }}">سفارشات</a></li>
                                <li class="breadcrumb-item active">افزوذن سفارش</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_add_order")}}" method="post" class="w-100">
        @csrf

        <div class="row">
            <div class="col-lg-9">

                <p>
                    <label>ایدی کاربر</label>
                    <input type="text" placeholder="ایدی کاربر" name="user_id"
                          value="{{ old("user_id") }}"></p>

                <p>
                    <label>ایدی محصول</label>
                    <input type="text" placeholder="ایدی محصول" name="products_id"
                          value="{{ old("products_id") }}">
                </p>

                <p>
                    <label>وضعیت</label>
                    <select name="status">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ __($status) }}</option>
                        @endforeach
                    </select>
                </p>

                <p>
                    <label>قیمت</label>
                    <input type="text" placeholder="قیمت" name="price"
                           value="{{ old("price") }}">
                </p>

            </div>
            <div class="col-lg-3">


            </div>
        </div>
        <p>
            <button class="btn-blue">افزودن</button>
        </p>
    </form>


</x-slot>
</x-admin-panel-layout>
