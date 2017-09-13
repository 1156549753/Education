@extends('home/buju/layout')
@section('content')

<link rel="stylesheet" href="/home/css/page-learing-pay.css" />
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
<!--主体内容-->
<div class="container">
    <div class="learing-pay">
        <div class="tit">
            课程已成功加入购物车！</div>
        <div class="pay-list">
<div class="row">
    <div class="col-lg-2"><img src="{{$course->cover_img}}" alt=""></div>
    <div class="col-lg-9">
        <p>名称：{{$course->course_name}} <em>北京大学</em></p>
        <p>描述：{{$course->course_desc}}</p>
    </div>
    <div class="col-lg-1">￥{{$course->course_price}}</div>
    <p>
        <a href="#" class="btn btn-default" style="display:inline;">查看课程详情</a>
        
        <a href="{{url('home/shop/cart_account')}}" class="btn btn-primary" style="display:inline;">去购物车结算</a>

    </p>
</div>
        </div>

    </div>
</div>

@endsection