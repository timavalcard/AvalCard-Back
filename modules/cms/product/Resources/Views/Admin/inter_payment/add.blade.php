
<x-admin-panel-layout>
    <x-slot name="title">
        افزودن سایت
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">افزودن سایت</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_product_list",["product_type"=>"buy_product"]) }}">سایت ها</a></li>
                            <li class="breadcrumb-item active">افزودن سایت</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>

        <form action="{{ route("admin_product_add") }}" method="post" class="w-100" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="product_nick_name" value="@if(old("product_nick_name")){{ old("product_nick_name") }}@endif">
                    <input type="hidden" name="product_type" value="{{ request()->product_type }}">

                    <p>
                        <input type="text" placeholder="نام سایت" name="title" value="{{old("title")}}">
                    </p>
                    <p>
                        <input type="text" name="slug" class="mt-3" value="{{ old("slug") }}"
                               placeholder="نامک را وارد کنید">
                    </p>
                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>محتوا</h5>
                            <span lass="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <p class="col-12 form-item">
                            <textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                        </p>
                    </div>
                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title"><h5>مشخصات  سایت</h5>
                            <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                        </div>
                        <div class="col-12 form-item">
                            <div class="admin-order-select-box d-none">
                                <div></div>
                                <div class="admin-select-all-checkbox">

                                    <label>نوع سایت : </label>
                                    <input type="hidden" value="comment" name="type">
                                    <select name="type" class="product-select-type" >
                                        <option value="simple" selected>ساده</option>
                                        <option value="variable">متغیر</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">

                                <ul class="admin-product-list-ul nav nav-tabs col-md-3 p-0" style="flex-direction: column" data-tabs="tabs">
                                    <li><a data-toggle="tab" href="#asli">مشخصات اصلی</a></li>
                                </ul>


                                <div class="tab-content col-lg-9">
                                    <div id="asli" class="admin-product-list-content-item tab-pane fade in active show " >
                                        <div class="for-sample">
                                            <p class="mt-2">
                                                <label style="width: 23%">ارز : </label>
                                                @includeIf("admin.partials.currency", [
                                                                         "value" => old("currency"),
                                                                         "select_by_user"=>true,
                                                                         "name" => "currency"
                                                                     ])
                                            </p>
                                            <p class="mt-2">
                                                <label style="width: 23%">قیمت اصلی  : </label>
                                                <input type="text" placeholder="در صورت خالی گزاشتن قیمت توسط کاربر تعیین می شود" class="w-100 admin-input-price" name="price" value="{{  old("price")  }}">
                                            </p>

                                        </div>
                                        <p>
                                            <input type="text" name="time_to_send" class="mt-3" value="{{ old("time_to_send") }}"
                                                   placeholder="مدت زمان تحویل">
                                        </p>
                                    </div>
                                </div>
                                @includeIf("admin.partials.ajax-loading")
                            </div>
                        </div>
                    </div>

                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title">
                            <h5>اطلاعات مورد نیاز کاربر</h5>
                            <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                        </div>

                        <div id="user-info-list" class="space-y-2 mt-4">
                            <!-- اینجا آیتم‌ها اضافه میشن -->
                        </div>

                        <button type="button" onclick="addUserInfoInput()" class="btn btn-primary mt-3">
                            افزودن اطلاعات جدید
                        </button>
                    </div>
                    <script>
                        let userInfoIndex = 0;

                        function addUserInfoInput(value = {label: '', type: 'text'}) {
                            const container = document.getElementById('user-info-list');

                            const div = document.createElement('div');
                            div.classList.add('input-group', 'mb-2');
                            div.setAttribute('data-index', userInfoIndex);

                            div.innerHTML = `
            <input
                type="text"
                name="user_info[${userInfoIndex}][label]"
                class="form-control"
                placeholder="مثلاً: ایمیل یا پسورد"
                value="${value.label || ''}">

            <select name="user_info[${userInfoIndex}][type]" class="form-control mx-2">
                <option value="text" ${value.type === 'text' ? 'selected' : ''}>متن</option>
                <option value="email" ${value.type === 'email' ? 'selected' : ''}>ایمیل</option>
                <option value="password" ${value.type === 'password' ? 'selected' : ''}>پسورد</option>
                <option value="date" ${value.type === 'date' ? 'selected' : ''}>تاریخ</option>
                <option value="time" ${value.type === 'time' ? 'selected' : ''}>زمان</option>
            </select>

            <div class="input-group-append">
                <button class="btn btn-danger" type="button" onclick="removeUserInfoInput(${userInfoIndex})">حذف</button>
            </div>
        `;

                            container.appendChild(div);
                            userInfoIndex++;
                        }

                        function removeUserInfoInput(index) {
                            const item = document.querySelector(`[data-index="${index}"]`);
                            if (item) {
                                item.remove();
                            }
                        }
                    </script>

                    <style>

                        .admin-metabox-item-btn-up i {
                            cursor: pointer;
                            color: #666;
                        }
                        .input-group {
                            display: flex;
                        }
                        .input-group input {
                            flex: 1;
                        }
                        #user-info-list select{
                            height: 44px;
                            background: #f1f1f1;
                            width: 100%;
                            margin-right: 0 !important;
                            margin-left: 0 !important;
                            margin-top: 11px;
                            font-size: 14px !important;
                            padding: 10px !important;
                            border-radius: 10px !important;
                        }
                        .btn {
                            padding: 6px 12px;
                            font-size: 14px;
                            margin-top: 15px;
                        }
                    </style>



                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>نکات قبل از خرید</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <p class="col-12 form-item"><textarea name="excerpt" id="excerpt" cols="30" rows="10"></textarea>
                        </p></div>

                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>سوالات متداول</h5>
                            <span  class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item">
                            <div id="faq-wrapper">
                                @php

                                    $oldFAQ = old('faq',[]);
                                @endphp

                                @if (empty($oldFAQ))
                                    <div class="service-item">
                                        <div class="service-item-header">
                                            <input type="text" name="faq[0][title]" placeholder="عنوان سوال">
                                            <button type="button" class="remove-faq">حذف</button>
                                        </div>
                                        <textarea name="faq[0][description]" placeholder="جواب سوال"></textarea>
                                    </div>
                                @else
                                    @foreach ($oldFAQ as $index => $service)
                                        <div class="service-item">
                                            <div class="service-item-header">
                                                <input type="text" name="faq[{{$index}}][title]" value="{{ $service['title']??"" }}" placeholder="عنوان سوال">
                                                <button type="button" class="remove-faq">حذف</button>
                                            </div>
                                            <textarea name="faq[{{$index}}][description]" placeholder="جواب سوال">{{ $service['description']??"" }}</textarea>
                                        </div>
                                    @endforeach
                                @endif

                                <button type="button" id="add-faq">افزودن سوال</button>
                            </div>
                            <style>
                                #addresses-wrapper {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 10px;
                                    max-width: 600px;
                                    margin: 10px 0 30px;
                                    padding: 20px;
                                    border: 1px solid #ccc;
                                    border-radius: 8px;
                                    background-color: #f9f9f9;
                                }
                                .address-item {
                                    display: flex;
                                    flex-wrap: wrap;
                                    align-items: center;
                                    gap: 10px;
                                }
                                .address-item input,
                                .address-item textarea,
                                .address-item select {
                                    flex: 1;
                                    padding: 8px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                }.address-item input, .address-item textarea, .address-item select {
                                     display: block !important;
                                     width: 100% !important;
                                     flex: 0 0 100%;
                                 }
                                .remove-address {
                                    background-color: #ff4d4d;
                                    color: white;
                                    border: none;
                                    padding: 5px 10px;
                                    cursor: pointer;
                                    border-radius: 4px;
                                }
                                .remove-address:hover {
                                    background-color: #cc0000;
                                }
                                #add-address {
                                    background-color: #4CAF50;
                                    color: white;
                                    border: none;
                                    padding: 8px 12px;
                                    cursor: pointer;
                                    border-radius: 4px;
                                }
                                #add-address:hover {
                                    background-color: #45a049;
                                }
                                button#add-faq, button.remove-faq,button#add-service, button.remove-service ,#add-address,button.remove-address{
                                    padding: 19px;
                                }
                                #services-wrapper,#faq-wrapper {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 10px;
                                    max-width: 600px;
                                    margin: 10px 0 30px;

                                    padding: 20px;
                                    border: 1px solid #ccc;
                                    border-radius: 8px;
                                    background-color: #f9f9f9;
                                }
                                .service-item {
                                    display: grid;
                                    gap: 5px
                                }

                                .service-item .service-item-header {
                                    align-items: center;
                                    gap: 10px;
                                    display: flex;
                                }
                                .service-item input {
                                    flex: 1;
                                    padding: 8px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                }
                                .remove-service,.remove-faq  {
                                    background-color: #ff4d4d;
                                    color: white;
                                    border: none;
                                    padding: 5px 10px;
                                    cursor: pointer;
                                    border-radius: 4px;
                                }
                                .remove-service:hover,.remove-faq:hover {
                                    background-color: #cc0000;
                                }
                                #add-service ,#add-faq{
                                    background-color: #4CAF50;
                                    color: white;
                                    border: none;
                                    padding: 8px 12px;
                                    cursor: pointer;
                                    border-radius: 4px;
                                }
                                #add-service:hover,#add-faq:hover {
                                    background-color: #45a049;
                                }
                            </style>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    document.getElementById("add-faq").addEventListener("click", function () {
                                        let newService = document.createElement("div");
                                        let count = document.getElementById("faq-wrapper").children.length;

                                        newService.classList.add("service-item");
                                        newService.innerHTML = '<div class="service-item-header">' +
                                            `<input type="text" name="faq[${count}][title]" placeholder="عنوان سوال">` +
                                            '<button type="button" class="remove-faq">حذف</button>' +
                                            '</div>' +
                                            `<textarea name="faq[${count}][description]" placeholder="جواب سوال" />`;
                                        document.getElementById("add-faq").before(newService);
                                    });

                                    document.getElementById("faq-wrapper").addEventListener("click", function (e) {
                                        if (e.target.classList.contains("remove-faq")) {
                                            e.target.closest('div.service-item').remove();
                                        }
                                    });
                                });






                            </script>

                        </div>
                    </div>


                    <div class="admin-metabox-item metabox-close open">
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



                </div>

                <div class="col-lg-3">
                    <p>
                        <button class="btn-blue">انتشار</button>
                    </p>
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>وضعیت</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">
                            <select name="status" class="mt-3">
                                <option value="publish" @if(old("status") == "publish" || old("status") != "draft") selected @endif>منتشر شده</option>
                                <option value="draft" @if(old("status") == "draft") selected @endif>پیش نویس</option>
                            </select>

                        </div>
                    </div>

                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>درصد کارمزد</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">

                            <input type="number" name='fee_percent' min="0" max="100" class="mt-3" value="{{ old("fee_percent") }}"
                                   placeholder="درصد را وارد کنید">
                            <span class="font-italic mt-3 mb-4 d-block"></span>
                        </div>
                    </div>


                    <div class="admin-metabox-item metabox-close position-relative ">
                        <div class="category-loading">
                            @includeIf("admin.partials.ajax-loading")
                        </div>
                        <div class="admin-metabox-item-title">
                            <h5>دسته بندی</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item ">
                            <div class="c-ui-input c-ui-input--quick-search mt-4"><input type="text" class="c-ui-input__field c-ui-input__field--cleanable js-filter-input js-cleanable-input " id="cat_search" placeholder="جستجوی نام دسته بندی…"><span class="c-ui-input-cleaner js-input-cleaner"></span></div>
                            <div class="c-box__divider c-box__divider--full"><div></div></div>
                            <ul class="mt-3 category-list" id="cats"
                            @foreach($categories as $category)
                                <li>
                                    <input type="checkbox" name="product_cat[]" value="{{$category->id}}">
                                    <label  for="">{{ $category->name }}</label>
                                </li>
                                @endforeach
                                </ul>
                        </div>
                    </div>


                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>عکس</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                        <div class="col-12 form-item mt-3">
                            <input type="hidden" class="admin-media-frame-input" name="thumbnail">

                            <button class="open-admin-media-frame btn-blue" type="button">عکس سایت</button>
                            <img src="{{ asset(env("IMG_DIR","images")).'/' }}" class="admin-media-frame-img mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @includeIf("admin.partials.media_frame")


        @push("admin-scripts")

            @includeIf("admin.partials.attribute-js")
            @includeIf("admin.partials.variation-js")
            @includeIf("admin.partials.add-category-js",["checkbox_name"=>"product_cat"])

            <script>
                CKEDITOR.replace('contents');
                CKEDITOR.replace('excerpt');
                jQuery("input#cat_search").keyup(function(){
                    var value=this.value;
                    if(value.length == 0){
                        jQuery("#cats li").removeClass("d-none");
                    } else{
                        jQuery("#cats label").each(function (){

                            var textContent=jQuery(this).text();
                            if(!textContent.includes(value)){
                                jQuery(this).parents("#cats li").addClass("d-none");
                            } else{
                                jQuery(this).parents("#cats li").removeClass("d-none");
                            }
                        })
                    }
                })
                CKEDITOR.instances['contents'].setData(`{!! old("contents") !!}`);
                CKEDITOR.config.contentsLangDirection = 'rtl';
                CKEDITOR.instances['excerpt'].setData(`{!! old("excerpt") !!}`)

                jQuery(".variable-items-box").sortable({
                    update: function( event, ui ) {
                        jQuery(".variation_priority").each(function(){
                            var index=jQuery(this).parents(".variable-item").index()
                            jQuery(this).val(index)
                        })
                    }
                })
                /*Sortable.create(document.querySelector(".variable-items-box"), {
                    animation: 150,
                    ghostClass: 'blue-background-class',
                    swapThreshold: 1,
                    invertSwap: true,
                })*/
            </script>
        @endpush

        @push("admin-css")
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
        @endpush

    </x-slot>
</x-admin-panel-layout>
