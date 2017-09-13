<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    protected $table = "course";   //设置表名
    protected $primaryKey = "course_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['course_name','pro_id','cover_img','course_desc','course_price'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * 建立与专业的1对1的关系
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profession()
    {
        return $this->hasOne('App\Http\Models\Profession','pro_id','pro_id');
    }

    /**
    *  建立[课程 课时] 的1对多关系
    */
    public function lesson(){
        return $this->hasMany('App\Http\Models\Lesson','course_id','course_id');
    }


}