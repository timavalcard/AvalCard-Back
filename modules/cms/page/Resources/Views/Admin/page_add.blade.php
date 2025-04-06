
    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن برگه
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">برگه تازه</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_list_page") }}">برگه ها</a></li>
                                <li class="breadcrumb-item active">
                                    برگه تازه
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_add_page") }}" method="post" class="w-100" enctype="multipart/form-data">

        <div class="row">
            <div class="col-lg-9">
                @csrf
                <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                <p><input type="text" placeholder="نام برگه" name="title" value="{{old("title")}}"></p>
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
                </div>

                <p>
                    <button class="btn-blue">انتشار</button>
                </p>
            </div>
            <div class="col-lg-3">

                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>نامک</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <p class="col-12 form-item">
                        <input name="slug" type="text"  class="mt-3"  value="{{old("slug")}}" placeholder="نامک را وارد کنید">
                        <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی&zwnj;ها (URLs)&zwnj; استفاده می&zwnj;شود. برای نامگذاری فقط از حروف،&zwnj; ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>
                    </p>

                </div>
            </div>
        </div>
    </form>
    @push("admin-scripts")
    <script>
        CKEDITOR.replace('contents');
        CKEDITOR.replace('excerpt');
        CKEDITOR.instances['contents'].setData(`{!! old("content") !!}`);
        CKEDITOR.instances['excerpt'].setData(`{!! old("post_excerpt") !!}`)
    </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
