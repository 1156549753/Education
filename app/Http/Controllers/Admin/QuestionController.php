<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Paper;
use App\Http\Models\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index(Request $request,Paper $paper)
    {
        $info = $paper->question;
        //$info = Question::get();
        return view('admin/question/index',compact('info','paper'));
    }

    /**
     * 添加试题
     * @param Request $request
     * @param Paper $paper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tianjia(Request $request, Paper $paper)
    {
        if($request->isMethod('post')){
            $shuju = $request->all();
            //先计算该试题的正确答案(单选/多选)
            $shuju['qs_answer'] = array_sum($shuju['qs_answer']);
            //组织paper_id试卷到 试题的表单信息里边
            $shuju['paper_id']  = $paper->paper_id;
            //校验
            $rules = [
                'qs_name' => 'required',
                'qs_score' => 'required',
                'qs_answer' => ['regex:/^[1-9]|1[012345]$/'],
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'qs_remark' => 'required',
            ];
            $notices = [
                'qs_name.required' => "试题名称必填",
                'qs_score.required' => "试题分数必填",
                'qs_answer.regex'  => "试题答案必须设置",
                'option_a.required' => "试题名称选项A必填",
                'option_b.required' => "试题名称选项B必填",
                'option_c.required' => "试题名称选项C必填",
                'option_d.required' => "试题名称选项D必填",
                'qs_remark.required' => "试题备注必填",
            ];
            //制作校验
            $validator = \Validator::make($shuju,$rules,$notices);
            if($validator->passes()){
                //给数据存储数据
                Question::create($shuju);
                return ['success'=>true];
            }else{
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
            //收集数据入库
        }
        return view('admin/question/tianjia',compact('paper'));
    }
}

