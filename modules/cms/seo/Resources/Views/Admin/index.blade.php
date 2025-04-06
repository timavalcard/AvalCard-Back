

    <x-admin-panel-layout>
        <x-slot name="title">
            مدیریت سئو
        </x-slot>
        <x-slot name="main">
<div class="row" style="overflow: hidden;">

    <div class="col-12">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">مدیریت سئو</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">مدیریت سئو</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <div class="rank-math-ui module-listing dashboard-wrapper">

            <div class="grid">
                <div class="rank-math-box  ">

                    <i class="rm-icon rm-icon-dashicons-admin-site-alt3 rm-icon-instant-indexing"></i>

                    <header>

                        <h3>
                            نمایه سازی فوری													</h3>

                        <p>هنگام افزودن، بروزرسانی یا حذف صفحات، مستقیماً به موتور جستجو (google) اطلاع دهید.</p>

                    </header>

                    <div class="status wp-clearfix">
                        <a href="{{ route("admin_seo_google") }}" class="module-settings button button-secondary">تنظیمات</a>
                    </div>

                </div>
                <div class="rank-math-box active ">

                    <i class="rm-icon rm-icon-instant-indexing"></i>

                    <header>

                        <h3>
                            نمایه سازی فوری													</h3>

                        <p>هنگام افزودن، بروزرسانی یا حذف صفحات، مستقیماً به موتور جستجو (Bing) اطلاع دهید.</p>

                    </header>

                    <div class="status wp-clearfix">
                        <a href="{{ route("admin_seo_bing") }}" class="module-settings button button-secondary">تنظیمات</a>
                    </div>

                </div>
                <div class="rank-math-box active ">

                    <i class="rm-icon rm-icon-link"></i>

                    <header>

                        <h3>
                            شمارنده پیوند													</h3>

                        <p>تعداد کل پیوندهای داخلی، خارجی، به و از پیوندهای داخل پست های شما را می شمارد. همین تعداد را می توانید در صفحه لیست پست ها نیز مشاهده کنید.</p>

                    </header>

                    <div class="status wp-clearfix">

                    </div>

                </div>
               {{-- <div class="rank-math-box active ">

                    <i class="rm-icon rm-icon-local-seo"></i>

                    <header>

                        <h3>
                            سئو محلی و گراف دانش														<span class="rank-math-pro-badge">PRO</span>
                        </h3>

                        <p>با بهینه سازی وب سایت خود برای سئو محلی در نتایج جستجو بر مخاطبان محلی خود تسلط پیدا کنید. همچنین به شما در افزودن کد مربوط به نمودار دانش کمک می کند.</p>

                    </header>

                    <div class="status wp-clearfix">

                        <a href="{{ route("admin_seo_local") }}" class="module-settings button button-secondary">تنظیمات</a>
                    </div>

                </div>--}}
            </div>

        </div>


    </div>



</div>
        </x-slot>
</x-admin-panel-layout>
