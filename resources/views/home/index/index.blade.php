@extends('home/buju/layout')
@section('content')

<link rel="stylesheet" href="/home/css/page-learing-index.css" />
<!--banner区-->
<div class="travel-index-imgroll">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/home/img/widget-bannerA.jpg" alt="AA">
            </div>
            <div class="item">
                <img src="/home/img/widget-bannerB.jpg" alt="">
            </div>
        </div>
        <!--<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">-->
        <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <!--<span class="sr-only">Previous</span>-->
        <!--</a>-->
        <!--<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">-->
        <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
        <!--<span class="sr-only">Next</span>-->
        <!--</a>-->
    </div>
</div>
<div class="container">
    <!--左侧列表导航-->
    <div class="travel-index-nav">
        <div class="citylistbox">
            <div class="title text-center">全部分类课程</div>
            <div class="listbox">
                <div class="list">
                    <dl><dt>编程入门</dt></dl>
                </div>
                <div class="box">编程入门编程入门编程入门编程入门编程入门编程入门编程入门编程入门编程入门</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt>数据分析师</dt></dl>
                </div>
                <div class="box">机器学习工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl>
                        <dt>机器学习工程师</dt>
                    </dl>
                </div>
                <div class="box">机器学习工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt>人工智能工程师</dt></dl>
                </div>
                <div class="box">人工智能工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt>全栈工程师</dt></dl>
                </div>
                <div class="box">全栈工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt> iOS工程师</dt></dl>
                </div>
                <div class="box">iOS工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt> VR 开发者</dt></dl>
                </div>
                <div class="box"> VR 开发者</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt>商业预测分析师</dt></dl>
                </div>
                <div class="box">商业预测分析师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt> Java 工程师</dt></dl>
                </div>
                <div class="box"> Java 工程师</div>
            </div>
            <div class="listbox">
                <div class="list">
                    <dl><dt> 前端开发工程师</dt></dl>
                </div>
                <div class="box">前端开发工程师</div>
            </div>
        </div>
    </div>
    <div class="recommend-list">
        <div class="btn-group btn-group-justified">
            <a href="#" class="btn btn-primary">北京大学</a>
            <a href="#" class="btn btn-primary">清华大学</a>
            <a href="#" class="btn btn-primary">厦门大学</a>
            <a href="#" class="btn btn-primary">复旦大学</a>
            <a href="#" class="btn btn-primary">武汉大学</a>
            <a href="#" class="btn btn-primary">中央财经大学</a>
            <a href="#" class="btn btn-primary">西安电子科技大学</a>
            <a href="#" class="btn btn-primary">哈尔滨工业大学</a>
        </div>
    </div>
    <div class="conten-list">
        @foreach($course as $v)
        <div class="conten" id="a">
            <div class="row text-center top">
                <div class="col-lg-3 text-left" id="Title">{{$v->course_name}}</div>
                <div class="col-lg-5 ">
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary active">热 门</a>
                        <a href="#" class="btn btn-primary">初 级</a>
                        <a href="#" class="btn btn-primary">中 级</a>
                        <a href="#" class="btn btn-primary">高 级</a>
                    </div>
                </div>
                <div class="col-lg-3 text-right">

<a href="{{url('home/course/detail',['course'=>$v->course_id])}}" class="btn btn-default ck-all" target="_blank">查看全部</a>

                </div>
            </div>
            <div class="container cont-list">
                <div class="cont-list-roll">
                    <div class="next glyphicon glyphicon-chevron-right"></div>
                    <div class="prev glyphicon glyphicon-chevron-left"></div>
                    <div class="cont-list-box">
                        @foreach($v->lesson as $vv)
                        @if($loop->index<5)
                        <li class="">
                            <img src="{{$vv->cover_img}}" alt="AA">
                            <div class="tit">{{$vv->lesson_name}} <span>高</span></div>
                            <div>武汉大学</div>
                            <div>1门课程</div>
                        </li>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="index-cont-nav">
    <div id="myNavbar" class="collapse navbar-collapse ">
        <div id="myCollapse" class="collapse navbar-collapse">
            <div class="logo-ico"><img src="/home/img/asset-logoIco.png" alt=""></div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#a">编程入门</a></li>
                <li><a href="#b">数据分析师</a></li>
                <li><a href="#c">机器学习工程师</a></li>
                <li><a href="#d">前端开发工程师</a></li>
                <li><a href="#e">人工智能工程师</a></li>
                <li><a href="#f">全栈工程师</a></li>
                <li><a href="#g">iOS工程师</a></li>
                <li><a href="#h">VR开发者</a></li>
                <li><a href="#i">深度学习</a></li>
                <li><a href="#j">商业预测分析师</a></li>
                <li><a href="#k">Android开发工程师</a></li>
            </ul>
        </div>
    </div>
</div>

</div>
<div class="container">
    <div class="index-bot-video text-center">
        <div class="tit">运作方式</div>
        <div class="row">
            <div class="col-lg-6 text-left">
                <div class="cont">
                    <p class="tit glyphicon glyphicon-hand-right"> 课程作业</p>
                    <p>每门课程都像是一本互动的教科书，具有预先录制的视频、测验和项目。</p>
                </div>
                <div>
                    <p class="tit glyphicon glyphicon-hand-right"> 证书</p>
                    <p>获得正式认证的作业，并与朋友、同事和家人分享您的成功。</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="/home/img/widget-video.jpg" width="500" alt="">
            </div>
        </div>
    </div>
</div>
<!-- 页面底部 -->
<div class="gotop">
    <a href="#"><i class="glyphicon glyphicon-pencil"></i><span class="hide">问题反馈</span></a>
    <a href="#top"><i class="glyphicon glyphicon-plane"></i><span class="hide">返回顶部</span></a>
</div>
<!--底部版权-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div>
                    <!--<h1 style="display: inline-block">学成网</h1>--><img src="/home/img/asset-logoIco.png" alt=""></div>
                <div>学成网致力于普及中国最好的教育它与中国一流大学和机构合作提供在线课程。</div>
                <div>© 2017年XTCG Inc.保留所有权利。-沪ICP备15025210号</div>
                <input type="button" class="btn btn-primary" value="下 载" />
            </div>
            <div class="col-lg-5 row">
                <dl class="col-lg-4">
                    <dt>关于学成网</dt>
                    <dd>关于</dd>
                    <dd>管理团队</dd>
                    <dd>工作机会</dd>
                    <dd>客户服务</dd>
                    <dd>帮助</dd>
                </dl>
                <dl class="col-lg-4">
                    <dt>新手指南</dt>
                    <dd>如何注册</dd>
                    <dd>如何选课</dd>
                    <dd>如何拿到毕业证</dd>
                    <dd>学分是什么</dd>
                    <dd>考试未通过怎么办</dd>
                </dl>
                <dl class="col-lg-4">
                    <dt>合作伙伴</dt>
                    <dd>合作机构</dd>
                    <dd>合作导师</dd>
                </dl>
            </div>
        </div>
    </div>
</footer>

<!-- 页面 css js -->

<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/home/js/widget-travel-index-nav.js"></script>
<script>
    $('.cont-list-roll').hover(function() {
        $(this).find('.next,.prev').show();
    }, function() {
        $(this).find('.next,.prev').hide();
    });
    $('.gotop a').hover(function() {
        $(this).find('span').removeClass('hide')
    }, function() {
        $(this).find('span').addClass('hide')
    })
</script>
<script src="/home/js/page-learing-index.js"></script>

@endsection