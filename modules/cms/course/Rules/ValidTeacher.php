<?php
namespace CMS\Course\Rules;
use CMS\RolePermissions\Models\Permission;
use Illuminate\Contracts\Validation\Rule;
use CMS\User\Repositories\UserRepository;

class ValidTeacher implements Rule
{

    public function passes($attribute, $value)
    {
       $user = UserRepository::find($value);
       return $user->hasPermissionTo(Permission::PERMISSION_TEACH);
    }

    public function message()
    {
        return "کاربر انتخاب شده یک مدرس معتبر نیست.";
    }
}
