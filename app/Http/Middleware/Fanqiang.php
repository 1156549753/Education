<?php

namespace App\Http\Middleware;

use Closure;

class Fanqiang
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
        //获取登录系统管理员的信息
        $admin_id   = \Auth::guard('admin')->user()->mg_id;
        $admin_name = \Auth::guard('admin')->user()->username;

        //"非root" 超级管理员才进行翻墙访问权限校验
        if($admin_name!='root'){
            //"判断"管理员是否有权利访问当前的请求
            //① 获得当前请求的“控制器-操作方法”
            $nowCA = getCurrentControllerName()."-".getCurrentMethodName();
            //② 获得当前管理员本身具备的访问权限 "控制器-操作方法,控制器-操作方法..."
            $roleinfo = \DB::table('manager as m')
                ->join('role as r','r.role_id','=','m.mg_role_ids')
                ->where('m.mg_id',$admin_id)
                ->select('r.role_permission_ac')
                ->first();
            $haveCA = $roleinfo->role_permission_ac; //提取具备的权限"控制器-操作方法"信息

            //③ 判断① 在②中是否存在，存在可以继续访问，否则停止请求
            if(strpos($haveCA,$nowCA)===false){
                exit('您没有权限访问');
            }
        }
        return $next($request);  //继续后续代码执行
    }
}
