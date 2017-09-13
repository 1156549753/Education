<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Permission;
use App\Http\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * 列表展示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //获得角色列表信息
        $info = Role::get();

        return view('admin/role/index',compact('info'));
    }

    /**
     * 修改角色
     * @param Request $request
     * @param Role $role
     */
    public function xiugai(Request $request,Role $role)
    {
        if($request->isMethod('post')){
            //角色名称校验:必填、不能重复
            $rules = [
                'role_name'=>'required|unique:role,role_name,'.$role->role_id.',role_id',
            ];
            $notices = [
                'role_name.required'=>'名称必填',
                'role_name.unique'=>'名称重复',
            ];
            //制作校验
            $validator = \Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //给角色修改信息：角色名称、权限的ids、权限的ac
                $role_name = $request->input('role_name');
                $role_permission_ids = implode(',',$request->input('quanxian'));
                $role_permission_ac = Permission::whereIn('ps_id',$request->input('quanxian'))
                    ->select(\DB::raw('concat(ps_c,"-",ps_a) as jie'))
                    ->where('ps_level','1')
                    ->pluck('jie');  //collection(arr[c-a,c-a,c-a..])

                //把收集的控制器-操作方法 变为字符串信息
                //collection(arr[c-a,c-a,c-a..])-->c-a,c-a,c-a...
                $permission_ac = implode(',',$role_permission_ac->toArray());

                $role->update([
                    'role_name'=>$role_name,
                    'role_permission_ids'=>$role_permission_ids,
                    'role_permission_ac'=>$permission_ac,
                ]);
                return ['success'=>true];
            }else{
                //获取校验的错误信息
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获得用于分配的真实的权限信息，一级、二级分别获取
        $permissionA = Permission::where('ps_level','0')->get();
        $permissionB = Permission::where('ps_level','1')->get();

        return view('admin/role/xiugai',compact('role','permissionA','permissionB'));
    }
}

















