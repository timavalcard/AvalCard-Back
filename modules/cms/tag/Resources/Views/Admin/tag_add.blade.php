
    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن برچسب
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">برچسب ها</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">برچسب ها</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <div class="row">

        <div class="col-lg-6">

            <div class="admin-box">
                <div class="admin-box-title d-flex justify-content-between align-items-center">
                    <strong>
                        افزودن برچسب
                    </strong>
                </div>
                <div class="admin-box-content">
                    <form action="{{ route("admin_add_tag") }}" method="post">

                @csrf

                <input type="hidden" value="@isset($_GET["post_type"]){{$_GET["post_type"]}}@else{{"article"}} @endisset" name="post_type">

                <p>

                    <label for="">نام برچسب : </label>

                    <input type="text" name="name" placeholder="نام برچسب را وارد کنید" value="{{old("name")}}">

                </p>

                <p>

                    <label for="">نامک :</label>

                    <input type="text" name="slug" placeholder="نامک برچسب را وارد کنید" value="{{old("slug")}}">

                    <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

                </p>



                <p>

                    <label for=""> توضیحات برچسب (اختیاری) :</label>

                    <textarea name="contents" id="" cols="30" rows="10">{{old("contents")}}</textarea>

                </p>

                <p>

                    <button class="btn-blue"> افزودن برچسب</button>

                </p>

                <p>



                </p>

            </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="admin-box">
                <div class="admin-box-title d-flex justify-content-between align-items-center">
                    <strong>
                       لیست برچسب ها
                    </strong>
                </div>
                <div class="admin-box-content">
                    <table class="admin-table final-table">

                <tr>

                    <th>نام برچسب</th>

                    <th>توضیحات</th>

                    <th>نامک</th>


                    <th>تاریخ انتشار</th>

                </tr>

                @foreach($tags as $tag)


                    <tr>

                        <td>

                            <a href="{{ route("admin_edit_tag",["id"=>$tag->id,"post_type"=>request()->post_type]) }}">{{ $tag->name }}</a>

                            <div class="admin-table-actions">

                                <a href="{{ route("admin_edit_tag",["id"=>$tag->id,"post_type"=>request()->post_type]) }}"><span>بروزرسانی</span></a>

                                <a class="admin-table-actions-delete" href="{{ route("admin_delete_tag",["id"=>$tag->id]) }}"><span>حذف</span></a>

                                <a href="#"><span>نمایش در سایت</span></a>

                            </div>

                        </td>



                        <td>@if($tag->content) {{ $tag->content }} @else {{ "_" }} @endif</td>

                        <td>{{ $tag->slug }}</td>


                        <td>{{ toShamsi($tag->created_at) }}</td>

                    </tr>

                @endforeach



            </table>
                </div>
            </div>
        </div>

    </div>

            @includeIf("admin.partials.delete_modal")

        </x-slot>
    </x-admin-panel-layout>

