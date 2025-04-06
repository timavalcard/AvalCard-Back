@extends("Theme::hidi.affiliate.master")

@section("title")
    حساب بازاریابی
@endsection

@section("affiliate-content")
    <div class="uap-user-page-content">

        <div class="uap-ap-wrap">
            <h3>درخواست تسویه</h3>


            <div id="affiliate-bank-form">
                <form action="{{ route("affiliate.settled") }}" method="post">
                    @csrf
                    <p>
                        <input type="number" placeholder="مقداری که میخواهید برداشت کنید را وارد کنید (تومان)"  value="{{ old("amount") }}" name="amount">
                    </p>
                    <p class="my-4">موجودی شما :
                        {{ format_price_with_currencySymbol(auth()->user()->amount) }}
                    </p>

                        <button class="btn-blue" type="submit">ارسال درخواست تسویه</button>
                </form>
            </div>


        </div>
    </div>
    <style>
        .uap-success-box {
            display: none;
        }#affiliate-bank-form p input {
             width: 326px !important;
         }form {
              text-align: center;
          }h3 {
               text-align: center;
           }
    </style>
@endsection
