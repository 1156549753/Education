<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Paper;
use App\Http\Models\Question;
use App\Http\Models\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * 展示答卷子页面、收集卷子存储答案入库
     * @param Request $request
     * @param Paper $paper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(Request $request, Paper $paper)
    {
        if($request->isMethod('post')){
            //收卷子，给答案
            $shuju = $request->all();
            foreach($shuju['answer_'] as $k => $v){
                //$k:每个试题的主键id值
                //$v:是数组类型，给的答案是该数组的各个元素值
                //组织数据对答案表进行填充
                $data['paper_id'] = $paper->paper_id;
                $data['qs_id'] = $k;
                $data['std_id'] = 112;
                $data['answer_result'] = array_sum($v);

                //制作试题的model对象
                $question = Question::find($k);
                //获得答题的结果情况，以数组形式返还['score'=>5,'right'=>'半对']
                $result_qingkuang = $question->fetchExamResult($data['answer_result']);

                $data['answer_score'] = $result_qingkuang['score'];
                $data['right_wrong']  = $result_qingkuang['right'];

                //把上边组织好的信息填充到答案表中
                \DB::table('answer')->insert($data);
            }
            //页面跳转到答案页面
            //return redirect('home/exam/result',['paper'=>$paper->paper_id]);
            echo "提交成功";
            exit;
        }

        //获取"单选"试题信息
        $dan_info = Question::where('qs_type','单选')->get();
        //获取"多选"试题信息
        $duo_info = Question::where('qs_type','多选')->get();

        return view('home/exam/run',compact('dan_info','duo_info','paper'));
    }


    public function result(Request $request, Paper $paper)
    {
        //获取当前学员、当前试卷的总分数信息
        $total_score = Answer::where('std_id',112)
            ->where('paper_id',$paper->paper_id)
            ->sum('answer_score');

        //获得"试题"及该学员的"答案"相关信息
        //① 单选试题
        $dan_info = Question::where('qs_type','单选')
            ->with(['answer'=>function($an){
                //给关系设置限定条件
                $an->where('std_id',112);
            }])
            ->get();
        //② 多选试题
        $duo_info = Question::where('qs_type','多选')
            ->with(['answer'=>function($an){
                //给关系设置限定条件
                $an->where('std_id',112);
            }])
            ->get();

        return view('home/exam/result',compact('paper','dan_info','duo_info','total_score'));
    }

}


