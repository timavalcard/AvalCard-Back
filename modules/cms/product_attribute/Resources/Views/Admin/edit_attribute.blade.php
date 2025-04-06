
       <x-admin-panel-layout>
           <x-slot name="title">
               ویرایش   {{ $edit_attr->name }}
           </x-slot>
           <x-slot name="main">
               <div class="content-header">
                   <div class="container-fluid">
                       <div class="row mb-4">
                           <div class="col-sm-6">
                               <h3 class="m-0 text-dark">ویرایش   {{ $edit_attr->name }}</h3>
                           </div><!-- /.col -->
                           <div class="col-sm-6">
                               <ol class="breadcrumb float-sm-left">
                                   <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                   <li class="breadcrumb-item"><a href="{{ route("admin_product_list") }}">محصولات</a></li>
                                   <li class="breadcrumb-item"><a href="{{ route("admin_add_attribute") }}">ویژگی ها</a></li>
                                   <li class="breadcrumb-item active">ویرایش   {{ $edit_attr->name }}</li>
                               </ol>
                           </div><!-- /.col -->
                       </div>
                   </div>
               </div>

<div class="row">

    <div class="col-lg-4">


        <form action="{{ route("admin_edit_attribute",["id"=>$edit_attr->id]) }}" method="post">

            @csrf


            <p>

                <label for="">نام ویژگی : </label>

                <input type="text" name="name" placeholder="نام ویژگی را وارد کنید" value="@if(old("name")){{old("name")}}@else{{ $edit_attr->name }}@endif">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک ویژگی را وارد کنید" value="@if(old("slug")){{old("slug")}}@else{{ $edit_attr->slug }}@endif">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>

            @if($edit_attr->parent !=0)
                <div class="mb-3">

                    <label for="">انتخاب نوع (رنگ یا عکس) :</label>
                    <select class="d-block w-25 p-1 rounded" id="attr_color_or_image_select" name="attr_color_or_image_select">
                        <option>انتخاب کنید</option>
                        <option value="image" @if($edit_attr->image) selected @endif>عکس</option>
                        <option value="color" @if($edit_attr->color) selected @endif>رنگ</option>
                    </select>

                    <div id="attr_color" style=" @if($edit_attr->color) display:block @endif">

                        <input type="text" value="{{ $edit_attr->color }}"/>
                        <input type="color" name="color" value="{{ $edit_attr->color }}" />

                    </div>
                    <div id="attr_image"  style=" @if($edit_attr->image) display:block @endif">
                        <span class="font-italic mt-3 mb-4 d-block">لینک رنگ ویژگی را وارد کنید یا دکمه زیر را برای انتخاب رنگ کلیک کنید</span>
                        <input type="text" class="admin-media-frame-input " name="thumbnail">
                        <button class="open-admin-media-frame btn btn-success">عکس ویژگی</button>
                        <img height="50" width="50" src="{{ asset(store_image_link($edit_attr->image)) }}" class="admin-media-frame-img mt-3" >

                    </div>
                </div>
                @endif

            <p>

                <button class="btn-blue"> ویرایش</button>

            </p>

            <p>



            </p>

        </form>

    </div>

    <div class="col-lg-8">

        <table class="admin-table final-table">

            <tr>

                <th>نام ویژگی</th>


                <th>نامک</th>
                 <th>مقدار ها</th>

                <th>تاریخ انتشار</th>

            </tr>

            @foreach($attributes as $attribute)

                @php($value=$attributes->where("parent",$attribute->id))
                @if($attribute->parent == 0)
                   <tr>

                    <td>

                        <a href="{{ route("admin_edit_attribute",["id"=>$attribute->id]) }}">{{ $attribute->name }}</a>

                        <div class="admin-table-actions">

                            <a href="{{ route("admin_edit_attribute",["id"=>$attribute->id]) }}"><span>بروزرسانی</span></a>

                            <a class="admin-table-actions-delete" href="{{ route("admin_delete_attribute",["id"=>$attribute->id]) }}"><span>حذف</span></a>


                        </div>

                    </td>




                    <td>{{ $attribute->slug }}</td>
                    <td>
                          @if($value)
                             @foreach($value as $item)
                              {{ $item->name }} |

                                 @endforeach

                              @else

                              مقداری ندارد

                              @endif
                        <a href="{{ route("admin_add_attribute_value",["id"=>$attribute->id]) }}" class="d-block">افزودن مقدار جدید</a>
                    </td>

                    <td>{{ toShamsi($attribute->created_at) }}</td>

                </tr>
                @endif
            @endforeach

            <tr>

                <th>نام ویژگی</th>

                <th>توضیحات</th>

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
                document.querySelector("#attr_color").insertAdjacentHTML("afterbegin",'<input type="color" name="color" value="{{ $edit_attr->color }}">');
                jQuery("#attr_color input[type=text]").val('{{ $edit_attr->color }}');

                if(jQuery("#attr_color input[type=text]").val()){
                    jQuery("#attr_color input[type=color]").val(jQuery("#attr_color input[type=text]").val())
                }
            }
        })
        jQuery("#attr_color input[type=color]").on("input change",function (e) {
            jQuery("#attr_color input[type=text]").val(e.target.value);
        })
    </script>
@endpush
           </x-slot>
       </x-admin-panel-layout>
