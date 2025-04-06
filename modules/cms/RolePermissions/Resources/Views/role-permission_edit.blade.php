@extends("admin.adminMain.main")
@section("admin_title")
    ویرایش نقش کاربری :  @lang($role->name )
@endsection

@section("AdminContent")
    <div class="col-lg-4">
        <h3>ویرایش نقش کاربری :  @lang($role->name )</h3>

        <form action="{{ route('role-permissions.update', $role->id) }}" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $role->id }}">
            <p>


                @if(in_array($role->name,\CMS\RolePermissions\Models\Permission::$permissions ))
                    @php($type="hidden")
                @else
                    <label for="">نام نقش کاربری : </label>
                     @php($type="text")
                @endif
                <input type="{{ $type }}" name="name" placeholder="نام نقش کاربری را وارد کنید" value="{{ $role->name}}">

            </p>

            <div>
                <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
                @foreach($permissions as $permission)
                    <p>
                        <label class="ui-checkbox pt-1 pr-3">
                            <input type="checkbox" name="permissions[{{ $permission->name }}]" class="sub-checkbox" data-id="2"
                                   value="{{ $permission->name }}"
                                   @if($role->hasPermissionTo($permission->name)) checked @endif
                            >
                            <span class="checkmark"></span>
                            @lang($permission->name)
                        </label>
                    </p>
                @endforeach
            </div>


            <p>

                <button class="btn-blue">بروزرسانی</button>

            </p>

            <p>



            </p>

        </form>
    </div>
@endsection
