<?php

namespace CMS\Settlement\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use CMS\RolePermission\Models\Permission;
use CMS\User\Models\User;

class SettlementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user){
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_Settlement);
    }

    public function index(User $user){
        return $user->hasAnyPermission([Permission::PERMISSION_MANAGE_Settlement,Permission::PERMISSION_EXPERT,Permission::PERMISSION_TEAM_LEADER]);
    }

    public function create(User $user){
        return $user->hasAnyPermission([Permission::PERMISSION_EXPERT,Permission::PERMISSION_TEAM_LEADER]);
    }

    public function edit(User $user){
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_Settlement);
    }

}
