<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/11/2020
 * Time: 8:08 PM
 */

namespace CMS\Newsletter\policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use CMS\RolePermissions\Models\Permission;

class NewsletterPolicy
{
    use HandlesAuthorization;
    public function index($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

    public function create($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

    public function edit($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

    public function update($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

    public function delete($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

    public function sendAgain($user){
    if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
    return null;
}
    public function search($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }
}
