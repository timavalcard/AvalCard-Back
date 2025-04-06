
    <x-admin-panel-layout>
        <x-slot name="title">
            تنظیمات ارسال ایمیل

        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">تنظیمات ارسال ایمیل</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">
                                    تنظیمات ارسال ایمیل
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <div class="col-lg-9">

        <form action="{{ route("admin_save_email_setting") }}" method="post">
            @csrf
            <div class="mb-4 mt-4">
                <p class="mt-4">
                    <label>نام سرور ارسال ایمیل</label>
                 <input type="text" value="{{$data["server_name"]}}" name="server_name">
                </p>

                <p class="mt-4">
                    <label>پورت سرور</label>
                    <input type="text" value="{{$data["server_port"]}}" name="server_port">
                </p>

                <p class="mt-4">
                    <label>یوزر نیم</label>
                    <input type="text" value="{{$data["email_username"]}}" name="email_username">
                </p>

                <p class="mt-4">
                    <label>پسورد</label>
                    <input type="password" value="{{$data["email_password"]}}" name="email_password">
                </p>

                <p class="mt-4">
                    <label>ادرس ایمیل ارسال کننده</label>
                    <input  type="text" value="{{$data["sender_email"]}}" name="sender_email">
                </p>

                <p class="mt-4">
                    <label>نام ارسال کننده</label>
                    <input  type="text" value="{{$data["sender_name"]}}" name="sender_name">
                </p>

                <p class="mt-4">
                    <label>نوع رمزنگاری</label>
                    <input placeholder="tls|ssl" type="text" value="{{$data["email_encryption"]}}" name="email_encryption">
                </p>


                <p class="mt-4">
                <button type="submit" class="btn-blue">ذخیره و تست بر قراری ارتباط</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
    </x-admin-panel-layout>
