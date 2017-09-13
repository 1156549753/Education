<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class StudentController extends Controller
{

    /**
     * 给学员发送短信
     * @param Request $request
     */
    public function sms(Request $request)
    {
        if($request->isMethod('post')){
            $config = [
                'accessKeyId'    => 'LTAIstDir8I9DcWX',
                'accessKeySecret' => 'pdIOHDbsYgJKc9ZJY0ZF7UsbRDKk1m',
            ];
            $client  = new Client($config);
            $sendSms = new SendSms;
            $mobile = $request->input('mobile');  //手机号码
            $sendSms->setPhoneNumbers($mobile);
            $sendSms->setSignName('万马奔腾');
            $sendSms->setTemplateCode('SMS_87235011');
            $code = rand(100000, 999999);   //短信验证码，
            \Session::put('shouji_code',$code); //同时要存储给session，用于后期判断
            $time = 5;                      //验证的有效期时间
            $sendSms->setTemplateParam(['code' => $code,'time'=>$time]);
            $sendSms->setOutId('demo'.time());  //发送短信序号

            $rst = $client->execute($sendSms);
            if($rst->Message == 'OK'){
                return ['success'=>true];   //短信发送成功
            }else{
                return ['success'=>false];
            }
        }
    }

    /**
     * QQ登录
     * 作用：弹出qq登录的窗口，同时要识别出来当前系统哪个qq可以登录系统
     * @param Request $request
     */
    public function qqlogin(Request $request)
    {
        //获得本机登陆的qq信息 或 提示用户名/密码登陆
        return Socialite::driver('qq')->redirect();
    }

    /**
     * QQ登录后的回调处理
     * 用于完成QQ登录的处理逻辑
     * @param Request $request
     */
    public function qqlogin_back(Request $request)
    {
        //获得当前登录QQ账号的相关信息
        $user = Socialite::driver('qq')->user();
        //dd($user);
        $qq_id      = $user -> getId();
        $qq_name    = $user -> getName();

        //把获得到的$user qq信息维护到student数据表中
        //判断该qq账号之前是否有登录
        $qqStudent = Student::where('qq_id',$qq_id)->first(); //Object有记录 / null没有记录
        if($qqStudent===null){
            //新qq第一次登录，执行insert操作
            $data['std_name']   = $qq_name;
            $data['password']   = bcrypt('');
            $data['std_email']  = '';
            $data['std_phone']  = '';
            $data['qq_id']      = $qq_id;
            $data['std_name']   = $qq_name;
            $qqStudent = Student::create($data);      //返回新记录对应的模型对象
        }else{
            //该qq已经登录过，执行update操作
            $data['std_name']   = $qq_name;
            $qqStudent -> update($data);
            //Student::where('qq_id',$qq_id)->update($data);
        }

        //对登录账号信息进行session持久化操作
        \Auth::guard('home')->attempt(['std_id'=>$qqStudent->std_id,'password'=>'']);
        //\Auth::guard('home')->login($qqStudent);  //给当前$qqStudent模型对象进行session持久化操作

        //关闭qq弹窗，同时页面跳转到"首页"
        echo <<<eof
        <script type="text/javascript">
            window.opener.location.href="/";  //父页面跳转到首页,opener代表调用父页面
            window.close();//关闭弹窗
        </script>
eof;

    }
    
    /**
     * 学员登录
     */
    public function login(Request $request)
    {
        if($request->isMethod('post')){

            //判断手机号码是否正确
            $mobile_code = $request->input('mobile_code');  //收集用户输入的手机验证码
            $session_code = \Session::get('shouji_code'); //session的验证码

            if($mobile_code != $session_code){
                //用户输入的手机号码错误
                //页面回跳(登录页)
                return redirect('home/student/login')
                    ->withErrors(['mobile_code_error'=>'手机验证码错误'])
                    ->withInput();
            }

            $rules = [
                'std_name'=>'required',
                'password'=>'required',
            ];
            $notices = [
                'std_name.required'=>'登录名必填',
                'password.required'=>'密码必填',
            ];
            $validator = \Validator::make($request->all(),$rules,$notices);




            if($validator->passes()){
                //用户名密码校验
                //['std_name'=>'xxx','password'=>'xxxx']
                $name_pass = $request->only(['std_name','password']);

                if(\Auth::guard('home')->attempt($name_pass)){
                    //用户名、密码正确
                    //return redirect('/');
                    return redirect()->intended();
                }else{
                    //页面回跳(登录页)
                    return redirect('home/student/login')
                        ->withErrors(['errorinfo'=>'用户名或密码错误'])
                        ->withInput();
                }
            }else{
                //页面回跳(登录页)
                return redirect('home/student/login')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        return view('home.student.login');
    }

    /**
     * 用户退出系统
     */
    public function logout(){
        \Auth::guard('home')->logout();
        return redirect('/');
    }
}

