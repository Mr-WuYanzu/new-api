<?php

namespace App\Admin\Controllers;

use App\Firm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CheckUserController extends Controller
{
    public function check(){
        $data=Firm::where('status',1)->paginate('5');
        return view('firm',['data'=>$data]);
    }
    public function update(){
        $uid=$_GET['uid'];
        $data=Firm::where('id',$uid)->first();
        $appid=substr(md5($data->firm_name.time()).Str::random('6'),9,18);
        $key=encrypt($appid);
        $res=Firm::where('id',$uid)->update(['status'=>2,'appid'=>$appid,'key'=>$key]);
        if($res){
            $response=[
                'errno'=>'0',
                'msg'=>'通过审核'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
            $response=[
                'errno'=>'60015',
                'msg'=>'失败'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
    }
    public function del(){
        $uid=$_GET['uid'];
        $res=Firm::destroy($uid);
        if($res){
            $response=[
                'errno'=>'0',
                'msg'=>'驳回成功'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
            $response=[
                'errno'=>'60015',
                'msg'=>'失败'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
    }
}
