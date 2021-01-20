<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Authenticate
{

    protected $except = ['login','login2', 'register'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        foreach ($this->except as $uri) {
            if ($request->is($uri)) {
                return $next($request);
            }
        }
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                $is_login = Cookie::get('is_login');
                if($is_login){
                    return redirect()->guest('login2');
                }else{
                    return redirect()->guest('login');
                }
            }
        }
        return $next($request);
    }
}
