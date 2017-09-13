@extends('admin/buju/layout')


@section('title','添加直播流 - 直播流管理 - H-ui.admin v2.4')

@section('content')
	<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	{{ csrf_field() }}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播流名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="" id="stream_name" name="stream_name">
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 

<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
    $('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	//给添加form表单设置submit事件
	$('#form-admin-add').submit(function(evt){
	    //ajax方式提交form表单信息给服务器
		evt.preventDefault(); //阻止浏览器form表单提交
		//收集form表单的信息为 username=xxx&password=xxx&mg_email=xxx...
		var shuju = $(this).serialize();
		// console.log(shuju);
		//执行ajax
		$.ajax({
			url:'/admin/stream/tianjia',
			data:shuju,
			dataType:'json',
			type:'post',
			success:function(msg){
			    //alert(msg);  //{'success':true/false}
				if(msg.success === true){
					//a提示成功信息、b关闭当前的添加页、c父级列表页刷新
                    layer.alert('添加成功', function(){
                        parent.window.location.href = parent.window.location.href; //父页面刷新
                        layer_close();  //关闭当前添加页
					});
                }else{
					//a提示失败信息
                    layer.alert('添加失败【'+msg.errorinfo+'】', {icon: 5});  //icon:1/2/3/4/5  设置表情
                }
			}
		});
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
@endsection