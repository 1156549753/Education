<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    protected $table = "student";   //设置表名
    protected $primaryKey = "std_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['std_name','password','std_phone','std_email','std_sex','std_desc','std_birthday','std_pic','qq_id'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}












