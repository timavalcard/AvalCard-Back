
   <x-admin-panel-layout>
       <x-slot name="title">
           تراکنش های کیف پول
       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">تراکنش های کیف پول</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item"><a href="{{ route("admin_wallet_index") }}">کیف پول ها</a></li>
                               <li class="breadcrumb-item active">تراکنش های کیف پول</li>
                           </ol>
                       </div><!-- /.col -->
                   </div>
               </div>
           </div>

           <table class="admin-table final-table">
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>مبلغ</th>
            <th>وضعیت</th>
            <th>تاریخ ساخت</th>
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
            <td>
                @if($transaction->user)
                    {{ $transaction->user->email}}
                @else
                    کاربر پاک شده است
                @endif
            </td>
            <td>
              {{ format_price_with_currencySymbol($transaction->price) }}
            </td>
            <td>{{ __($transaction->status) }}</td>
            <td>{{ toShamsi($transaction->created_at) }}</td>

        </tr>        @endforeach
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>مبلغ</th>
            <th>وضعیت</th>
            <th>تاریخ ساخت</th>
        </tr>
    </table>
    <div class="admin-paginator">
        {{ $transactions->links() }}
    </div>
   @includeIf('admin.partials.delete_modal')
       </x-slot>
   </x-admin-panel-layout>
