@extends("Theme::hidi.affiliate.master")

@section("title")
    حساب بازاریابی
@endsection


@section("affiliate-content")
    <div class="uap-user-page-content">

        <div class="uap-ap-wrap">
            <h3>داشبورد</h3>
            <div class="uap-row">
                <div class="uapcol-md-4 uap-account-overview-tab1">
                    <div class="uap-account-no-box uap-account-box-green" style="padding-left:0px;">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count">@if($entrances->isNotEmpty()) {{ count($entrances) }} @else 0 @endif</div>
                            <div class="uap-detail">مجموع بازدید ها</div>
                        </div>
                    </div>
                </div>
                <div class="uapcol-md-4 uap-account-overview-tab2">
                    <div class="uap-account-no-box uap-account-box-lightyellow" style="padding-left:0px;">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count">@if($success_entrances->isNotEmpty()) {{ count($success_entrances) }} @else 0 @endif </div>
                            <div class="uap-detail">بازدید های موفق</div>
                            <div class="uap-subnote">که به درآمد تبدیل شده اند</div>
                        </div>
                    </div>
                </div>
                <div class="uapcol-md-4 uap-account-overview-tab3">
                    <div class="uap-account-no-box uap-account-box-red" style="padding-left:0px;">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count">@if($failed_entrances->isNotEmpty()) {{ count($failed_entrances) }} @else 0 @endif </div>
                            <div class="uap-detail">بازدید های ناموفق</div>
                            <div class="uap-subnote">که هنوز به درآمد تبدیل نشده اند</div>
                        </div>
                    </div>
                </div>
                <div class="uapcol-md-4 uap-account-overview-tab4">
                    <div class="uap-account-no-box uap-account-box-lightblue " style="padding-left:0px;">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count"> {{ count(auth()->user()->settlement) }} </div>
                            <div class="uap-detail">تعداد درخواست های تسویه</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uap-row">
                <div class="uapcol-md-2 uap-account-overview-tab5">
                    <div class="uap-account-no-box uap-account-box-lightgray">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count"> {{ format_price_with_currencySymbol(auth()->user()->settlement()->sum("amount"))  }} </div>
                            <div class="uap-detail">کل درآمد برداشت شده تا امروز (کل دریافتی)</div>
                        </div>
                    </div>
                </div>
                <div class="uapcol-md-2 uap-account-overview-tab6">
                    <div class="uap-account-no-box uap-account-box-blue">
                        <div class="uap-account-no-box-inside">
                            <div class="uap-count">{{ format_price_with_currencySymbol(auth()->user()->inventory) }}</div>
                            <div class="uap-detail">موجودی فعلی حساب</div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection
