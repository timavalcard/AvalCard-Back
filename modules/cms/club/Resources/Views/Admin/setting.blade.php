 <x-admin-panel-layout>
        <x-slot name="title">
            تنظیمات باشگاه مشتریان
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">تنظیمات باشگاه مشتریان </h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_club_index") }}">باشگاه مشتریان</a></li>
                                <li class="breadcrumb-item active">تنظیمات باشگاه مشتریان </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>

    <div class="col-lg-9">
        <h4>
        </h4>

        <form action="{{ route("admin_save_club_setting") }}" method="post">
            @csrf
            <div class="mb-4 mt-4">
                <p class="mt-5">
                    <label> چه تعداد امتیاز به ازای خرید هر .... تومان : (محصولات)</label>
                    <input class="mt-2" placeholder="مبلغ را وارد کنید..." type="text" value="@if(isset( $setting["product_point_price"] )){{ $setting["product_point_price"] }}@endif" name="product_point_price">
                    <input class="mt-2" placeholder="امتیاز را وارد کنید..." type="text" value="@if(isset( $setting["product_point"] )){{ $setting["product_point"] }}@endif" name="product_point" >
                </p>
                <p class="mt-5 d-none">
                    <label> چه تعداد امتیاز به ازای خرید هر .... تومان : (خدمات)</label>
                    <input class="mt-2" placeholder="مبلغ را وارد کنید..." type="text" value="@if(isset( $setting["service_point_price"] )){{ $setting["service_point_price"] }}@endif" name="service_point_price">
                    <input class="mt-2" placeholder="امتیاز را وارد کنید..." type="text" value="@if(isset( $setting["service_point"] )){{ $setting["service_point"] }}@endif" name="service_point" >
                </p>

                <p class="mt-5">
                    <label>حداقل مقدار امتیاز برای استفاده از تخفیف؟</label>
                    <input placeholder="مقدار امتیاز را وارد کنید..." type="text" value="@if(isset( $setting["min_need_point"] )){{ $setting["min_need_point"] }}@endif" name="min_need_point" >
                </p>

                <p class="mt-5">
                    <label>چه مقدار تخفیف (تومان) به ازای چه تعداد امتیاز؟</label>
                    <input class="mt-2" placeholder="مقدار تخفیف را وارد کنید..." type="text" value="@if(isset( $setting["club_offer_price"] )){{ $setting["club_offer_price"] }}@endif" name="club_offer_price">
                    <input class="mt-2" placeholder="امتیاز را وارد کنید..." type="text" value="@if(isset( $setting["club_offer_point"] )){{ $setting["club_offer_point"] }}@endif" name="club_offer_point" >
                    <span class="description" style="font-size: 13px;color:#818181;font-style: italic;margin-top:10px;display: block">مثلا ده هزار تومان تخفیف به ازای هر 10 امتیاز</span>
                </p>


                <p class="mt-4">
                <button type="submit" class="btn-blue">ذخیره تنظیمات</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
 </x-admin-panel-layout>
