<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="csrfToken" name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="token" content="{{ csrf_token() }}">
    <title>پنل مدیریت | {{$title ?? ''}}</title>
    {{--    font vazir--}}
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v29.1.0/dist/font-face.css" rel="stylesheet"
          type="text/css"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->

    <script src="https://use.fontawesome.com/943f545643.js"></script>
    {{--    <link rel="stylesheet" href="{{asset('adminPanel/plugins/font-awesome/css/font-awesome.min.css')}}">--}}
<!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminPanel/dist/css/adminlte.min.css?ver=7')}}">
    {{--    ck editor--}}
    {{--    <link rel="stylesheet" href="{{asset('adminPanel/dist/css/adminlte.min.css')}}">--}}
<!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminPanel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('adminPanel/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="/panel/css/style.css?v={{ uniqid() }}">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="/panel/css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="/panel/css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="/panel/css/font.css">
    <link rel="stylesheet" href="{{asset('adminPanel/dist/css/custom-style.css?ver='. time())}}">
    {{--    <link rel="stylesheet" href="{{asset('adminPanel/dist/css/dropzone.min.css')}}">--}}
{{--
    <script src="https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js"></script>
--}}
    <script src="{{asset('adminPanel/plugins/tefdgfh/ckeditor.js')}}"></script>

    @stack("admin-css")

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper admin-main-content">



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image ">
                            <img src="{{ theme_asset("img/user_avatar.png") }}" class=" mr-3" style="width: 65px; height: 65px">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{auth()->user()->name}}
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10">
                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="5" cy="5" r="5" fill="#70cf97"/>
                        </svg>

                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="{{route("admin.dashboard")}}"
                               class="nav-link @if(request()->segment(2) == 'dashboard') active @endif">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <p>
                                    داشبورد
                                </p>
                            </a>
                        </li>

                        @php
                            $currentUrl = url()->current(); // آدرس بدون کوئری
                            $currentQuery = request()->query(); // آرایه‌ی کوئری
                        @endphp

                        @foreach(config("AdminSidebar") as $configItem)
                            @if(
                                !array_key_exists("permission", $configItem) ||
                                (is_array($configItem["permission"]) && auth()->user()->hasAnyPermission($configItem["permission"])) ||
                                (!is_array($configItem["permission"]) && auth()->user()->hasPermissionTo($configItem["permission"])) ||
                                auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN)
                            )
                                @php
                                    $active_li_class = "";
                                    $configLinkUrl = strtok($configItem["link"], '?');
                                    $configLinkQuery = [];
                                    parse_str(parse_url($configItem["link"], PHP_URL_QUERY), $configLinkQuery);

                                    // اول چک والد
                                    if($currentUrl == $configLinkUrl && empty(array_diff_assoc($configLinkQuery, $currentQuery))) {
                                        $active_li_class = "menu-open";
                                    }

                                    // بعد چک بچه‌ها
                                    $childIsActive = false;
                                    if(!empty($configItem["children"])) {
                                        foreach($configItem["children"] as $children) {
                                            $childLinkUrl = strtok($children["link"], '?');
                                            $childLinkQuery = [];
                                            parse_str(parse_url($children["link"], PHP_URL_QUERY), $childLinkQuery);

                                            if($currentUrl == $childLinkUrl && empty(array_diff_assoc($childLinkQuery, $currentQuery))) {
                                                $childIsActive = true;
                                                break;
                                            }
                                        }
                                    }

                                    if($childIsActive) {
                                        $active_li_class = "menu-open";
                                    }
                                @endphp

                                <li class="nav-item has-treeview {{ $active_li_class }}">
                                    <a href="{{ $configItem["link"] }}" class="nav-link {{ $active_li_class ? 'active' : '' }}">

                                        <i class="fa {{  $configItem["icon"] }}"></i>
                                        <p>
                                            {{ $configItem["name"] }}
                                            <i class="right fa fa-angle-left"></i>
                                        </p>

                                        @if($configItem["name"] == "مدیریت تیکت ها" )
                                            @php
                                                $unreadCount = \CMS\Ticket\Models\Ticket::query()->where("status", "در حال بررسی")->count();
                                            @endphp
                                            @if($unreadCount > 0)
                                                <span style="background: #3664ff;
    color: #fff;
    width: 18px;
    height: 18px;
    margin-right: 9px;
    display: inline-block;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 12px;
    text-align: center;
    line-height: 20px;">{{ $unreadCount }}</span>
                                            @endif
                                        @endif
                                        @if($configItem["name"] == "درخواست احراز هویت" )
                                            @php
                                                $unreadCount = CMS\User\Repositories\UserRepository::get_users_meta_equal_to("authorize_status","pending")->count();
                                            @endphp
                                            @if($unreadCount > 0)
                                                <span style="background: #3664ff;
    color: #fff;
    width: 18px;
    height: 18px;
    margin-right: 9px;
    display: inline-block;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 12px;
    text-align: center;
    line-height: 20px;">{{ $unreadCount }}</span>
                                            @endif
                                        @endif
                                    </a>

                                    @if(!empty($configItem["children"]))
                                        <ul class="nav nav-treeview">
                                            @foreach($configItem["children"] as $children)
                                                @php
                                                    $childLinkUrl = strtok($children["link"], '?');
                                                    $childLinkQuery = [];
                                                    parse_str(parse_url($children["link"], PHP_URL_QUERY), $childLinkQuery);

                                                    $childActive = ($currentUrl == $childLinkUrl && empty(array_diff_assoc($childLinkQuery, $currentQuery)));
                                                @endphp
                                                <li class="nav-item">
                                                    <a href="{{ $children["link"] }}" class="nav-link {{ $childActive ? 'children-active' : '' }}">
                                                        <i class="fa fa-circle-o nav-icon"></i>
                                                        <p>{{ $children["name"] }}</p>
                                                    </a>
                                                </li>


                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach


                        <li class="nav-item has-treeview">
                            <a href="{{ route("admin_edit_user", ["id" => auth()->id()]) }}"
                               class="nav-link ">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>
                                    ویرایش پروفایل
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">

                            <form  method="post" action="{{route('logout')}}" id="logoutForm">
                                @csrf
                                <button type="submit" style="background: transparent;border: 0;cursor: pointer;    color: #c2c7d0;" class="nav-link " >
                                    <span class="ml-1" ><i class="fa fa-sign-out"></i></span>

                                    خروج از حساب</button>

                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span
       aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
        @if(session()->get("custom-error"))
            @foreach (session()->get("custom-error") as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span
       aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif


    <!-- Content Header (Page header) -->
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">                        {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>                @endif
                <a href="{{ env("FRONT_URL") }}" class="btn-blue return_home">بازگشت به سایت
                    <i class="fa fa-angle-left"> </i>
                </a>
            {{$main ?? ''}}
        </section>
    </div>
</div>
{{--modal Btn--}}
{{--@include('partials.modalLaravelStatus')--}}
<!-- jQuery -->
{{--loding section ajax--}}
{{--
<div class="loader_ajax d-none"></div>
--}}

</body>

<script src="{{asset('adminPanel/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('adminPanel/dist/js/mamad.js?ver=2')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('adminPanel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adminPanel/plugins/chartjs-old/Chart.js')}}"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script src="/panel/js/js.js?v={{ uniqid() }}"></script>
<script src="{{asset('adminPanel/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminPanel/dist/js/sweetalert2.js')}}"></script>
<script src="{{asset('adminPanel/dist/js/styles.js')}}"></script>
<script src="{{asset('adminPanel/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('adminPanel/dist/js/dropzone.min.js')}}"></script>
{{$linkScript ?? ''}}
<script src="{{asset('adminPanel/dist/js/ajaxAdmin.js?ver=6')}}"></script>

{{--<script src="{{asset('/js/app.js')}}"></script>--}}
@stack("admin-scripts")
<script>
    {{ $script ?? '' }}
    jQuery(document).ajaxStart(function () {
        jQuery('.loader_ajax').toggleClass('d-none')
        jQuery("#btnClose").trigger('click');
    });
    $(document).ajaxComplete(function () {
        jQuery('.loader_ajax').toggleClass('d-none')
    });

    function logout(event) {
        event.preventDefault();
        document.getElementById('logoutForm').submit();
    }
    CKEDITOR.addCss("@font-face{font-family:IRANSans;font-style:normal;font-weight:500;src:url(/fonts/woff/IRANSansWeb_Medium.woff) format('woff')}\n.cke_editable{cursor:text; font-size: 14px; font-family: IranSans, sans-serif;}");

</script>
</html>
