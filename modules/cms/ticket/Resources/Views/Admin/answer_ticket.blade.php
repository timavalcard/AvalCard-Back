<x-admin-panel-layout>
    <x-slot name="title">
        پاسخ به تیکت
        " {{$ticket->subject}} "
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">پاسخ به تیکت
                            " {{$ticket->subject}} "</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">تیکت‌ها</a></li>
                            <li class="breadcrumb-item active">پاسخ به تیکت
                                " {{$ticket->subject}} "</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- نمایش پیام‌های تیکت --}}
        <div class="row mb-4">

            <div class="col-lg-9">
                @foreach ($ticket->messages as $message)
                    <div class="d-flex {{ $message->is_admin ? 'justify-content-end' : ' justify-content-start' }}">
                        <div class="message-box w-50 p-3 mb-3 {{ $message->is_admin ? 'bg-light text-primary' : 'bg-white' }}">
                            <strong>
                                {{ $message->is_admin ? 'پاسخ ادمین:' : 'پیام کاربر:' }}
                            </strong>
                            <p class="mb-1">{{ $message->message }}</p>
                            @if($message->media_id)
                                <a target="_blank" href="{{ $message->media->url }}">
                                    <img style="width: 300px; display: block; margin-top: 10px; margin-bottom: 10px;" src="{{ $message->media->url }}" alt="">
                                </a>
                            @endif
                            <p class="text-muted">تاریخ: {{ jdate($message->created_at)->format('Y/m/d H:i') }}</p>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

        {{-- فرم ارسال پاسخ --}}
        <form action="{{ route('admin_answer_ticket', ['id' => $ticket->id]) }}" method="post" class="w-100" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <input type="hidden" name="is_admin" value="1">

                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title">
                            <h5>پاسخ</h5>
                        </div>
                        <p class="col-12 form-item">
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </p>
                        <p class="col-12 form-item">
                            <input type="file" name="file" id="fileInput" style="display: none;" onchange="showFileName(this)" />
                            <button type="button" class="btn btn-primary" id="uploadBtn">
                                آپلود عکس
                            </button>
                            <span id="file-name" class="d-block mt-2 text-secondary"></span>
                        </p>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const uploadBtn = document.getElementById('uploadBtn');
                                const fileInput = document.getElementById('fileInput');

                                uploadBtn.addEventListener('click', function () {
                                    fileInput.click();
                                });
                            });

                            function showFileName(input) {
                                const fileName = input.files.length > 0 ? input.files[0].name : '';
                                document.getElementById('file-name').textContent = fileName;
                            }
                        </script>


                    </div>

                    <p>
                        <button class="btn-blue">ارسال پاسخ</button>
                    </p>
                </div>
            </div>
        </form>
    </x-slot>
</x-admin-panel-layout>
