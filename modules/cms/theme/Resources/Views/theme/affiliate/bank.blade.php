@extends("Theme::hidi.affiliate.master")

@section("title")
    حساب بازاریابی
@endsection


@section("affiliate-content")
    <div class="uap-user-page-content">

        <div class="uap-ap-wrap">
            <h3>اطلاعات  حساب بانکی</h3>
            <p class="description">قبل از اینکه بتوانیم برای شما پرداخت انجام دهیم ، باید اطلاعات پرداخت شما را داشته باشیم. مطمئن باشید که اطلاعات به درستی ارسال شده باشند.</p>


            <div id="affiliate-bank-form">
                <form action="{{ route("affiliate.bank") }}" method="post">
                    @csrf
                    <p>
                        <input type="text" placeholder="نام صاحب کارت را وارد کنید"  value="{{ $bank_information["bank_owner_name"] }}" name="bank_owner_name">
                    </p>
                    <p>
                        <input type="text"  placeholder="نام بانک خود را وارد کنید" value="{{ $bank_information["bank_name"] }}" name="bank_name">
                    </p>
                    <p>
                        <input type="text"  placeholder="شماره حساب  خود را وارد کنید" value="{{ $bank_information["bank_account_number"] }}" name="bank_account_number">
                    </p>
                    <p>
                        <input type="text"  placeholder="شماره کارت  خود را وارد کنید" value="{{ $bank_information["bank_cart_number"] }}" name="bank_cart_number">
                    </p>
                    <p>
                        <input type="text"  placeholder="شماره شبا  خود را وارد کنید" value="{{ $bank_information["bank_shaba_number"] }}" name="bank_shaba_number">
                    </p>
                        <button class="btn-blue" type="submit">ویرایش</button>
                </form>
            </div>


        </div>
    </div>
@endsection
