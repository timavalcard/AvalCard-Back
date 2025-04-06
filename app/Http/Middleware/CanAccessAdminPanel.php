<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use CMS\RolePermissions\Models\Permission;

class CanAccessAdminPanel extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {

        if(auth()->check()) {
            $permissions = auth()->user()->getAllPermissions()->pluck("name")->toArray();

            if (!empty(array_intersect(Permission::$admin_permissions, $permissions))) {

                return $next($request);

            }
        }
        return abort(403);
    }
}
