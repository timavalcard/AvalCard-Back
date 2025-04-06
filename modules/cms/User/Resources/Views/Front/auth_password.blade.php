@extends(config("theme.theme_mainContent_path"),["header"=>false,"footer"=>false])
@section("meta")
    <meta name="robots" content="noindex,nofollow">
@endsection
@if($affiliate)

    @section('title','همکاری در فروش')
@else
    @section('title','ورود | ثبت نام')
@endif

@section("content")

<body style="">

    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-4 mt-md-0 d-md-block">
                <img class="w-100" data-src="{{ theme_asset("img/login.png") }}" alt="">
            </div>
            <div class="col-md-5 col-12">
                <div class="auth_container ">

                    <div class="mt-3 logoAuth mx-auto d-flex justify-content-center  text-center">

                        <a href="/">

                            {{--<img data-src="{{ theme_asset("img/logo.png") }}" alt="هیدی لیدی">--}}</a>

                    </div>
                    <p class="statusAuth">
                        ورود به هیدی لیدی
                        <span>
              لطفا برای ادامه شماره همراه یا ایمیل خود را وارد نمایید.
            </span>
                    </p>
                    <form class="custom_form " id="authForm">
                        <input type="hidden" id="prevUrl" value="{{ url()->previous() }}">
                        @if($affiliate)
                            <input type="hidden" id="affiliate" value="true">
                        @endif
                        <input type="hidden" id="checkStatusAuth" value="{{route('auth.check_exists_and_status')}}">
                        <input type="hidden" id="sendRegisterCode" value="{{route('auth.register')}}">
                        <input type="hidden" id="sendLoginCode" value="{{route('auth.login_code')}}">
                        <input type="hidden" id="checkRegisterCode" value="{{route('auth.check_code')}}">
                        <input type="hidden" id="checkLoginCode" value="{{route('auth.check_login_code')}}">
                        <input type="hidden" id="checkLogin" value="{{route('auth.login')}}">
                        <input type="hidden" id="sendForgotCode" value="{{route('auth.forgot_password_send')}}">
                        <input type="hidden" id="checkForgotCode" value="{{route('auth.forgot_password_check_code')}}">
                        <div id="auth_mobile_check">
                            <div class="tab">
                                <div class="floating-label ">

                                    <input class="floating-input" type="text" id="mobile_register" name="mobile" placeholder="شماره همراه یا ایمیل خود را وارد کنید" autofocus>
                                </div>
                            </div>

                            <div id="password_container">
                                <div id="tab2">
                                    <div class="floating-label position-relative">

                                        <div class="show-password">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.199" height="16.199" viewBox="0 0 16.199 16.199">
                                                <g id="vuesax_linear_eye" data-name="vuesax/linear/eye" transform="translate(-108 -188)">
                                                    <g id="eye" transform="translate(108 188)">
                                                        <path id="Vector" d="M4.833,2.416A2.416,2.416,0,1,1,2.416,0,2.414,2.414,0,0,1,4.833,2.416Z" transform="translate(5.683 5.683)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-2" data-name="Vector" d="M6.6,11.171a7.436,7.436,0,0,0,6.149-3.834,3.6,3.6,0,0,0,0-3.5A7.436,7.436,0,0,0,6.6,0,7.436,7.436,0,0,0,.456,3.834a3.6,3.6,0,0,0,0,3.5A7.436,7.436,0,0,0,6.6,11.171Z" transform="translate(1.495 2.511)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-3" data-name="Vector" d="M0,0H16.2V16.2H0Z" transform="translate(16.199 16.199) rotate(180)" fill="none" opacity="0"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <input type="password"  class="show-input floating-input" id="password_register" name="password"
                                               placeholder="رمز عبور خود را وارد کنید">

                                    </div>
                                </div>
                                <div id="tab3">
                                    <div class="floating-label">
                                        <div class="auth-input-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.199" height="16.199" viewBox="0 0 16.199 16.199">
                                                <g id="vuesax_linear_unlock" data-name="vuesax/linear/unlock" transform="translate(-236 -252)">
                                                    <g id="unlock" transform="translate(236 252)">
                                                        <path id="Vector" d="M10.125,8.1H3.375C.675,8.1,0,7.425,0,4.725V3.375C0,.675.675,0,3.375,0h6.75c2.7,0,3.375.675,3.375,3.375v1.35C13.5,7.425,12.825,8.1,10.125,8.1Z" transform="translate(1.35 6.75)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-2" data-name="Vector" d="M0,5.4V4.05C0,1.816.675,0,4.05,0,7.087,0,8.1,1.35,8.1,3.375" transform="translate(4.05 1.35)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-3" data-name="Vector" d="M3.375,1.687A1.687,1.687,0,1,1,1.687,0,1.687,1.687,0,0,1,3.375,1.687Z" transform="translate(6.412 9.112)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-4" data-name="Vector" d="M0,0H16.2V16.2H0Z" transform="translate(16.199 16.199) rotate(180)" fill="none" opacity="0"/>
                                                    </g>
                                                </g>
                                            </svg>                                </div>
                                        <input type="password" class="show-input floating-input" name="password_confirmation" id="password_confirmation" placeholder="رمز عبور را دوباره وارد کنید">
                                    </div>
                                </div>
                            </div>
                            <div id="password_container_login" class="mb-2">
                                <!-- <p class="small">
                                پسورد شامل حروف کوچک , بزرگ , عدد و علامت نگارشی و حداقل ۶ رقم باشد
                            </p> -->
                                <div id="tab4">
                                    <div class="floating-label mb-2 position-relative">
                                        <div class="show-password">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.199" height="16.199" viewBox="0 0 16.199 16.199">
                                                <g id="vuesax_linear_eye" data-name="vuesax/linear/eye" transform="translate(-108 -188)">
                                                    <g id="eye" transform="translate(108 188)">
                                                        <path id="Vector" d="M4.833,2.416A2.416,2.416,0,1,1,2.416,0,2.414,2.414,0,0,1,4.833,2.416Z" transform="translate(5.683 5.683)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-2" data-name="Vector" d="M6.6,11.171a7.436,7.436,0,0,0,6.149-3.834,3.6,3.6,0,0,0,0-3.5A7.436,7.436,0,0,0,6.6,0,7.436,7.436,0,0,0,.456,3.834a3.6,3.6,0,0,0,0,3.5A7.436,7.436,0,0,0,6.6,11.171Z" transform="translate(1.495 2.511)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                        <path id="Vector-3" data-name="Vector" d="M0,0H16.2V16.2H0Z" transform="translate(16.199 16.199) rotate(180)" fill="none" opacity="0"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>

                                        <input type="password" class="show-input floating-input" id="password_login" name="password_login"
                                               placeholder="رمز عبور خود را وارد کنید " >
                                    </div>
                                </div>
                                <a href="#" id="forgot_password_request" class="small">
                                    رمز عبور خود را فراموش کرده اید؟
                                </a>
                            </div>
                            <div class="btnsAuth mx-auto  d-flex justify-content-around">
                                <button type="button" class="btnAuth btnprev" id="prevBtnLevel1"><i class="fa fa-arrow-right"></i></button>
                                <button value="lvl1" class="submit btnAuth btnnext" id="nextBtnLevel1">ادامه <i class="fa fa-spinner fa-spin mr-2 fa-fw ajaxBtn" style="display: none"></i></button>
                                <button class="btnAuth d-none" id="login-otc" type="button">ورود با کد یک بار مصرف</button>
                            </div>
                        </div>
                    </form>
                    <form class="custom_form" id="auth_code_registering">

                        <div class="code_container d-flex justify-content-center flex-row-reverse">
                            <div class="floating-label">
                                <input  type="number" class="floating-input code_input ml-2" id="numb1" min="0" max="9" maxLength="1" placeholder="" pattern="[0-9]{1}" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input type="number"  class="floating-input code_input ml-2 not-first" id="numb2" min="0" max="9" maxLength="1" placeholder="" pattern="[0-9]{1}" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input type="number"  class="floating-input code_input ml-2 not-first" id="numb3" min="0" max="9" maxLength="1" placeholder="" pattern="[0-9]{1}" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input  type="number" class="floating-input code_input ml-2 not-first" id="numb4" min="0" max="9" maxLength="1" placeholder="" pattern="[0-9]{1}" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input type="number"  class="floating-input code_input ml-2 not-first" id="numb5" min="0" max="9" maxLength="1" placeholder="" pattern="[0-9]{1}" autocomplete="off">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" value="counter" class="btnAuth time_counter_btn btnprev mx-auto mb-3" id="time_counter_btn">
                                <span id="time_counter">00</span>
                                <span >ثانیه</span>
                            </button>
                        </div>
                        <div class="btnsAuth mx-auto  d-flex justify-content-around">
                            <button type="button" class="btnAuth btnprev" id="check_code_register_back"><i class="fa fa-arrow-right"></i></button>
                            <button  class="submit btnAuth btnnext btn-verify" id="check_code_register">ادامه <i class="fa fa-spinner fa-spin mr-2 fa-fw ajaxBtn" style="display: none"></i></button>
                        </div>
                    </form>

                    <form class="custom_form" id="auth_code_forgot_password">
                        <div class="code_container d-flex justify-content-center flex-row-reverse">
                            <div class="floating-label">
                                <input name="numb1forgot"  class="floating-input code_input-forgot ml-2" id="numb1forgot" min="0" max="9" maxLength="1" placeholder="" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input name="numb2forgot"  class="floating-input code_input-forgot ml-2 not-first-forgot" id="numb2forgot" min="0" max="9" maxLength="1" placeholder="" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input name="numb3forgot"  class="floating-input code_input-forgot ml-2 not-first-forgot" id="numb3forgot" min="0" max="9" maxLength="1" placeholder="" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input name="numb4forgot"  class="floating-input code_input-forgot ml-2 not-first-forgot" id="numb4forgot" min="0" max="9" maxLength="1" placeholder="" autocomplete="off">
                            </div>

                            <div class="floating-label">
                                <input name="numb5forgot"  class="floating-input code_input-forgot ml-2 not-first-forgot" id="numb5forgot" min="0" max="9" maxLength="1" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div id="password_container_forgot">
                            <div id="tab4">
                                <div class="floating-label position-relative">
                                    <div class="show-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.199" height="16.199" viewBox="0 0 16.199 16.199">
                                            <g id="vuesax_linear_eye" data-name="vuesax/linear/eye" transform="translate(-108 -188)">
                                                <g id="eye" transform="translate(108 188)">
                                                    <path id="Vector" d="M4.833,2.416A2.416,2.416,0,1,1,2.416,0,2.414,2.414,0,0,1,4.833,2.416Z" transform="translate(5.683 5.683)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                    <path id="Vector-2" data-name="Vector" d="M6.6,11.171a7.436,7.436,0,0,0,6.149-3.834,3.6,3.6,0,0,0,0-3.5A7.436,7.436,0,0,0,6.6,0,7.436,7.436,0,0,0,.456,3.834a3.6,3.6,0,0,0,0,3.5A7.436,7.436,0,0,0,6.6,11.171Z" transform="translate(1.495 2.511)" fill="none" stroke="#2c3e50" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                    <path id="Vector-3" data-name="Vector" d="M0,0H16.2V16.2H0Z" transform="translate(16.199 16.199) rotate(180)" fill="none" opacity="0"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <input type="password" class="show-input floating-input" id="password_forgot" name="password_forgot"
                                           placeholder="رمز عبور جدید را وارد کنید." autocomplete="off" />
                                </div>
                            </div>
                            <div id="tab5">
                                <div class="floating-label">
                                    <input type="password" class="show-input floating-input" name="password_forgot_confirmation" id="password_forgot_confirmation" placeholder="رمز عبور جدید را دوباره وارد کنید." autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="btnsAuth mx-auto  d-flex justify-content-around">
                            <button type="button" class="btnAuth btnprev" id="check_code_forgot_back"><i class="fa fa-arrow-right"></i></button>
                            <button  class="submit btnAuth btnnext btn-verify-forgot" id="check_code_register">ادامه <i class="fa fa-spinner fa-spin mr-2 fa-fw ajaxBtn" style="display: none"></i></button>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" value="counter" class="btnAuth time_counter_btn btnprev mx-auto mb-3" id="time_counter_btn_forgot">
                                <span id="time_counter_forgot" class="small">00</span>
                                <span class="small" >ارسال مجدد کد تایید</span>
                            </button>
                        </div>
                    </form>
                    <p class="text-caption color-700 mt-3">با ورود به هیدی لیدی

                        <a class="mx-1 d-inline-block color-secondary-700" href="/terms/">شرایط هیدی لیدی</a>

                        و<a class="mx-1 d-inline-block color-secondary-700" href="/privacy/">
                            قوانین حریم خصوصی
                        </a>
                        را می پذیرم.
                    </p>
                </div>
            </div>
        </div>
    </div>



<style>
    .auth_container.col-md-4.mx-auto.mt-5 {
        margin-top: 0 !important;
    }input#mobile_register {
         text-align: left;    font-size: 15px;
         padding-left: 10px;
     }

    .auth_container {
       padding:0 15px;
    }.auth_container p.text-caption {
         font-size: 13px;

         font-weight: normal;
     }

    form#auth_code_registering input::-webkit-outer-spin-button, form#auth_code_registering input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    form#auth_code_registering input {
        appearance: none;
        -webkit-apearance: none;
        -moz-appearance: textfield;
    }input {
         direction: ltr !important;
         text-align: left;
     }

    .auth_container p {
        color: #515151;
        font-weight: bold;
        font-size: small;
        margin-bottom: 20px;
    }
    .logoAuth {
        margin-bottom: 20px;
    }
    .auth_container #authForm #auth_mobile_check p {
        margin-bottom: 0.5rem;
        color: #515151;
    }input#password_login {
         text-align: left;
     }

    .auth_container #authForm #auth_mobile_check #password_container {
        display: none;
        padding-top: 0px;
    }

    .auth_container #authForm #auth_mobile_check #password_container p {
        font-size: small;
    }

    .auth_container #authForm #auth_mobile_check #password_container_login {
        display: none;
    }

    .auth_container #authForm #auth_mobile_check #password_container_login p {
        font-size: small;
    }

    .auth_container #auth_code_registering {
        display: none;
    }

    .auth_container #auth_code_registering .btnsAuth #check_code_register_back {
        display: block !important;
        opacity: 1 !important;
        z-index: 1 !important;
    }

    .auth_container #auth_code_forgot_password {
        display: none;
    }

    .auth_container #auth_code_forgot_password .btnsAuth #check_code_forgot_back {
        display: block !important;
        opacity: 1 !important;
        z-index: 1 !important;
    }

    .auth_container .btnsAuth .btnprev,
    .auth_container .btnsAuth .btnnext {
        outline: none;
        border: none;
        color: white;
        border-radius: 0.4rem;
        padding: 10px;transition:.4s;
        width: 100%;
        background-color:#0068a8;
    }

    .auth_container .btnsAuth .btnprev {
        width: 100%;
        opacity: 0;
        z-index: -1;
    }

    .auth_container .btnsAuth .btnnext {
        z-index: 30000;
    }

    .auth_container .btnsAuth .btnnext:disabled {
        cursor: not-allowed;
    }

    @media only screen and (max-width: 1366px) {
        .auth_container {
            width: 35%;
        }
    }

    @media only screen and (max-width: 768px) {
        .auth_container {
            width:100% !important;
            position: unset !important;
            transform: unset !important;
        }.main-content::before,.main-content::after {
             box-shadow:0px 0px 109px 100px #759352 !important;
         }
        .auth_container #password_container p {
            font-size: xx-small !important;
        }
    }
    .auth_container {
        padding-top: 27px;
        border-radius: 10px;
    }.text-center {
         text-align: center!important;
     }.auth_container .logoAuth img {
          width: 112px;margin: 0 auto;
      }.auth_container p {
           text-align: center;
       }
    .auth_container p {
        color: #515151;
        font-weight: bold;
        font-size: small;
        margin-bottom: 1.4rem
    ;
    }.custom_form .floating-label {
         position: relative;
         margin-bottom: 26px;
         z-index: 1;
     }
    .floating-label {
        position: relative !important;
    }
    .floating-label {
        width: 100%;
        margin: 26px auto;
    }.auth-input-icon {
         position: absolute;
         top: 12px;
         left: 8px;
     }.custom_form .floating-input, .custom_form .floating-select {
                   font-size: 14px;
                   padding: 4px 4px;
                   display: block;
                   width: 100%;
                   background-color: #1f201d0f;
                   border: none;
                   height: 47px;
                   border: 2px solid rgb(140 140 140 / 14%);
                   background: transparent;
                   border-radius: 0.5rem;
                   padding-right: 12px;
                   display: block;
                   margin: 0 auto;
      }

    input#mobile_register {
        text-align: left;
        padding-left: 10px;
    }
    input#mobile_register {
        width: 100%;
        display: block;
        margin: 0 auto;
    }.floating-label input {
         padding-left: 30px !important;padding-right: 30px !important;
     }.auth_container #authForm #auth_mobile_check #password_container {
          display: none;
          padding-top: 0px;
      }.floating-label.position-relative {
           width: 100%;
           margin: 0 auto 26px;
       }.auth_container #authForm #auth_mobile_check #password_container_login {
            display: none;
        }.show-password {
             position: absolute;
             cursor: pointer;
             left: 8px;
             top: 13px;
             font-size: 15px;
         }.custom_form label.main {
              right: 30px;
              font-size: 15px;
          }p.statusAuth span {
               display: block;
               font-size: 13px;
               margin-top: 15px;
               font-weight: normal;
           }
    .custom_form label.main {
        color: #999;
        background-color: transparent;
        font-size: 15px;
        padding-left: 7px;
        padding-right: 7px;
        font-weight: normal;
        position: absolute;
        z-index: 20;
        pointer-events: none;
        left: 32px;
        top: 11px;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
    }a#forgot_password_request {
         text-align: center;
         display: block;
         margin: 20px 0;
     }.btnsAuth.mx-auto.d-flex.justify-content-around {
          justify-content: center !important;
          width: 100%;
          flex-direction: column-reverse;
          align-items: center;
      }.btnsAuth.mx-auto.d-flex.justify-content-around button {
           margin-bottom: 15px;
       }
    .auth_container .btnsAuth .btnprev {
        width: 100%;
        opacity: 0;
        z-index: -1;
    }
    .auth_container .btnsAuth .btnprev, .auth_container .btnsAuth .btnnext {
        outline: none;
        border: none;
        color: #fff;
        border-radius: 13px;
        padding: 15px;
        width: 100%;
        background-color:rgb(54 100 255);
    }.auth_container .btnsAuth .btnprev {
         width: 100%;
         opacity: 0;
         z-index: -1;
     }.auth_container #auth_code_registering {
          display: none;
      }.auth_container #auth_code_forgot_password {
           display: none;
       }.text-center {
            text-align: center!important;
        }.ml-auto, .mx-auto {
             margin-left: auto!important;
         }
    .mr-auto, .mx-auto {
        margin-right: auto!important;
    }label.error.fail-alert {
         margin-top: 6px;
         display: block;
         font-size: 13px;
         color: #e72a2a;
     }.code_container input {
         width: 46px !important;
         height: 47px !important;
         display: flex;
         justify-content: center;
         align-items: center;
         font-size: x-large !important;
         padding-right: 19px
         !important;
         color: #6f6f6f !important;
         -webkit-touch-callout: none;
     }form#auth_code_registering input {
          padding: 0 !important;
          display: flex !important;
          align-items: center;
          justify-content: center;
          text-align: center;
      }.time_counter_btn {
           outline: none;
           border: none;
           color: #42b4e7;
           border-radius: 0.4rem;
           padding: 10px;
           min-width: 20%;
           border: 2px solid #42b4e7;
           transition: all 0.3s;
       }.auth_container .btnsAuth .btnprev:hover, .auth_container .btnsAuth .btnnext:hover {
            background-color: rgb(54 100 255);
            border-color: rgb(54 100 255);
            color: rgb(255, 255, 255);
        }.auth_container {
                                                 border: 2px solid rgb(140 140 140 / 14%);
                                                 border-radius: 24px;
                                                 transform: translateX(93px) translateY(-50%);
                                                 width: 80%;
         }.auth_container {
              background: #fff;
              padding: 0 20px  ;
          }.logoAuth img {


               width: 120px !important;
               height: auto !important;

           }
    .logoAuth {
        text-align: center;
        position: relative;
    }input#mobile_register {
         padding-right: 8px !important;
     }
    input#mobile_register::placeholder {
        text-align: right;
    }button#prevBtnLevel1 {
             background: transparent !important;
             color: #000 !important;
             position: absolute;
             top: 7px;
             right: 25px;
             width: auto !important;
     }input#password_register,input#password_confirmation{
        text-align: left;
               }
    input#password_register::placeholder,input#password_confirmation::placeholder{
        text-align: right;
    }.floating-label {
          margin-bottom: 20px;
      }p.statusAuth {
           text-align: right;
           font-size: 18px;
           font-weight: bold;
       }.auth_container {
             z-index: 999999;
         }.code_container input {
              padding: 0 !important;
              text-align: center;
          }button#check_code_forgot_back,button#check_code_register_back {
               background: transparent !important;
               color: #000 !important;
               position: absolute;
               top: 7px;
               right: 25px;
               width: auto !important;
           }.tata.error {
                background: #000;
                padding-right: 21px;
                /* border: solid 2px #e9546b; */
                border-radius: 10px;
            }.auth_container {
                                                                          position: absolute;
                                                                          top: 50%;
             }a {
                  color: rgb(54 100 255);
              }p.statusAuth {
                   text-align: center;font-weight: 800;
                   font-size: 20px;
               }
               .top-mid{
                   z-index: 999999999999999999999999999;
               }button#login-otc {
                    outline: none;
                    border: none;
                    color: #fff;
                    border-radius: 13px;
                    padding: 15px;
                    width: 100%;
                    background-color: rgb(54 100 255);
                }
</style>
    @push("css")
        <link rel="stylesheet" href="{{ theme_asset("css/tata.css") }}">
    @endpush
    @push("js")
        <script>
            function toEnglishDigits(str) {

                // convert persian digits [۰۱۲۳۴۵۶۷۸۹]
                var e = '۰'.charCodeAt(0);
                str = str.replace(/[۰-۹]/g, function(t) {
                    return t.charCodeAt(0) - e;
                });

                // convert arabic indic digits [٠١٢٣٤٥٦٧٨٩]
                e = '٠'.charCodeAt(0);
                str = str.replace(/[٠-٩]/g, function(t) {
                    return t.charCodeAt(0) - e;
                });
                return str;
            }

            jQuery("input#mobile_register").keyup(function (){
                var value=toEnglishDigits(this.value);
                jQuery(this).val(value)
            })

            jQuery(".show-password").click(function(){
                var type=jQuery("input.show-input").attr("type");
                if(type=="password"){
                    type="text"
                } else{
                    type="password"
                }
                jQuery("input.show-input").attr("type",type)
            })
        </script>
        <script src="{{ theme_asset("js/validation.js") }}"></script>
        <script src="{{ theme_asset("js/tata.js") }}"></script>
        <script>

            // start Auth

            // window.nextLevelAuth = function(event){
            //   console.log(this)
            // }
            //   event.preventDefault()
            var _token = $('meta[name="csrf-token"]').attr('content');


            $.validator.addMethod("email_or_mobile", function(value, element) {
                return /^\d{11,11}$/.test(value) ||   //Indian Mobile No. Lenth 10
                    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(value) //email
            }, "یک ایمیل| تلفن معتبر وارد کنید");




                jQuery.validator.addMethod("password_confirmationFormat", function (value, element) {
                    return value == $('#password_register').val();
                }),

                jQuery.validator.addMethod("password_forgot_confirmationFormat", function (value, element) {
                    return value == $('#password_forgot').val();
                }),

                $("#nextBtnLevel1").click(function (event) {
                    if ($(this).val() == "lvl1") {
                        validateLevel1 = $("#authForm").validate({
                            errorClass: "error fail-alert",
                            validClass: "valid success-alert",
                            rules: {
                                mobile: {
                                    required: true,
                                    email_or_mobile: true
                                },
                            },
                            messages: {
                                mobile: {
                                    required: "فیلد شماره موبایل الزامی است",
                                    email_or_mobile: "ایمیل یا تلفن همراه معتبر نیست"
                                }
                            },
                            submitHandler: function (form) {
                                var mobile_number = $('#mobile_register').val()
                                // درخواست ایجکس که چک کنیم اگر کاربر موبایل رو تایید کرده بود بره برای لاگین اگر نه که برای ثبت نام با توجه به پاسخ ایجکس این فیلد ها نمایش داده میشود
                                var check = null;
                                let checkStatusAuth = $('#checkStatusAuth').val();
                                jQuery.ajax({
                                    type: 'post',
                                    url: checkStatusAuth,
                                    data: {
                                        _token: _token,
                                        mobile: mobile_number
                                    },
                                    success: function (data) {

                                        if(data.message == 'not registered by email'){
                                          tata.error('خطا', "حساب کاربری با مشخصات وارد شده وجود ندارد. لطفا از شماره تلفن همراه برای ساخت حساب کاربری استفاده نمایید.", {
                                                    position: 'tm',
                                                    duration: 8000,closeBtn: false
                                          })
                                        } else{
                                            if (data.message == 'before registered and active account') {
                                                check = false;
                                            } else if (data.message == 'not registered or not active account') {
                                                check = true;
                                            }
                                            if (check) {
                                                // console.log($(form));
                                                $("#password_container").slideDown(300)
                                                $("#prevBtnLevel1").animate({opacity: 1, zIndex: 2}, 300);
                                                $("#mobile_register").attr("disabled", true);
                                                $("#nextBtnLevel1").val("lvl2")

                                                validateLevel1.destroy()

                                                if ($("#nextBtnLevel1").val() == "lvl2") {
                                                    validateLevel2 = $("#authForm").validate({
                                                        errorClass: "error fail-alert",
                                                        validClass: "valid success-alert",
                                                        rules: {
                                                            mobile: {
                                                                required: true,
                                                                minlength: 11,
                                                                maxlength: 11,
                                                                mobileFormat: true,
                                                                number: true
                                                            },
                                                            name: {
                                                                required: true,

                                                            },
                                                            national_code: {
                                                                required: true,

                                                            },
                                                            lastname: {
                                                                required: true,

                                                            },
                                                            yo18:"required",
                                                            password: {
                                                                required: true,
                                                                minlength: 8,

                                                            },

                                                            password_confirmation: {
                                                                required: true,
                                                                password_confirmationFormat: true,
                                                            },
                                                        },
                                                        messages: {
                                                            mobile: {
                                                                required: "فیلد شماره موبایل الزامی است",
                                                                email_or_mobile: "ایمیل یا تلفن همراه معتبر نیست"
                                                            },
                                                            name: {
                                                                required: "فیلد نام  الزامی است",

                                                            },
                                                            lastname: {
                                                                required: "فیلد نام خانوادگی الزامی است",

                                                            },
                                                            national_code: {
                                                                required: "فیلد کد ملی الزامی است",

                                                            },
                                                            yo18:"انتخاب این گزینه الزامی است",
                                                            password: {
                                                                required: "رمز عبور موبایل الزامی است",
                                                                minlength: " حداقل تعداد کارکترها برابر با 8 باشد",
                                                            },
                                                            password_confirmation: {
                                                                required: "تکرار رمز عبور موبایل الزامی است",
                                                                password_confirmationFormat: "پسورد وارد شده با مقدار وارد شده منطبق نیست",
                                                            }
                                                        },
                                                        submitHandler: function (form) {
                                                            // درخواست ایجکس ارسال کد فعالسازی برای ثبت نام و رفتن به صفحه ورود کد
                                                            var mobile_number = $('#mobile_register').val()
                                                            let sendRegisterCode = $('#sendRegisterCode').val()
                                                            let passwordRegister = $('#password_register').val()
                                                            let passwordConfirmation = $('#password_confirmation').val()
                                                            var statusSendCode = null
                                                            var affiliate=false;
                                                            if(jQuery("#affiliate").val()) {
                                                                affiliate=true
                                                            }
                                                            jQuery.ajax({
                                                                type: 'post',
                                                                url: sendRegisterCode,
                                                                data: {
                                                                    _token: _token,
                                                                    mobile: mobile_number,
                                                                    password: passwordRegister,
                                                                    password_confirmation: passwordConfirmation,
                                                                    affiliate:affiliate
                                                                },
                                                                success: function (data) {
                                                                    if (data.status == 'error to send code') {
                                                                        statusSendCode = false;
                                                                        tata.error('خطا', data.message.message, {
                                                                            position: 'tm',
                                                                            duration: 8000,closeBtn: false
                                                                        })
                                                                    } else if (data.status == "send code successfully") {
                                                                        statusSendCode = true;
                                                                    }
                                                                    if (statusSendCode == true) {
                                                                        // console.log($(form));
                                                                        $("#prevBtnLevel1").trigger("click");
                                                                        $("#authForm").hide();
                                                                        $(".statusAuth").text(`کد ارسالی به  ${mobile_number}  را وارد نمایید :`)
                                                                        $("#auth_code_registering").fadeIn();
                                                                        $("#numb1").attr('autofocus');
                                                                        $('.not-first').prop("disabled", true);

                                                                        $('.btn-verify').prop("disabled", true);

                                                                        $('#check_code_register_back').click(function () {
                                                                            $("#authForm").fadeIn();
                                                                            $("#auth_code_registering").hide();
                                                                            $(".code_input").removeClass('border_danger');
                                                                            $(".statusAuth").text("برای ثبت نام یا ورود به حساب کاربری , شماره موبایل خود را وارد کنید ")
                                                                            stopTimer();
                                                                            $(".code_input").each(function () {
                                                                                var element = $(this);
                                                                                element.val(null)
                                                                            });
                                                                        })

                                                                        //set timer code
                                                                        startTimer(60)

                                                                        //code inputs settings
                                                                        $(function () {
                                                                            'use strict';
                                                                            var body = $('body');

                                                                            function goToNextInput(e) {
                                                                                //keycode input value
                                                                                var key = e.which,
                                                                                    t = $(e.target),
                                                                                    //sib == next input
                                                                                    sib = t.parent().next().children();

                                                                                if (key === 8) {
                                                                                    sib = t.parent().prev().children();
                                                                                }

                                                                                if (!sib || !sib.length) {
                                                                                    // sib = body.find('#numb1');
                                                                                    $('.btn-verify').prop("disabled", false);

                                                                                    //check all input filled
                                                                                    let isValid = true;
                                                                                    $(".code_input").each(function () {
                                                                                        var element = $(this);
                                                                                        if (element.val() == "") {
                                                                                            isValid = false;
                                                                                        }
                                                                                    });

                                                                                    if (isValid) {
                                                                                        //بعد از وارد کردن آخرین اینپوت اگر همه اینپوت ها پر شده باشه اتوماتیک درخواست ایجکس چک کردن کد ثبت نام
                                                                                        var mobile_number = $('#mobile_register').val()
                                                                                        let checkRegisterCode = $('#checkRegisterCode').val()
                                                                                        // let prevUrl = $('#prevUrl').val()
                                                                                        let passwordRegister = $('#password_register').val()
                                                                                        let code = $('#numb1').val() + $('#numb2').val() + $('#numb3').val() + $('#numb4').val() + $('#numb5').val();
                                                                                        var checkCodeForRegister = null
                                                                                        jQuery.ajax({
                                                                                            type: 'post',
                                                                                            url: checkRegisterCode,
                                                                                            data: {
                                                                                                _token: _token,
                                                                                                mobile: mobile_number,
                                                                                                code: code,
                                                                                                passwordRegister: passwordRegister,
                                                                                                affiliate:affiliate
                                                                                            },
                                                                                            success: function (data) {
                                                                                                if (data.status == "success") {
                                                                                                    window.location = data.url;
                                                                                                }
                                                                                                if (data.status == 'failed') {
                                                                                                    statusSendCode = false;
                                                                                                    tata.error('خطا', data.message.message, {
                                                                                                        position: 'tm',
                                                                                                        duration: 8000,closeBtn: false
                                                                                                    })
                                                                                                }

                                                                                                if (checkCodeForRegister == true) {
                                                                                                } else {
                                                                                                    $(".code_input").addClass('border_danger')
                                                                                                }
                                                                                            },
                                                                                            error: function (data) {
                                                                                                tata.error('خطا', data.responseJSON.message, {
                                                                                                    position: 'tm',
                                                                                                    duration: 8000,closeBtn: false
                                                                                                })
                                                                                                $(".code_input").addClass('border_danger')
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                }
                                                                                //delete disable attr from input selected
                                                                                sib.select().removeAttr('disabled');
                                                                                sib.select().focus();
                                                                            }

                                                                            function onFocus(e) {
                                                                                $(e.target).select();
                                                                            }

                                                                            body.on('keyup', '.code_input', goToNextInput);
                                                                            body.on('click', '.code_input', onFocus);

                                                                        })
                                                                    }

                                                                },
                                                                error: function (data) {
                                                                    if(typeof data.responseJSON.message === 'object'){
                                                                        tata.error('خطا', data.responseJSON.message.message, {
                                                                            position: 'tm',
                                                                            duration: 8000,closeBtn: false
                                                                        })
                                                                    } else{
                                                                        tata.error('خطا', data.responseJSON.message, {
                                                                            position: 'tm',
                                                                            duration: 8000,closeBtn: false
                                                                        })
                                                                    }
                                                                }
                                                            })
                                                        }
                                                    });
                                                }
                                            }
                                            else {
                                                $("#password_container_login").slideDown(500)
                                                $("#prevBtnLevel1").animate({opacity: 1, zIndex: 2}, 500);
                                                $("#mobile_register").attr("disabled", true);
                                                $("#nextBtnLevel1").val("lvl2_login")

                                                    var mobile_number = $('#mobile_register').val()
                                                    if(/^\d{11,11}$/.test(mobile_number)){
                                                    $("#login-otc").removeClass("d-none")
                                                    $("#login-otc").click(function (){
                                                    //


                                                        let sendLoginCode = $('#sendLoginCode').val()
                                                        var statusSendCode = null
                                                        var affiliate=false;
                                                        if(jQuery("#affiliate").val()) {
                                                            affiliate=true
                                                        }
                                                        jQuery.ajax({
                                                            type: 'post',
                                                            url: sendLoginCode,
                                                            data: {
                                                                _token: _token,
                                                                mobile: mobile_number,
                                                                affiliate:affiliate
                                                            },
                                                            success: function (data) {
                                                                if (data.status == 'error to send code') {
                                                                    statusSendCode = false;
                                                                    tata.error('خطا', data.message.message, {
                                                                        position: 'tm',
                                                                        duration: 8000,closeBtn: false
                                                                    })
                                                                } else if (data.status == "send code successfully") {
                                                                    statusSendCode = true;
                                                                }
                                                                if (statusSendCode == true) {
                                                                    // console.log($(form));
                                                                    $("#prevBtnLevel1").trigger("click");
                                                                    $("#authForm").hide();
                                                                    $(".statusAuth").text(`کد ارسالی به  ${mobile_number}  را وارد نمایید :`)
                                                                    $("#auth_code_registering").fadeIn();
                                                                    $("#numb1").attr('autofocus');
                                                                    $('.not-first').prop("disabled", true);

                                                                    $('.btn-verify').prop("disabled", true);

                                                                    $('#check_code_register_back').click(function () {
                                                                        $("#authForm").fadeIn();
                                                                        $("#auth_code_registering").hide();
                                                                        $(".code_input").removeClass('border_danger');
                                                                        $(".statusAuth").text("برای ثبت نام یا ورود به حساب کاربری , شماره موبایل خود را وارد کنید ")
                                                                        stopTimer();
                                                                        $(".code_input").each(function () {
                                                                            var element = $(this);
                                                                            element.val(null)
                                                                        });
                                                                    })

                                                                    //set timer code
                                                                    startTimer(60)

                                                                    //code inputs settings
                                                                    $(function () {
                                                                        'use strict';
                                                                        var body = $('body');

                                                                        function goToNextInput(e) {
                                                                            //keycode input value
                                                                            var key = e.which,
                                                                                t = $(e.target),
                                                                                //sib == next input
                                                                                sib = t.parent().next().children();

                                                                            if (key === 8) {
                                                                                sib = t.parent().prev().children();
                                                                            }

                                                                            if (!sib || !sib.length) {
                                                                                // sib = body.find('#numb1');
                                                                                $('.btn-verify').prop("disabled", false);

                                                                                //check all input filled
                                                                                let isValid = true;
                                                                                $(".code_input").each(function () {
                                                                                    var element = $(this);
                                                                                    if (element.val() == "") {
                                                                                        isValid = false;
                                                                                    }
                                                                                });

                                                                                if (isValid) {
                                                                                    var mobile_number = $('#mobile_register').val()
                                                                                    let checkLoginCode = $('#checkLoginCode').val()
                                                                                    // let prevUrl = $('#prevUrl').val()
                                                                                    let passwordRegister = $('#password_register').val()
                                                                                    let code = $('#numb1').val() + $('#numb2').val() + $('#numb3').val() + $('#numb4').val() + $('#numb5').val();
                                                                                    var checkCodeForRegister = null
                                                                                    jQuery.ajax({
                                                                                        type: 'post',
                                                                                        url: checkLoginCode,
                                                                                        data: {
                                                                                            _token: _token,
                                                                                            mobile: mobile_number,
                                                                                            code: code,
                                                                                            passwordRegister: passwordRegister,
                                                                                            affiliate:affiliate
                                                                                        },
                                                                                        success: function (data) {
                                                                                            if (data.status == "success") {
                                                                                                window.location = data.url;
                                                                                            }
                                                                                            if (data.status == 'failed') {
                                                                                                statusSendCode = false;
                                                                                                tata.error('خطا', data.message.message, {
                                                                                                    position: 'tm',
                                                                                                    duration: 8000,closeBtn: false
                                                                                                })
                                                                                            }

                                                                                            if (checkCodeForRegister == true) {
                                                                                            } else {
                                                                                                $(".code_input").addClass('border_danger')
                                                                                            }
                                                                                        },
                                                                                        error: function (data) {
                                                                                            tata.error('خطا', data.responseJSON.message, {
                                                                                                position: 'tm',
                                                                                                duration: 8000,closeBtn: false
                                                                                            })
                                                                                            $(".code_input").addClass('border_danger')
                                                                                        }
                                                                                    })
                                                                                }
                                                                            }
                                                                            //delete disable attr from input selected
                                                                            sib.select().removeAttr('disabled');
                                                                            sib.select().focus();
                                                                        }

                                                                        function onFocus(e) {
                                                                            $(e.target).select();
                                                                        }

                                                                        body.on('keyup', '.code_input', goToNextInput);
                                                                        body.on('click', '.code_input', onFocus);

                                                                    })
                                                                }

                                                            },
                                                            error: function (data) {
                                                                if(typeof data.responseJSON.message === 'object'){
                                                                    tata.error('خطا', data.responseJSON.message.message, {
                                                                        position: 'tm',
                                                                        duration: 8000,closeBtn: false
                                                                    })
                                                                } else{
                                                                    tata.error('خطا', data.responseJSON.message, {
                                                                        position: 'tm',
                                                                        duration: 8000,closeBtn: false
                                                                    })
                                                                }
                                                            }
                                                        })


                                                })
                                               } else{
                                                        $("#login-otc").addClass("d-none")
                                                    }


                                                validateLevel1.destroy()
                                                if ($("#nextBtnLevel1").val() == "lvl2_login") {
                                                    validateLevel2_login = $("#authForm").validate({
                                                        errorClass: "error fail-alert",
                                                        validClass: "valid success-alert",
                                                        rules: {
                                                            mobile: {
                                                                required: true,
                                                                minlength: 11,
                                                                maxlength: 11,
                                                                mobileFormat: true,
                                                                number: true
                                                            },
                                                            password_login: {
                                                                required: true,
                                                                minlength: 5,
                                                            },
                                                        },
                                                        messages: {
                                                            mobile: {
                                                                required: "فیلد شماره موبایل الزامی است",
                                                                email_or_mobile: "ایمیل یا تلفن همراه معتبر نیست"
                                                            },
                                                            password_login: {
                                                                required: "رمز عبور  الزامی است",
                                                                minlength: " حداقل تعداد کارکترها برابر با 5 باشد",
                                                            },
                                                        },
                                                        // درخواست ایجکس اگر رمز و موبایل درست بود لاگین بشه
                                                        submitHandler: function (form) {
                                                            event.preventDefault();
                                                            var mobile_number = $('#mobile_register').val()
                                                            let password_login = $('#password_login').val()
                                                            let checkLogin = $('#checkLogin').val()
                                                            var affiliate=false;
                                                            if(jQuery("#affiliate").val()) {
                                                                affiliate=true
                                                            }
                                                            var statusLogin = null
                                                            jQuery.ajax({
                                                                type: 'post',
                                                                url: checkLogin,
                                                                data: {
                                                                    _token: _token,
                                                                    mobile: mobile_number,
                                                                    password: password_login,
                                                                    affiliate:affiliate
                                                                },
                                                                success: function (data) {
                                                                    if (data.status == 'success') {
                                                                        statusLogin = true;
                                                                        if ($('#authForm').hasClass('AuthOrderSection')) {
                                                                            setAddressUser(data.address);
                                                                        } else {
                                                                            window.location.href = data.url;
                                                                        }
                                                                    } else if (data.status == "failed") {
                                                                        statusLogin = false;
                                                                        tata.error('خطا', data.responseJSON.message, {
                                                                            position: 'tm',
                                                                            duration: 8000,closeBtn: false
                                                                        })
                                                                    }
                                                                },
                                                                error: function (data) {
                                                                    tata.error('خطا', data.responseJSON.message, {
                                                                        position: 'tm',
                                                                        duration: 8000,closeBtn: false
                                                                    })
                                                                }
                                                            })
                                                        }
                                                    });
                                                }
                                            }
                                        }


                                    },
                                    error: function (data) {
                                        tata.error('خطا', 'لطفا چند دقیقه بعد مجددا امتحان کنید !', {
                                            position: 'tm',
                                            duration: 8000,closeBtn: false
                                        })
                                    }
                                });
                            }
                        });
                    }
                })

            //forgot password request
            $("#forgot_password_request").click(function (event) {
                event.preventDefault();
                //درخواست کد فراموشی رمز
                var mobile_number = $('#mobile_register').val()
                let sendForgotCode = $('#sendForgotCode').val()
                var statusLogin = null
                jQuery.ajax({
                    type: 'post',
                    url: sendForgotCode,
                    data: {
                        _token: _token,
                        mobile: mobile_number,
                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            statusLogin = true;
                            //ajax send code for forgot password
                            $("#prevBtnLevel1").trigger("click");
                            $("#authForm").hide();
                            $(".statusAuth").text(`کد ارسالی به  ${mobile_number}  را وارد نمایید :`)
                            $("#auth_code_forgot_password").fadeIn();
                            jQuery("form#auth_code_forgot_password .code_input-forgot").val("")
                            $("#numb1forgot").focus();

                            // $('.not-first-forgot').prop("disabled", true);

                            $('#check_code_forgot_back').click(function () {
                                $("#authForm").fadeIn();
                                $("#auth_code_forgot_password").hide();
                                // $(".code_input").removeClass('border_danger');
                                $(".statusAuth").text("برای ثبت نام یا ورود به حساب کاربری , شماره موبایل خود را وارد کنید ")
                                stopTimer_forgot();
                                $(".code_input-forgot").each(function () {
                                    var element = $(this);
                                    element.val(null)
                                });
                            })


                            //set timer code
                            startTimerForgot(60)

                            //code inputs settings

                            $(function () {
                                'use strict';
                                var body = $('body');

                                function goToNextInput(e) {
                                    //keycode input value
                                    var key = e.which,
                                        t = $(e.target),
                                        //sib == next input
                                        sib = t.parent().next().children();

                                    if (key === 9) {
                                        return true;
                                    }

                                    if (!sib || !sib.length) {
                                        // sib = body.find('#numb1');
                                        // $('.btn-verify').prop("disabled", false);
                                        $('#password_forgot').focus()
                                    }
                                    //delete disable attr from input selected
                                    sib.select().removeAttr('disabled');
                                    sib.select().focus();
                                }

                                function onFocus(e) {
                                    $(e.target).select();
                                }

                                body.on('keyup', '.code_input-forgot', goToNextInput);
                                body.on('click', '.code_input-forgot', onFocus);

                            })

                            validateForgotPassword = $("#auth_code_forgot_password").validate({
                                errorClass: "error fail-alert",
                                validClass: "valid success-alert",
                                rules: {
                                    numb1forgot: {
                                        required: true,
                                        number: true
                                    },
                                    numb2forgot: {
                                        required: true,
                                        number: true
                                    },
                                    numb3forgot: {
                                        required: true,
                                        number: true
                                    },
                                    numb4forgot: {
                                        required: true,
                                        number: true
                                    },
                                    numb5forgot: {
                                        required: true,
                                        number: true
                                    },
                                    password_forgot: {
                                        required: true,
                                        minlength: 8,
                                     },
                                    password_forgot_confirmation: {
                                        required: true,
                                        password_forgot_confirmationFormat: true,
                                    },
                                },
                                messages: {
                                    numb1forgot: {
                                        required: "",
                                        number: "",
                                        max: "",
                                        min: ""
                                    },
                                    numb2forgot: {
                                        required: "",
                                        number: "",
                                        max: "",
                                        min: ""
                                    },
                                    numb3forgot: {
                                        required: "",
                                        number: "",
                                        max: "",
                                        min: ""
                                    },
                                    numb4forgot: {
                                        required: "",
                                        number: "",
                                        max: "",
                                        min: ""
                                    },
                                    numb5forgot: {
                                        required: "",
                                        number: "",
                                        max: "",
                                        min: ""
                                    },
                                    password_forgot: {
                                        required: "رمز عبور موبایل الزامی است",
                                        minlength: " حداقل تعداد کارکترها برابر با 5 باشد",
                                        },
                                    password_forgot_confirmation: {
                                        required: "تکرار رمز عبور موبایل الزامی است",
                                        password_forgot_confirmationFormat: "تکرار رمز عبور با رمز وارد شده منطبق نیست",
                                    }
                                },

                                submitHandler: function (form) {
                                    // درخواست ایجکس چک کردن کد فراموشی رمز عبور همراه چک کردن رمز عبور جدید اگه درست بود ریدایرکت و لاگین
                                    event.preventDefault();
                                    var mobile_number = $('#mobile_register').val()
                                    let checkForgotCode = $('#checkForgotCode').val()
                                    let passwordForgot = $('#password_forgot').val()
                                    let passwordForgotConfirm = $('#password_forgot_confirmation').val()
                                    let code = $('#numb1forgot').val() + $('#numb2forgot').val() + $('#numb3forgot').val() + $('#numb4forgot').val() + $('#numb5forgot').val();
                                    // var checkedForgot = null
                                    jQuery.ajax({
                                        type: 'post',
                                        url: checkForgotCode,
                                        data: {
                                            _token: _token,
                                            mobile: mobile_number,
                                            code: code,
                                            password: passwordForgot,
                                            password_confirmation: passwordForgotConfirm
                                        },
                                        success: function (data) {
                                            if (data.status == 'success') {
                                                if ($('#authForm').hasClass('AuthOrderSection')) {
                                                    setAddressUser(data.address);
                                                } else {
                                                    window.location.href = data.url;
                                                }
                                            }
                                            if (data.status == 'failed') {
                                                tata.error('خطا', data.responseJSON.message, {
                                                    position: 'tm',
                                                    duration: 8000,closeBtn: false
                                                })
                                            }
                                        },
                                        error: function (data) {
                                            tata.error('خطا', data.responseJSON.message, {
                                                position: 'tm',
                                                duration: 8000,closeBtn: false
                                            })
                                        }
                                    })
                                }
                            })
                            jQuery("input#numb5forgot").val(null)
                        } else if (data.status == "failed") {
                            statusLogin = false;
                            tata.error('خطا', data.message.message, {
                                position: 'tm',
                                duration: 8000,closeBtn: false
                            })
                        }
                    },
                    error: function (data) {
                        tata.error('خطا', data.responseJSON.message, {
                            position: 'tm',
                            duration: 8000,closeBtn: false
                        })
                    }
                })
            })


            // timer send code register
            function startTimer(secends = 60) {
                var btn_counter = $("#time_counter_btn")
                var time_counter = $('#time_counter')

                btn_counter.attr('disabled', true)
                time_counter.text(secends)

                var timer = setInterval(function () {
                    --secends
                    time_counter.text(secends)

                    if (secends <= 0) {
                        clearInterval(timer);
                        btn_counter.attr('value', 'ajax_send_code_again')
                        btn_counter.html('ارسال مجدد')
                        btn_counter.attr('disabled', false)
                    }

                }, 1000)

            }

            function stopTimer() {
                var btn_counter = $("#time_counter_btn")
                btn_counter.attr('value', 'counter')
                btn_counter.html("<span id='time_counter'>00</span><span> ثانیه </span>")
                // if(timer){
                //   clearInterval(timer);
                // }
            }

            $("#time_counter_btn").click(function () {
                var btn_counter = $("#time_counter_btn")

                if (btn_counter.attr('value') == 'ajax_send_code_again') {

                    // ارسال مجدد کد فعالسازی ثبت نام
                    var mobile_number = $('#mobile_register').val()
                    let sendRegisterCode = $('#sendRegisterCode').val()
                    let passwordRegister = $('#password_register').val()
                    let passwordConfirmation = $('#password_confirmation').val()
                    var statusSendCode = null
                    jQuery.ajax({
                        type: 'post',
                        url: sendRegisterCode,
                        data: {
                            _token: _token,
                            mobile: mobile_number,
                            password: passwordRegister,
                            password_confirmation: passwordConfirmation
                        },
                        success: function (data) {
                            if (data.status == 'error to send code') {
                                statusSendCode = false;
                                tata.error('error', data.message.message, {
                                    position: 'tm',
                                    duration: 8000,closeBtn: false
                                })
                            } else if (data.status == "send code successfully") {
                                statusSendCode = true;
                            }
                            if (statusSendCode == true) {
                                btn_counter.attr('value', 'counter')
                                btn_counter.html("<span id='time_counter'>00</span><span> ثانیه </span>")
                                startTimer(60)
                            }
                        },
                        error: function (data) {
                            tata.error('error', data.responseJSON.message.message, {
                                position: 'tm',
                                duration: 8000,closeBtn: false
                            })
                        }
                    })


                }

            })

            $('#check_code_register').click(function (event) {
                event.preventDefault();
                var mobile_number = $('#mobile_register').val()
                let checkRegisterCode = $('#checkRegisterCode').val()
                let code = $('#numb1').val() + $('#numb2').val() + $('#numb3').val() + $('#numb4').val() + $('#numb5').val();
                var checkCodeForRegister = null
                jQuery.ajax({
                    type: 'post',
                    url: checkRegisterCode,
                    data: {
                        _token: _token,
                        mobile: mobile_number,
                        code: code,
                    },
                    success: function (data) {
                        if (data.status == 'failed') {
                            statusSendCode = false;
                            tata.error('error', data.message.message, {
                                position: 'tm',
                                duration: 8000,closeBtn: false
                            })
                        } else if (data.status == "success") {
                            statusSendCode = true;
                            if ($('#authForm').hasClass('AuthOrderSection')) {
                                setAddressUser(data.address);
                            } else {
                                window.location.href = data.url;
                            }

                        }

                        if (checkCodeForRegister == true) {
                        } else {
                            $(".code_input").addClass('border_danger')
                        }
                    },
                    error: function (data) {
                        tata.error('error', data.responseJSON.message, {
                            position: 'tm',
                            duration: 8000,closeBtn: false
                        })
                        $(".code_input").addClass('border_danger')
                    }
                })
            })

            // timer send code forgot password
            function startTimerForgot(secends = 60) {
                var btn_counter_forgot = $("#time_counter_btn_forgot")
                var time_counter_forgot = $('#time_counter_forgot')

                btn_counter_forgot.attr('disabled', true)
                time_counter_forgot.text(secends)

                var timer_forgot = setInterval(function () {
                    --secends
                    time_counter_forgot.text(secends)

                    if (secends <= 0) {
                        clearInterval(timer_forgot);
                        btn_counter_forgot.attr('value', 'ajax_send_code_again_forgot_password')
                        btn_counter_forgot.html('ارسال مجدد کد')
                        btn_counter_forgot.attr('disabled', false)
                    }

                }, 1000)

            }

            function stopTimer_forgot() {
                var btn_counter_forgot = $("#time_counter_btn_forgot")
                btn_counter_forgot.attr('value', 'counter')
                btn_counter_forgot.html("<span id='time_counter_forgot'>00</span><span> ثانیه </span>")
                // if(timer_forgot){
                //   clearInterval(timer_forgot);
                // }
            }

            $("#time_counter_btn_forgot").click(function (event) {
                event.preventDefault();

                var btn_counter_forgot = $("#time_counter_btn_forgot")

                if (btn_counter_forgot.attr('value') == 'ajax_send_code_again_forgot_password') {

                    var mobile_number = $('#mobile_register').val()
                    let sendForgotCode = $('#sendForgotCode').val()
                    var statusLogin = null
                    jQuery.ajax({
                        type: 'post',
                        url: sendForgotCode,
                        data: {
                            _token: _token,
                            mobile: mobile_number,
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                statusLogin = true;
                                btn_counter_forgot.attr('value', 'counter')
                                btn_counter_forgot.html("<span id='time_counter_forgot'>00</span><span> ثانیه </span>")
                                startTimerForgot(60)
                            }
                            if (data.status == 'failed') {
                                tata.error('error', data.message.message, {
                                    position: 'tm',
                                    duration: 8000,closeBtn: false,
                                })
                            }
                        },
                        error: function (data) {
                            tata.error('error', data.message.message, {
                                position: 'tm',
                                duration: 8000,closeBtn: false,
                            })
                        }
                    })
                }

            })


            // edit mobile number
            $("#prevBtnLevel1").click(function (event) {
                jQuery("button#login-otc").addClass("d-none")
                if ($("#password_container").css("display") == "block") {
                    $("#password_container").slideUp(500)
                    $("#prevBtnLevel1").animate({opacity: 0, zIndex: -1}, 500);
                    $("#mobile_register").attr("disabled", false);
                    $("#nextBtnLevel1").val("lvl1")
                    validateLevel2.destroy()
                } else if ($("#password_container_login").css("display") == "block") {
                    $("#password_container_login").slideUp(500)
                    $("#prevBtnLevel1").animate({opacity: 0, zIndex: -1}, 500);
                    $("#mobile_register").attr("disabled", false);
                    $("#nextBtnLevel1").val("lvl1")
                    validateLevel2_login.destroy()
                }

            });


            //end Auth


        </script>
    @endpush

@endsection
