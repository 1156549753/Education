<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Models\Stream;

class VideoController extends Controller
{
    public function play(Request $request,Stream $stream){
        //根据$stream获得对应的拉流地址
        $urlpath = "rtmp://pili-publish.www.fgwen.top";
        $space = "arties";
        $name = $stream->stream_name; //直播流名称
        $pullurl = $urlpath."/".$space."/".$name; //拼装拉流地址

        return view('home/video/play',compact('pullurl'));
    }
}
