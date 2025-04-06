
    <x-admin-panel-layout>
        <x-slot name="title">
            ویرایش برچسب : {{ $tag->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">ویرایش برچسب : {{ $tag->name }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_shop_index") }}">برچسب ها</a></li>
                                <li class="breadcrumb-item active">ویرایش برچسب : {{ $tag->name }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <div class="col-lg-4">


        <form action="{{ route("admin_edit_tag",["id"=>$tag->id] ) }}" method="post">

            @method("put")

            @csrf

            <input type="hidden" value="{{$tag->type}}" name="post_type">

            <input type="hidden" value="{{$tag->id}}" name="id">

            <p>

                <label for="">نام برچسب : </label>

                <input type="text" name="name" placeholder="نام برچسب را وارد کنید" value="@if(old("name")) {{old("name")}} @else {{ $tag->name }} @endif">

            </p>

            <p>

                <label for="">نامک :</label>

                <input type="text" name="slug" placeholder="نامک برچسب را وارد کنید" value="@if(old("slug")) {{old("slug")}} @else {{ $tag->slug }} @endif">

                <span class="font-italic mt-3 mb-4 d-block">نامک نسخه لاتین واژه است که در نشانی‌ها (URLs)‌ استفاده می‌شود. برای نامگذاری فقط از حروف،‌ ارقام و خط تیره استفاده کنید. نمایش فقط با حروف کوچک خواهد بود.</span>

            </p>



            <p>

                <label for=""> توضیحات برچسب (اختیاری) :</label>

                <textarea name="contents" id="" cols="30" rows="10">@if(old("contents")) {{old("contents")}} @else {{ $tag->content }} @endif</textarea>

            </p>

            <p>

                <button class="btn-blue">بروزرسانی</button>

            </p>

            <p>



            </p>

        </form>

    </div>



</x-slot>
    </x-admin-panel-layout>
