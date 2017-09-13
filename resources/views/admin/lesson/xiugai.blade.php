@extends('admin/buju/layout')

@section('title','添加课时')

@section('content')
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-lesson-add">
		{{csrf_field()}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" id="lesson_name" name="lesson_name" value="{{$lesson->lesson_name}}" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>对应课程：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select name="course_id">
					<option value="">-请选择-</option>
					@foreach($course as $k => $v)
						@if($lesson->course_id === $k)
							<option value="{{$k}}" selected="selected">{{$v}}</option>
						@else
							<option value="{{$k}}">{{$v}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>



<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/uploadify/uploadify.css">
<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3">视频：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" value="" id="shipin" name="shipin" />
	</div>
	<label class="form-label col-xs-4 col-sm-3"></label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" readonly="readonly" name="video_address"
		 value="{{$lesson->video_address}}"
		/>
	</div>
</div>
<script type="text/javascript">
	<?php $timestamp = time();?>
		$(function() {
		$('#shipin').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'_token'     : '{{csrf_token()}}'
			},
			'swf'      : '/uploadify/uploadify.swf',
			//服务器端处理上传附件的地址
			'uploader' : '{{ url("admin/lesson/up_video") }}',
			//上传成功回调函数处理
			'onUploadSuccess' : function(file, data, response) {
				//response:true/false
				//file上传附件名字
				//data:接收服务器端返回的信息
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				var obj = JSON.parse(data);
				if(obj.success===true){
					//显示上传好附件
					//把附件的名字赋予给当前form表单input框mg_pic
					$('[name=video_address]').val(obj.filename);
				}
			}
		});
	});
</script>


<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>封面图：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" id="fengmian" />
	</div>
	<label class="form-label col-xs-4 col-sm-3"></label>
	<div class="formControls col-xs-8 col-sm-9">
		<img src="{{$lesson->cover_img}}" alt="" id="show_cover_img" width="200" height="100" />
	</div>
	<label class="form-label col-xs-4 col-sm-3"></label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" id="cover_img" name="cover_img" readonly="readonly"
		value="{{$lesson->cover_img}}"
		 />
	</div>
</div>
<script type="text/javascript">
	<?php $timestamp = time();?>
		$(function() {
		$('#fengmian').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'_token'     : '{{csrf_token()}}'
			},
			'swf'      : '/uploadify/uploadify.swf',
			//服务器端处理上传附件的地址
			'uploader' : '{{ url("admin/lesson/up_pic") }}',
			//上传成功回调函数处理
			'onUploadSuccess' : function(file, data, response) {
				//response:true/false
				//file上传附件名字
				//data:接收服务器端返回的信息
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				var obj = JSON.parse(data);
				if(obj.success===true){
					//显示上传好附件
					//显示上传好的图片
                    $('#show_cover_img').attr('src',obj.filename);
					//把附件的名字赋予给当前form表单input框mg_pic
					$('#cover_img').val(obj.filename);
				}
			}
		});
	});
</script>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">课时描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="lesson_desc" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)">{{$lesson->lesson_desc}}</textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">时长：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" class="input-text" placeholder="" id="lesson_duration" name="lesson_duration"  value="{{$lesson->lesson_duration}}" />
				分钟
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">授课老师：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="teacher_ids" name="teacher_ids">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">启用/停用：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="radio-box">
					<input name="is_ok" type="radio" value="启用" id="sex-1"
					@if($lesson->is_ok=='启用')
						checked="checked"
					@endif
					 />
					<label for="sex-1">启用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" value="停用" name="is_ok"
				   	@if($lesson->is_ok=='停用')
				   		checked="checked"
					@endif
					 />
					<label for="sex-2">停用</label>
				</div>
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
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.radio-box input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	//添加表单提交动作
	$('#form-lesson-add').submit(function(evt){
		evt.preventDefault();//阻止浏览器自己的submit

		//收集form表单信息为字符串：name=xx&title=xx&email=xx
		var shuju = $(this).serialize();

		//ajax提交
		$.ajax({
			url:'{{url("admin/lesson/xiugai")}}'+'/'+'{{$lesson->lesson_id}}',
			data:shuju,
			dataType:'json',
			type:'post',
			success:function(msg){
				if(msg.success===true){
				    //alert('添加课时成功');
                    //layer.msg('添加课时成功!',{icon:1,time:1000});

                    layer.alert('修改课时成功', function(index){
						parent.mydatatable.api().ajax.reload();//刷新父页面,即刷新datatable
						layer_close();//关闭当前弹出层
                    });
                }else{
				    //alert('添加课时失败【'+msg.errorinfo+'】');
                    layer.alert('修改课时失败【'+msg.errorinfo+'】',{icon:5});
				}
			}
		});
	});

	/*
	$("#form-lesson-add").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:16
			},
			sex:{
				required:true,
			},
			mobile:{
				required:true,
				isMobile:true,
			},
			email:{
				required:true,
				email:true,
			},
			uploadfile:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
	*/
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
@endsection