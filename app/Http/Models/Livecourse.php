<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livecourse extends Model
{
    //给启用、停用设置标志，下述停用、启用信息与数据表要求完全一致
    public static $IS_OK = [1=>'停用',2=>'启用'];


    protected $table = "live_course";   //设置表名
    protected $primaryKey = "id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['name','stream_id','cover_img','start_at','end_at','desc'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function stream()
    {
        return $this->hasOne('App\Http\Models\Stream','stream_id','stream_id');
    }

    /**
     * 根据当前时间判断，该直播课程是否允许直播
     */
    public function is_play_by_time()
    {
        //$this关键字：代表调用该方法的当前对象
        $nowtime = time(); //当前时间(时间戳)
        if($nowtime>=$this->start_at && $nowtime<=$this->end_at){
            return 1;
        }
        return 0;
    }
}

