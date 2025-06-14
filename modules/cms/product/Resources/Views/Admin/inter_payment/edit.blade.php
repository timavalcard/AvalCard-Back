
<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش سایت : {{ $product->title }}
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">ویرایش سایت : {{ $product->title }}</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_product_list",["product_type"=>"buy_product"]) }}">سایت ها</a></li>
                            <li class="breadcrumb-item active">ویرایش سایت : {{ $product->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form action="{{ route("admin_product_edit",["id"=>$product->id]) }}" method="post" class="w-100"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">
                    @csrf <input type="hidden" name="user_id"
                                 value="{{ auth()->id() }}">
                    <input type="hidden" value="{{$product->id}}" name="id">
                    <input type="hidden" value="{{$product->product_type}}" name="product_type">
                    <p><input type="text" placeholder="نام سایت" name="title"
                              value="@if(old("title")){{old("title")}}@else{{ $product->title }}@endif"></p>
                    <p>
                        <input type="text" name="slug" class="mt-3"
                               value="@if(old("slug")){{old("slug")}}@else{{ $product->slug }}@endif"
                               placeholder="نامک را وارد کنید">
                    </p>
                    <p class="mt-2">
                        <a target="_blank" href="{{ $product->url }}" class="btn text-white btn-primary">نمایش در پنل کاربری</a>
                        @if(isset($product->category[0]))
                            <a target="_blank" href="https://avalcard.com/foreign-payment/{{$product->category[0]->slug}}/{{$product->slug}}" class="btn text-white btn-primary mr-2">نمایش در سایت</a>
                        @endif
                    </p>
                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>محتوا</h5>
                            <span class="admin-metabox-item-btn-up">
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
                                        <option value="simple" @if($product->type == "simple" || is_null($product->type)) selected @endif>ساده</option>
                                        <option value="variable" @if($product->type == "variable") selected @endif>متغیر</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">

                                <ul class="admin-product-list-ul  nav-tabs col-md-3 p-0 nav" style="flex-direction: column" data-tabs="tabs">
                                    <li><a data-toggle="tab" href="#asli">مشخصات اصلی</a></li>
                                </ul>


                                <div class="tab-content col-lg-9">
                                    <div id="asli" class="admin-product-list-content-item tab-pane fade in active show " >
                                        <div class="for-sample @if($product->type == "variable") d-none @endif">
                                            <p class="mt-2">
                                                <label style="width: 23%">ارز : </label>
                                                @includeIf("admin.partials.currency", [
                                                                         "value" => $product->currency,
                                                                         "select_by_user"=>true,
                                                                         "name" => "currency"
                                                                     ])
                                            </p>
                                            <p class="mt-2">
                                                <label style="width: 23%">قیمت اصلی : </label>
                                                <input type="text" placeholder="در صورت خالی گزاشتن قیمت توسط کاربر تعیین می شود" class="w-100 admin-input-price" name="price" value="{{  $product->regularPrice  }}">
                                            </p>
                                        </div>
                                        <p>
                                            <input type="text" name="time_to_send" class="mt-3" value="{{ $product->time_to_send }}"
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
                        const existingUserInfo = @json($product->user_info ?? []);

                        window.addEventListener('DOMContentLoaded', () => {
                            existingUserInfo.forEach(info => {
                                addUserInfoInput(info);
                            });
                        });

                        function addUserInfoInput(value = { label: '', type: 'text' }) {
                            const container = document.getElementById('user-info-list');

                            const div = document.createElement('div');
                            div.classList.add('input-group', 'mb-2');
                            div.setAttribute('data-index', userInfoIndex);

                            div.innerHTML = `
            <input type="text" name="user_info[${userInfoIndex}][label]" class="form-control" placeholder="مثلاً: ایمیل یا پسورد" value="${value.label ?? ''}">
            <select name="user_info[${userInfoIndex}][type]" class="form-control ml-2">
                <option value="text" ${value.type === 'text' ? 'selected' : ''}>متن</option>
                <option value="email" ${value.type === 'email' ? 'selected' : ''}>ایمیل</option>
                <option value="password" ${value.type === 'password' ? 'selected' : ''}>پسورد</option>
                <option value="date" ${value.type === 'date' ? 'selected' : ''}>تاریخ</option>
                <option value="time" ${value.type === 'time' ? 'selected' : ''}>ساعت</option>
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
                        .btn {
                            padding: 6px 12px;
                            font-size: 14px;
                            margin-top: 15px;
                        } #user-info-list select{
                              height: 44px;
                              background: #f1f1f1;
                              width: 100%;
                              margin-right: 0 !important;
                              margin-left: 0 !important;
                              margin-top: 11px;
                              font-size: 14px !important;
                              padding: 10px !important;
                              border-radius: 10px !important;
                          }.dropdown-select.wide.form-control.ml-2 {
                               display: none;
                           }
                    </style>




                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title">
                            <h5>نکات قبل از خرید</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <p class="col-12 form-item">
                        <textarea name="excerpt" id="excerpt" cols="30" rows="10">

                        </textarea>
                        </p>
                    </div>


                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>سوالات متداول</h5>
                            <span  class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item">
                            <div id="faq-wrapper">
                                @php($oldFAQ = old('faq',$product->faq))


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
                                                <input type="text" name="faq[{{$index}}][title]" value="{{ $service->title??"" }}" placeholder="عنوان سوال">
                                                <button type="button" class="remove-faq">حذف</button>
                                            </div>
                                            <textarea name="faq[{{$index}}][description]" placeholder="جواب سوال">{{ $service->description??"" }}</textarea>
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
                                       value="@if(old("meta_title")){{old("meta_title")}}@else @if(isset($product->post_meta_array["meta_title"])) {{ $product->post_meta_array["meta_title"] }}@endif  @endif"
                                       placeholder="متا تگ تایتل را وارد کنید">
                            </p>
                            <p class="mt-4">
                                <label>متا تگ دیسکریپشن:</label>

                                <textarea  name="meta_description"
                                           placeholder="متا تگ دیسکریپشن را وارد کنید">@if(old("meta_description")){{old("meta_description")}}@else  @if(isset($product->post_meta_array["meta_description"])) {{ $product->post_meta_array["meta_description"] }}@endif @endif</textarea>
                            </p>
                            <p class="mt-4">
                                <label>ایندکس یا نو ایندکس:</label>
                                <span class="mr-2">ایندکس</span>
                                <input type="radio" name="meta_index"
                                       value="index" @if(isset($product->post_meta_array["meta_index"]) && $product->post_meta_array["meta_index"]=="index" ) checked  @endif>
                                <span class="mr-2">نو ایندکس</span>
                                <input type="radio" name="meta_index"
                                       value="noindex" @if(isset($product->post_meta_array["meta_index"]) && $product->post_meta_array["meta_index"]=="noindex" ) checked  @endif>
                            </p>

                            <p class="mt-4">
                                <label>فالو یا نو فالو:</label>
                                <span class="mr-2">فالو</span>
                                <input type="radio" name="meta_follow"
                                       value="follow" @if(isset($product->post_meta_array["meta_follow"]) && $product->post_meta_array["meta_follow"]=="follow" ) checked  @endif>
                                <span class="mr-2">نو فالو</span>
                                <input type="radio" name="meta_follow"
                                       value="nofollow" @if(isset($product->post_meta_array["meta_follow"]) && $product->post_meta_array["meta_follow"]=="nofollow" ) checked  @endif>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <p>
                        <button class="btn-blue">بروزرسانی</button>
                    </p>
                    <div class="admin-metabox-item">
                        <div class="admin-metabox-item-title"><h5>وضعیت</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">
                            <select name="status" class="mt-3">
                                <option value="publish" @if(old("status") == "publish") selected @elseif($product->status=="publish") selected @endif>منتشر شده</option>
                                <option value="draft" @if(old("status") == "draft") selected @elseif($product->status=="draft") selected @endif>پیش نویس</option>
                            </select>

                        </div>
                    </div>

                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>درصد کارمزد</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">

                            <input type="number" name='fee_percent' min="0" max="100" class="mt-3" value="{{ $product->fee_percent }}"
                                   placeholder="درصد را وارد کنید">
                            <span class="font-italic mt-3 mb-4 d-block"></span>
                        </div>
                    </div>

                    <div class="admin-metabox-item metabox-close position-relative">
                        <div class="category-loading">
                            @includeIf("admin.partials.ajax-loading")
                        </div>
                        <div class="admin-metabox-item-title">
                            <h5>دسته بندی</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item">
                            <div class="c-ui-input c-ui-input--quick-search mt-4"><input type="text" class="c-ui-input__field c-ui-input__field--cleanable js-filter-input js-cleanable-input " id="cat_search" placeholder="جستجوی نام دسته بندی…"><span class="c-ui-input-cleaner js-input-cleaner"></span></div>
                            <div class="c-box__divider c-box__divider--full"><div></div></div>
                            <ul class="mt-3 category-list" id="cats"
                            @foreach($categories as $category)
                                <li>
                                    <input type="checkbox" name="product_cat[]"
                                           value="{{$category->id}}" @if(in_array($category->id,$productCatId)){{"checked"}}@endif>
                                    <label for="">{{ $category->name }}</label>
                                </li>
                                @endforeach
                                </ul>


                        </div>

                    </div>



                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>عکس</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                        <div class="col-12 form-item mt-3">


                            <button class="open-admin-media-frame btn-blue" type="button">عکس سایت</button>


                            <img class="admin-media-frame-img mt-3"
                                 src="@if($product->media) {{ $product->media->url }} @endif"
                                 style="width: 100%; height: auto;margin-top: 20px;">
                            <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                                   value="@if($product->media) {{ $product->media->id }} @endif">

                        </div>
                    </div>

                </div>
            </div>

        </form>
        @includeIf("admin.partials.media_frame")
        @push("admin-scripts")
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            @includeIf("admin.partials.attribute-js")
            @includeIf("admin.partials.variation-js")
            @includeIf("admin.partials.add-category-js",["checkbox_name"=>"product_cat"])

            <script>
                CKEDITOR.replace('contents');
                CKEDITOR.replace('excerpt');
                CKEDITOR.instances['contents'].setData(`{!! $product->content !!}`);
                CKEDITOR.config.contentsLangDirection = 'rtl';
                CKEDITOR.instances['excerpt'].setData(`{!! $product->post_excerpt !!}`)
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
                $(".attribute-select-box").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    //dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
                });
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

                    filter: 'input',
                    preventOnFilter: false,

                })*/

            </script>
        @endpush

        @push("admin-css")
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        @endpush
    </x-slot>
</x-admin-panel-layout>
