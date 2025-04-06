<?php

namespace  CMS\Marketing\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CMS\Marketing\Repository\AffiliateRepository;
use CMS\Marketing\Services\AffiliateService;
use CMS\RolePermissions\Models\Permission;

class CheckLinkAffiliateMiddleware
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
        if (isset($request->affiliate_id)){
            if(!AffiliateService::check_affiliate_link()){
                AffiliateService::store_entrance(["affiliate_id"=>$request->affiliate_id,"ip"=>$request->ip(),"link"=>$request->url()]);
            }
            return redirect($request->url());
        }

        return $next($request);

    }
}
