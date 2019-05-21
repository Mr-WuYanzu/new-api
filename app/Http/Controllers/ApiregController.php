<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Firm;
use Illuminate\Support\Facades\Redis;
class ApiregController extends Controller
{
    public function regview(){
        return view('reg');
    }
    //用户注册公司
    public function reg(Request $request){
        $data=$request->all();
        $uid=Auth::id();
        unset($data['_token']);
        if(empty($data['firm_name'])??''||empty($data['legal_person'])??''||empty($data['tax_no'])??''||empty($data['pub_banknum'])??''){
            $response=[
                'errno'=>'60011',
                'msg'=>'信息不完整'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }

        $firm_info=Firm::where('firm_name',$data['firm_name'])->first();
        if($firm_info){
            $response=[
                'errno'=>'60012',
                'msg'=>'此企业名称已经提交注册'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
        $rs=Firm::where('uid',$uid)->first();
        if($rs){
            $response=[
                'errno'=>'60022',
                'msg'=>'您已经有一个企业了'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
        $file_name=$this->upload('permit',$request);
        $data['permit']=$file_name;
        $data['uid']=$uid;
        $id=Firm::insertGetId($data);
        if($id){
            header('Refresh:2,url:/firm/list');
        }
    }

    //上传文件
    public function upload($file_name,$request){
        if ($request->hasFile($file_name) && $request->file($file_name)->isValid()) {
            $photo = $request->file($file_name);
            $extension = $photo->extension();
            $filename=substr((time().Str::random(15)),3,18).'.'.$extension;
            $file_path='photo/'.date('Ymd');
            $store_result = $photo->storeAs($file_path, $filename);
            return $store_result;exit;
        }
        exit('未获取到上传文件或上传过程出错');
    }

//    我的公司
    public function firm_list(){
        return view('firm.list');
    }
    public function firm_list_do(){
        $uid=Auth::id();
        $data=Firm::where('uid',$uid)->first();
        if(!$data){
            $response=[
                'errno'=>'60023',
                'msg'=>'您还没有公司，去注册一个吧'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else if($data->status==1){
            $response=[
                'errno'=>'60025',
                'msg'=>'您的公司还没有通过审核，请耐心等待'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
            $response=[
                'errno'=>'0',
                'msg'=>'ok',
                'data'=>[
                    'data'=>$data
                ]
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
    }
}
