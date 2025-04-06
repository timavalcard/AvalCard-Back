<div class="cart-collaterals col-md-3">
    <div class="cart_totals calculated_shipping">


        <h2>جمع کل سبد خرید</h2>

        <table cellspacing="0" class="shop_table shop_table_responsive">

            <tbody>
            <tr class="cart-coupon @if(empty(session()->get("coupon_name"))) d-none @endif">
                <th>کوپن تخفیف:</th>
                <td data-title="کوپن تخفیف">{{ session()->get("coupon_name") }}</td>
            </tr>
            @if($use_wallet)
                <tr class="cart-discount">
                    <th>پرداخت از کیف پول</th>
                    <td data-title="پرداخت از کیف پول">-{{ $use_wallet }}</td>
                </tr>

            @endif
            <tr class="order-total">
                <th>مجموع</th>
                <td data-title="مجموع">{{ format_price_with_currencySymbol($total_price) }}</td>
            </tr>
            </tbody>
        </table>
        @if(isset($cart_page) && $cart_page)
            <div class="wc-proceed-to-checkout">
                <a href="{{ route("course.pay") }}" class="checkout-button button alt wc-forward">
                    اقدام به پرداخت</a>


            </div>
        @endif

    </div>
</div>
