<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Course;
use App\Http\Models\Lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * 课时列表显示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            //① 负责帮组datatable获得数据
            //获得纪录总条数
            $cnt = Lesson::count();

            //获得课时列表信息
            //【实现排序】，获得排序的条件， order by 字段 asc/desc
            $n = $request->input('order.0.column');         //字段序号
            $order = $request->input('columns.'.$n.'.data'); //获得排序字段
            $by = $request->input('order.0.dir');               //顺序

            //【实现分页】
            $offset = $request->input('start');
            $len = $request->input('length');

            //【检索模糊查找】
            $search = $request->input('search.value');

            $info = Lesson::orderBy($order,$by)->offset($offset)->limit($len)->
                where('lesson_name','like',"%$search%")->
                orWhere('lesson_desc','like',"%$search%")->
                with(['course'=>function($c){
                    //$c->orderBy('course_id','desc');
                    //$c->where('course_price','>',1000);
                    $c->with('profession');
                }])->
                get();
            //把$info数据传递给客户端的datatable使用
            return [
                'draw'=>$request->get('draw'),
                'recordsTotal'=>$cnt,
                'recordsFiltered'=>$cnt,
                'data'=>$info,
            ];
        }
        //② 展示列表页面
        return view('admin/lesson/index');
    }

    /**
     * 集中启用、启用操作
     * @param Request $request
     * @param Lesson $lesson
     * @return array
     */
    public function start_stop(Request $request, Lesson $lesson)
    {
        if($request->isMethod('post')){
            //给课时做启用、停用操作
            //$flag = 1;  //停用
            //$flag = 2;  //启动
            $flag = $request->input('flag');
            $val = Lesson::$IS_OK[$flag];

            if($lesson->update(['is_ok'=>$val])){
                return ['success'=>true];
            }else{
                return ['success'=>false];
            }
        }
    }

    /**
     * 添加课时
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            //验证
            $rules = [
                'lesson_name'=>'required',
                'course_id'=>'required',
            ];
            $notices = [
                'lesson_name.required' => '课时名称必填',
                'course_id.required' => '课程必选',
            ];
            //制作验证
            $validator = Validator::make($request->all(),$rules,$notices);
            if($validator->passes()){
                //数据存储
                Lesson::create($request->all());
                return ['success'=>true];
            }else{
                //验证失败，回传错误信息
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获取供选取的"课程"信息
        //$course = Course::get();
        $course = Course::pluck('course_name','course_id');

        return view('admin/lesson/tianjia',compact('course'));
    }

    /**
     * 实现视频上传
     * @param Request $request
     */
    public function up_video(Request $request)
    {
        //接收附件并存储到服务器上
        $file = $request->file('Filedata');  //文件流
        if($file->isValid()){
            $filename = $file -> store('video','public');
            //dd($rst);//二级目录和图片名字
            echo json_encode(['success'=>true,'filename'=>"/storage/".$filename]);
        }else{
            echo json_encode(['success'=>false]);
        }
        exit;//避免后续输出信息
    }

    /**
     * 实现封面图上传
     * @param Request $request
     */
    public function up_pic(Request $request)
    {
        //接收附件并存储到服务器上
        $file = $request->file('Filedata');  //文件流
        if($file->isValid()){
            $filename = $file -> store('lesson','public');
            //dd($rst);//二级目录和图片名字
            echo json_encode(['success'=>true,'filename'=>"/storage/".$filename]);
        }else{
            echo json_encode(['success'=>false]);
        }
        exit;//避免后续输出信息
    }

    /**
     * 播放视频
     * @param Request $request
     * @param Lesson $lesson
     */
    public function play(Request $request,Lesson $lesson){
        return view('admin/lesson/play',compact('lesson'));
    }

    public function xiugai(Request $request, Lesson $lesson)
    {
        //其中$lesson是控制反转
        //使用的各种门面 Auth/Session/Input/Config等等
        //Student::

        if($request->isMethod('post')){
            //验证
            $rules = [
                'lesson_name'=>'required',
                'course_id'=>'required',
            ];
            $notices = [
                'lesson_name.required' => '课时名称必填',
                'course_id.required' => '课程必选',
            ];
            //制作验证
            $validator = Validator::make($request->all(),$rules,$notices);
            if($validator->passes()){
                //如果上传新图片，就删除旧图片，判断依据：表单图片路径名 与 数据库的不一致
                if($request->input('cover_img')!== $lesson->cover_img){
                    //删除
                    //去除文件的/storage/前缀
                    $filename = str_replace('/storage/','',$lesson->cover_img);
                    Storage::disk('public')->delete($filename);
                }

                //如果上传新视频，就删除旧视频，判断依据：表单图片路径名 与 数据库的不一致
                if($request->input('video_address')!== $lesson->video_address){
                    //删除
                    //去除文件的/storage/前缀
                    $filename = str_replace('/storage/','',$lesson->video_address);
                    Storage::disk('public')->delete($filename);
                }

                //修改数据
                $lesson->update($request->all());
                return ['success'=>true];
            }else{
                //验证失败，回传错误信息
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }
        //获取供选取的"课程"信息
        //$course = Course::get();
        $course = Course::pluck('course_name','course_id');
        return view('admin/lesson/xiugai',compact('lesson','course'));
    }

    /**
     * 批量删除数据
     * @param Request $request
     * @param $lesson_ids： 15,14 模样过来的
     */
    public function delall(Request $request)
    {
        if($request->isMethod('post')){
            $lesson_ids = $request->input('ids');//接收post表单提交过来的被删除的课时ids信息 15-14

            $z = Lesson::destroy($lesson_ids);//允许通过数组方式进行批量删除
            if($z){
                return ['success'=>true];
            }
            return ['success'=>false];
        }
    }
}

