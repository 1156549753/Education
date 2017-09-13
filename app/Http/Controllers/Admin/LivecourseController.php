<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Livecourse;
use App\Http\Models\Stream;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LivecourseController extends Controller
{
    /**
     * 列表展示
     * @param Request $request
     */
    public function index(Request $request)
    {
        $info = Livecourse::with('stream')->get();
        return view('admin/livecourse/index',compact('info'));
    }

    /**
     * 添加操作
     * @param Request $request
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            //验证
            $rules = [
                'name'=>'required',
                'stream_id'=>'required',
                'start_at'=>'required',
                'end_at'=>'required',
            ];
            $notices = [
                'name.required'=>'名称不能为空',
                'stream_id.required'=>'直播流必选',
                'start_at.required'=>'直播流必选',
                'end_at.required'=>'直播流必选',
            ];
            //制作
            $validator = Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //存储数据入库
                //格式化时间变为时间戳
                $start = strtotime($request->input('start_at'));
                $end = strtotime($request->input('end_at'));
                Livecourse::create([
                    'name'=>$request->input('name'),
                    'stream_id'=>$request->input('stream_id'),
                    'start_at'=>$start,
                    'end_at'=>$end,
                ]);
                return ['success'=>true];
            }else{
                //校验失败
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获取直播流
        $stream = Stream::pluck('stream_name','stream_id');
        return view('admin/livecourse/tianjia',compact('stream'));
    }

    public function getpush(Request $request, Stream $stream, Livecourse $livecourse){
        if($request->isMethod('get')){
            //dd($stream);

            //根据$stream的直播流信息获得对应的“推流地址”
            //rtmp://pili-publish.www.fgwen.top/arties/song?e=1504852097&token=_98OrN3aio-B1RT4blxTXGidnbgq_dvChJN7FUnM:L1XQmZc0urAVYPuJUj5k3eoKujs=
            $host = "pili-publish.www.fgwen.top";
            $space = "arties";
            $stream_name = $stream->stream_name;  //灵活化直播流名称
            $e = $livecourse->end_at;

            //制作鉴权的信息token
            $path = "/$space/$stream_name?e=$e";
            $ak = config('filesystems.disks.qiniu.access_key');
            $sk = config('filesystems.disks.qiniu.secret_key');
            $qiniu = new \Qiniu\Auth($ak,$sk);
            $token = $qiniu->sign($path);
            //以上4行代码执行的时候，就会向七牛发起请求，并对我们的鉴权进行"认证",形式上与在“七牛云直播流页面”刷新效果一样

            return "rtmp://".$host."/".$space."/".$stream_name."?e=".$e."&token=".$token;
        }
    }


    // 删除
   public function del(Livecourse $livecourse){
        // dd($req->livecourse);
       
        $rst = $livecourse->delete();
        if($rst){
            return ['success'=>true];
        }else{
            return ['sucess'=>false];
        }
    }
}
