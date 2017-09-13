
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/home/img/asset-favicon.ico">
    <title>在线教育网</title>
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="/home/css/page-learing-course-answer.css" />
</head>

<body>
<!-- 页面头部 -->
<div class="learing-course">

    <div class="course-weeklist">
        <div class="nav nav-stacked">
            <div class="tit nav-justified text-center"><i class="pull-left glyphicon glyphicon-chevron-left"></i>第一周软件安装 <i class="pull-right">1/4</i></div>
            <li><i class="glyphicon glyphicon-check"></i>分级政策细分 <span>视</span></li>
            <li><i class="glyphicon glyphicon-unchecked"></i>为什么分为A、B、C部分</li>
            <li><i class="glyphicon glyphicon-unchecked"></i>软安装介绍</li>
            <li><i class="glyphicon glyphicon-unchecked"></i>Emacs安装 <span>阅</span></li>
        </div>
        <div class="course-nav">
            <div class="nav nav-stacked text-center">
                <li class="active">
                    <a href="" class="glyphicon glyphicon-user"></a>
                </li>
                <li>
                    <a href="" class="glyphicon glyphicon-list-alt"></a>
                </li>
                <li>
                    <a href="" class="glyphicon glyphicon-cog"></a>
                </li>
                <li>
                    <a href="" class="glyphicon glyphicon-log-out"></a>
                </li>
            </div>
        </div>
    </div>
    <div class="course-answer-cont col-lg-8">
        <div class="top text-center">
            <i class="glyphicon glyphicon-align-justify pull-left hv-poin"></i>
            < {{$paper->paper_name}}>
            <i class="glyphicon glyphicon-book pull-right"></i>
        </div>
        <div class="container">
            <div class="subtitle-cont">
                <div>
                    <div class="sum-up">得分：<i class="cl-red">{{$total_score}}分</i> 满分：100</div>
                    <div class="title">一、选择题：(单选)</div>

@foreach($dan_info as $v)
<li class="problem-choice">
{{$loop->iteration}}.{{$v->qs_name}}？（{{$v->qs_score}}）分
        @if($v->answer->right_wrong=='对')
            <div class="problem-tit"><i class="">√</i>不错
        @elseif($v->answer->right_wrong=='半对')
            <div class="problem-tit error"><i class="">乄</i>努力
        @else
             <div class="problem-tit error"><i class="">X</i>很遗憾
        @endif

        这个题你答【{{$v->answer->right_wrong}}】了 +{{$v->answer->answer_score}} 分
        <span class="pull-right"><div class="star"><div class="score" style="width: 31.4px;"><i>4</i></div></div></span></div>

<label><input type="radio" value="1" disabled="disabled"
    @if(($v->answer->answer_result & 1) ==1)
    checked="checked"
    @endif
    > A:{{$v->option_a}};</label>
<label><input type="radio" value="2" disabled="disabled"
    @if(($v->answer->answer_result & 2) ==2)
    checked="checked"
    @endif
    > B:{{$v->option_b}};</label>
<label><input type="radio" value="4" disabled="disabled"
    @if(($v->answer->answer_result & 4) ==4)
    checked="checked"
    @endif
    > C:{{$v->option_c}};</label>
<label><input type="radio" value="8" disabled="disabled"
    @if(($v->answer->answer_result & 8) ==8)
    checked="checked"
    @endif
    > D:{{$v->option_d}};</label>
<div class="problem-explain">

    <div>您的答案：{{\App\Http\Models\Question::$QUESTION_ANSWER[$v->answer->answer_result]}}</div>
    <div class="correct">正确答案：{{\App\Http\Models\Question::$QUESTION_ANSWER[$v->qs_answer]}}</div>
    <div class="explain">
        函数运行题
    </div>
</div>
</li>
@endforeach

                    
                    <div class="title">二、选择题：(多选)</div>
@foreach($duo_info as $v)
    <li class="problem-choice">
        {{$loop->iteration}}.{{$v->qs_name}}？（{{$v->qs_score}}）分
        @if($v->answer->right_wrong=='对')
            <div class="problem-tit"><i class="">√</i>不错
                @elseif($v->answer->right_wrong=='半对')
                    <div class="problem-tit error"><i class="">乄</i>努力
                        @else
                            <div class="problem-tit error"><i class="">X</i>很遗憾
                                @endif

                                这个题你答【{{$v->answer->right_wrong}}】了 +{{$v->answer->answer_score}} 分
                                <span class="pull-right"><div class="star"><div class="score" style="width: 31.4px;"><i>4</i></div></div></span></div>

                            <label><input type="checkbox" value="1" disabled="disabled"
                                          @if(($v->answer->answer_result & 1) ==1)
                                          checked="checked"
                                        @endif
                                > A:{{$v->option_a}};</label>
                            <label><input type="checkbox" value="2" disabled="disabled"
                                          @if(($v->answer->answer_result & 2) ==2)
                                          checked="checked"
                                        @endif
                                > B:{{$v->option_b}};</label>
                            <label><input type="checkbox" value="4" disabled="disabled"
                                          @if(($v->answer->answer_result & 4) ==4)
                                          checked="checked"
                                        @endif
                                > C:{{$v->option_c}};</label>
                            <label><input type="checkbox" value="8" disabled="disabled"
                                          @if(($v->answer->answer_result & 8) ==8)
                                          checked="checked"
                                        @endif
                                > D:{{$v->option_d}};</label>
                            <div class="problem-explain">

                                <div>您的答案：{{\App\Http\Models\Question::$QUESTION_ANSWER[$v->answer->answer_result]}}</div>
                                <div class="correct">正确答案：{{\App\Http\Models\Question::$QUESTION_ANSWER[$v->qs_answer]}}</div>
                                <div class="explain">
                                    函数运行题
                                </div>
                            </div>
    </li>
@endforeach
                </div>

                <div class="text-center answer-but"><a href="#" class="btn btn-default">开始学习下一课</a></div>
            </div>
        </div>
    </div>

    <div class="course-evaluate" style="display: none;">
        <div class="shade"></div>
        <div class="evaluate">
            <div class="title"> 您的评论：
                <div class="star">
                    <div class="score"><i>0</i></div>
                </div><span class="star-score"> <i>0</i>分</span>
                <div class="close glyphicon glyphicon-remove"></div>
            </div>
            <div><textarea class="form-control" rows="5" placeholder="扯淡、吐槽、表扬、鼓励......想说啥说啥！"></textarea></div>
            <div class="text-right"><a href="#" class="btn btn-default">提交</a></div>
        </div>
    </div>
</div>
<!-- 页面底部 -->
<!-- 页面 css js -->
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
<script>
    $(function() {
        //评分
        $('.star .score').map(function(n, i) {
            var x = Number($(this).find('i').text());
            var w = 107 * (1 - x / 5);
            $(this).css('width', w + 'px');
        })
        //弹出评论打分窗口
        $('.answer-but').click(function() {
            $('.course-evaluate').show();
        })
        //评论打分
        $('.evaluate .star').mousemove(function(e) {
            var startX = $(this).offset().left;
            var movX = e.clientX - startX + 0.5;
            var w = 106 * (1 - movX / 106);
            $(this).find('.score').css('width', w + 'px');
            $('.star-score i').text((movX / 106 * 5).toFixed(2))
        })
        //关闭评分
        $('.title .close').click(function() {
            $('.course-evaluate').hide();
        })
        //点击展开左侧窗口
        $('.course-answer-cont .glyphicon-align-justify').click(function() {
            var contWidth = $(document).width() - 380;
            if (!$(this).hasClass('ck')) {
                $(this).addClass('ck');
                $('.course-answer-cont').animate({
                    width: contWidth
                }, 500);
                $('.course-weeklist').animate({
                    left: 0
                }, 500);
                $('.course-nav').animate({
                    left: 380
                }, 500)
            } else {
                $(this).removeClass('ck');
                $('.course-answer-cont').animate({
                    width: '100%'
                }, 500)
                $('.course-weeklist').animate({
                    left: -380
                }, 500)
                $('.course-nav').animate({
                    left: 0
                }, 500)
            }

        });
    })


    $(function() {
        //$('body').css('height',$('.course-cont').height()+'px')
        var vidHit = $('html').height() - 120;
        var vidCenHit = (vidHit - $('.video-play').height()) / 2;
        $('.video').css('height', vidHit)
        $('.video-play').css('top', vidCenHit);

        $('.course-cont .glyphicon-align-justify').click(function() {
            var contWidth = $(document).width() - 380;
            if (!$(this).hasClass('ck')) {
                $(this).addClass('ck');
                $('.course-cont').animate({
                    width: contWidth
                }, 500);
                $('.course-weeklist').animate({
                    left: 0
                }, 500);
                $('.course-nav').animate({
                    left: 380
                }, 500)
            } else {
                $(this).removeClass('ck');
                $('.course-cont').animate({
                    width: '100%'
                }, 500)
                $('.course-weeklist').animate({
                    left: -380
                }, 500)
                $('.course-nav').animate({
                    left: 0
                }, 500)
            }

        });

    })
</script>
</body>
</html>