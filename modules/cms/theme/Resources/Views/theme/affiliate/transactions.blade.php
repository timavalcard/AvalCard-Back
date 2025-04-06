@extends("Theme::hidi.affiliate.master")

@section("title")
    حساب بازاریابی
@endsection


@section("affiliate-content")
    <div class="uap-user-page-content">

        <div class="uap-ap-wrap">
            <h3>پرداختها</h3>

            <div class="uap-row">
                <div class="uapcol-md-2 uap-account-payments-tab1">
                    <div class="uap-account-no-box uap-account-box-lightgray"><div class="uap-account-no-box-inside"><div class="uap-count">{{ format_price_with_currencySymbol(auth()->user()->settlement()->sum("amount"))  }}</div><div class="uap-detail">کل درآمد برداشت شده تا امروز (کل دریافتی)</div></div></div>
                </div>
                <div class="uapcol-md-2 uap-account-payments-tab2">
                    <div class="uap-account-no-box uap-account-box-lightblue"><div class="uap-account-no-box-inside"><div class="uap-count">{{ count(auth()->user()->settlement) }}</div><div class="uap-detail">تعداد درخواست های تسویه</div></div></div>
                </div>
            </div>

            <div class="uap-profile-box-wrapper">
                <div class="uap-profile-box-title"><span>تاریخچه برداشت</span></div>
                <div class="uap-profile-box-content">
                    <div class="uap-row ">
                        <div class="uap-col-xs-12">
                            @if(auth()->user()->settlement->isEmpty())
                            <div class="uap-account-detault-message">
                                <div>در اینجا شما می توانید تسویه حساب هایی که به حساب شما واریز شده اند را مشاهده کنید.</div>
                            </div>
                            @else
                                <div class="uap-settlements">
                                    @foreach(auth()->user()->settlement as $settlement)
                                        <div class="uap-settlement-item">
                                            <p>مبلغ : {{ format_price_with_currencySymbol($settlement->amount) }}</p>
                                            <p>وضعیت : {{ __($settlement->status) }}</p>
                                            <p>زمان درخواست تسویه : {{ IR_TimestampToDate($settlement->created_at) }}</p>
                                        </div>
                                   @endforeach
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
