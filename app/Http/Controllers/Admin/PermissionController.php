<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * 列表展示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //获得权限的数据，并转为二维数组
        $info = Permission::get()->toArray();

        $info = generateTree($info);  //给权限数据做上下级排序

        return view('admin/permission/index',compact('info'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            //检验数据
            $rules = [
                'ps_name' => 'required',
            ];
            $notices = [
                'ps_name.required' => '权限名称必填',
            ];
            $validator = \Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //处理ps_level等级(0/1)
                $shuju = $request->all();
                $shuju['ps_level'] = $shuju['ps_pid']==0 ? '0' : '1';
                Permission::create($shuju);
                return ['success'=>true];
            }else{
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }
        //获得可供选取的父权限
        $permissionA = Permission::where('ps_level','0')->pluck('ps_name','ps_id');
        return view('admin/permission/tianjia',compact('permissionA'));
    }
}
















