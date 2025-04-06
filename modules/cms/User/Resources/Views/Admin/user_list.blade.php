<x-admin-panel-layout>
    <x-slot name="title">
        لیست کاربران
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">کاربران</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">کاربران</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_users_group_action") }}" method="post">
            @csrf
        <div class="admin-table-content">
            <div class="admin-page-top">
                <p class="">تعداد کل : {{ $users_count }} عدد </p>
                <div class="admin-filter-search mb-3">
                    <form action="" class="d-flex align-items-center">
                        <input style="border-radius: 10px;" type="text" name="name" placeholder="جستجوی کاربر...">
                        <button class="btn-blue mr-2">جستجو</button>
                    </form>
                </div>
            </div>
            <div class="admin-order-select-box mt-3 mb-3">
                <div></div>
                <div class="admin-order-select-box">

                    <div class="admin-select-all-checkbox mb-3">


                        <select name="action">
                            <option value="" selected="selected">کارهای دسته جمعی : </option>
                            <option value="delete">حذف</option>
                        </select>
                        <button class="btn-outline-primary mr-3">اجرا</button>
                    </div>
                </div>

            </div>


                <table class="admin-table final-table">
                    <tr>
                        <th>
                            <label>انتخاب همه موارد</label>
                            <input type="checkbox" class="admin-select-all-checkbox-btn ml-3">
                        </th>
                        <th>نام </th>
                        <th>ایمیل</th>
                        <th>تلفن همراه</th>
                        <th>نقش کاربری</th>
                        <th>تاریخ عضویت</th>
                        <th></th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}
                            <input type="checkbox" name="checkbox_item[]" value="{{ $user->id }}">
                        </td>
                        <td><a href="{{ route("admin_edit_user",["id"=>$user->id]) }}">
                                @php($user_data=CMS\User\Repositories\UserRepository::get_all_meta($user))
                                {{ $user->name}} @if(isset($user_data["lastname"])){{ $user_data["lastname"] }}@endif
                            </a>
                            <div class="admin-table-actions"><a href="{{ route("admin_edit_user",["id"=>$user->id]) }}"><span>بروزرسانی</span></a>
                                <a class="admin-table-actions-delete"
                                   href="{{ route("admin_delete_user",["id"=>$user->id]) }}"><span>حذف</span></a> <a href="#"><span>نمایش در سایت</span></a>
                            </div>
                        </td>
                        <td style="width: 230px;    min-width: 230px;">{{ $user->email}}</td>
                        <td>{{ $user->mobile}}</td>
                        <td>
                            <ul>
                            @foreach($user->roles as $userRole)
                               <li>@lang($userRole->name)</li>
                            @endforeach
                            </ul>
                        </td>
                        {{--<td>@lang($user->status)</td>--}}
                        <td>{{ toShamsi($user->created_at) }}</td>
                        <td class="icons">
                            <div class="admin-table-actions">
                                <a title="ویرایش" href="{{ route("admin_edit_user",["id"=>$user->id]) }}">
                                                                <span>
                                                                    <svg id="Component_9_1" data-name="Component 9 – 1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
              <path id="Path_71" data-name="Path 71" d="M0,0H20V20H0Z" fill="none"/>
              <path id="Path_72" data-name="Path 72" d="M8.167,7h-2.5A1.667,1.667,0,0,0,4,8.667v7.5a1.667,1.667,0,0,0,1.667,1.667h7.5a1.667,1.667,0,0,0,1.667-1.667v-2.5" transform="translate(-0.667 -1.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
              <path id="Path_73" data-name="Path 73" d="M9,12.98h2.5L18.583,5.9a1.768,1.768,0,1,0-2.5-2.5L9,10.48v2.5" transform="translate(-1.5 -0.48)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
              <line id="Line_21" data-name="Line 21" x2="2.5" y2="2.5" transform="translate(13.333 4.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </svg>

                                                                </span>
                                </a>
                                <a title="حذف" class="admin-table-actions-delete" href="{{ route("admin_delete_user",["id"=>$user->id]) }}">
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
                               </div>
                        </td>
                    </tr>        @endforeach

                </table>

            <div class="admin-paginator">
                {{ $users->links() }}
            </div>
        </div>
        </form>
        @includeIf("admin.partials.delete_modal")
    </x-slot>
</x-admin-panel-layout>
