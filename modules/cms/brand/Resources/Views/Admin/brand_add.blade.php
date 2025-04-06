

    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن برند
        </x-slot>
        <x-slot name="main">
<div class="row" style="overflow: hidden;">

    <div class="col-lg-6 mx-auto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">برند ها</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">برند ها</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>

        <form action="{{ route("admin_add_brand") }}" method="post">

            @csrf

            <input type="hidden" value="@isset($_GET["post_type"]){{$_GET["post_type"]}}@else{{"article"}} @endisset" name="type">

            <p>

                <label for="">نام برند : </label>

                <input type="text" name="name" placeholder="نام برند را وارد کنید" value="{{old("name")}}">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک برند را وارد کنید" value="{{old("slug")}}">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>

            <p>

                <label for=""> برند والد :</label>

                <select name="parent" id="">

                    <option value="0" @if(old("parent") ==0) {{"selected"}} @endif>برند اصلی</option>

                    @foreach($categories as $brand)

                        <option @if(old("parent") ==$brand->id) {{"selected"}} @endif value="{{$brand->id}}">{{ $brand->name }}</option>

                    @endforeach

                </select>

            </p>
            <p>
                <label for="">درصد تخفیف محصولات این برند :</label>
                <input type="text" name="offer" placeholder="درصد تخفیف را وارد کنید" value="@if(old("offer")){{old("offer")}}@endif">
            </p>
            <p>
                تصویر برند :
                <button class="open-admin-media-frame btn-blue" type="button">انتخاب عکس برند</button>
                <img class="admin-media-frame-img mt-3"
                     src=""
                     style="width: 100%; height: auto;margin-top: 20px;">

                <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                       value="">
            </p>
            <p>

                <label for=""> توضیحات برند (اختیاری) :</label>

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

                <button class="btn-blue"> افزودن</button>

            </p>

            <p>



            </p>

        </form>

    </div>

    <div class="col-lg-12">

        <table class="admin-table mb-4" >

            <tr>

                <th>نام برند</th>

                <th>نامک</th>

                <th>برند والد</th>

                <th>تاریخ انتشار</th>

            </tr>

            @foreach($categories as $brand)

                <tr>

                    <td>
                        <img class="admin-media-frame-img mt-3"
                             src="@if($brand->media) {{ $brand->media->url }} @endif "
                             style="width: 50px; height: 50px;margin-left: 10px;">
                        <a href="{{ route("admin_edit_brand",["id"=>$brand->id,"post_type"=>request()->post_type]) }}">{{ $brand->name }}</a>

                        <div class="admin-table-actions">

                            <a href="{{ route("admin_edit_brand",["id"=>$brand->id,"post_type"=>request()->post_type]) }}"><span>بروزرسانی</span></a>

                            <a class="admin-table-actions-delete" href="{{ route("admin_delete_brand",["id"=>$brand->id]) }}"><span>حذف</span></a>

                            <a href="{{ $brand->url }}"><span>نمایش در سایت</span></a>

                        </div>

                    </td>




                    <td>{{ $brand->slug }}</td>

                    <td>{!! $brand->parentBrand !!} </td>

                    <td>{{ $brand->created_at }}</td>

                </tr>

            @endforeach



        </table>

    </div>

</div>
            @push("admin-scripts")
                <script>
                    CKEDITOR.replace('contents');
                    CKEDITOR.instances['contents'].setData(`{!! old("contents") !!}`);
                </script>
            @endpush

<div class="admin-delete-modal">

    <form action="" method="post">

        @csrf

        @method("delete")

        <p >شما می خواهید اینرا پاک کنید؟ این کار غیر قابل برگشت است</p>

        <span class="admin-modal-close btn-blue">انصراف</span>

        <button class="btn btn-danger">حذف</button>

    </form>

</div>

@includeIf("admin.partials.media_frame")

        </x-slot>
    </x-admin-panel-layout>
