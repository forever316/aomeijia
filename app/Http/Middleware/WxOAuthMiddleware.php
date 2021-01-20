<?php

//微信授权中间件
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\WechatMember;

class WxOAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        //是否已经授权过
        if(!Session::has('wechat_user')){
            //保存当前路径以便回调时跳转
            Session::put('target_url','http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);//$request->path());

            // 执行业务逻辑操作
            $urlArray = explode('.', $_SERVER['HTTP_HOST']);
            $app = getWxApp($urlArray[0]);
            $response = $app->oauth
                ->setRequest($request)
                ->redirect();
            return $response;
        }else{
            $user = Session::get('wechat_user');
            $openid = $user['id'];
            $data = WechatMember::where('openid',$openid)->first();
            if(!$data){
                //保存当前路径以便回调时跳转
                Session::put('target_url','http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

                // 执行业务逻辑操作
                $urlArray = explode('.', $_SERVER['HTTP_HOST']);
                $app = getWxApp($urlArray[0]);
                $response = $app->oauth
                    ->setRequest($request)
                    ->redirect();
                return $response;
            }
        }
        return $next($request);  
    }
}
