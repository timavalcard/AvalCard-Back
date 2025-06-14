

<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش دسته بتدی :{{ $category->name }}
    </x-slot>
    <x-slot name="main">
    <div class="col-lg-6 mx-auto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">ویرایش دسته بندی : {{ $category->name }}</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_add_category",["post_type"=>$category->type]) }}">دسته بندی ها</a></li>
                            <li class="breadcrumb-item active">ویرایش دسته بندی : {{ $category->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_edit_category",["id"=>$category->id] ) }}"
              method="post">
            @method("put")
            @csrf
            <input type="hidden" value="{{$category->type}}" name="type">
            <input type="hidden" value="{{$category->id}}"  name="id">

            <p>
                <label for="">نام دسته بندی : </label>
                <input type="text" name="name"  placeholder="نام دسته بندی را وارد کنید"
                  value="@if(old("name")) {{old("name")}} @else {{ $category->name }} @endif">

            </p>
            <p>
                <label for="">نامک :</label>
                <input type="text" name="slug" placeholder="نامک دسته بندی را وارد کنید"
                  value="@if(old("slug")) {{old("slug")}} @else {{ $category->slug }} @endif">
                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>
            </p>
            <p>
                <label for=""> دسته والد :</label>
                <select name="parent" id="">
                    <option value="0" @if(old("parent") ==0) {{"selected"}} @endif>دسته اصلی </option>
                    @foreach($categories as $category2)
                     <option @if(old("parent") == $category2->id) {{"selected"}} @elseif($category->parent == $category2->id) {{"selected"}} @endif  value="{{$category2->id}}">{{ $category2->name }}</option>
                    @endforeach
                </select></p>
            @if(request()->post_type!="article")
                <p class="d-none">
                    <label for="">درصد تخفیف محصولات این دسته بندی :</label>
                    <input type="text" name="offer" placeholder="درصد تخفیف را وارد کنید" value="@if(old("offer")){{old("offer")}}@else{{ $category->offer }}@endif">
                </p>
            @endif

            <p>
                تصویر دسته بندی :
                <button class="open-admin-media-frame btn-blue" type="button">انتخاب عکس دسته بندی</button>
                <img class="admin-media-frame-img mt-3"
                     src="@if($category->media) {{ $category->media->url }} @endif"
                     style="width: 100%; height: auto;margin-top: 20px;">
                <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                       value="@if($category->media) {{ $category->media->id }} @endif">
            </p>

            <p>
                <label for=""> توضیحات دسته بندی (اختیاری) :</label>
                <textarea name="contents" id="contents" cols="30"  rows="10">@if(old("contents")) {{old("contents")}} @else {{ $category->content }} @endif</textarea>
            </p>


            <h4 class="mt-5">تنظیمات سئو</h4>

            <div class="col-12 form-item">
                <p class="mt-4">
                    <label>متا تگ تایتل:</label>
                    <input type="text" name="meta_title"
                           value="@if(old("meta_title")){{old("meta_title")}}@else @if(isset($category->post_meta_array["meta_title"])) {{ $category->post_meta_array["meta_title"] }}@endif  @endif"
                           placeholder="متا تگ تایتل را وارد کنید">
                </p>
                <p class="mt-4">
                    <label>متا تگ دیسکریپشن:</label>

                    <textarea  name="meta_description"
                               placeholder="متا تگ دیسکریپشن را وارد کنید">@if(old("meta_description")){{old("meta_description")}}@else  @if(isset($category->post_meta_array["meta_description"])) {{ $category->post_meta_array["meta_description"] }}@endif @endif</textarea>
                </p>
                <p class="mt-4">
                    <label>ایندکس یا نو ایندکس:</label>
                    <span class="mr-2">ایندکس</span>
                    <input type="radio" name="meta_index"
                           value="index" @if(isset($category->post_meta_array["meta_index"]) && $category->post_meta_array["meta_index"]=="index" ) checked  @endif>
                    <span class="mr-2">نو ایندکس</span>
                    <input type="radio" name="meta_index"
                           value="noindex" @if(isset($category->post_meta_array["meta_index"]) && $category->post_meta_array["meta_index"]=="noindex" ) checked  @endif>
                </p>

                <p class="mt-4">
                    <label>فالو یا نو فالو:</label>
                    <span class="mr-2">فالو</span>
                    <input type="radio" name="meta_follow"
                           value="follow" @if(isset($category->post_meta_array["meta_follow"]) && $category->post_meta_array["meta_follow"]=="follow" ) checked  @endif>
                    <span class="mr-2">نو فالو</span>
                    <input type="radio" name="meta_follow"
                           value="nofollow" @if(isset($category->post_meta_array["meta_follow"]) && $category->post_meta_array["meta_follow"]=="nofollow" ) checked  @endif>
                </p>
            </div>

            <p>
                <button class="btn-blue">بروزرسانی</button>
            </p>

        </form>
    </div>
 @includeIf("admin.partials.media_frame")
        @push("admin-scripts")
            <script>
                CKEDITOR.replace('contents');
                CKEDITOR.instances['contents'].setData(`{!! $category->contents !!}`);
            </script>
        @endpush
    </x-slot>
</x-admin-panel-layout>
