

    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن دسته بندی
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">دسته بندی ها</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">

                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
<div class="row" style="overflow: hidden;">

    <div class="col-lg-6">

        <div class="admin-box">
            <div class="admin-box-title d-flex justify-content-between align-items-center">
                <strong>
                    افزودن دسته بندی
                </strong>
            </div>
            <div class="admin-box-content">
                <form action="{{ route("admin_add_category") }}" method="post">

            @csrf

            <input type="hidden" value="@isset($_GET["post_type"]){{$_GET["post_type"]}}@else{{"article"}} @endisset" name="type">
            <input type="hidden" value="@isset($_GET["product_type"]){{$_GET["product_type"]}}@endisset" name="product_type">

            <p>

                <label for="">نام دسته بندی : </label>

                <input type="text" name="name" placeholder="نام دسته بندی را وارد کنید" value="{{old("name")}}">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک دسته بندی را وارد کنید" value="{{old("slug")}}">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>

            <p>

                <label for=""> دسته والد :</label>

                <select name="parent" id="">

                    <option value="0" @if(old("parent") ==0) {{"selected"}} @endif>دسته اصلی</option>

                    @foreach($categories as $category)

                        <option @if(old("parent") ==$category->id) {{"selected"}} @endif value="{{$category->id}}">{{ $category->name }}</option>

                    @endforeach

                </select>

            </p>
            @if(request()->post_type!="article")
                <p class="d-none">
                    <label for="">درصد تخفیف محصولات این دسته بندی :</label>
                    <input type="text" name="offer" placeholder="درصد تخفیف را وارد کنید" value="@if(old("offer")){{old("offer")}}@endif">
                </p>
            @endif

            <p>

                تصویر دسته بندی :
                <button class="open-admin-media-frame btn-blue" type="button">انتخاب عکس دسته بندی</button>
                <img class="admin-media-frame-img mt-3"
                     src=""
                     style="width: 100%; height: auto;margin-top: 20px;">

                <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                       value="">
            </p>
            <p>

                <label for=""> توضیحات دسته بندی (اختیاری) :</label>

                <textarea  name="contents" id="contents" cols="30" rows="10">{{old("contents")}}</textarea>

            </p>

            <h4 class="mt-5">تنظیمات سئو</h4>

            <div class="col-12 form-item">
                <p class="mt-4">
                    <label>متا تگ تایتل:</label>
                    <input type="text" name="meta_title"
                           value="@if(old("meta_title")){{old("meta_title")}} @endif"
                           placeholder="متا تگ تایتل را وارد کنید">
                </p>
                <p class="mt-4">
                    <label>متا تگ دیسکریپشن:</label>

                    <textarea  name="meta_description"
                               placeholder="متا تگ دیسکریپشن را وارد کنید">@if(old("meta_description")){{old("meta_description")}}@endif</textarea>
                </p>
                <p class="mt-4">
                    <label>ایندکس یا نو ایندکس:</label>
                    <span class="mr-2">ایندکس</span>
                    <input type="radio" checked name="meta_index"
                           value="index" >
                    <span class="mr-2">نو ایندکس</span>
                    <input type="radio" name="meta_index"
                           value="noindex" >
                </p>

                <p class="mt-4">
                    <label>فالو یا نو فالو:</label>
                    <span class="mr-2">فالو</span>
                    <input type="radio" checked name="meta_follow"
                           value="follow" >
                    <span class="mr-2">نو فالو</span>
                    <input type="radio" name="meta_follow"
                           value="nofollow">
                </p>
            </div>

            <p>

                <button class="btn-blue"> افزودن دسته بندی</button>

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
                    لیست دسته بندی ها
                </strong>
            </div>
            <div class="admin-box-content">
                <div class="admin-filter-search mb-3 col-5 mt-5">
                    <form action="" class="d-flex align-items-center">
                        <input style="border-radius: 10px;" type="text" name="name" placeholder="نام مورد نظر را وارد کنید...">
                        <input  type="hidden" name="post_type" value="{{ request()->post_type }}">
                        <button class="btn-blue mr-2">
                            <svg id="Group_126" data-name="Group 126" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path id="Path_143" data-name="Path 143" d="M0,0H24V24H0Z" fill="none"/>
                                <circle id="Ellipse_11" data-name="Ellipse 11" cx="7" cy="7" r="7" transform="translate(3 3)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <line id="Line_58" data-name="Line 58" x1="6" y1="6" transform="translate(15 15)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>

                        </button>
                    </form>
                </div>
                <table class="admin-table final-table mb-4">

                    <tr>

                        <th>نام دسته بندی</th>

                        <th>نامک</th>

                        <th>دسته والد</th>

                        <th>تاریخ انتشار</th>

                    </tr>

                    @foreach($categories as $category)

                        <tr>

                            <td>
                                @if($category->media)
                                <img class="admin-media-frame-img mt-3"
                                     src="@if($category->media) {{ $category->media->url }} @endif "
                                     style="width: 50px; height: 50px;margin-left: 10px;">
                                @endif
                                <a style="display: block;margin-top: 10px" href="{{ route("admin_edit_category",["id"=>$category->id,"post_type"=>request()->post_type]) }}">{{ $category->name }}</a>

                                <div class="admin-table-actions">

                                    <a href="{{ route("admin_edit_category",["id"=>$category->id,"post_type"=>request()->post_type]) }}"><span>بروزرسانی</span></a>

                                    <a class="admin-table-actions-delete" href="{{ route("admin_delete_category",["id"=>$category->id]) }}"><span>حذف</span></a>

                                    <a href="{{ $category->url }}"><span>نمایش در سایت</span></a>

                                </div>

                            </td>




                            <td>{{ $category->slug }}</td>

                            <td>{!! $category->parentCat !!} </td>

                            <td>{{ toShamsi($category->created_at) }}</td>

                        </tr>

                    @endforeach



                </table>
            </div>
        </div>
    </div>
    <style>
        .admin-table-actions{
            padding-right: 50px;
        }
    </style>
</div>
            @push("admin-scripts")
                <script>
                    CKEDITOR.replace('contents');
                    CKEDITOR.instances['contents'].setData(`{!! old("contents") !!}`);
                </script>
            @endpush

            @includeIf("admin.partials.delete_modal")

@includeIf("admin.partials.media_frame")

        </x-slot>
    </x-admin-panel-layout>
