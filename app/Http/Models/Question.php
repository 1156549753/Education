<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    //设计各个试题的答案(abcd四种答案的排序组合)
    public static $QUESTION_ANSWER = [
        1=>'A',
        2=>'B',
        3=>'AB',
        4=>'C',
        5=>'AC',
        6=>'BC',
        7=>'ABC',
        8=>'D',
        9=>'AD',
        10=>'BD',
        11=>'ABD',
        12=>'CD',
        13=>'ACD',
        14=>'BCD',
        15=>'ABCD',
    ];

    protected $table = "question";   //设置表名
    protected $primaryKey = "qs_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['paper_id','qs_name','qs_score','qs_type',
        'option_a','option_b','option_c','option_d','qs_answer','qs_remark'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * 根据用户答案 和 本身题目的正确答案 给用户答题返回正确与否信息
     * @param $daan 用户提交答案
     */
    public function fetchExamResult($daan)
    {
        //$this: 当前被对比的小question对象
        //$daan:用户提交答案
        //$this->qs_answer: 本题的正确答案
        if((($this->qs_answer & $daan) == $daan) && (($this->qs_answer & $daan) == $this->qs_answer)){
            //全对
            return ['score'=>$this->qs_score,'right'=>'对'];
        }elseif(($this->qs_answer & $daan) == $daan){
            //半对
            return ['score'=>$this->qs_score/2,'right'=>'半对'];
        }else{
            //错
            return ['score'=>0,'right'=>'错'];
        }
    }

    /**
     * 建立与answer答案模型的关系
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function answer()
    {
        return $this->hasOne('App\Http\Models\Answer','qs_id','qs_id');
    }
}
















