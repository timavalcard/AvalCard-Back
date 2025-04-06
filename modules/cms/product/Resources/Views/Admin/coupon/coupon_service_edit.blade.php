
 <x-admin-panel-layout>
     <x-slot name="title">
         ویرایش کوپن     {{ $coupon->name }}
     </x-slot>
     <x-slot name="main">
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-4">
                     <div class="col-sm-6">
                         <h3 class="m-0 text-dark">افزودن کوپن تخفیف</h3>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-left">
                             <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                             <li class="breadcrumb-item"><a href="{{ route("admin_coupon_list","service") }}">کوپن های تخفیف</a></li>
                             <li class="breadcrumb-item ">ویرایش کوپن {{ $coupon->name }}</li>
                         </ol>
                     </div><!-- /.col -->
                 </div>
             </div>
         </div>
    <div class="row">

        <div class="col-lg-4">


            <form action="{{ route("admin_coupon_edit",["coupon"=>$coupon->id,"type"=>$coupon->type]) }}" method="post">

                @csrf
                @method("PUT")
                <p>

                    <label for="">نام کوپن تخفیف : </label>

                    <input type="text" name="name" placeholder="نام کوپن تخفیف را وارد کنید" value="{{ $coupon->name }}" required>

                </p>

                <p>

                    <label for=""> تاریخ انقضا
                    <span style="font-size: 14px">(روز و ماه و سال)</span>
                    </label>

                    <input type="date" name="time"  value="{{ $coupon->time }}" required>

                </p>

                <p>

                    <label for="">ساعت تاریخ انقضا
                        <span style="font-size: 14px">(ساعت و دقیقه)</span>
                    </label>

                    <input type="text" name="hour"  value="{{ $coupon->hour }}" required placeholder="مثال  15:25">

                </p>

                <div class="mt-4">

                    <label for="">مقدار و نوع تخفیف : </label>
                    <div class="d-flex">
                       <p class="m-0 ml-3">

                        <input type="radio" value="percent" name="price_type" @if($coupon->price_type== "percent") checked @endif>
                           <label>درصد</label>
                       </p>
                        <p class="m-0">

                            <input type="radio" value="cash" name="price_type" @if($coupon->price_type== "cash") checked @endif>
                            <label>تومان</label>
                        </p>
                </div>
                    <input type="number" name="price_offering" placeholder="مقدار تخفیف را وارد کنید" value="{{ $coupon->price_offering }}" required>

                </div>

                <div class="mt-4">
                    <label> تعداد قابل استفاده
                    <span style="font-size: 13px">(به طور پیش فرض بینهایت است)</span>
                    </label>
                    <input type="number" min="1" placeholder="به چه تعداد میتوان از این کوپن استفاده کرد؟" name="number" value="{{ $coupon->number }}" >
                </div>

                <div class="mt-4">
                    <input type="checkbox"  name="use_for_first_user"  @if($coupon->use_for_first_user ) checked @endif>

                    <label style="font-size: 14px"> استفاده فقط برای کاربرانی که تا حالا سفارش خدمت نداشته اند</label>
                </div>



                <p class="mt-3">

                    <button class="btn-blue">بروزرسانی</button>

                </p>

                <p>



                </p>

            </form>

        </div>


    </div>

    @includeIf("admin.partials.delete_modal")


</x-slot>
 </x-admin-panel-layout>
