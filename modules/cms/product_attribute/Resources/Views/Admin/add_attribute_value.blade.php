
    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن مقدار به ویژگی {{ $attribute->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">افزودن مقدار به ویژگی {{ $attribute->name }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_product_list") }}">محصولات</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_add_attribute") }}">ویژگی ها</a></li>
                                <li class="breadcrumb-item active">افزودن مقدار به ویژگی {{ $attribute->name }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
<div class="row">

    <div class="col-lg-4">


        <form action="{{ route("admin_add_attribute_value",["id"=>$parent_id]) }}" method="post">
            <input type="hidden" value="{{ $attribute->product_type  }}" name="product_type">

            @csrf

            <p>

                <label for="">مقدار  : </label>

                <input type="text" name="name" placeholder="مقدار را وارد کنید" value="{{old("name")}}">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک مقدار را وارد کنید" value="{{old("slug")}}">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>
            <div class="mb-3">

                <label for="">انتخاب نوع (رنگ یا عکس) :</label>
                <select class="d-block w-25 p-1 rounded" id="attr_color_or_image_select" name="attr_color_or_image_select">
                    <option>انتخاب کنید</option>
                    <option value="image">عکس</option>
                    <option value="color">رنگ</option>
                </select>
                <div id="attr_color">

                    <input type="text" >
                </div>
                <div id="attr_image">
                    <span class="font-italic mt-3 mb-4 d-block">لینک رنگ ویژگی را وارد کنید یا دکمه زیر را برای انتخاب رنگ کلیک کنید</span>
                    <input type="hidden" class="admin-media-frame-input " name="thumbnail" value="{{ old("thumbnail") }}">
                    <button class="open-admin-media-frame btn btn-success">عکس ویژگی</button>
                    <img height="50" width="50" src="{{ asset(env("IMG_DIR","images")).'/' }}" class="admin-media-frame-img mt-3" >

                </div>
            </div>




            <p>

                <button class="btn-blue"> افزودن</button>

            </p>

            <p>



            </p>

        </form>

    </div>

    <div class="col-lg-8">
        <form action="" class="d-flex align-items-center">
            <input style="border-radius: 10px;" type="text" name="name" placeholder="جستجوی مقدار...">
            <button class="btn-blue mr-2">جستجو</button>
        </form>
        <table class="admin-table final-table">

            <tr>

                <th>نام مقدار</th>


                <th>نامک</th>

                <th>تاریخ انتشار</th>

            </tr>

            @foreach($attr_values as $attr_value)

                   <tr>

                    <td>
                        @if($attr_value->image)
                            <img src="{{ asset(store_image_link($attr_value->image)) }}" width="30px" height="30" style="margin-left: 8px;">
                            @elseif($attr_value->color)
                            <div style="background-color: {{ $attr_value->color }};width: 30px;height: 30px;margin-left: 8px;display: inline-block;border-radius:5px"></div>
                            @endif
                        <a href="{{ route("admin_edit_attribute_value",["id"=>$attr_value->id]) }}">{{ $attr_value->name }}</a>

                        <div class="admin-table-actions">

                            <a href="{{ route("admin_edit_attribute_value",["id"=>$attr_value->id]) }}"><span>بروزرسانی</span></a>

                            <a class="admin-table-actions-delete" href="{{ route("admin_delete_attribute",["id"=>$attr_value->id]) }}"><span>حذف</span></a>


                        </div>

                    </td>




                    <td>{{ $attr_value->slug }}</td>


                    <td>{{ toShamsi($attr_value->created_at) }}</td>

                </tr>
            @endforeach

            <tr>

                <th>نام ویژگی</th>


                <th>نامک</th>


                <th>تاریخ انتشار</th>

            </tr>

        </table>

    </div>

</div>

<div class="admin-delete-modal">

    <form action="" method="post">

        @csrf

        @method("delete")

        <p >شما می خواهید اینرا پاک کنید؟ این کار غیر قابل برگشت است</p>

        <span class="admin-modal-close btn-blue">انصراف</span>

        <button class="btn btn-danger">حذف</button>

    </form>

</div>

@includeIf("admin.partials.media_frame")
    @push("admin-scripts")
        <script>

            jQuery("#attr_color input[type=text]").on("keyup",function (e) {
                jQuery("#attr_color input[type=color]").val(e.target.value);
            })

            jQuery("#attr_color_or_image_select").on("change",function (e) {
                if(this.value=="image"){
                    jQuery("#attr_image").css("display","block");
                    jQuery("#attr_color").css("display","none");
                    jQuery("#attr_color input[type=color]").remove();
                } else if(this.value=="color"){
                    jQuery("#attr_image").css("display","none");
                    jQuery("#attr_color").css("display","block");
                    document.querySelector("#attr_color").insertAdjacentHTML("afterbegin",'<input type="color" name="color">');
                    jQuery("#attr_color input[type=color]").on("input change",function (e) {
                        jQuery("#attr_color input[type=text]").val(e.target.value);
                    })
                    if(jQuery("#attr_color input[type=text]").val()){
                        jQuery("#attr_color input[type=color]").val(jQuery("#attr_color input[type=text]").val())
                    }
                }
            })
        </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
