<?php

namespace App\Http\Middleware;

use Closure;

class CheckMobile
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
        $mobile = [
            'IPhone',
            'iPad',
            'Android',
            'iPhone'
        ];
        foreach($mobile as $k=>$v){
            if(strpos($_SERVER['HTTP_USER_AGENT'],$v)){
                return redirect("http://h5.1910.com");
            }
        }
        return $next($request);
    }
}
