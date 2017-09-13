<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//匿名函数function还成为"闭包"
//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', 'Home\IndexController@index');

//Route::get('abc/edf/ddd', 'Home\IndexController@index');
//Route::post('abc', 'Home\IndexController@index');
//Route::match(['get','post'],'abc','Home\IndexController@index');
//Route::any('abc','Home\IndexController@index');
//Route::get('home/index/index','Home\IndexController@index');

//前台首页面--首页
Route::get('/','Home\IndexController@index');

//前台个人中心--播放直播课程
Route::get('live/{stream}','Home\VideoController@play');

Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
    //QQ登录
    Route::get('student/qqlogin','StudentController@qqlogin');
    Route::get('student/qqlogin_back','StudentController@qqlogin_back');
    //发送短信
    Route::post('student/sms','StudentController@sms');

    //超市管理--添加课程到购物车
    Route::get('shop/cart_tianjia/{course}','ShopController@cart_tianjia');
    //超市管理--展示购物车信息)
    Route::get('shop/cart_account','ShopController@cart_account');
    //超市管理--购物车结算
    Route::get('shop/cart_jiesuan','ShopController@cart_jiesuan');
    //超市管理--支付完成
    Route::get('shop/cart_complete','ShopController@cart_complete');





    //学员管理--登录
    Route::match(['get','post'],'student/login','StudentController@login');
    //学员管理--退出
    Route::get('student/logout','StudentController@logout');

    //前台个人中心--课程展示
    Route::get('person/course','PersonController@course');

    //前台个人中心--播放直播课程
    // Route::get('video/play/{stream}','VideoController@play');

    //课程管理--详情
    Route::get('course/detail/{course}','CourseController@detail');

    //答卷管理--进行答卷..
    Route::match(['get','post'],'exam/run/{paper}','ExamController@run');


    //答卷管理--查看答题结果
    Route::get('exam/result/{paper}','ExamController@result');

});


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台管理员--登录
    Route::match(['get','post'],'manager/login','ManagerController@login')->name('login');
    Route::group(['middleware'=>['auth:admin']],function(){
        //后台管理员--退出
        Route::get('manager/logout','ManagerController@logout');
        //后台--首页面
        Route::get('index/index','IndexController@index');
        //后台--首页面(右侧部分)
        Route::get('index/welcome','IndexController@welcome');

        //设置使用“fanqiang”中间件的路由
        Route::group(['middleware'=>['fanqiang']],function(){

            //试卷管理--列表展示
            Route::get('paper/index','PaperController@index');

            //试题管理--列表展示
            Route::get('question/index/{paper}','QuestionController@index');
            //试题管理--添加
            Route::match(['get','post'],'question/tianjia/{paper}','QuestionController@tianjia');


            //后台管理员--列表
            Route::get('manager/showlist','ManagerController@showlist');
            //后台管理员--添加
            Route::match(['get','post'],'manager/tianjia','ManagerController@tianjia');
            //后台管理员--修改
            Route::match(['get','post'],'manager/xiugai/{manager}','ManagerController@xiugai');
            //后台管理员--删除
            Route::post('manager/del/{manager}','ManagerController@del');
            //后台管理员--处理附件
            Route::post('manager/up_pic','ManagerController@up_pic');


            //课时管理--列表
            Route::match(['get','post'],'lesson/index','LessonController@index');
            //课时管理--停用操作
            Route::post('lesson/start_stop/{lesson}','LessonController@start_stop');
            //课时管理--添加
            Route::match(['get','post'],'lesson/tianjia','LessonController@tianjia');
            //课时管理--上传视频
            Route::post('lesson/up_video','LessonController@up_video');
            //课时管理--上传封面图
            Route::post('lesson/up_pic','LessonController@up_pic');
            //课时管理--播放视频
            Route::get('lesson/play/{lesson}','LessonController@play');
            //课时管理--修改
            Route::match(['get','post'],'lesson/xiugai/{lesson}','LessonController@xiugai');
            //课时管理--批量删除
            Route::post('lesson/delall','LessonController@delall');

            //直播流--添加
            Route::match(['get','post'],'stream/tianjia','StreamController@tianjia');
            //直播流--列表显示
            Route::get('stream/index','StreamController@index');
            //直播流--删除
            Route::post('stream/del/{stream}','StreamController@del');

            //直播课程--添加
            Route::match(['get','post'],'livecourse/tianjia','LivecourseController@tianjia');
            //直播课程--列表显示
            Route::get('livecourse/index','LivecourseController@index');
            //直播课程--删除
            Route::post('livecourse/del/{livecourse}','LivecourseController@del');

            //直播课程--获得推流地址
            Route::get('livecourse/getpush/{stream}/{livecourse}','LivecourseController@getpush');


            //角色管理--列表显示
            Route::get('role/index','RoleController@index');
            //角色管理--修改(分配权限)
            Route::match(['get','post'],'role/xiugai/{role}','RoleController@xiugai');


            //权限管理--列表显示
            Route::get('permission/index','PermissionController@index');
            //权限管理--添加
            Route::match(['get','post'],'permission/tianjia','PermissionController@tianjia');
        });

    });
});



















