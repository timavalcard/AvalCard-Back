<x-admin-panel-layout>
        <x-slot name="title">

        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">درگاه {{ $gateway_data["persian_name"] }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                                <li class="breadcrumb-item active">درگاه {{ $gateway_data["persian_name"] }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_gateway_edit",["gateway"=>$gateway]) }}" method="post" class="w-100">
        <div class="row">
            <div class="col-lg-9">
                @csrf

                <p>
                    <input type="text" placeholder="نام درگاه" name="name" value="{{ $gateway_data["persian_name"] }}">
                </p>
                @if($gateway !="home")
                <p>
                    <input type="text" placeholder="مرچنت کد درگاه" name="merchant_id" value="{{ $gateway_data["merchantId"] }}">
                </p>
                @endif
                <p>
                    <input @if(isset($gateway_data["active"]) && $gateway_data["active"]==true) checked @endif id="active" type="checkbox"  name="active" value="on">
                    <label for="active">فعال / غیر فعال کردن</label>

                </p>

                <p>
                    <button class="btn-blue">بروز رسانی</button>
                </p>
            </div>


        </div>
    </form>

        </x-slot>
</x-admin-panel-layout>
