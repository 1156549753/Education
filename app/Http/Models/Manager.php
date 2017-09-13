<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


//该模型同时兼顾 用户名 和 密码 校验工作，因此要去继承
class Manager extends Authenticatable
{
    protected $table = "manager";   //设置表名
    protected $primaryKey = "mg_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['username','password','mg_role_ids','mg_sex','mg_phone','mg_email','mg_remark','mg_pic'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * 建立 与 Role的1对1关系
     */
    public function role()
    {
        return $this->hasOne('App\Http\Models\Role','role_id','mg_role_ids');
    }
}


