@extends(config("theme.theme_mainContent_path"))

@section("title")
    نظرات
@endsection

@section("content")
        <div class="container">
            <div class="rows">

                <div class="woocommerce">
                    <div class="my-accountsss row">
                        @includeIf(config("theme.theme_path")."account.sidebar")
                        <div class="col-12 col-lg-9 fl">
                            <div class="woocommerce-MyAccount-content">
                                <div class="woocommerce-notices-wrapper"></div>

                                <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                    <thead>
                                    <tr>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">متن شما</span></th>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">لینک صفحه در سایت</span></th>
                                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">وضعیت</span></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($comments as $comment)
                                        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-cancelled order">

                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="مجموع">
                                                {{ $comment->text }}
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="مجموع">
                                                <a href="{{ $comment->commentable->url }}">{{ $comment->commentable->title }}</a>
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="مجموع">
                                                @if($comment->status)
                                                    پذیرفته شده
                                                @else
                                                    در انتظار تایید
                                                @endif
                                            </td>
                                       </tr>
                                    @endforeach

                                    </tbody>
                                </table>




                            </div></div>
                    </div>


                </div>
        </div>

@endsection
