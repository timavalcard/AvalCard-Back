
   <x-admin-panel-layout>
       <x-slot name="title">
           بازاریابان منتظر تایید

       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">بازاریابان منتظر تایید</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item active">بازاریابان منتظر تایید</li>
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

            <th>تاریخ عضویت</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td><a href="{{ route("admin_edit_user",["id"=>$user->id]) }}">
                    {{ $user->id}}</a>
                <div class="admin-table-actions"><a href="{{ route("admin_accept_marketer",["id"=>$user->id]) }}"><span>پذیرفتن</span></a>
                    <a class="admin-table-actions-delete"
                       href="{{ route("admin_delete_user",["id"=>$user->id]) }}"><span>حذف کاربر</span></a>
                </div>
            </td>
            <td>
                {{ $user->name ?? "-"}}
            </td>
            <td>{{ $user->mobile}}</td>


            <td>{{ toShamsi($user->created_at)  }}</td>


        </tr>        @endforeach

    </table>


       </x-slot>
   </x-admin-panel-layout>
