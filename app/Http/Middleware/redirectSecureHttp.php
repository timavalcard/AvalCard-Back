<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use  CMS\RolePermission\Models\Permission;

class redirectSecureHttp extends Middleware
{
    public function handle($request, Closure $next, ...$guards){
        if (!$request->secure()) {
            return redirect()->secure($request->path());
        }
        return $next($request);
    }
}
