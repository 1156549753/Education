@extends('admin/buju/layout')

@section('tou')
	@parent
@endsection

@section('title','添加管理员 - 管理员管理 - H-ui.admin v2.4')

@section('content')

<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	{{ csrf_field() }}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="username" name="username">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password_confirmation" name="password_confirmation">
		</div>
	</div>

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/uploadify/uploadify.css">
<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>头像：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="file"  name="mypicture" id="mypicture">
	</div>
</div>
<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"></label>
	<div class="formControls col-xs-8 col-sm-9">
		<p><img id="show_pic" src="" alt="" width="200" height="100" /></p>
		<p></p><input type="text"  class="input-text" name="mg_pic" value="" readonly="readonly" /></p>
	</div>
</div>
<script type="text/javascript">
	<?php $timestamp = time();?>
	$(function() {
		$('#mypicture').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'_token'     : '{{csrf_token()}}'
			},
			'swf'      : '/uploadify/uploadify.swf',
			//服务器端处理上传附件的地址
			'uploader' : '/admin/manager/up_pic',
			//上传成功回调函数处理
            'onUploadSuccess' : function(file, data, response) {
			    //response:true/false
				//file上传附件名字
				//data:接收服务器端返回的信息
                //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				var obj = JSON.parse(data);
				if(obj.success===true){
				    //显示上传好附件
					$('#show_pic').attr('src',obj.filename);
					//把附件的名字赋予给当前form表单input框mg_pic
					$('[name=mg_pic]').val(obj.filename);
				}
            }
		});
	});
</script>


	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="mg_sex" type="radio" id="sex-1" checked value="男">
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				<input name="mg_sex" type="radio" id="sex-2" value="女">
				<label for="sex-2">女</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="mg_phone" name="mg_phone">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="mg_email" id="mg_email">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="mg_role_ids" size="1">
				<option value="10">超级管理员</option>
				<option value="11">总编</option>
				<option value="12">栏目主辑</option>
				<option value="10">栏目编辑</option>
			</select>
			</span> </div>
	</div>


	<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="mg_remark" id="mg_remark" style="width:550px;height:110px;" class="textarea" ></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<script type="text/javascript">
        var ue = UE.getEditor('mg_remark',{toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|'
        ]]});
	</script>
	<style type="text/css">
	.textarea{height:200px;padding:0;}
	</style>


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
		//执行ajax
		$.ajax({
			url:'/admin/manager/tianjia',
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

	/**
	$("#form-admin-add").validate({
		rules:{
			adminName:{
				required:true,
				minlength:4,
				maxlength:16
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			sex:{
				required:true,
			},
			phone:{
				required:true,
				isPhone:true,
			},
			email:{
				required:true,
				email:true,
			},
			adminRole:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "xxxxxxx" ,
				success: function(data){
					layer.msg('添加成功!',{icon:1,time:1000});
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
	*/
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
@endsection