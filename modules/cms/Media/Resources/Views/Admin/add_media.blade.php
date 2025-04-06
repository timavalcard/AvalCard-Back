 <x-admin-panel-layout>
        <x-slot name="title">
            افزودن رسانه
        </x-slot>
        <x-slot name="main">

    <div class="w-100"><h3>اپلود رسانه جدید</h3>
        <form enctype="multipart/form-data" method="post" class="admin-media-form-file"
              action="{{ route("admin_add_media") }}">            @csrf <input type="file" name="media_field[]"
                                                                               class="admin-media-input-file" multiple>
            <button class="btn-blue">ذخیره</button>
        </form>
        <span class="font-italic mt-3 mb-4 d-block">            برای اپلود چند تایی کلید cntrl را نگه دارید سپس فایل های خود را انتخاب کنید        </span>
    </div>
        </x-slot>
    </x-admin-panel-layout>
