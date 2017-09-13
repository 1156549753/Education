<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/home/img/asset-favicon.ico">
    <title>在线教育网</title>
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="/home/css/page-learing-sign.css" />
</head>

<body>
    <!-- 页面 -->
    <div class="register">
        <div class="register-head">
            <div class="wrap">
                <a href="javascript:;" class="logo">
                <img src="/home/img/asset-logoico.png" alt="logo" width="200">
            </a>
                <div class="go-regist" style="position: absolute;border-bottom: 10px;">还没有账号？<a href="#">去注册</a></div>
            </div>
        </div>
        <div class="register-body">
            <div class="register-cent">
                <img src="/home/img/asset-login_img.jpg" alt="" class="register-ico">
<form class="required-validate" id="regStudentForm" method='post' 
    action="{{url('home/student/login')}}">

    {{csrf_field()}}
    <ul class="r-position login">
        <li>
            <div class="page-header">
                <h3>欢迎登录在线教育</h3>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">登录名：</label>
                <div class="">
                    <input type="text" class="form-control" name="std_name" placeholder="请输入登录名" value="{{old('std_name')}}" />
                    <span class="verif-span">请输入5-25个字符</span>
                    <span style='color:red'>{{$errors->first('std_name')}}</span>
                </div>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">密码</label>
                <div class="">
                    <input type="password" class="form-control" name="password" placeholder="请输入密码" value="{{old('password')}}">
                    <span class="verif-span">请输入6-16个字符</span>
                    <span style='color:red'>{{$errors->first('password')}}</span>
                </div>
            </div>
        </li>

        <li>
            <div class="form-group">
                <label class="control-label">手机号码</label>
                <div class="">
                    <input type="text" class="form-control" name="mobile" placeholder="请输入手机" value="{{old('mobile')}}">
                    <input type="button" value="发送短信" onclick="send_sms()" />
                    <input type="text" class="form-control" name="mobile_code" placeholder="请输入验证码" value="{{old('mobile_code')}}">
                    <span id="send_result" style='color:blue'></span>
                    <span style='color:red'>{{$errors->first('mobile_code_error')}}</span>
                </div>
            </div>
        </li>
        <script type="text/javascript">
            function send_sms(){
                //获得手机号码
                var mobile = $('[name=mobile]').val();

                //发送ajax
                $.ajax({
                    url:"{{url('home/student/sms')}}",
                    data:'mobile='+mobile,
                    dataType:'json',
                    type:'post',
                    'headers': {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },
                    success:function(msg){
                        if(msg.success===true){
                            $('#send_result').html('短信发送成功');
                        }else{
                            $('#send_result').html('短信发送失败');
                        }
                    }
                });
            }
        </script>

        <li>
            <div style='color:red'>{{$errors->first('errorinfo')}}</div>
        </li>
        <li class="">
            <button name="login" type="submit" class="btn btn-primary">登录</button>
        </li>

        <script type="text/javascript">
            function open_qq(){
                //新建窗口
                window.open("{{url('home/student/qqlogin')}}",'QQ_login',"width=450,height=320");
            }
            </script>

        <li><img src="/home/img/QQ.png" alt="" onclick="open_qq()"></li>

    </ul>
</form>
            </div>
        </div>
        <div class="register-footer">
            <!--底部版权-->
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div>
                                <!--<h1 style="display: inline-block">学成网</h1>--><img src="/home/img/asset-logoIco.png" alt=""></div>
                            <div>学成网致力于普及中国最好的教育它与中国一流大学和机构合作提供在线课程。</div>
                            <div>© 2017年XTCG Inc.保留所有权利。-沪ICP备15025210号</div>
                            <input type="button" class="btn btn-primary" value="下 载" />
                        </div>
                        <div class="col-lg-5 row">
                            <dl class="col-lg-4">
                                <dt>关于学成网</dt>
                                <dd>关于</dd>
                                <dd>管理团队</dd>
                                <dd>工作机会</dd>
                                <dd>客户服务</dd>
                                <dd>帮助</dd>
                            </dl>
                            <dl class="col-lg-4">
                                <dt>新手指南</dt>
                                <dd>如何注册</dd>
                                <dd>如何选课</dd>
                                <dd>如何拿到毕业证</dd>
                                <dd>学分是什么</dd>
                                <dd>考试未通过怎么办</dd>
                            </dl>
                            <dl class="col-lg-4">
                                <dt>合作伙伴</dt>
                                <dd>合作机构</dd>
                                <dd>合作导师</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <!-- 页面 css js -->
    <script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>

</body>