@extends("admin.adminMain.main")
@section("admin_title")

    افزودن خدمت
    @endsection
@section("AdminContent")
    <form action="{{ route("admin_services_add")}}" method="post" class="w-100">
        @csrf

        <div class="row">
            <div class="col-lg-9"><h3>افزودن خدمت</h3>

                <p><input type="text" placeholder="نام خدمت" name="name"
                          value="{{ old("name") }}"></p>

                <p><input type="text" placeholder="نامک" name="slug"
                          value="{{ old("slug") }}">
                    <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی&zwnj;ها (URLs)&zwnj; استفاده می&zwnj;شود. برای نامگذاری فقط از حروف،&zwnj; ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>
                </p>

            </div>
            <div class="col-lg-3">
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>عکس خدمت</h5>                        <span
                            class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>

                    <div class="col-12 form-item mt-3">
                        <input type="hidden" class="admin-media-frame-input" name="thumbnail">

                        <button class="open-admin-media-frame btn-blue" type="button">عکس خدمت</button>
                        <img src="{{ asset(env("IMG_DIR","images")).'/' }}" class="admin-media-frame-img mt-3">
                    </div>
                </div>

            </div>
        </div>
        <p>
            <button class="btn-blue">افزودن</button>
        </p>
    </form>
    @includeIf("admin.partials.media_frame")

@endsection
