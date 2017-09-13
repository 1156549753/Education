<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * 后台首页面
     */
    public function index()
    {
        //dd(Auth::guard('admin')->user()->username);

        // $info = \DB::table('lesson')->get();
        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
        // exit;

        //获得当前登录系统管理员对应的全部的权限信息
        $mg_id = \Auth::guard('admin')->user()->mg_id;
        //获得角色的信息
        $roleinfo = \DB::table('manager as m')->
            //join('role as r',主表联系字段,'=',当前表联系字段)
            join('role as r','m.mg_role_ids','=','r.role_id')->
            select('role_permission_ids')->
            where('m.mg_id',$mg_id)->
            first();
        //dd($roleinfo);

        try{
            //③ 有正确分配角色的普通管理员
            $permission_ids = explode(',',$roleinfo->role_permission_ids);
            //dd($permission_ids);    //["101,104,102,107"]
            //根据$permission_ids获得全部的权限信息
            //一级的
            $permissionA = \DB::table('permission')->
                whereIn('ps_id',$permission_ids)->
                where('ps_level','0')->
                get();
            //二级的
            $permissionB = \DB::table('permission')->
                whereIn('ps_id',$permission_ids)->
                where('ps_level','1')->
                get();

        }catch(\Exception $e){
            if($mg_id==3){
                //① 超级管理员[全部权限]
                //一级的
                $permissionA = \DB::table('permission')->
                    where('ps_level','0')->
                    get();
                //二级的
                $permissionB = \DB::table('permission')->
                    where('ps_level','1')->
                    get();
            }else{
                //② 未分配角色的普通管理员[0个权限]
                $permissionA = [];
                $permissionB = [];
            }
        } 
        return view('admin/index/index',compact('permissionA','permissionB'));
    }

    /**
     * 后台首页面-右侧部分
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('admin/index/welcome');
    }
}
