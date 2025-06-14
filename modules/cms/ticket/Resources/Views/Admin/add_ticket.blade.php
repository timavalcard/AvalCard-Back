<x-admin-panel-layout>
    <x-slot name="title">
       افزودن تیکت جدید
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">       افزودن تیکت جدید</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">تیکت‌ها</a></li>
                            <li class="breadcrumb-item active">       افزودن تیکت جدید</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        {{-- فرم ارسال پاسخ --}}
        <form action="{{ route('admin_add_ticket') }}" method="post" class="w-100" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">
                    @csrf
                    <input type="hidden" name="is_admin" value="1">

                    <div class="admin-metabox-item ">
                        <div class="admin-metabox-item-title">
                            <h5>ارسال تیکت</h5>
                        </div>

                        <p class="col-12 form-item">
                            <label for="message">موضوع تیکت</label>
                            <input type="text" name="subject" id="subject" >
                        </p>
                        <p class="col-12 form-item">
                            <label for="message">متن تیکت</label>
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </p>
                        <p class="col-12 form-item">
                            <label for="message">انتخاب بخش</label>
                            <select name="department" >
                                <option value="">انتخاب</option>
                                <option value="فروش">فروش</option>
                                <option value="پشتیبانی">پشتیبانی</option>
                                <option value="خرید گیفت کارت">خرید گیفت کارت</option>
                                <option value="نقد کردن درآمد">نقد کردن درآمد</option>
                                <option value="خرید کالا">خرید کالا</option>
                                <option value="پرداخت در وب سایت‌های خارجی">پرداخت در وب سایت‌های خارجی</option>
                            </select>
                        </p>
                        @php
                            $selectedUserId = request()->query('user_id');
                        @endphp


                        <p class="col-12 form-item">
                            <label for="userSelect">انتخاب کاربر</label>
                            <select  name="user_id" id="userSelect" class="d-none select2">
                                <option value="">یک کاربر انتخاب کنید</option>
                                @foreach ($users as $user)

                                    {{--@if($user->id != auth()->id())--}}
                                        <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                            {{ $user->mobile }} - {{ $user->name }} {{ $user->last_name }}
                                        </option>
                                   {{-- @endif--}}
                                @endforeach
                            </select>
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
                        <button class="btn-blue">ارسال تیکت</button>
                    </p>
                </div>
            </div>
        </form>

        <style>
            .dropdown-select.wide.d-none.select2 {
                display: block !important;
            }
        </style>
        @push("admin-css")
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        @endpush
        @push('js')
            <script>
                $(document).ready(function () {
                    $('#userSelect').select2({
                        placeholder: 'یک کاربر انتخاب کنید',
                        dir: 'rtl'
                    });
                });
            </script>
        @endpush

    </x-slot>
</x-admin-panel-layout>
