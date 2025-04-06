<?php

namespace CMS\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CMS\RolePermissions\Models\Permission;
use CMS\RolePermissions\Models\Role;

class DashboardAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole(Role::ROLE_USER) || auth()->user()->hasPermissionTo(Permission::PERMISSION_AFFILIATE)){
            return redirect()->route('user.account')->send();
        }
        return $next($request);
    }
}
