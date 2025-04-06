<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/11/2020
 * Time: 8:08 PM
 */

namespace CMS\Menu\policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use CMS\RolePermissions\Models\Permission;

class MenuPolicy
{
    use HandlesAuthorization;
    public function index($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_MENU)) return true;
        return null;
    }

    public function create($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_MENU)) return true;
        return null;
    }

}
