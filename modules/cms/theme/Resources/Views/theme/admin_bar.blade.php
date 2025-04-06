@can(CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN)
<style>

   #wpadminbar {
       direction: ltr;
       color: #c3c4c7;
       font-size: 13px;
       font-weight: 400;
       font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
       line-height: 2.46153846;
       height: 32px;
       position: fixed;
       top: 0;
       right: 0;
       width: 100%;
       min-width: 600px;
       z-index: 99999;
       background: #1d2327;
   }#wpadminbar .ab-sub-wrapper, #wpadminbar ul, #wpadminbar ul li {
        background: 0 0;
        clear: none;
        list-style: none;
        margin: 0;
        padding: 0;
        position: relative;
        text-indent: 0;
        z-index: 99999;
    }#wpadminbar ul#wp-admin-bar-root-default>li {
         margin-left: 0;
     }#wpadminbar #wp-admin-bar-my-sites a.ab-item, #wpadminbar #wp-admin-bar-site-name a.ab-item {
          white-space: nowrap;
      }
   #wpadminbar .quicklinks>ul>li>a {
       padding: 0 7px 0 8px;
   }#wpadminbar li {
        float: right;
    }
   #wpadminbar .ab-empty-item, #wpadminbar a.ab-item, #wpadminbar>#wp-toolbar span.ab-label, #wpadminbar>#wp-toolbar span.noticon {
       color: #f0f0f1;
   }html {
        margin-top: 32px;
    }
   #wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
       height: 32px;
       display: block;
       padding: 0 10px;
       margin: 0;
   }
   #wpadminbar a, #wpadminbar a img, #wpadminbar a img:hover, #wpadminbar a:hover {
       border: none;
       text-decoration: none;
       background: 0 0;
       box-shadow: none;
   }
</style>
    <div id="wpadminbar" class="nojq">

    <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="نوار ابزار">
        <ul id="wp-admin-bar-root-default" class="ab-top-menu">
            <li id="wp-admin-bar-site-name" class="menupop">
                <a class="ab-item" aria-haspopup="true" href="{{ route("admin.dashboard") }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    رفتن به پیشخوان
                </a>
            </li>

            @if(Route::currentRouteName()=="home")

                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_edit_page",31) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        ویرایش برگه
                    </a>
                </li>
            @endif

            @if(Route::currentRouteName()=="home")
                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_theme_setting_list") }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        تنظیمات قالب
                    </a>
                </li>
            @endif
            @if(Route::currentRouteName()=="page.index" && isset($page))
                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_edit_page",$page->id) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        ویرایش برگه
                    </a>
                </li>
            @endif
            @if(Route::currentRouteName()=="article.index2" || Route::currentRouteName()=="article.index")
                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_article_edit",$article->id) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        ویرایش مقاله
                    </a>
                </li>
            @endif

            @if(Route::currentRouteName()=="category.index" || Route::currentRouteName()=="category.index2")
                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_edit_category", ["id"=>$category->id,"post_type"=>$category->type]) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        ویرایش دسته بندی
                    </a>
                </li>
            @endif

            @if(Route::currentRouteName()=="product.index" || Route::currentRouteName()=="product.index2")
                <li id="wp-admin-bar-site-name" class="menupop">
                    <a class="ab-item" aria-haspopup="true" href="{{ route("admin_product_edit",$product->id) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                        ویرایش محصول
                    </a>
                </li>
            @endif


            <li id="wp-admin-bar-site-name" class="menupop" style="
    float: left;
    margin-left: 20px;
">
                <form action="{{ route("logout") }}" method="post">
                    @csrf
                    <button type="submit" style="
    text-align: right;
    display: block;
    -webkit-transition: .2s;
    -o-transition: .2s;
    transition: .2s;
    font-size: 14px;
    border-radius: 20px;

    color: #fff;
    border: 0;
    background: transparent;
"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        خروج از حساب</button>
                </form>

            </li>

        </ul>
    </div>

</div>
@endcan
