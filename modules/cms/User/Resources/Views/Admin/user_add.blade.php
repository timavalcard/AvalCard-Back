<x-admin-panel-layout>
    <x-slot name="title">
        افزودن کاربر
    </x-slot>
    <x-slot name="main">
    <form action="{{ route("admin_add_user")}}" method="post" class="w-100"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9"><h3>افزودن کاربر</h3> @csrf

                <p><input type="text" placeholder="نام کاربر" name="name"
                          value="{{ old("name") }}"></p>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>ایمیل کاربر</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item">
                       <input type="text" placeholder="ایمیل کاربر" name="email"
                          value="{{ old("email") }}">
                    </p></div>
                    <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>پسورد کاربر</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item">
                       <input type="password" placeholder="پسورد کاربر" name="password"
                          >
                            <input class="mt-3" type="password" placeholder="تکرار پسورد" name="password_confirmation"
                         >
                    </p></div>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>نقش  کاربری</h5>
                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <div class="col-12 form-item mt-2">
                        @foreach($roles as $role)
                            <p>
                                <label class="ui-checkbox pt-1">
                                    <input type="checkbox" name="role[]" class="sub-checkbox" data-id="2"
                                           value="{{ $role->name }}">
                                    <span class="checkmark"></span>
                                    @lang($role->name)
                                </label>
                            </p>
                        @endforeach
                    </div>
                </div>

                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>وضعیت حساب</h5>
                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <div class="col-12 form-item mt-2">

                        <p>
                            <select name="status" id="">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @if(old("status") == $status) selected @endif>@lang($status)</option>
                                @endforeach
                            </select>
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">


            </div>
        </div>
        <p>
            <button class="btn-blue">افزودن</button>
        </p>
    </form>

</x-slot>
</x-admin-panel-layout>

