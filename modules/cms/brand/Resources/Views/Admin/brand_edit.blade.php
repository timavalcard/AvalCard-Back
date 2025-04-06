

<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش برند :{{ $brand->name }}
    </x-slot>
    <x-slot name="main">
    <div class="col-lg-6 mx-auto">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">ویرایش برند : {{ $brand->name }}</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_add_brand",["post_type"=>$brand->type]) }}">برند ها</a></li>
                            <li class="breadcrumb-item active">ویرایش برند : {{ $brand->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_edit_brand",["id"=>$brand->id] ) }}"
              method="post">
            @method("put")
            @csrf
            <input type="hidden" value="{{$brand->type}}" name="type">
            <input type="hidden" value="{{$brand->id}}"  name="id">

            <p>
                <label for="">نام برند : </label>
                <input type="text" name="name"  placeholder="نام برند را وارد کنید"
                  value="@if(old("name")) {{old("name")}} @else {{ $brand->name }} @endif">

            </p>
            <p>
                <label for="">نامک :</label>
                <input type="text" name="slug" placeholder="نامک برند را وارد کنید"
                  value="@if(old("slug")) {{old("slug")}} @else {{ $brand->slug }} @endif">
                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>
            </p>
            <p>
                <label for=""> برند والد :</label>
                <select name="parent" id="">
                    <option value="0" @if(old("parent") ==0) {{"selected"}} @endif>برند اصلی </option>
                    @foreach($categories as $brand2)
                     <option @if(old("parent") == $brand2->id) {{"selected"}} @elseif($brand->parent == $brand2->id) {{"selected"}} @endif  value="{{$brand2->id}}">{{ $brand2->name }}</option>
                    @endforeach
                </select></p>

            <p>
                <label for="">درصد تخفیف محصولات این برند :</label>
                <input type="text" name="offer" placeholder="درصد تخفیف را وارد کنید" value="@if(old("offer")){{old("offer")}}@else{{ $brand->offer }}@endif">
            </p>

            <p>
                تصویر برند :
                <button class="open-admin-media-frame btn-blue" type="button">انتخاب عکس برند</button>
                <img class="admin-media-frame-img mt-3"
                     src="@if($brand->media) {{ $brand->media->url }} @endif"
                     style="width: 100%; height: auto;margin-top: 20px;">
                <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                       value="@if($brand->media) {{ $brand->media->id }} @endif">
            </p>

            <p>
                <label for=""> توضیحات برند (اختیاری) :</label>
                <textarea name="contents" id="contents" cols="30"  rows="10">@if(old("contents")) {{old("contents")}} @else {{ $brand->content }} @endif</textarea>
            </p>

            <h4 class="mt-5">تنظیمات سئو</h4>

            <div class="col-12 form-item">
                <p class="mt-4">
                    <label>متا تگ تایتل:</label>
                    <input type="text" name="meta_title"
                           value="@if(old("meta_title")){{old("meta_title")}}@else @if(isset($brand->post_meta_array["meta_title"])) {{ $brand->post_meta_array["meta_title"] }}@endif  @endif"
                           placeholder="متا تگ تایتل را وارد کنید">
                </p>
                <p class="mt-4">
                    <label>متا تگ دیسکریپشن:</label>

                    <textarea  name="meta_description"
                               placeholder="متا تگ دیسکریپشن را وارد کنید">@if(old("meta_description")){{old("meta_description")}}@else  @if(isset($brand->post_meta_array["meta_description"])) {{ $brand->post_meta_array["meta_description"] }}@endif @endif</textarea>
                </p>
                <p class="mt-4">
                    <label>ایندکس یا نو ایندکس:</label>
                    <span class="mr-2">ایندکس</span>
                    <input type="radio" name="meta_index"
                           value="index" @if(isset($brand->post_meta_array["meta_index"]) && $brand->post_meta_array["meta_index"]=="index" ) checked  @endif>
                    <span class="mr-2">نو ایندکس</span>
                    <input type="radio" name="meta_index"
                           value="noindex" @if(isset($brand->post_meta_array["meta_index"]) && $brand->post_meta_array["meta_index"]=="noindex" ) checked  @endif>
                </p>

                <p class="mt-4">
                    <label>فالو یا نو فالو:</label>
                    <span class="mr-2">فالو</span>
                    <input type="radio" name="meta_follow"
                           value="follow" @if(isset($brand->post_meta_array["meta_follow"]) && $brand->post_meta_array["meta_follow"]=="follow" ) checked  @endif>
                    <span class="mr-2">نو فالو</span>
                    <input type="radio" name="meta_follow"
                           value="nofollow" @if(isset($brand->post_meta_array["meta_follow"]) && $brand->post_meta_array["meta_follow"]=="nofollow" ) checked  @endif>
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
                CKEDITOR.instances['contents'].setData(`{!! $brand->contents !!}`);
            </script>
        @endpush
    </x-slot>
</x-admin-panel-layout>
