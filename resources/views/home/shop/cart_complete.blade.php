@extends('home/buju/layout')
@section('content')

<link rel="stylesheet" href="/home/css/page-learing-pay.css" />
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>

<!--主体内容-->
<div class="container">
    <div class="learing-pay">

        <div>恭喜，订单【{{$_GET['out_trade_no']}}】已经支付成功</div>
    </div>

</div>


@endsection
