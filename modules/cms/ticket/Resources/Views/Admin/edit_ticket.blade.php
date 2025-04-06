<x-admin-panel-layout>
        <x-slot name="title">
            ویرایش تیکت {{ $ticket->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">  ویرایش تیکت  {{ $ticket->name }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route($ticket->ticket_able_type."_tickets.index") }}">تیکت ها</a></li>
                                <li class="breadcrumb-item active">
                                    ویرایش تیکت  {{ $ticket->name }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_edit_ticket",["id"=>$ticket->id]) }}" method="post" class="w-100" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9"> @csrf
            <input type="hidden" name="user_id"  value="{{ auth()->id() }}">
            <input type="hidden" name="parent_id" value="{{ $ticket->id }}">
                <input type="hidden" name="post_id" value="{{ $ticket->ticket_able_id }}">
                <input type="hidden" name="post_type" value="{{ $ticket->ticket_able_type }}">
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>متن</h5>
                        <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <p class="col-12 form-item">
                        <textarea name="text" id="text" cols="30" rows="10"></textarea>
                    </p>
                </div>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>نام</h5>
                        <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <p class="col-12 form-item">
                        <input name="name" class="mt-2" type="text" value="{{ $ticket->name }}">
                    </p>
                </div>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>ایمیل</h5>
                        <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <p class="col-12 form-item">
                        <input name="email" class="mt-2" type="text" value="{{ $ticket->email }}">
                    </p>
                </div>

                <p>
                    <button class="btn-blue">بروزرسانی</button>
                </p>
            </div>

        </div></form>

    <script>        CKEDITOR.replace('text');
        CKEDITOR.replace('excerpt');
        CKEDITOR.instances['text'].setData(`{!! $ticket->text !!}`);
          </script>
        </x-slot>
</x-admin-panel-layout>
