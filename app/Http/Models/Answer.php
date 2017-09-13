<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    protected $table = "answer";   //设置表名
    protected $primaryKey = "answer_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['paper_id','qs_id','std_id','answer_result',
        'answer_score','right_wrong'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
