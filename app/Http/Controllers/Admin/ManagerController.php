<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * 上传附件处理
     * @param Request $request
     */
    public function up_pic(Request $request)
    {
        //接收附件并存储到服务器上
        $file = $request->file('Filedata');  //文件流
        if($file->isValid()){
            $filename = $file -> store('manager','public');
            //dd($rst);//二级目录和图片名字
            echo json_encode(['success'=>true,'filename'=>"/storage/".$filename]);
        }else{
            echo json_encode(['success'=>false]);
        }
        exit;//避免后续输出信息
    }

    /**
     * @return string
     * 管理员登录
     */
    public function login(Request $request)
    {
        if($request->isMethod('post')){

            //用户名和密码 非空 校验
            //验证码非空、正确 校验
            $rules = [
                'username' => 'required',
                'password' => 'required',
                'verify_code' => 'required|captcha',
            ];
            $notices = [
                'username.required' => '用户名必填',
                'password.required' => '密码必填',
                'verify_code.required' => '验证码必填',
                'verify_code.captcha' => '验证码不正确',
            ];

            //制作验证
            $validator = Validator::make($request->all(),$rules,$notices);
            //判断验证
            if($validator->passes()){
                //去数据库校验用户名和密码
                $name = $request->input('username');
                $pwd  = $request->input('password');
                //Auth限定使用的guard，并调用attempt()方法校验用户名和密码
                if(Auth::guard('admin')->attempt(['username'=>$name,'password'=>$pwd])){
                    return redirect('admin/index/index');
                }else{
                    return redirect('admin/manager/login')
                        ->withErrors(['errorinfo'=>'用户名或密码错误'])
                        ->withInput();
                }
            }else{
                //调回到之前的login登录页面，同时把相关的错误信息 和 用户输入信息返回
                return redirect('admin/manager/login')
                        ->withErrors($validator)
                        ->withInput();
            }
        }else{
            return view('admin/manager/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('admin/manager/login');
    }

    /**
     * @return string
     * 管理员列表
     */
    public function showlist()
    {
        //$info = Manager::groupBy('mg_sex')->get();
//        $info = Manager::groupBy('mg_sex')->select(DB::raw('mg_sex,count(*) as cnt'))->get();
//        dd($info);
//        //设置session
//        Session::put('local','127.0.0.1');
//        Session::put('port',11277);
//
//        //一次性session
//        Session::flash('school','itcast');

//        dd(Manager::where('mg_id','>',3)->count());
//        dd(Manager::where('mg_id','>',3)->sum('mg_id'));
//        dd(Manager::where('mg_id','>',3)->avg('mg_id'));
//        dd(Manager::where('mg_id','>',3)->max('mg_id'));
//        dd(Manager::where('mg_id','>',3)->min('mg_id'));

//Manager::select('mg_id','username')->get();
////select `mg_id`, `username` from `qz_manager` where `qz_manager`.`deleted_at` is null
//Manager::select('mg_id','username')->where('mg_id','>=',2)->get();
////select `mg_id`, `username` from `qz_manager` where `mg_id` >= '2' and `qz_manager`.`deleted_at` is null
//Manager::select('mg_id','username')->where('mg_id','>=',2)->where('mg_email','like','fu%')->get();
////select `mg_id`, `username` from `qz_manager` where `mg_id` >= '2' and `mg_email` like 'fu%' and `qz_manager`.`deleted_at` is null
//Manager::select('mg_id','username')->where('mg_id','>=',7)->orWhere('mg_id','<',5)->get();
////select `mg_id`, `username` from `qz_manager` where (`mg_id` >= '7' or `mg_id` < '5') and `qz_manager`.`deleted_at` is null
//Manager::select('mg_id','username')->orderBy('mg_id','desc')->get();
////select `mg_id`, `username` from `qz_manager` where `qz_manager`.`deleted_at` is null order by `mg_id` desc
//Manager::orderBy('mg_id','desc')->select('mg_id','username')->get();
////select `mg_id`, `username` from `qz_manager` where `qz_manager`.`deleted_at` is null order by `mg_id` desc
//Manager::offset(5)->limit(3)->get();
////select * from `qz_manager` where `qz_manager`.`deleted_at` is null limit 3 offset 5

        //Manager::groupBy('mg_sex')->select('count(*)')->get();

        //获取管理员列表
        //Manager::get(); //全部数据
        //Manager::first();//获得一条数据
        //Manager::find(数字/数组);//根据主键为条件获得纪录
        //$info = Manager::get();
        //$info = Manager::first();

        //$info = Manager::with('role')->get();
        //制作数据分页
        $info = Manager::with('role')->paginate(3);
        //$info = Manager::with('role')->simplePaginate(3);
        //dd($info);
        return view('admin/manager/showlist',['info'=>$info]);
    }

    /**
     * @return string
     * 管理员添加
     * 两个作用：① 展示添加表单 ②
     */
    public function tianjia1(Request $request)
    {
        //读取session
//        dd(Session::get('local'));
//        dd(Session::get('port'));
//
//        dd(Session::get('school'));

        if($request->isMethod('post')){
            //收集数据，存储入库
            //var_dump($request -> all());
            //$shuju = $request -> except(['_token']);
            //① 添加方式
            //$obj = new Manager();
            //$obj -> username = $request->input('username');
            //$obj -> password = $request->input('password');
            //$obj -> mg_email = $request->input('mg_email');
            //...
            //$obj -> save();

            //② create()方法添加
            $shuju = $request->all();
            $shuju['password'] = bcrypt($shuju['password']);//加密处理
            if(Manager::create($shuju)){
                return ['success'=>true];  //array()  会返回json格式，自动json转化
            }else{
                return ['success'=>false];  //array()
                //return array('success'=>true);
            }
        }else{
            //展示添加管理员的表单效果
            $name = "tom";
            $age = 50;
            $title = "<a href='http://www.baidu.com'>百度</a>";

            $color = ['c1'=>'red','c2'=>'blue','c3'=>'yellow','c4'=>'pink'];
            //return view('admin/manager/tianjia',['name'=>$name,'age'=>$age,'title'=>$title]);
            return view('admin/manager/tianjia',compact('name','age','title','color'));
        }
    }

    /**
     * @return string
     * 管理员添加
     * 两个作用：① 展示添加表单 ②
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){

            //给收集的form表单信息实现表单验证
            //① 指定规则
            $rules = [
                'username'=>'required|unique:manager,username|min:4|max:12',
                'password'=>'required|confirmed',
                'mg_email'=>'required|email',
                'mg_phone'=>['required','regex:/^1[35]\d{9}$/'],
            ];
            //② 制作错误提示
            $notices = [
                'username.required' =>'用户名必须填写',
                'username.unique' =>'用户名被占用',
                'username.min' =>'用户名长度不能小于4个字符',
                'username.max' =>'用户名长度不能大于12个字符',
                'password.required' => '密码必须填写',
                'password.confirmed' => '两次输入密码必须一致',
                'mg_email.required' => '邮箱必须填写',
                'mg_email.email' => '邮箱格式不正确',
                'mg_phone.required' => '手机号码必须填写',
                'mg_phone.regex' => '手机号码格式不正确',
            ];

            //③ 开始校验
            $validator = Validator::make($request->all(),$rules,$notices);


            if($validator->passes()){
                //校验成功
                $shuju = $request->all();
                $shuju['password'] = bcrypt($shuju['password']);//加密处理
                Manager::create($shuju);
                return ['success'=>true];
            }else{
                //校验失败
                //获取校验的错误信息
                //var_dump($validator->messages());
                //var_dump(collect($validator->messages()));
                //验证的所有项目错误信息集合为大的字符串
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }else{
            //展示添加管理员的表单效果
            return view('admin/manager/tianjia');
        }
    }

    /**
     * 实现管理员数据修改
     * @param Request $request
     * @param Manager $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function xiugai(Request $request,Manager $manager){
        
        Session::forget('local');

        if($request->isMethod('post')){
            //收集数据，存储入库
            $shuju = $request -> all();
            $rst = $manager -> update($shuju);  //会返回boolean值代表是否成功
            if($rst){
                return ['success'=>true];
            }else{
                return ['success'=>false];
            }
         }

        //修改表单展示
        return view('admin/manager/xiugai',['manager'=>$manager]);
    }

    function del(Manager $manager){
        $rst = $manager->delete();
        if($rst){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
}

