<?php

namespace  CMS\Marketing\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CMS\RolePermissions\Models\Permission;

class CheckIsAffiliateMiddleware
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
        if(auth()->check()){
            if(auth()->user()->hasPermissionTo(Permission::PERMISSION_AFFILIATE)){
                return $next($request);
            }
        }
        return abort(403);
    }
}
