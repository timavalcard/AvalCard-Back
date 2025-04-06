<div class="cart-collaterals @if(isset($bill_page)) bill_cart @endif">
    <div class="cart_totals calculated_shipping">


        <h2>جمع کل سبد خرید</h2>

        <table cellspacing="0" class="shop_table shop_table_responsive">

            <tbody>
            <tr class="cart-subtotal">
                <th>جمع قیمت محصولات</th>
                <td data-title="جمع  قیمت محصولات">{{ $total_box_cart_products_total_price }}</td>
            </tr>
            @if(!isset($cart_page))
                <tr class="cart-delivery">
                    <th>هزینه حمل و نقل</th>
                    <td data-title=" هزینه حمل و نقل  ">{{ $delivery_price }}</td>
                </tr>
            @endif
            <tr class="cart-coupon @if(empty(session()->get("coupon_name"))) d-none @endif">
                <th>کوپن تخفیف:</th>
                <td data-title="کوپن تخفیف">{{ session()->get("coupon_name") }}</td>
            </tr>
            @if($use_wallet)
                <tr class="cart-wallet">
                    <th>پرداخت از کیف پول</th>
                    <td data-title="پرداخت از کیف پول">-{{ $use_wallet }}</td>
                </tr>

            @endif

            @if($total_box_cart_products_offer_price > 0)
                <tr class="cart-discount">
                    <th>سود شما از این خرید</th>
                    <td data-title=" سود شما از این خرید  ">{{ $total_box_cart_products_offer_price }}</td>
                </tr>
            @endif

            <tr class="order-total">
                <th>مجموع</th>
                <td data-title="مجموع">{{ format_price_with_currencySymbol($total_price) }}</td>
            </tr>
            </tbody>
        </table>
       {{-- @if(isset($cart_page) && $cart_page)
            <div class="wc-proceed-to-checkout">
                <a href="{{ route("shop.checkout") }}" class="checkout-button button alt wc-forward">
                    اقدام به پرداخت</a>


            </div>
        @else
            <div class="wc-proceed-to-checkout">
                <a id="submit-order" href="#" class="checkout-button d-none button alt wc-forward">
                    پرداخت و ثبت سفارش</a>
            </div>
        @endif--}}
    </div>
</div>
