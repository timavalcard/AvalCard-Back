

    <x-admin-panel-layout>
        <x-slot name="title">
            نمایه سازی فوری google
        </x-slot>
        <x-slot name="main">
<div class="row" style="overflow: hidden;">

    <div class="col-12">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">نمایه سازی فوری google</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_seo") }}">مدیریت سئو</a></li>
                            <li class="breadcrumb-item active">نمایه سازی فوری google</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_seo_google") }}" method="post">
            @csrf
            <label>
                google API Key
            </label>
            <input type="text" name="google_api" value="{{ $google_api }}">
            <button  type="submit" class="btn-blue mt-3">ذخیره</button>
        </form>

    </div>



</div>
        </x-slot>
</x-admin-panel-layout>
