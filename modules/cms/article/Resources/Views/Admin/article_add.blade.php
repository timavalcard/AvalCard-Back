<x-admin-panel-layout>

    <x-slot name="title"> افزودن مقاله</x-slot>
    <x-slot name="main">
        <form action="{{ route("admin_article_add") }}" method="post" class="w-100" enctype="multipart/form-data">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">افزودن مقاله</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_article_list") }}">مقالات</a></li>
                                <li class="breadcrumb-item active">افزودن مقاله</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">


                    @csrf <input type="hidden" name="user_id"
                                 value="{{ auth()->id() }}">
                    <p><input type="text" placeholder="نام مقاله" name="title" value="{{old("title")}}"></p>
                    <p>
                        <label>نامک :
                            <span class="length-indicator mt-3">(<span class="max">75</span>/<span id="slug_description_length">@if(old("slug")){{ strlen(old("slug")) }} @else 0 @endif</span>)</span>
                        </label>
                        <input data-length="slug_description_length" type="text" name="slug" class="mt-3" value="{{ old("slug") }}" placeholder="نامک را وارد کنید">
                    </p>
                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title"><h5>محتوای نوشته</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <p class="col-12 form-item"><textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                        </p></div>
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>توضیحات کوتاه نوشته</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <p class="col-12 form-item"><textarea name="excerpt" id="excerpt" cols="30" rows="10"></textarea>
                        </p></div>


                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>تنظیمات سئو</h5>
                            <span  class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item">
                            <p class="mt-4">
                                <label>متا تگ تایتل:
                                    <span class="length-indicator">(<span class="max">60</span>/<span id="meta_title_length">@if(old("meta_title")){{ strlen(old("meta_title"))}} @else 0 @endif</span>)</span>

                                </label>
                                <input type="text" name="meta_title"
                                       value="@if(old("meta_title")){{old("meta_title")}} @endif"
                                       data-length="meta_title_length"
                                       placeholder="متا تگ تایتل را وارد کنید">
                            </p>
                            <p class="mt-4">
                                <label>متا تگ دیسکریپشن:
                                    <span class="length-indicator">(<span class="max">160</span>/<span id="meta_description_length">@if(old("meta_description")){{ strlen(old("meta_description")) }} @else 0 @endif</span>)</span>

                                </label>

                                <textarea  name="meta_description"
                                           data-length="meta_description_length"
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
                            @includeIf("admin.partials.seo_information")
                        </div>
                    </div>


                </div>

                <div class="col-lg-3">
                    <p>
                        <button class="btn-blue">انتشار</button>
                    </p>


                    <div class="admin-metabox-item metabox-close position-relative">
                        <div class="category-loading">
                            @includeIf("admin.partials.ajax-loading")
                        </div>
                        <div class="admin-metabox-item-title"><h5>دسته بندی مقاله</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">
                            <ul class="mt-3 category-list">
                                @foreach($categories as $category)
                                    <li>
                                        <input type="checkbox" name="article_cat[]" value="{{$category->id}}">
                                        <label for="">{{ $category->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <a class="btn btn-outline-primary d-inline-block m-3 btn-add-category"
                               href="#">افزودن دسته بندی تازه</a>

                            <div class="form-add-category d-none">
                                <input type="hidden" value="article" name="category_post_type">

                                <p>

                                    <label for="">نام دسته بندی : </label>

                                    <input type="text" name="category_name" placeholder="نام ذسته بندی را وارد کنید" value="{{old("name")}}">

                                </p>

                                <p>

                                    <label for="">نامک :</label>

                                    <input type="text" name="category_slug" placeholder="نامک ذسته بندی را وارد کنید" value="{{old("slug")}}">

                                    <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

                                </p>
                                <p>

                                    <label for=""> دسته والد :</label>

                                    <select name="category_parent" id="">

                                        <option value="0" selected>دسته اصلی</option>

                                        @foreach($categories as $category)

                                            <option  value="{{$category->id}}">{{ $category->name }}</option>

                                        @endforeach

                                    </select>

                                </p>


                                <p>
                                    <button class="btn-blue btn-submit-category">افزودن دسته بندی</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="admin-metabox-item metabox-close position-relative">
                        <div class="tag-loading">
                            @includeIf("admin.partials.ajax-loading")
                        </div>
                        <div class="admin-metabox-item-title">
                            <h5>برچسب های مقاله</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item">
                            <ul class="mt-3 tag-list">
                                @foreach($tags as $tag)
                                    <li >
                                        <input id="tag_{{ $tag->id }}" type="checkbox" name="article_tag[]" value="{{$tag->id}}">
                                        <label for="tag_{{ $tag->id }}">  {{ $tag->name }} </label>
                                    </li>
                                @endforeach
                            </ul>
                            <a class="btn btn-outline-primary d-inline-block m-3 btn-add-tag"
                               href="#">افزودن برچسب تازه</a>

                            <div class="form-add-tag d-none">
                                <input type="hidden" value="article" name="tag_post_type">

                                <p>

                                    <label for="">نام برچسب : </label>

                                    <input type="text" name="tag_name" placeholder="نام برچسب را وارد کنید" value="{{old("name")}}">

                                </p>

                                <p>

                                    <label for="">نامک :</label>

                                    <input type="text" name="tag_slug" placeholder="نامک برچسب را وارد کنید" value="{{old("slug")}}">

                                    <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

                                </p>
                                <p>
                                    <button class="btn-blue btn-submit-tag">افزودن برچسب</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>عکس مقاله</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                        <div class="col-12 form-item mt-3">
                            <input type="hidden" class="admin-media-frame-input" name="thumbnail">

                            <button class="open-admin-media-frame btn-blue" type="button">عکس مقاله</button>
                            <img src="{{ asset(env("IMG_DIR","images")).'/' }}" class="admin-media-frame-img mt-3">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>

        @includeIf("admin.partials.media_frame")
        @push("admin-scripts")
            @includeIf("admin.partials.add-tag-js",["checkbox_name"=>"article_tag"])
            @includeIf("admin.partials.add-category-js",["checkbox_name"=>"article_cat"])
            <script>
                CKEDITOR.replace('contents');
                CKEDITOR.replace('excerpt');
                CKEDITOR.instances['contents'].setData(`{!! old("contents") !!}`);
                CKEDITOR.instances['excerpt'].setData(`{!! old("excerpt") !!}`)
            </script>
            @includeIf("admin.partials.seo_information_script")
        @endpush


        @push("admin-css")
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
        @endpush
    </x-slot>

</x-admin-panel-layout>
