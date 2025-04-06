@extends("admin.adminMain.main")
@section("admin_title")

ویرایش خدمت {{ $service->name }}
    @endsection
@section("AdminContent")
    <form action="{{ route("admin_service_edit",["id"=>$service->id])}}" method="post" class="w-100">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-lg-9"><h3>ویرایش خدمت {{ $service->name }}
                </h3>

                <p><input type="text" placeholder="نام خدمت" name="name"
                          value="@if(old("name")){{old("name")}}@else{{ $service->name }}@endif"></p>

                <p><input type="text" placeholder="نامک" name="slug"
                          value="@if(old("slug")){{old("slug")}}@else{{ $service->slug }}@endif">
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
                        <img class="admin-media-frame-img mt-3"
                             src="@if($service->media) {{ $service->media->url }} @endif"
                             style="width: 100%; height: auto;margin-top: 20px;">
                        <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                               value="@if($service->media) {{ $service->media->id }} @endif">
                    </div>
                </div>

            </div>
        </div>
        <p>
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>
    @includeIf("admin.partials.media_frame")

@endsection
