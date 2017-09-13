<?php

//声明命名空间
namespace App\Http\Controllers\Home;

//use:做空间类元素引入
use App\Http\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Course;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function index()
    {

        //dd(Lesson::find(14)->course);
        //dd(Lesson::find(14)->course->toArray());

        //dd(Course::find(2)->lesson()->where('lesson_duration','>',20)->first());
        //dd(Course::find(2)->lesson);
//        dd(Course::with(['lesson'=>function($l){
//            $l->where('lesson_duration','>',20);
//            $l->first();
//        }])->find(2));

        //dd(new \App\Tools\Cart());
        //获取课程、课时信息
        $course = Course::with('lesson')->get();

        return view('home.index.index',compact('course'));
    }
}


