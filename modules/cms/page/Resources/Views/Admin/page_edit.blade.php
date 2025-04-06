
<x-admin-panel-layout>
        <x-slot name="title">
            ویرایش برگه : {{ $page->title }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">ویرایش برگه : {{$page->title}}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_list_page") }}">برگه ها</a></li>
                                <li class="breadcrumb-item active">
                                    ویرایش برگه : {{$page->title}}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_edit_page",["id"=>$page->id]) }}" method="post" class="w-100"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9">@csrf <input type="hidden" name="user_id"
                                                                                       value="{{ auth()->id() }}">
                <input type="hidden" value="{{$page->id}}" name="id">
                <p><input type="text" placeholder="نام برگه" name="title"
                          value="@if(old("title")){{old("title")}}@else{{ $page->title }}@endif"></p>
                <div class="admin-metabox-item metabox-close open">
                    <div class="admin-metabox-item-title"><h5>محتوای برگه</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item"><textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                    </p></div>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>توضیحات کوتاه برگه</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item"><textarea name="excerpt" id="excerpt" cols="30" rows="10"></textarea>
                    </p></div>


                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title">
                        <h5>تنظیمات سئو</h5>
                        <span  class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                    </div>
                    <div class="col-12 form-item">
                        <p class="mt-4">
                            <label>متا تگ تایتل:</label>
                            <input type="text" name="meta_title"
                                   value="@if(old("meta_title")){{old("meta_title")}}@else @if(isset($page->post_meta_array["meta_title"])) {{ $page->post_meta_array["meta_title"] }}@endif  @endif"
                                   placeholder="متا تگ تایتل را وارد کنید">
                        </p>
                        <p class="mt-4">
                            <label>متا تگ دیسکریپشن:</label>

                            <textarea  name="meta_description"
                                       placeholder="متا تگ دیسکریپشن را وارد کنید">@if(old("meta_description")){{old("meta_description")}}@else  @if(isset($page->post_meta_array["meta_description"])) {{ $page->post_meta_array["meta_description"] }}@endif @endif</textarea>
                        </p>
                        <p class="mt-4">
                            <label>ایندکس یا نو ایندکس:</label>
                            <span class="mr-2">ایندکس</span>
                            <input type="radio" name="meta_index"
                                   value="index" @if(isset($page->post_meta_array["meta_index"]) && $page->post_meta_array["meta_index"]=="index" ) checked  @endif>
                            <span class="mr-2">نو ایندکس</span>
                            <input type="radio" name="meta_index"
                                   value="noindex" @if(isset($page->post_meta_array["meta_index"]) && $page->post_meta_array["meta_index"]=="noindex" ) checked  @endif>
                        </p>

                        <p class="mt-4">
                            <label>فالو یا نو فالو:</label>
                            <span class="mr-2">فالو</span>
                            <input type="radio" name="meta_follow"
                                   value="follow" @if(isset($page->post_meta_array["meta_follow"]) && $page->post_meta_array["meta_follow"]=="follow" ) checked  @endif>
                            <span class="mr-2">نو فالو</span>
                            <input type="radio" name="meta_follow"
                                   value="nofollow" @if(isset($page->post_meta_array["meta_follow"]) && $page->post_meta_array["meta_follow"]=="nofollow" ) checked  @endif>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">

                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>نامک</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item">
                        <input name="slug" type="text"  class="mt-3"  value="@if(old("slug")){{old("slug")}}@else{{ $page->slug }}@endif">
                        <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی&zwnj;ها (URLs)&zwnj; استفاده می&zwnj;شود. برای نامگذاری فقط از حروف،&zwnj; ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>
                    </p></div>
            </div>
        </div>
        <p>
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>
    @push("admin-scripts")
    <script>
        CKEDITOR.replace('contents');
        CKEDITOR.replace('excerpt');
        CKEDITOR.instances['contents'].setData(`{!! $page->content !!}`);
        CKEDITOR.instances['excerpt'].setData(`{!! $page->post_excerpt !!}`)
    </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
