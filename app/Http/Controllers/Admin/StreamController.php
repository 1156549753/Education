<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StreamController extends Controller
{
    /**
     * 直播流列表
     * @param Request $request
     */
    public function index(Request $request)
    {
        //获取直播流列表信息
        $info = Stream::get();
        return view('admin/stream/index',compact('info'));
    }

    /**
     * 添加操作
     * @param Request $request
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            $rules = [
                'stream_name' => 'required|unique:stream,stream_name',
            ];
            $notices = [
                'stream_name.required'=>'流名称必填',
                'stream_name.unique'=>'流名称已存在',
            ];
            //制作校验
            $validate = Validator::make($request->all(),$rules,$notices);
            if($validate->passes()){
                $space = "arties";
                $method = 'POST';
                $path = '/v2/hubs/'.$space.'/streams';
                $host = 'pili.qiniuapi.com';
                $contentType = 'application/json';
                $body = json_encode([
                    'key' => $request->input('stream_name'),  //直播流名称
                ]);

                //鉴权数据格式
                $token = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
                //根据鉴权格式制作对应的数据

                //利用七牛功能类Qiniu/Auth 实现鉴权数据制作
                $ak = config('filesystems.disks.qiniu.access_key');
                $sk = config('filesystems.disks.qiniu.secret_key');
                $qiniu = new \Qiniu\Auth($ak,$sk);
                $quan = "Qiniu ".$qiniu->sign($token);

                //实现对七牛发起请求，并传递“直播流名称”，同时要设置http协议的信息
                $cli = new \GuzzleHttp\Client();
                //$cli = new \Guzzle\Client();
                $res = $cli->request($method,$host.$path,[
                    'headers'=>[
                        'Authorization'=>$quan,
                        'Content-Type'=>'application/json',
                        'Accept-Encoding'=>'gzip',
                        'Content-Length'=>strlen($body),
                        'User-Agent'=>'pili-sdk-go/v2 go1.6 darwin/amd64',
                    ],
                    'body'=>$body,
                ]);
                $code = $res->getStatusCode(); //200->ok    614->已存在

                //存储流信息到数据库
                Stream::create($request->all());
                return ['success'=>true];
            }else{
                //校验有问题
                $errorinfo = collect($validate->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        return view('admin/stream/tianjia');
    }

    //删除直播流
    public function del(Stream $stream)
    {
        $rst = $stream -> delete();
        // dd($rst);exit();
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
}
