

    <x-admin-panel-layout>
        <x-slot name="title">
            نمایه سازی فوری bing
        </x-slot>
        <x-slot name="main">
<div class="row" style="overflow: hidden;">

    <div class="col-12">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">نمایه سازی فوری bing</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_seo") }}">مدیریت سئو</a></li>
                            <li class="breadcrumb-item active">نمایه سازی فوری bing</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_seo_bing") }}" method="post">
            @csrf
            <label>
                Bing API Key
            </label>
            <input type="text" name="bing_api" value="{{ $bing_api }}">
            <p class="cmb2-metabox-description">
                کلید API Bing Webmaster Tools خود را وارد کنید.
               </p>
            <button type="submit" class="btn-blue">ذخیره</button>
        </form>

    </div>



</div>
        </x-slot>
</x-admin-panel-layout>
