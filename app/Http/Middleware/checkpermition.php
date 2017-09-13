<?php

namespace App\Http\Middleware;

use Closure;

class checkpermition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        echo "I am checkpermition 中间件";
        //判断请求是否满足条件
        //if(满足条件){
            return $next($request); //继续执行
        //}else{
            //不满足条件
            //return redirect()->route('login');  //跳转
            //route('login');  使用函数制作login名字对应的请求地址出来
            //url('admin/manager/login')
            //或
            //exit('停止执行');
        //}

    }
}
