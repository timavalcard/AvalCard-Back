
    <x-admin-panel-layout>
        <x-slot name="title">
            لیست رسانه ها
        </x-slot>
        <x-slot name="main">

<div class="w-100 admin-all-media"><h3>رسانه ها</h3>
    <div class="row">
        @foreach ($files as $media)

                <div class="admin-media-item admin-frame-item col-2 col-md-3 col-lg-1">
                    <a class="btn btn-danger admin-table-actions-delete admin-media-item-delete"
                            href="{{ route("admin_delete_media",["media"=>$media->id]) }}"> <i class="fa fa-times"></i></a> <img
                            src="{{ $media->url }}" alt=""></div>

         @endforeach

    </div>

</div>
<div class="admin-delete-modal">
    <form action="" method="post">
        @csrf
        @method("delete")
        <p>شما می خواهید اینرا پاک کنید؟ این
            کار غیر قابل برگشت است</p>
        <span class="admin-modal-close btn-blue">انصراف</span>
        <button class="btn btn-danger">حذف</button>
    </form>
</div>
        </x-slot>
    </x-admin-panel-layout>
