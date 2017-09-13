<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Livecourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    //展示课程相关信息(直播课程、购买的点播课程、观看过课程)
    public function course()
    {
        //展示直播课程信息
        $livecourse = Livecourse::get();

        $livecourse->each(function($v, $k){
            //$v->access=1;
            $v->access = $v->is_play_by_time();
        });
        //dd($livecourse);

        return view('home/person/course',compact('livecourse'));
    }
}




