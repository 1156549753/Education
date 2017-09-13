<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    protected $table = "profession";   //设置表名
    protected $primaryKey = "pro_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['pro_name','teacher_ids','pro_desc','cover_img','carousel_imgs'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
