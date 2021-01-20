<?php

//权限中间件
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;

class AuthorityMiddleware
{

    protected $except = ['login','login2', 'register','userOut','/','index','home'];

    public function handle($request, Closure $next)
    {
        foreach ($this->except as $uri) {
            if ($request->is($uri)) {
                return $next($request);
            }
        }

        if(!Session::has('authority')){
            return redirect()->guest('userOut');
        }else{
            $authority = Session::get('authority');
            if(!in_array('/'.$request->path(),array_values($authority['resources']))){
                abort(500,'您没有该操作权限');
            }
        }
        return $next($request);
    }
}
