
<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش محصول : {{ $product->title }}
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">ویرایش محصول : {{ $product->title }}</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_product_list") }}">محصولات</a></li>
                            <li class="breadcrumb-item active">ویرایش محصول : {{ $product->title }}</li>
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
                    <p><input type="text" placeholder="نام محصول" name="title"
                              value="@if(old("title")){{old("title")}}@else{{ $product->title }}@endif"></p>
                    <p>
                        <input type="text" name="slug" class="mt-3"
                               value="@if(old("slug")){{old("slug")}}@else{{ $product->slug }}@endif"
                               placeholder="نامک را وارد کنید">
                    </p>
                    <p class="mt-2">
                        <a href="{{ $product->url }}" class="btn text-white btn-primary">نمایش محصول</a>
                    </p>

                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title">
                            <h5>محتوای محصول</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <p class="col-12 form-item">
                            <textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                        </p>
                    </div>

                    <div class="admin-metabox-item metabox-close open">
                        <div class="admin-metabox-item-title"><h5>مشخصات  محصول</h5>
                            <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                        </div>
                        <div class="col-12 form-item">
                            <div class="admin-order-select-box">
                                <div></div>
                                <div class="admin-select-all-checkbox">

                                    <label>نوع محصول : </label>
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
                                    <li><a data-toggle="tab" href="#vizhegi">ویژگی‌ها</a></li>
                                    <li class="for-variable li-for-variable-tab @if($product->type != "variable") d-none @endif "><a data-toggle="tab" href="#variable">متغیر ها</a></li>
                                    <li class="for-sample @if($product->type == "variable") d-none @endif"><a data-toggle="tab" href="#anbar">انبار</a></li>
                                </ul>


                                <div class="tab-content col-lg-9">
                                    <div id="asli" class="admin-product-list-content-item tab-pane fade in active show " >
                                        <div class="for-sample @if($product->type == "variable") d-none @endif">
                                            <p class="mt-2">
                                                <label style="width: 23%">ارز : </label>
                                                @includeIf("admin.partials.currency", [
                                                                         "value" => $product->currency,
                                                                         "name" => "currency"
                                                                     ])
                                            </p>
                                            <p class="mt-2">
                                                <label style="width: 23%">قیمت اصلی : </label>
                                                <input type="text" class="w-50 admin-input-price" name="price" value="{{  $product->regularPrice  }}">
                                            </p>
                                            <p class="mt-2">
                                                <label style="width: 23%">قیمت فروش فوق‌العاده : </label>
                                                <input type="text" class="w-50 admin-input-price-offer" name="offer_price" value="{{  $product->OriginalOfferPrice  }}">
                                                <span class="d-none btn-danger admin-span-price-offer btn"> قیمت فروش فوق العاده باید کوچک تر از قیمت اصلی باشد </span>
                                            </p>



                                        </div>
                                        <p class="mt-2">
                                            <label style="width: 23%">تعداد خریداران محصول : </label>
                                            <input type="text" class="w-50" name="buyer_count" value="{{  $product->buyer_count  }}">
                                        </p>

                                    </div>
                                    <div id="vizhegi" class="admin-product-list-content-item tab-pane fade in  " >
                                        <div class="vizhegi-select-box mb-3 d-flex align-items-center">
                                            <select class="p-1 vizhegi-select w-50 mb-0">
                                                <option id="vizhegi-new" value="vizhegi-new" selected>افزودن ویژگی جدید</option>
                                                @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}" >{{ $attribute->name }}</option>
                                                @endforeach
                                            </select>
                                            <a href="#" class="btn-blue mr-3 add-vizhegi-btn">افزودن</a>
                                        </div>
                                        <div class="vizhegi-items-box">
                                            @foreach($product->attributes as $productAttribute)

                                                <div class="vizhegi-new-item vizhegi-item mt-4 ">
                                                    <div class="vizhegi-new-item-top text-left">
                                                        <span class="text-danger remove-vizhegi-item">پاک کردن این ویژگی</span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>نام :</label>
                                                            <input type="text" value="{{ $productAttribute->attribute->name }}"  name="attribute_xx[]" readonly>
                                                            <input type="hidden" value="{{ $productAttribute->attribute->id }}"  name="attribute_name[]">

                                                        </div>
                                                        <div class="col-md-9">
                                                            <label> مقدار(ها):</label>

                                                            <select class="attribute-select-box item-${attr_id}" multiple="multiple"  name="attribute_value[{{ $productAttribute->attribute->id }}][]">

                                                                @foreach($productAttribute->attribute->sub_attr as $key=>$attrValue)
                                                                    <option value="{{ $attrValue->name }}" @if(in_array($attrValue->id,$productAttribute->values)) selected @endif >{{ $attrValue->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="attribute-select-all-btn mt-2">
                                                                <button type="button" class="btn-blue ml-2 selectAll">انتخاب همه</button>
                                                            </div>
                                                            <div  class="mt-2">
                                                                <input type="checkbox" name="use_in_product[{{ $productAttribute->attribute->id }}]" @if($productAttribute->use_in_product) checked @endif>
                                                                <label> نمایش در برگه محصول</label>
                                                                <div class="vizhegi-item-checkbox for-variable @if($product->type=="simple") d-none @endif"  >
                                                                    <input type="checkbox" name="use_in_variable[{{ $productAttribute->attribute->id }}]" @if($productAttribute->use_in_variable) checked @endif>
                                                                    <label>استفاده  برای متغیر ها</label>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="vizhegi-bottom text-right mt-4">
                                            <button class="btn-blue btn-save-attribute">
                                                ذخیره ویژگی ها
                                            </button>
                                        </div>
                                    </div>

                                    <div id="variable" class="admin-product-list-content-item tab-pane fade in  " >
                                        <div class="vizhegi-select-box mb-3 d-flex align-items-center @if(count($product->attributes) == 0) d-none @endif">
                                            <select class="p-1 variable-select w-50  mb-0">
                                                <option id="variable_new" value="variable_new" selected>افزودن متغیر  جدید</option>
                                                <option id="make_all_variable" value="make_all_variable">ساخت متغیر از همه ویژگی های موجود</option>
                                            </select>
                                            <a href="#" class="btn-blue mr-2 add-variable-btn">انجام</a>
                                        </div>
                                        <div class="change-variations_price">
                                            <input class="mb-3" type="text"   id="variations_price" placeholder="قیمت متغیر ها">
                                            <input class="mb-3" type="text" id="variations_offer_price" placeholder="قیمت فروش ویژه متغیر ها">
                                        </div>
                                        <div class="variable-items-box">
                                            @if(count($attributes_for_variation) >0)
                                                @php($index=0)

                                                @foreach($productVariations as $productVariation)

                                                    <div class="variable-item">
                                                        <input type="hidden" value="{{ $index }}" name="variation_priority[variation_{{ $productVariation["id"] }}]" class="variation_priority">
                                                        <section class="variable-item-top">
                                                            <div class="variable-item-top-right">

                                                                @foreach($attributes_for_variation as $key=>$attr_for_variable)

                                                                    <div class="variable-item-top-right-select-item">
                                                                        <input type="hidden" value="{{ $productVariation["id"] }}" class="variation_id">

                                                                        <select class="variable-select_{{$key}}" name='attribute_select[variation_{{ $productVariation["id"] }}][{{$attr_for_variable["parent"]["id"] }}]'>

                                                                            <option value="" selected>{{$attr_for_variable["parent"]["name"] }}</option>

                                                                            @foreach($attr_for_variable["values"] as $option)
                                                                                @php($varId=0)
                                                                                @if(isset($productVariation["variations"][$attr_for_variable["parent"]["id"]]))
                                                                                    @php($varId=$productVariation["variations"][$attr_for_variable["parent"]["id"]][0]))
                                                                                @endif

                                                                                @php($optionId=$option["id"] ? $option["id"] : null)

                                                                                <option value="{{ $optionId }}" @if(is_array($varId)) @if($optionId == $varId["id"]) selected @endif @endif>{{ $option["name"] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                @endforeach
                                                            </div>
                                                            <div class="variable-item-top-left">
                                                                <div class="variable-item-top-left-closeBtn">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </div>
                                                                <div class="variable-item-top-left-deleteBtn">
                                                                    <span>حذف</span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <div class="variable-item-content">
                                                            <div class="row">
                                                                <div class="col-md-6 variable-input-box">
                                                                    <input type="hidden" name="variable_id[variation_{{ $productVariation["id"] }}]"  value="{{ $productVariation["id"] }}">
                                                                    <label>قیمت</label>
                                                                    <input type="text" name="variable_price[variation_{{ $productVariation["id"] }}]" placeholder="قیمت را وارد کنید" value="{{$productVariation["price"]}}">
                                                                </div>
                                                                <div class="col-md-6 variable-input-box">
                                                                    <label>قیمت فروش ویژه</label>
                                                                    <input type="text"  name="variable_offer_price[variation_{{ $productVariation["id"] }}]" placeholder="قیمت  فروش ویژه را وارد کنید" value="{{$productVariation["offer_price"]}}">
                                                                </div>
                                                                <div class="col-md-6 variable-input-box ">
                                                                    <label>ارز</label>
                                                                    @includeIf("admin.partials.currency", [
                                                                         "value" => $productVariation["currency"],
                                                                         "name" => "variation_currency[variation_{$productVariation['id']}]"
                                                                     ])

                                                                </div>


                                                                <div class="col-md-6 variable-input-box d-none">
                                                                    <label>وزن (گرم)</label>
                                                                    <input type="text"  name="variable_weight[variation_{{ $productVariation["id"] }}]" placeholder="وزن را وارد کنید" value="{{$productVariation["weight"]}}">
                                                                </div>

                                                                <div class="col-md-6 variable-input-box  d-none">
                                                                    <label>ابعاد (L×W×H) (cm)</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <input type="text"  name="variable_length[variation_{{ $productVariation["id"] }}]" placeholder="طول" value="{{$productVariation["length"]}}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="text"  name="variable_width[variation_{{ $productVariation["id"] }}]" placeholder="عرض" value="{{$productVariation["width"]}}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="text"  name="variable_height[variation_{{ $productVariation["id"] }}]" placeholder="ارتفاع" value="{{$productVariation["height"]}}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="variable-input-box col-12">
                                                                    <p class="d-none">
                                                                        <label for="">شناسه محصول</label>
                                                                        <input type="text" name="variable_sku[variation_{{ $productVariation["id"] }}]" value="{{$productVariation["sku"]}}">
                                                                    </p>
                                                                    <p class="d-none">
                                                                        <input type="checkbox" name="variable_manage_stock[variation_{{ $productVariation["id"] }}]" @if($productVariation["manage_stock"] == "on") checked @endif>
                                                                        <label for="">مدیریت موجودی انبار؟</label>
                                                                    </p>



                                                                    <div class="manage-stock-number">
                                                                        <p>
                                                                            <label for="">تعداد موجود در انبار.</label>
                                                                            <input type="text" name="variable_stock_number[variation_{{ $productVariation["id"] }}]" value="{{$productVariation["stock_number"]}}" >
                                                                        </p>
                                                                        <p class=" d-none">
                                                                            <label for="">آستانه کم‌بودن موجودی انبار.</label>
                                                                            <input type="number" name="variable_low_stock_amount[variation_{{ $productVariation["id"] }}]" value="{{$productVariation["low_stock_amount"]}}">
                                                                        </p>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    @php($index++)
                                                @endforeach


                                            @else
                                                <p class="mt-2 product-no-attrbiute-text">لطفا اول به این محصول ویژگی اضافه کنید بعد متغیرها را بسازید</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="anbar" class="@if($product->type == "variable") d-none @endif for-sample admin-product-list-content-item tab-pane fade in " >
                                        <p>
                                            <input id="stock_manage" type="checkbox" name="manage_stock" @if($product->manageStock) checked @endif>
                                            <label for="stock_manage">مدیریت موجودی انبار؟</label>
                                        </p>
                                        <p>
                                            <label for="">شناسه محصول</label>
                                            <input type="text" name="sku" value="{{ $product->post_meta_where("sku")->meta_value }}">
                                        </p>


                                        <div class="manage-stock-number @unless($product->manageStock) d-none @endif ">
                                            <p>
                                                <label for="">تعداد موجود در انبار.</label>
                                                <input type="number" name="stock_number" value="{{ $product->post_meta_where("stock_number")->meta_value }}" >
                                            </p>
                                            <p>
                                                <label for="">آستانه کم‌بودن موجودی انبار.</label>
                                                <input type="number" name="low_stock_amount" value="{{ $product->post_meta_where("low_stock_amount")->meta_value }}">
                                            </p>
                                        </div>

                                    </div>

                                </div>
                                @includeIf("admin.partials.ajax-loading")
                            </div>
                        </div>
                    </div>
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title">
                            <h5>توضیحات کوتاه محصول</h5>
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
                        <div class="admin-metabox-item-title"><h5>درصد بازاریاب</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                        <div class="col-12 form-item">

                            <input type="number" name='affiliate_percent' min="0" max="100" class="mt-3" value="{{ $product->affiliate_percent }}"
                                   placeholder="درصد را وارد کنید">
                            <span class="font-italic mt-3 mb-4 d-block">چند درصد از قیمت این محصول به بازاریاب تعلق میگیرد؟</span>
                        </div>
                    </div>

                    <div class="admin-metabox-item metabox-close position-relative">
                        <div class="category-loading">
                            @includeIf("admin.partials.ajax-loading")
                        </div>
                        <div class="admin-metabox-item-title">
                            <h5>دسته بندی محصول</h5>
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
                                <a class="btn btn-outline-primary d-inline-block m-3 btn-add-category"
                                   href="#">افزودن دسته بندی تازه</a>

                                <div class="form-add-category d-none">
                                    <input type="hidden" value="product" name="category_post_type">

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

                    <div class="admin-metabox-item metabox-close position-relative ">

                        <div class="admin-metabox-item-title">
                            <h5>برند محصول</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="col-12 form-item ">
                            <ul class="mt-3 category-list">
                                @foreach($brands as $brand)
                                    <li>
                                        <input type="checkbox" name="product_brand[]" @if(in_array($brand->id,$productBrands)){{"checked"}}@endif value="{{$brand->id}}">
                                        <label  for="">{{ $brand->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>عکس محصول</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                        <div class="col-12 form-item mt-3">


                            <button class="open-admin-media-frame btn-blue" type="button">عکس محصول</button>


                            <img class="admin-media-frame-img mt-3"
                                 src="@if($product->media) {{ $product->media->url }} @endif"
                                 style="width: 100%; height: auto;margin-top: 20px;">
                            <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                                   value="@if($product->media) {{ $product->media->id }} @endif">

                        </div>
                    </div>



                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>گالری تصاویر محصول</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                        <div class="col-12 form-item mt-3">

                            <button class="open-admin-media-frame open-admin-media-frame-gallery btn-blue">انتخاب
                                عکس
                            </button>
                            <div class="row mt-3 admin-product-gallery-box">
                                @if($gallery)
                                    @foreach($gallery as $image)

                                        <div class="col-4 mb-2 gallery-item">
                                            <span class="remove-gallery-item btn-danger"><i class="fa fa-times"></i></span>
                                            <img src="{{ asset(store_image_link($image)) }}">
                                            <input type="hidden" name="gallery_image[]" value="{{ $image }}">
                                        </div>

                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        @includeIf("admin.partials.media_frame")
        @push("admin-scripts")
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        @endpush
    </x-slot>
</x-admin-panel-layout>
