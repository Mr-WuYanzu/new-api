<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Firm;

class ApiController extends Controller
{
    //显示客户端ip
    public function client_ip(){
//       $ip=$_SERVER['REMOTE_ADDR'];
//       $response=[
//           'errno'=>'60006',
//           'msg'=>'ok',
//           'data'=>[
//               'ip'=>$ip
//           ]
//       ];
//       return json_encode($response,JSON_UNESCAPED_UNICODE);
    }
    //显示客户端UA
    public function clientua(){
//        $ua=$_SERVER['HTTP_USER_AGENT'];
//        $response=[
//            'errno'=>'60006',
//            'msg'=>'ok',
//            'data'=>[
//                'ua'=>$ua
//            ]
//        ];
//        return json_encode($response,JSON_UNESCAPED_UNICODE);
    }
    //显示用户注册信息
    public function regInfo(){
        $appid=$_GET['appid']??'';
        $key=$_GET['key']??'';
        if(empty($appid)){
            $response=[
                'errno'=>'60022',
                'msg'=>'缺少appid'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }else if(empty($key)){
            $response=[
                'errno'=>'60023',
                'msg'=>'缺少key'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $data=Firm::where(['appid'=>$appid,'key'=>$key])->first();
        if(!$data){
            $response=[
                'errno'=>'60021',
                'msg'=>'appid或key错误'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
            $response=[
                'errno'=>'0',
                'data'=>json_encode($data,JSON_UNESCAPED_UNICODE)
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }

    }
}
