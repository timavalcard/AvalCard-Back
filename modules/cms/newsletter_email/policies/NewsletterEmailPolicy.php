<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/11/2020
 * Time: 8:08 PM
 */

namespace CMS\NewsletterEmail\policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use CMS\RolePermissions\Models\Permission;

class NewsletterEmailPolicy
{
    use HandlesAuthorization;
    public function index($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }
    public function delete($user){
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_NEWSLETTER)) return true;
        return null;
    }

}
