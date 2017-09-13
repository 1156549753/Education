<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $table = "permission";   //设置表名
    protected $primaryKey = "ps_id";//设置主键


    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['ps_name','ps_pid','ps_c','ps_a','address','ps_level'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}

