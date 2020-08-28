<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        $user_id=session('user.user_id');
        if(empty($user_id)){
            echo "请先登录";
            header("refresh:3;url=/index/login");die;
        }
        return $next($request);
    }
}
