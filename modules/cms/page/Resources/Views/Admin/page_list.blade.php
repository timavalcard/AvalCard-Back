<x-admin-panel-layout>
        <x-slot name="title">
            لیست برگه
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">لیست برگه ها</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">
                                    لیست برگه ها
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    {{--<form action="{{ route("admin_group_action") }}" method="post">
        @csrf--}}
            <div class="admin-table-content">
                <div class="admin-order-select-box mt-3">
                    <div class="admin-order-by-box">

                        <label>مرتب سازی بر اساس : </label>


                        <a href="{{ route("admin_list_page" ,["orderBy"=>"desc"]) }}"
                           class="btn btn-sm btn-outline-dark @if(request("orderBy")=="desc" ) btn-dark text-white @endif">قدیم به جدید</a>
                        <a href="{{ route("admin_list_page" ,["orderBy"=>"asc"]) }}"
                           class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="asc" ) btn-dark text-white @endif">جدید به قدیم</a>
                        <a href="{{ route("admin_list_page" ,["orderBy"=>"name"]) }}"
                           class="btn btn-sm btn-outline-dark @if(request("orderBy")=="name") btn-dark text-white @endif">حروف الفبا</a>


                    </div>
                    <div class="admin-filter-search mb-3">
                        <form action="" class="d-flex align-items-center">
                            <input style="border-radius: 10px;" type="text" name="name" placeholder="نام مورد نظر را وارد کنید...">
                            <button class="btn-blue mr-2">
                                <svg id="Group_126" data-name="Group 126" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path id="Path_143" data-name="Path 143" d="M0,0H24V24H0Z" fill="none"/>
                                    <circle id="Ellipse_11" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(3 3)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    <line id="Line_58" data-name="Line 58" x1="6" y1="6" transform="translate(15 15)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>

                            </button>
                        </form>
                    </div>



                </div>

                <table class="admin-table final-table">
                    <tr>

                        <th>نام برگه</th>
                        <th>نامک</th>
                        <th>تاریخ انتشار</th>
                        <th></th>
                    </tr>
                    @foreach($pages as $page)

                        <tr>

                            <td><a href="{{ route("admin_edit_page",["id"=>$page->id]) }}">{{ $page->title }}</a>
                            </td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ toShamsi($page->created_at) }}</td>
                            <td class="icons">
                                <div class="admin-table-actions">
                                    <a title="ویرایش" href="{{ route("admin_edit_page",["id"=>$page->id]) }}">
                                                    <span>
                                                        <svg id="Component_9_1" data-name="Component 9 – 1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_71" data-name="Path 71" d="M0,0H20V20H0Z" fill="none"/>
  <path id="Path_72" data-name="Path 72" d="M8.167,7h-2.5A1.667,1.667,0,0,0,4,8.667v7.5a1.667,1.667,0,0,0,1.667,1.667h7.5a1.667,1.667,0,0,0,1.667-1.667v-2.5" transform="translate(-0.667 -1.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_73" data-name="Path 73" d="M9,12.98h2.5L18.583,5.9a1.768,1.768,0,1,0-2.5-2.5L9,10.48v2.5" transform="translate(-1.5 -0.48)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_21" data-name="Line 21" x2="2.5" y2="2.5" transform="translate(13.333 4.167)" fill="none" stroke="#7c8da7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                    </span>
                                    </a>
                                    <a title="حذف" class="admin-table-actions-delete" href="{{ route("admin_delete_page",["id"=>$page->id]) }}">
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
                                    <a title="نمایش" href="{{ $page->url }}">
                                                    <span>
                                                     <svg id="Group_70" data-name="Group 70" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_77" data-name="Path 77" d="M0,0H20V20H0Z" fill="none"/>
  <circle id="Ellipse_8" data-name="Ellipse 8" cx="2" cy="2" r="2" transform="translate(8 8)" fill="none" stroke="#3f8cff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_78" data-name="Path 78" d="M18.667,10.833q-3.334,5.834-8.333,5.833T2,10.833Q5.334,5,10.333,5t8.333,5.833" transform="translate(-0.333 -0.833)" fill="none" stroke="#3f8cff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>

                                                    </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>


    {{--</form>--}}
    <div class="admin-paginator">
        {{ $pages->links() }}
    </div>
            @includeIf("admin.partials.delete_modal")
  </x-slot>
</x-admin-panel-layout>
