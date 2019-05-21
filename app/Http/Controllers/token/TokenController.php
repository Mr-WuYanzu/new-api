<?php

namespace App\Http\Controllers\token;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Firm;
class TokenController extends Controller
{
    //获取access_token
    public function access_token(){
        $appid=$_GET['appid']??'';
        $key=$_GET['key']??'';
        if(empty($appid)||empty($key)){
            $response=[
                'errno'=>'60014',
                'msg'=>'参数不完整'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
        $num=Redis::Incr($appid);
        Redis::expire($appid,3600);
        if($num>=100){
            $response = [
                'errno' => '60041',
                'msg' => '您的请求过于频繁请等待一小时'
            ];
            return json_encode($response, JSON_UNESCAPED_UNICODE);
            die;
        }else {
            $data = Firm::where(['appid' => $appid, 'key' => $key])->first();
            if (!$data) {
                $response = [
                    'errno' => '60021',
                    'msg' => 'appid或key错误'
                ];
                return json_encode($response, JSON_UNESCAPED_UNICODE);
                die;
            }
            $token = substr(md5($appid . $key . time()), 5, 18);
            $keys = 's:token';
            Redis::Sadd($keys, $token);
            $response = [
                'errno' => '0',
                'access_token' => $token
            ];
        }
        return json_encode($response,JSON_UNESCAPED_UNICODE);
    }
}
