
    <table class="admin-table final-table" dir="rtl">
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>مبلغ</th>
            <th>تاریخ پرداخت</th>
        </tr>
        @foreach($transactions as $transaction)
        <tr>
            <td> {{ $transaction->user->name}}</td>
            <td>{{ $transaction->user->email}}</td>
            <td>
                @if($transaction->transactionable)
                {{ $transaction->transactionable->id}}
                @else
                 سفارش پاک شده است
                @endif
            </td>
            <td>
              {{ format_price_with_currencySymbol($transaction->price) }}
            </td>
            <td>{{ $transaction->created_at }}</td>

        </tr>        @endforeach

    </table>
