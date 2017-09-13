<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paper extends Model
{
    protected $table = "paper";   //设置表名
    protected $primaryKey = "paper_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['course_id','paper_name','paper_score'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function question(){
        return $this -> hasMany('App\Http\Models\Question','paper_id','paper_id');
    }
}
