<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class trailingSlashes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
       /* if (!str_contains($request->getRequestUri(),".xml") && !preg_match('/.+\/$/', $request->getRequestUri()) && $request->method() == "GET" && $request->getRequestUri() !="/" && !str_contains($request->getRequestUri(),'admin') && empty($_GET) )
        {
            return Redirect::to($request->getRequestUri().'/');
        }*/
        return $next($request);
    }
}

