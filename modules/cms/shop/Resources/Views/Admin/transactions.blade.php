<x-admin-panel-layout>
       <x-slot name="title">
           تراکنش ها
       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">تراکنش ها</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">فروشگاه</a></li>
                               <li class="breadcrumb-item active">تراکنش ها</li>
                           </ol>
                       </div><!-- /.col -->
                   </div>
               </div>
           </div>

           <table class="admin-table final-table">
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>شناسه سفارش</th>
            <th>مبلغ</th>
            <th>تاریخ پرداخت</th>
        </tr>
        @foreach($transactions as $transaction)
        <tr>
            <td>
                @if($transaction->user)
                {{ $transaction->user->name}}
                @else
                    کاربر پاک شده است
                @endif
            </td>
            <td>
                @if($transaction->user)
                    {{ $transaction->user->email}}
                @else
                    کاربر پاک شده است
                @endif
            </td>
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
            <td>{{ toShamsi($transaction->created_at) }}</td>

        </tr>        @endforeach
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>شناسه سفارش</th>
            <th>مبلغ</th>
            <th>تاریخ پرداخت</th>
        </tr>
    </table>
    <div class="admin-paginator">
        {{ $transactions->links() }}
    </div>
   @includeIf('admin.partials.delete_modal')
       </x-slot>
</x-admin-panel-layout>
