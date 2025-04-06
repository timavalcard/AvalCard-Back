 <x-admin-panel-layout>
        <x-slot name="title">
            تنظیمات بازاریابی
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">تنظیمات بازاریابی </h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin_marketing") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_club_index") }}">بازاریابان</a></li>
                                <li class="breadcrumb-item active">تنظیمات بازاریابی </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>

    <div class="col-lg-9">
        <h4>
        </h4>

        <form action="{{ route("admin_marketing_setting") }}" method="post">
            @csrf
            <div class="mb-4 mt-4">
                <p class="mt-5">
                    <label>حد اقل موجودی بازاریاب برای  درخواست برداشت وجه:</label>
                    <input class="mt-2" placeholder="مبلغ را وارد کنید..." type="text" value="@if(isset( $setting["affiliate_min_inventory"] )){{ $setting["affiliate_min_inventory"] }}@endif" name="affiliate_min_inventory">
                </p>


                <p class="mt-4">
                <button type="submit" class="btn-blue">ویرایش تنظیمات</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
 </x-admin-panel-layout>
