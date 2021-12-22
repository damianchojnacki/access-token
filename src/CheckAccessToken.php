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
        if ($request->cookie('access-token') != ($token = config('access.token'))) {
            if($request->token == $token){
                $cookie = cookie('access-token', $token, config('access.expiration'));

                return redirect()->route('homepage')->cookie($cookie);
            }

            abort(403);
        }

        return $next($request);
    }
}
