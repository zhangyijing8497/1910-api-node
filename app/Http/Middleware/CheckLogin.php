<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;


class CheckLogin
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
        $_SERVER['uid'] = 0;        //默认未登录
        $token = Cookie::get('token');
        if(!empty($token)){
            $token_key='h:login_info:'.$token;
            $u = Redis::hGetAll($token_key);
            if(isset($u['uid'])){
                $_SERVER['uid']=$u['uid'];
                $_SERVER['token'] = $u['token'];
                $_SERVER['user_name'] = $u['user_name'];
            }
        }
        return $next($request);
    }
}
