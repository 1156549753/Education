<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ordercourse extends Model
{
    protected $table = "order_course";   //设置表名
    protected $primaryKey = "id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['order_id','course_id','course_price'];

}

