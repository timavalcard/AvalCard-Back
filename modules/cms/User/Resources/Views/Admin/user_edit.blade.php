<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش کاربر : {{ $user->name }}
    </x-slot>
    <x-slot name="main">
    <form action="{{ route("admin_edit_user",["id"=>$user->id]) }}" method="post" class="w-100"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9"><h3>ویرایش کاربر : {{$user->name}}</h3> @csrf
                <p><input type="text" placeholder="نام کاربر" name="name"
                          value="@if(old("name")){{old("name")}}@else{{ $user->name }}@endif"></p>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>ایمیل کاربر</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item">
                       <input type="text" placeholder="ایمیل کاربر" name="email"
                          value="@if(old("email")){{old("email")}}@else{{ $user->email }}@endif">
                    </p></div>



                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title">
                        <h5>شماره تلفن کاربر</h5>
                        <span
                            class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                    </div>
                    <p class="col-12 form-item">
                        <input type="text" placeholder="شماره تلفن کاربر" name="mobile"
                               value="@if(old("mobile")){{old("mobile")}}@else{{ $user->mobile }}@endif">
                    </p>
                </div>

                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title">
                        <h5>کد ملی کاربر</h5>
                        <span
                            class="admin-metabox-item-btn-up">
                            <i class="fa fa-angle-up"></i>
                        </span>
                    </div>
                    <p class="col-12 form-item">
                        <input type="text" placeholder="کد ملی کاربر" name="national_code"
                               value="@if(old("national_code")){{old("national_code")}}@else{{ $user->national_code }}@endif">
                    </p>
                </div>


                       <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>پسورد جدید</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item">
                       <input type="password" placeholder="پسورد کاربر" name="password"
                          value="">
                           <input class="mt-3" type="password" placeholder="تکرار پسورد" name="password_confirmation"
                          value="">
                          <span class="font-italic mt-3 mb-4 d-block">اگر نمیخواهید تغییر کند خالی بزارید</span>
                    </p></div>

                <div className="col-12">
                    <div class="mt-4 mb-4">

                        <label class="d-block">عکس پروفایل</label>
                        <button type="button" class="open-admin-media-frame btn btn-primary mt-3">آپلود</button>

                        <input type="hidden" class="admin-media-frame-input" name="thumbnail"
                               value="{{$profile_avatar_id}}">

                        <img class="admin-media-frame-img ml-3 mt-3"
                             style="width: 70px" src="{{ $user->profile_avatar }}">



                    </div>
                </div>


                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>نقش  کاربری</h5>
                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <div class="col-12 form-item mt-2">
                        @foreach($roles as $role)
                            <p>
                                <label class="ui-checkbox pt-1">
                                    <input type="radio" name="role[]" class="sub-checkbox" data-id="2"
                                           value="{{ $role->name }}"
                                           @if($user->hasRole($role->name)) checked @endif
                                    >
                                    <span class="checkmark"></span>
                                    <span class="mr-5">
                                        @lang($role->name)
                                    </span>
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
                                        <option value="{{ $status }}" @if($user->status == $status) selected @endif>@lang($status)</option>
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
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>
        @includeIf("admin.partials.media_frame")
</x-slot>
</x-admin-panel-layout>
