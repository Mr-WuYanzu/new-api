<?php

namespace App\Http\Middleware;

use App\Firm;
use Closure;
use Illuminate\Support\Facades\Redis;

class CheckAccesstokenMiddleware
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
        $key='s:token';
        $token=$request->input('access_token');
        if(!$token){
            $response=[
                'errno'=>'60007',
                'msg'=>'缺少token参数'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $res=Redis::sismember($key,$token);
        if($res==false){
            $response=[
                'errno'=>'60024',
                'msg'=>'access_token错误或已过期'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
