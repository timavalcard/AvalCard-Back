<x-admin-panel-layout>
        <x-slot name="title">
            تنظیمات قالب
        </x-slot>
        <x-slot name="main">

    <div class="row">
        <div class="col-lg-3">
            <div class="shop-setting-top-ul">
                <ul class="admin-shop-list-ul  nav-tabs nav" style="flex-direction: column" data-tabs="tabs">
                    @foreach($fields as $key=>$fiels)
                        <li><a data-toggle="tab" href="#{{$key}}"  @if ($loop->first) class="active" @endif>{{ $fiels["persian_name"] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <form action="{{ route("admin_theme_setting_add") }}" method="post">
                @csrf
                <div class="tab-content">
                    @foreach($fields as $key=>$field)
                        <div id="{{$key}}" class="admin-the-setting-list-content-item tab-pane  @if ($loop->first) fade in show active @endif" >
                            @foreach($field["items"] as $boxKey=>$boxFields)
                                <div class="admin-metabox-item metabox-close" style="margin-top: 15px;">
                                    <div class="admin-metabox-item-title"><h5>{{ $boxFields["persian_name"] }}</h5>
                                        <span class="admin-metabox-item-btn-up">
                                            <i class="fa fa-angle-up"></i>
                                        </span>
                                    </div>
                                    <div class="admin-theme-setting-box mt-3 form-item">
                                        <div class="admin-theme-setting-box-items">
                                            @if(!$values->where("setting_key", $boxKey)->first() || empty($values->where("setting_key", $boxKey)->first()->setting_value) )
                                                <div class="admin-theme-setting-item mb-2">
                                                    @if($boxFields["options"]["repeatable"])
                                                        <div class="admin-theme-setting-item-delete text-danger">حذف این آیتم</div>
                                                    @endif
                                                        @php($fieldsWithValu=$boxFields["fields"]())
                                                        @foreach($fieldsWithValu as $themeField)
                                                            {!! $themeField["html"] !!}
                                                        @endforeach

                                                </div>
                                            @else
                                                @foreach($values->where("setting_key", $boxKey)->first()["setting_value"] as $fieldValue)

                                                    <div class="admin-theme-setting-item mb-2">
                                                        @if($boxFields["options"]["repeatable"])
                                                        <div class="admin-theme-setting-item-delete text-danger">حذف این آیتم</div>
                                                        @endif

                                                            @php($fieldsWithValu=$boxFields["fields"]($fieldValue))

                                                        @foreach($fieldsWithValu as $themeField)
                                                            {!! $themeField["html"] !!}
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                        @if(isset($boxFields["options"]["repeatable"]) && $boxFields["options"]["repeatable"]  == true)
                                        <div class="admin-theme-setting-action">
                                            <button class="btn btn-dark btn-sm add-setting-item">افزودن {{ $boxFields["persian_name"] }}</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="theme-setting-bottom-row text-left">
                    <button class="btn btn-danger">ذخیره تنظیمات</button>
                </div>
            </form>
        </div>
    </div>
    @includeIf("admin.partials.media_frame")

    @push("admin-scripts")

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script>
            jQuery('.admin-shop-list-ul a').click(function (e) {
                e.preventDefault();
                $(this).removeClass('active');

                $(".admin-shop-list-ul a").removeClass('active');
            });
        </script>

        <script>
            jQuery("body").on("click",".admin-theme-setting-item-delete",function (e) {
                if(confirm("از حذف این آیتم اطمینان دارید")){
                    var itemForDelete=e.target.closest(".admin-theme-setting-item");
                    var count = jQuery(e.target.closest(".admin-theme-setting-box-items")).children(".admin-theme-setting-item").length;
                    if(count>1){
                        itemForDelete.remove();
                    } else{
                        if(itemForDelete.querySelector("img")){
                            itemForDelete.querySelector("img").removeAttribute("src");
                        }
                        $(itemForDelete).find('input, select, textarea').each(function() {
                            $(this).val(null);
                            $(this).removeAttr("checked selected")
                        });
                    }

                }
            });

            jQuery(".add-setting-item").click(function (e) {
                e.preventDefault();
                var parent=e.target.closest(".admin-metabox-item").querySelector(".admin-theme-setting-box-items");
                var item= parent.querySelector(".admin-theme-setting-item");
                itemHTML=" <div class='admin-theme-setting-item mb-2'>" + item.innerHTML + "</div>"
                parent.insertAdjacentHTML("beforeend",itemHTML);
                var currentItem=parent.lastChild;
                if(currentItem.querySelector("img")){
                    currentItem.querySelector("img").removeAttribute("src");
                }
                $(currentItem).find('input, select, textarea').each(function() {
                    $(this).val(null);
                    $(this).removeAttr("checked selected")
                });

            });


        </script>

    @endpush
        </x-slot>
</x-admin-panel-layout>
