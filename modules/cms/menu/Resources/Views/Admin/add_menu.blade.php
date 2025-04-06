
    <x-admin-panel-layout>
        <x-slot name="title">
            فهرست ها
        </x-slot>
        <x-slot name="main">
    <div class="row">

        <div class="col-lg-3">

            <div class="admin-menu-pages">
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title">
                        <h5>لینک دلخواه</h5>
                        <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                    </div>
                    <div class="w-100 form-item my-3">
                        <ul>

                            <li>
                                <input class="menu-checkbox" type="checkbox" name="menu_item_check[]" value="">


                                <input type="hidden" class="menu-link" value="">

                                <label>لینک دلخواه</label>
                            </li>

                        </ul>
                    </div>
                </div>
                @foreach($menuSelectItems as $key=>$value)
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title">
                            <h5>{{ $key }}</h5>
                            <span class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                        </div>
                        <div class="w-100 form-item my-3">
                            <ul>
                                @foreach($value["items"] as $item)
                                    <li>
                                        <input class="menu-checkbox" type="checkbox" name="menu_item_check[]"
                                               value={{ $item->id }}>


                                        @php($slug=$item->slug?$item->slug:$item->id)
                                        <input type="hidden" class="menu-link"
                                               value="{{route($value['type'].".index" ,["slug"=>$slug])}}">

                                        <label>{{ $item->name ? $item->name : $item->title }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                <button class="btn btn-outline-primary menu-add-item-box">افزودن به فهرست</button>
            </div>

        </div>
        <div class="col-lg-9">
            <form action="{{route("admin_add_menu")}}" method="post">
                @csrf
                <div class="add-menu-boxs">
                    <ul>
                        @if(old("menu_name"))
                            @foreach(old("menu_name") as $key=>$value)
                                <li class="add-menu-box">
                                    <div class="add-menu-box-bottom-top">
                                        <div class="add-menu-box-name">
                                           {{ $value }}
                                        </div>
                                        <div class="add-menu-box-open-btn">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="add-menu-box-bottom-content">
                                        <input type="hidden" name="menu_id[]" value="{{ old("menu_id")[$key] }}">
                                        <p class="form-row">
                                            <label>نام :</label>
                                            <input type="text" name="menu_name[]" class="menu-name-input"
                                                   placeholder="نام" value="{{ $value }}">
                                        </p>
                                        <p class="form-row">
                                            <label>لینک :</label>
                                            <input type="text" name="menu_link[]" placeholder="لینک"
                                                   value="{{ $key }}">
                                        </p>
                                        <div class="form-row">
                                            <button class="btn btn-danger delete-admin-item btn-sm">حذف</button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                            @if(!empty($menus))

                                @foreach($menus as $menu)
                                    <li class="add-menu-box">
                                        <div class="add-menu-box-bottom-top">
                                            <div class="add-menu-box-name">
                                                {{ $menu->name }}
                                            </div>
                                            <div class="add-menu-box-open-btn">
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="add-menu-box-bottom-content">
                                            <input type="hidden" name="menu_id[]" value="">
                                            <p class="form-row">
                                                <label>نام :</label>
                                                <input type="text" name="menu_name[]" class="menu-name-input"
                                                       placeholder="نام" value="   {{ $menu->name }}">
                                            </p>
                                            <p class="form-row">
                                                <label>لینک :</label>
                                                <input type="text" name="menu_link[]" placeholder="لینک"
                                                       value="   {{ $menu->link }}">
                                            </p>
                                            <div class="form-row">
                                                <button class="btn btn-danger delete-admin-item btn-sm">حذف</button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                    </ul>
                    <button class="btn btn-outline-success">ذخیره فهرست</button>
                </div>

            </form>
        </div>
    </div>




</x-slot>
    </x-admin-panel-layout>
