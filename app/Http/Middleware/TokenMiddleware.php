<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class TokenMiddleware
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
        $key=$_SERVER['REMOTE_ADDR'].$_SERVER['REQUEST_URI'];
        $num=Redis::Incr($key);
        Redis::expire($key,60);
        if($num>=20){
            $response=[
                'errno'=>'60015',
                'msg'=>'您的访问过于频繁，请一分钟后访问'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
