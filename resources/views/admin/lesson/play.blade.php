@extends('admin/buju/layout')

@section('title','视频播放')

@section('content')
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
	<video src="{{$lesson->video_address}}" width="780" height="420" controls="controls">
		您的浏览器不支持video标签</video>

@endsection