@extends(config("theme.theme_mainContent_path"))

@section("title")
ویرایش اطلاعات کاربری
@endsection

@section("content")
        <div class="container">
            <div class="rows">
                <div class="woocommerce"> <div class="my-accountsss row">
                        @includeIf(config("theme.theme_path")."account.sidebar")
                        <div class="col-12 col-lg-9 fl">
                            <div class="woocommerce-MyAccount-content">
                                <div class="page-editForm">


                                    <form class="woocommerce-EditAccountForm edit-account" action="{{ route("user.save") }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4>اطلاعات حساب</h4>


                                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                    <label for="account_first_name">نام&nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="name" id="account_first_name" required autocomplete="given-name" value="{{ $user->name }}">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                    <label for="account_last_name">نام خانوادگی&nbsp;</label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="lastname" id="account_last_name" autocomplete="family-name" value="@if(isset($user_data["lastname"])){{ $user_data["lastname"] }}@endif">
                                                </p>

                                                <div class="clear"></div>
                                                <h4 style="height:26px"></h4>

                                                <div class="clear"></div>

                                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                    <label for="mobile">تلفن همراه</label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="mobile" id="mobile"  value="{{ $user->mobile }}">
                                                </p>

                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="account_email">آدرس ایمیل&nbsp;</label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="email" id="account_email"  autocomplete="email" value="{{ $user->email }}">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="account_code">کد ملی<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--code input-text" name="national_code" id="account_code" value="@if(isset($user_data["national_code"])){{ $user_data["national_code"] }}@endif">

                                                </p>

                                            </div>
                                            <div class="col-lg-6">
                                                <h4 style="height:26px"></h4>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="account_cart"> شماره کارت<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--code input-text" name="cart_number" id="account_cart" value="@if(isset($user_data["cart_number"]))) {{ $user_data["cart_number"] }} @endif">

                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="account_cart"> شماره شبا<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--code input-text" name="shaba_number" id="account_shaba" value="@if(isset($user_data["shaba_number"])) {{ $user_data["shaba_number"] }} @endif">

                                                </p>
                                                <fieldset>
                                                    <legend>تغییر گذرواژه</legend>

                                                    @if($user->password)
                                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                            <label for="password_current">گذرواژه پیشین (در صورتی که قصد تغییر ندارید خالی بگذارید)</label>
                                                            <span class="password-input"><input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password" id="password_current" autocomplete="off"><span class="show-password-input"></span></span>
                                                        </p>
                                                    @endif
                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                        <label for="password_1">گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی بگذارید)</label>
                                                        <span class="password-input"><input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="new_password" id="password_1" autocomplete="off"><span class="show-password-input"></span></span>
                                                    </p>
                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                        <label for="password_2">تکرار گذرواژه جدید</label>
                                                        <span class="password-input"><input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="new_password_confirmation" id="password_2" autocomplete="off"><span class="show-password-input"></span></span>
                                                    </p>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <p>
                                           <button type="submit" class="woocommerce-Button button" name="save_account_details" value="ذخیره تغییرات">ذخیره تغییرات</button>
                                        </p>


                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        @media(min-width:1200px) {
                            .mainarticlecontetngm {
                                height:565px;
                            }
                        }
                        @media(max-width:992px) {
                            .fr,.fl{
                                float:none
                            }
                            .dsdss{display:none !important;}
                        }

                        /*    body >header {display:none;}
                        */


                        .ns-profile-content table.table {
                            background: #fff;
                            -webkit-box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                            box-shadow: 0 12px 12px 0 hsla(0,0%,71%,.1);
                            border: 1px solid #dedede;
                            margin-bottom: 23px;
                            padding-bottom: 43px;
                        }
                        .ns-profile-content table.table .title {
                            display: block;
                            font-size: 13px;
                            line-height: 1.692;
                            letter-spacing: -.3px;
                            margin-bottom: 4px;
                            color: #bababa;
                        }
                        .ns-profile-content table.table .value {
                            font-size: 17px;
                            /* font-size: 1.357rem; */
                            line-height: 1.158;
                            direction: ltr;
                            text-align: right;
                            letter-spacing: -.5px;
                            color: #939393;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                        }
                        .woocommerce-MyAccount-content .btn{


                            color: #1ca2bd !important;
                            padding: 0;
                            line-height: 2;
                            background: transparent;
                            font-weight: 400;    position: relative;

                        }

                        .woocommerce-MyAccount-content .btn::after {
                            left: 0;
                            right: 0;
                            top: 50%;
                            margin-top: .85em;
                            content: "";
                            position: absolute;
                            border-bottom: 1px dashed #1ca2bd;
                        }
                        .c-table-orders__head .c-table-orders__row {
                            border-bottom: none;
                        }
                        .c-table-orders__row {
                            width: 100%;
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: horizontal;
                            -webkit-box-direction: normal;
                            -ms-flex-flow: row nowrap;
                            flex-flow: row nowrap;
                            border-bottom: 1px solid #f2f2f2;
                        }
                        .c-table-orders__head--highlighted .c-table-orders__cell {
                            background-color: #85b3be;
                            border-right-color: #85b3be;
                            border-bottom: none;
                            font-weight: 700;
                            letter-spacing: .2px;
                            font-size: 13px;
                            line-height: 1.692;
                            color: #fff;
                            padding-top: 12px;
                            padding-bottom: 12px;
                            min-height: 45px;
                        }
                        .c-table-orders__cell--id {
                            -ms-flex-preferred-size: 12%;
                            flex-basis: 12%;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                        }
                        .c-table-orders__cell {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: horizontal;
                            -webkit-box-direction: normal;
                            -ms-flex-flow: row nowrap;
                            flex-flow: row nowrap;
                            -webkit-box-flex: 1;
                            -ms-flex-positive: 1;
                            flex-grow: 1;
                            -ms-flex-preferred-size: 0;
                            flex-basis: 0;
                            padding: 15px 10px;
                            min-height: 104px;
                            -webkit-box-align: center;
                            -ms-flex-align: center;
                            align-items: center;
                            border-right: 1px solid #ebebeb;
                            font-size: 15px;
                            line-height: 1.467;
                            letter-spacing: -.5px;
                            color: #7e7e7e;justify-content: center;
                        }
                        .c-table-orders__head .c-table-orders__cell {
                            font-size: 13px !important;
                            line-height: 1.692;
                            font-weight: 700 !important;;
                            letter-spacing: .2px !important;;
                            color: #fff !important;;
                            min-height: 64px !important;
                            border-bottom: 1px solid #f2f2f2 !important;
                        }
                        .c-table-orders__cell:first-child {
                            border-right: none;
                        }

                        .c-table-orders__cell:first-child {
                            border-right: none;
                        }span.show-password-input {
                             display: none;
                         }
                        .c-table-orders__cell--hash {
                            -ms-flex-preferred-size: 6%;
                            flex-basis: 6%;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                        }
                        .c-table-orders__cell {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: horizontal;
                            -webkit-box-direction: normal;
                            -ms-flex-flow: row nowrap;
                            flex-flow: row nowrap;
                            -webkit-box-flex: 1;
                            -ms-flex-positive: 1;
                            flex-grow: 1;
                            -ms-flex-preferred-size: 0;
                            flex-basis: 0;
                            padding: 15px 10px;
                            min-height: 104px;
                            -webkit-box-align: center;
                            -ms-flex-align: center;
                            align-items: center;
                            border-right: 1px solid #ebebeb;
                            font-size: 15px !important;
                            line-height: 1.467;
                            letter-spacing: -.5px;
                            color: #7e7e7e;
                        }.c-table-orders__row {
                             width: 100%;
                             display: -webkit-box;
                             display: -ms-flexbox;
                             display: flex;
                             -webkit-box-orient: horizontal;
                             -webkit-box-direction: normal;
                             -ms-flex-flow: row nowrap;
                             flex-flow: row nowrap;
                             border-bottom: 1px solid #f2f2f2;
                         }.woocommerce .form-my-account-content form span.show-password-input {
                              left: .7em !important;
                              right: auto !important;
                          }.woocommerce .form-my-account-content form .form-row input.input-text {
                               direction: rtl;
                               text-align: right !important;
                           }
                    </style>

                </div>
        </div>
            <script>
                jQuery(document).ready(function (){
                    jQuery("input#password_current").val(null)
                })

            </script>

@endsection
