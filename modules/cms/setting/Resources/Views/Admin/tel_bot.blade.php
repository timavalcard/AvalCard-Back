
    <x-admin-panel-layout>
        <x-slot name="title">
            تنظیمات ربات تلگرامی

        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark"> تنظیمات ربات تلگرامی</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">
                                    تنظیمات ربات تلگرامی
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <div class="col-lg-9">

        <form action="{{ route("admin_save_tel_bot_setting") }}" method="post">
            @csrf
            <div class="mb-4 mt-4">
                <p class="mt-4">
                    <label>توکن ادمین</label>
                 <input type="text" value="@if(isset($data["tel_admin_token"])){{$data["tel_admin_token"]}}@endif" name="token">
                </p>

                <div class="mt-4">
                    <label class="ml-3 mb-0">ورودی فرم:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_form_send"]) || $data["tel_form_send"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_form_send" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_form_send"]) && $data["tel_form_send"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_form_send" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>

                <div class="mt-4">
                    <label class="ml-3 mb-0">مقاله جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_article_add"]) || $data["tel_article_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_article_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_article_add"]) && $data["tel_article_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_article_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>

                <div class="mt-4">
                    <label class="ml-3 mb-0">ویرایش مقاله:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_article_edit"]) || $data["tel_article_edit"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_article_edit" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_article_edit"]) && $data["tel_article_edit"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_article_edit" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>


                <div class="mt-4">
                    <label class="ml-3 mb-0">حذف مقاله:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_article_delete"]) || $data["tel_article_delete"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_article_delete" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_article_delete"]) && $data["tel_article_delete"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_article_delete" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>


                <div class="mt-4">
                    <label class="ml-3 mb-0">محصول جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_product_add"]) || $data["tel_product_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_product_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_product_add"]) && $data["tel_product_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_product_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>

                <div class="mt-4">
                    <label class="ml-3 mb-0">ویرایش محصول:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_product_edit"]) || $data["tel_product_edit"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_product_edit" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_product_edit"]) && $data["tel_product_edit"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_product_edit" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>


                <div class="mt-4">
                    <label class="ml-3 mb-0">حذف محصول:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_product_delete"]) || $data["tel_product_delete"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_product_delete" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_product_delete"]) && $data["tel_product_delete"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_product_delete" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>


                <div class="mt-4">
                    <label class="ml-3 mb-0">نظر جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_comment_add"]) || $data["tel_comment_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_comment_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_comment_add"]) && $data["tel_comment_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_comment_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>

                <div class="mt-4">
                    <label class="ml-3 mb-0">سفارش جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_order_add"]) || $data["tel_order_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_order_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_order_add"]) && $data["tel_order_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_order_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>

                <div class="mt-4">
                    <label class="ml-3 mb-0">کاربر جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_user_add"]) || $data["tel_user_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_user_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_user_add"]) && $data["tel_user_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_user_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>
                <div class="mt-4">
                    <label class="ml-3 mb-0">تیکت جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_ticket_add"]) || $data["tel_ticket_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_ticket_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_ticket_add"]) && $data["tel_ticket_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_ticket_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>
                <div class="mt-4">
                    <label class="ml-3 mb-0">احراز هویت جدید:</label>
                    <span  class="d-inline-flex align-items-center ml-2">
                        بله
                        <input @if(!isset($data["tel_authorize_add"]) || $data["tel_authorize_add"] == "yes"){{ "checked" }}@endif type="radio" value="yes" name="tel_authorize_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                    <span class="d-inline-flex align-items-center">
                        خیر
                        <input @if(isset($data["tel_authorize_add"]) && $data["tel_authorize_add"] == "no"){{ "checked" }}@endif type="radio" value="no" name="tel_authorize_add" style="
    height: 26px;
    width: 23px;
    margin-right: 10px;
    display: inline-block;
">
                    </span>
                </div>
                <p class="mt-4">
                <button type="submit" class="btn-blue">ذخیره</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
    </x-admin-panel-layout>
