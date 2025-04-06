
   <x-admin-panel-layout>
       <x-slot name="title">
           امتیاز کاربران باشگاه مشتریان

       </x-slot>
       <x-slot name="main">
           <div class="content-header">
               <div class="container-fluid">
                   <div class="row mb-4">
                       <div class="col-sm-6">
                           <h3 class="m-0 text-dark">امتیاز کاربران باشگاه مشتریان</h3>
                       </div><!-- /.col -->
                       <div class="col-sm-6">
                           <ol class="breadcrumb float-sm-left">
                               <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                               <li class="breadcrumb-item active">امتیاز کاربران باشگاه مشتریان</li>
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
            <th>امتیاز</th>
            <th>آخرین بروز رسانی</th>
        </tr>
        @foreach($club_metas as $club_meta)
        <tr>
            <td>{{ $club_meta->user->id }}</td>
            <td><a href="{{ route("admin_edit_club",["id"=>$club_meta->id]) }}">
                {{ $club_meta->user->name}}</a>
                <div class="admin-table-actions"><a href="{{ route("admin_edit_club",["id"=>$club_meta->id]) }}"><span>ویرایش امتیاز</span></a>
                    <a class="admin-table-actions-delete"
                       href="{{ route("admin_club_remove",["id"=>$club_meta->id]) }}"><span>حذف از باشگاه مشتریان</span></a>
                </div>
            </td>
            <td>{{ $club_meta->user->mobile}}</td>
            <td>{{ $club_meta->meta_value}}</td>

            <td>{{ toShamsi($club_meta->updated_at) }}</td>

        </tr>        @endforeach

    </table>

   @includeIf('admin.partials.delete_modal')
       </x-slot>
   </x-admin-panel-layout>
