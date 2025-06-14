<x-admin-panel-layout>
    <x-slot name="title">
        لیست کاربران رد شده
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">لیست کاربران رد شده</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">لیست کاربران رد شده</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_users_group_action") }}" method="post">
            @csrf
        <div class="admin-table-content">
            <div class="admin-page-top">
                <p class="">تعداد کل : {{ $users->count() }} عدد </p>
            </div>
                <table class="admin-table final-table">
                    <tr>
                        <th>نام </th>
                        <th>ایمیل</th>
                        <th>تلفن همراه</th>
                        <th>تاریخ ارسال</th>
                        <th></th>
                    </tr>
                    @foreach($users as $meta)
                        @if(isset($meta->user))
                            <tr>
                        <td><a href="{{ route("admin_check_not_authorized",["id"=>$meta->user->id]) }}">
                                {{$meta->user->authorize_name}} {{$meta->user->authorize_last_name}}
                            </a>
                            <div class="admin-table-actions" style="
    text-align: right;
    justify-content: flex-start;
"><a href="{{ route("admin_check_not_authorized",["id"=>$meta->user->id]) }}"><span>نمایش</span></a>
                                 </div>
                        </td>
                        <td style="width: 230px;    min-width: 230px;">{{ $meta->user->email}}</td>
                        <td>{{ $meta->user->authorize_phone}}</td>

                        {{--<td>@lang($meta->user->status)</td>--}}
                                <td>{{ toShamsi($meta->created_at) }}</td>
                        <td class="icons">
                            <div class="admin-table-actions" style="
    text-align: right;
    justify-content: flex-start;
">
                                <a title="نمایش" href="{{ route("admin_check_not_authorized",["id"=>$meta->user->id]) }}">
                                                                <span>
                                                                    <svg id="Component_9_1" data-name="Component 9 – 1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
              <path id="Path_71" data-name="Path 71" d="M0,0H20V20H0Z" fill="none"/>
              <path id="Path_72" data-name="Path 72" d="M8.167,7h-2.5A1.667,1.667,0,0,0,4,8.667v7.5a1.667,1.667,0,0,0,1.667,1.667h7.5a1.667,1.667,0,0,0,1.667-1.667v-2.5" transform="translate(-0.667 -1.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
              <path id="Path_73" data-name="Path 73" d="M9,12.98h2.5L18.583,5.9a1.768,1.768,0,1,0-2.5-2.5L9,10.48v2.5" transform="translate(-1.5 -0.48)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
              <line id="Line_21" data-name="Line 21" x2="2.5" y2="2.5" transform="translate(13.333 4.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </svg>

                                                                </span>
                                </a>

                               </div>
                        </td>
                    </tr>
                        @endif
                    @endforeach

                </table>


        </div>
        </form>
        @includeIf("admin.partials.delete_modal")
    </x-slot>
</x-admin-panel-layout>
