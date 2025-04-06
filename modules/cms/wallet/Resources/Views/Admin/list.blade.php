
   <x-admin-panel-layout>
       <x-slot name="title">
           کیف پول کاربران

       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">کیف پول ها</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item active">کیف پول ها</li>
                           </ol>
                       </div><!-- /.col -->
                   </div>
               </div>
           </div>
    <table class="admin-table final-table">
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>موجودی</th>
            <th>آخرین بروز رسانی</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td><a href="{{ route("admin_edit_wallet",["id"=>$user->wallet->id]) }}">
                {{ $user->name}}</a>
                <div class="admin-table-actions"><a href="{{ route("admin_edit_wallet",["id"=>$user->wallet->id]) }}"><span>ویرایش کیف پول</span></a>
                    <a class="admin-table-actions-delete"
                       href="{{ route("admin_wallet_remove",["id"=>$user->wallet->id]) }}"><span>حذف</span></a>
                </div>
            </td>
            <td>{{ $user->email}}</td>
            <td>
              {{ format_price_with_currencySymbol($user->wallet->price) }}
            </td>
            <td>{{ toShamsi($user->wallet->updated_at) }}</td>

        </tr>        @endforeach
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>موجودی</th>
            <th>آخرین بروز رسانی</th>
        </tr>
    </table>
    <div class="admin-paginator">
        {{ $users->links() }}
    </div>
   @includeIf('admin.partials.delete_modal')
       </x-slot>
   </x-admin-panel-layout>
