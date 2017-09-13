@extends('home/buju/layout')
@section('content')

<link rel="stylesheet" href="{{url('home/css/page-learing-list.css')}}" />
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>

<div class="container">
    <div class="table-responsive learing-list">
        <table class="table">
            <tr><td class="btn-group" width="40%">名称：{{$course->course_name}}</td>
                <td class="btn-group" width="*">价格：{{$course->course_price}}</td>
            </tr>
            <tr><td class="btn-group" width="40%">专业：{{$course->profession->pro_name}}</td>
                <td class="btn-group" width="*">描述：{{$course->course_desc}}</td>
            </tr>
            <tr><td class="btn-group" width="40%">封面图：<img src="{{$course->cover_img}}" alt="" width='200' height='120'/></td>
                <td class="btn-group" width="*"></td>
            </tr>
            <tr><td class="btn-group" width="40%"></td>
                <td class="btn-group" width="*">

<a href="{{url('home/shop/cart_tianjia',['course'=>$course->course_id])}}" class="btn btn-primary">加入购物车</a></td>
            
            </tr>
        </table>
    </div>
</div>
<div class="container" style="width: 1140px">
    <div class="row">
        <div class="col-lg-9 list-row-left">
            <div class="list-cont-left">
                <div class="tit">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#">推荐</a></li>
                        <li><a href="#">最新</a></li>
                        <li><a href="#">热评</a></li>
                        <div class="page navbar-right">
                            <span class="">1/28</span>
                            <a href="#" class="prev">
                                <</a>
                            <a href="#" class="next">></a>
                        </div>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="content-list">

@foreach($course->lesson as $v)                       
<li class="">
    <img src="{{$v->cover_img}}" alt="AA">
    <div class="tit">{{$v->lesson_name}} <span>高</span></div>
    <div>匡霞|史瑞|褚翼</div>
    <div><a href="" target="_blank">查看详细</a></div>
</li>
@endforeach

 
                        
                        <li class="clearfix"></li>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 list-row-rit">
            <div class="list-cont-right">
                <div class="right-box">
                    <div class="tit">猜你喜欢</div>
                    <div class="contList">
                        <li>
                            <img src="/home/img/widget-1.png" alt="">
                            <p>程序设计语言</p>
                            <p>评分7.4</p>
                        </li>
                        <li>
                            <img src="/home/img/widget-1.png" alt="">
                            <p>程序设计语言</p>
                            <p>评分7.4</p>
                        </li>
                        <li>
                            <img src="/home/img/widget-1.png" alt="">
                            <p>程序设计语言</p>
                            <p>评分7.4</p>
                        </li>
                        <li>
                            <img src="/home/img/widget-1.png" alt="">
                            <p>程序设计语言</p>
                            <p>评分7.4</p>
                        </li>
                        <li>
                            <img src="/home/img/widget-1.png" alt="">
                            <p>程序设计语言</p>
                            <p>评分7.4</p>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- 页面 css js -->
<script>
    $('.table .btn').on('click', function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    })


    $('.list-cont-left .nav-tabs li').on('click', function() {
        $(this).addClass("active").siblings().removeClass('active');
    })
</script>

@endsection
