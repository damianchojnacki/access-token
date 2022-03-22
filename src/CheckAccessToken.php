<?php

namespace Damianchojnacki\AccessToken;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!AccessToken::check($request->cookie('access-token'))) {
            if(AccessToken::check($request->token)){
                $cookie = AccessToken::createCookie();

                return redirect($request->path())->cookie($cookie);
            }

            abort(403);
        }

        return $next($request);
    }
}
