
<x-admin-panel-layout>
    <x-slot name="title">
        افزودن ویژگی
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">افزودن ویژگی</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("admin_product_list") }}">محصولات</a></li>
                            <li class="breadcrumb-item active">ویژگی ها</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
<div class="row">

    <div class="col-lg-4">

        <p>ویژگی ها به شما اجازه میدهند توضیحات بیشتری در مورد محصول، مانند رنگ و سایز بدهید.</p>
        <form action="{{ route("admin_add_attribute") }}" method="post">
            <input type="hidden" value="@isset($_GET["product_type"]){{$_GET["product_type"]}}@endisset" name="product_type">

            @csrf


            <p>

                <label for="">نام ویژگی : </label>

                <input type="text" name="name" placeholder="نام ویژگی را وارد کنید" value="{{old("name")}}">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک ویژگی را وارد کنید" value="{{old("slug")}}">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>





            <p>

                <button class="btn-blue"> افزودن</button>

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

    </x-slot>
</x-admin-panel-layout>
