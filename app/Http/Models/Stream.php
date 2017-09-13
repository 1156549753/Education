<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    protected $table = "stream";   //设置表名
    protected $primaryKey = "stream_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['stream_name'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
