<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/11/2020
 * Time: 8:08 PM
 */

namespace CMS\Comment\policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use CMS\RolePermissions\Models\Permission;

class CommentPolicy
{
    use HandlesAuthorization;
    public function index($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }

    public function create($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }

    public function edit($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }

    public function update($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }

    public function delete($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }

    public function approve($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }
    public function unAprrove($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }
    public function answer($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }
    public function changeState($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENT)) return true;
        return null;
    }
}
