<?php
namespace CMS\RolePermissions\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepo
{
    public function all()
    {
        return Permission::all();
    }
}
