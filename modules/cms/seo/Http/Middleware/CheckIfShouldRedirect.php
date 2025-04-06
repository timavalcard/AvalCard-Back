<?php

namespace  CMS\Seo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use CMS\RolePermissions\Models\Permission;
use CMS\Seo\Models\Redirect;

class CheckIfShouldRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $redirect=Redirect::query()->where("redirect_from",URL::current())
            ->orWhere("redirect_from",rtrim(URL::current(), '/\\'))
            ->first();
        if($redirect){
            return redirect($redirect->redirect_to,$redirect->status_code);
        }

        return $next($request);
    }
}
