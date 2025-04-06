@extends("admin.adminMain.main")

@section("admin_title")
افزودن نقش کاربری
@endsection

@section("AdminContent")

<div class="row">

    <div class="col-lg-4">

        <h3>افزودن نقش کاربری</h3>

        <form action="{{ route("role-permissions.store") }}" method="post">

            @csrf
            <p>

                <label for="">نام نقش کاربری : </label>

                <input type="text" name="name" placeholder="نام نقش کاربری را وارد کنید" value="{{old("name")}}">

            </p>

            <div>
                <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
                @foreach($permissions as $permission)
                    <p>
                        <label class="ui-checkbox pt-1 pr-3">
                            <input type="checkbox" name="permissions[{{ $permission->name }}]" class="sub-checkbox" data-id="2"
                                   value="{{ $permission->name }}"
                                   @if(is_array(old('permissions')) && array_key_exists($permission->name, old('permissions'))) checked @endif
                            >
                            <span class="checkmark"></span>
                            @lang($permission->name)
                        </label>
                    </p>
                @endforeach
            </div>


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

                <th>نام نقش کاربری</th>

                <th>مجوز ها</th>
            </tr>

            @foreach($roles as $role)

                <tr>

                    <td>

                        <a href="{{ route("role-permissions.edit",$role->id) }}">@lang($role->name)</a>

                        <div class="admin-table-actions">

                            <a href="{{ route("role-permissions.edit",$role->id) }}"><span>بروزرسانی</span></a>

                            <a class="admin-table-actions-delete" href="{{ route("role-permissions.destroy",$role->id) }}"><span>حذف</span></a>


                        </div>

                    </td>

                    <td>
                        <ul>
                            @foreach($role->permissions as $permission)
                                <li>@lang($permission->name)</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>

            @endforeach

            <tr>

                <th>نام نقش کاربری</th>
                <th>مجوز ها</th>


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

@endsection
