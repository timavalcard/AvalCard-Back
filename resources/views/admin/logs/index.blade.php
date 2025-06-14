<x-admin-panel-layout>
    <x-slot name="title">
        لیست خطا
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">لیست خطا ها</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">
                                لیست خطا ها
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        {{--<form action="{{ route("admin_group_action") }}" method="post">
            @csrf--}}
        <div class="admin-table-content">

            <table class="admin-table final-table">
                <tr>
                    <th>سطح</th>
                    <th>پیام</th>
                    <th>متن</th>
                    <th>کاربر</th>
                    <th>لینک</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>

                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->level }}</td>
                            <td style="
    text-align: left;
    direction: ltr;    overflow: scroll;
">{{ $log->message }}</td>
                            <td><pre style="text-align: center">{{ $log->context }}</pre></td>
                            <td>
                                @if(isset(json_decode($log->context)->userId))
                                    <a style="color: dodgerblue" href="{{ route("admin_edit_user",["id"=>json_decode($log->context)->userId]) }}">
                                        نمایش کاربر
                                    </a>
                                    @else -
                                @endif
                            </td>
                            <td style="
    width: 200px;
">{{ $log->referrer ?? $log->url }}</td>
                            <td>{{ $log->created_at }}</td>
                            <td>

                                <a title="حذف" class="admin-table-actions-delete" href="{{ route("log.delete",["id"=>$log->id]) }}">
                                                    <span>
                                                        <svg id="Group_69" data-name="Group 69" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_74" data-name="Path 74" d="M0,0H20V20H0Z" fill="none"/>
  <line id="Line_22" data-name="Line 22" x2="13.333" transform="translate(3.333 5.833)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_23" data-name="Line 23" y2="5" transform="translate(8.333 9.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_24" data-name="Line 24" y2="5" transform="translate(11.667 9.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_75" data-name="Path 75" d="M5,7l.833,10A1.667,1.667,0,0,0,7.5,18.667h6.667A1.667,1.667,0,0,0,15.833,17l.833-10" transform="translate(-0.833 -1.167)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_76" data-name="Path 76" d="M9,6.333v-2.5A.833.833,0,0,1,9.833,3h3.333A.833.833,0,0,1,14,3.833v2.5" transform="translate(-1.5 -0.5)" fill="none" stroke="#dd2d4a" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach

            </table>
        </div>


        {{--</form>--}}
        <div class="admin-paginator">
            {{ $logs->links() }}
        </div>
        @includeIf("admin.partials.delete_modal")
    </x-slot>
</x-admin-panel-layout>
