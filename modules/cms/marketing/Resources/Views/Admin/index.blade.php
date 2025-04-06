
   <x-admin-panel-layout>
       <x-slot name="title">
           بازاریابان

       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">بازاریابان</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item active">بازاریابان</li>
                           </ol>
                       </div><!-- /.col -->
                   </div>
               </div>
           </div>
    <table class="admin-table final-table">
        <tr>
            <th>شناسه کاربر</th>
            <th>نام کاربر</th>
            <th>تلفن</th>
            <th>تعداد ورودی</th>
            <th>موجودی قابل برداشت</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                {{ $user->name ?? "-"}}
            </td>
            <td>{{ $user->mobile}}</td>

            <td>{{ $user->entrance->count() }}</td>
            <td>{{ format_price_with_currencySymbol($user->inventory) }}</td>


        </tr>        @endforeach

    </table>

   @includeIf('admin.partials.delete_modal')
       </x-slot>
   </x-admin-panel-layout>
