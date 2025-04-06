@extends("Theme::hidi.affiliate.master")

@section("title")
    حساب بازاریابی
@endsection


@section("affiliate-content")
    <div class="uap-user-page-content">

        <div class="uap-ap-wrap">
            <h3>لینک های شما</h3>
            <p class="description">در این قسمت شما می توانید یک لینک از سایت را در فیلد پایین قرار دهید و لینک بازاریابی مخصوص خود را دریافت کنید و به کاربران بدهید</p>
            <div class="affiliate-links">
                @if($links)
                    @foreach($links as $link)
                        <div class="affiliate-link-item">
                            <div class="link">{{ $link }}</div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="affiliate-add-link">
                <form action="{{ route("affiliate.links") }}" method="post">
                    @csrf
                    <input type="url" name="link" placeholder="لینک مورد نظر خود را وارد کنید">
                    <button class="btn-blue" type="submit">افزودن لینک</button>
                </form>
            </div>


        </div>
    </div>
@endsection
