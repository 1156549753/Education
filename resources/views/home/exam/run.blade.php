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

    <link rel="stylesheet" href="/home/css/page-learing-course-problem.css" />
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
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
    <div class="course-problem-cont">
        <div class="top text-center">
            <i class="glyphicon glyphicon-align-justify pull-left hv-poin"></i>
            < {{$paper->paper_name}}>
            <i class="glyphicon glyphicon-book pull-right"></i>
        </div>
        <div class="subtitle-cont container">
            <form method="post" action="{{url('home/exam/run',['paper'=>$paper->paper_id])}}">
                {{csrf_field()}}
            <div>
                <div class="title">一、选择题：(单选)</div>
@foreach($dan_info as $v)
<li class="problem-choice">{{$loop->iteration}}. {{$v->qs_name}}&nbsp;&nbsp;（{{$v->qs_score}}）分
    <label><input type="radio" value="1" name="answer_[{{$v->qs_id}}][]">
        A:{{$v->option_a}}</label>
    <label><input type="radio" value="2" name="answer_[{{$v->qs_id}}][]">
        B:{{$v->option_b}}</label>
    <label><input type="radio" value="4" name="answer_[{{$v->qs_id}}][]">
        C:{{$v->option_c}}</label>
    <label><input type="radio" value="8" name="answer_[{{$v->qs_id}}][]">
        D:{{$v->option_d}}</label>
</li>
@endforeach

                <div class="title">二、选择题：(多选)</div>
@foreach($duo_info as $v)
<li class="problem-choice">{{$loop->iteration}}. {{$v->qs_name}}&nbsp;&nbsp;（{{$v->qs_score}}）分
    <label><input type="checkbox" value="1" name="answer_[{{$v->qs_id}}][]">
        A:{{$v->option_a}}</label>
    <label><input type="checkbox" value="2" name="answer_[{{$v->qs_id}}][]">
        B:{{$v->option_b}}</label>
    <label><input type="checkbox" value="4" name="answer_[{{$v->qs_id}}][]">
        C:{{$v->option_c}}</label>
    <label><input type="checkbox" value="8" name="answer_[{{$v->qs_id}}][]">
        D:{{$v->option_d}}</label>
</li>
@endforeach


            </div>
            <div class="text-center answer-but">
            <input type="submit" value="提交" class="btn btn-primary" />
            </div>
            </form>
        </div>
    </div>
</div>
<!-- 页面底部 -->
<!-- 页面 css js -->
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
<script>
    $(function() {
        $('.course-problem-cont .glyphicon-align-justify').click(function() {
            var contWidth = $(document).width() - 380;
            if (!$(this).hasClass('ck')) {
                $(this).addClass('ck');
                $('.course-problem-cont').animate({
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
                $('.course-problem-cont').animate({
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