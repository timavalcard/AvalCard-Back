
    <x-admin-panel-layout>
        <x-slot name="title">
            ویرایش منطقه حمل و نقل {{ key($current_country) }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">ویرایش منطقه حمل و نقل {{ key($current_country) }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                                <li class="breadcrumb-item active">ویرایش منطقه حمل و نقل {{ key($current_country) }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <div class="col-lg-9">


        <form action="{{"admin_delivery_save"}}" method="post">
            @csrf
            @method("put")
            <div class="mb-4 mt-4">
                <input @if(isset($data["delivery_active"]) && $data["delivery_active"]=="on") checked @endif id="delivery_active"  type="checkbox"  name="delivery_active" class="ml-2">
                <label for="delivery_active">فعال کردن هزینه پست</label>
               <div class="delivery_active_check @if(!isset($data["delivery_active"]) || $data["delivery_active"]!="on") d-none @endif">
                   <p class="mb-4 mt-2">
                       <label>هزینه پست</label>
                       <input type="text" placeholder="هزینه پست را وارد کنید..." name="delivery_price" value="@if(isset($data["delivery_price"])) {{ $data["delivery_price"] }} @endif">
                   </p>
                   <p>
                       <input id="delivery_free_active" @if(isset($data["delivery_free_active"]) && $data["delivery_free_active"]=="on") checked @endif  type="checkbox"  name="delivery_free_active" class="ml-2">
                       <label for="delivery_free_active">فعال کردن ارسال رایگان ( اگر مجموع قیمت سبد خرید از یک مقدار مشخص بیشتر بود)</label>
                   </p>
                   <div class="delivery_free_active @if(!isset($data["delivery_free_active"]) || $data["delivery_free_active"]!="on") d-none @endif">
                       <p class="mb-4">
                           <label>قیمت حد اقل سبد خرید برای رایگان کردن حمل و نقل  </label>
                           <input type="text" placeholder="قیمت حد اقل سبد خرید را وارد کنید..." name="delivery_free_price" value="@if(isset($data["delivery_free_price"])) {{ $data["delivery_free_price"] }} @endif">
                       </p>
                   </div>
               </div>
                <p class="mt-4">
                <button type="submit" class="btn-blue">ذخیره</button>

                </p>
            </div>
        </form>
    </div>

    @push("admin-scripts")
        <script>
            jQuery("input#delivery_active").click(function (){
                if(jQuery( "input#delivery_active" ).is( ":checked" )){
                    jQuery(".delivery_active_check").removeClass("d-none")
                } else{
                    jQuery(".delivery_active_check").addClass("d-none")
                }
            })

            jQuery("input#delivery_free_active").click(function (){
                if(jQuery( "input#delivery_free_active" ).is( ":checked" )){
                    jQuery(".delivery_free_active").removeClass("d-none")
                } else{
                    jQuery(".delivery_free_active").addClass("d-none")
                }
            })

        </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
