@extends('admin/buju/layout')

@section('title','课时列表')

@section('content')
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 课时中心 <span class="c-gray en">&gt;</span> 课时管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜课时</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">

			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>

			<a href="javascript:;" onclick="lesson_add('添加课时','{{url("admin/lesson/tianjia")}}','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加课时</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="5%"><input type="checkbox" name="" value=""></th>
				<th width="5%">ID</th>
				<th width="14%">课时名称</th>
				<th width="10%">对应课程</th>
				<th width="15%">图片</th>
				<th width="7%">视频</th>
				<th width="12%">授课老师</th>
				<th width="13%">创建时间</th>
				<th width="*">操作</th>
			</tr>
		</thead>
	</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
//批量删除课时
function datadel(){
    if(confirm('确定要删除选取的课时么？')){
		var lesson = [];//声明一个变量,接收被删除的课时的主键id值
		//找到全部选中的复选框，并遍历获得其value属性值
		$('.xiuzheng:checked').each(function(k){
			//$k:遍历的次数序号
			//this: 代表每个被选中复选框的dom对象
			//$(this):把dom对象this变为jquery对象了
			//console.log(this);

			//把复选框的value属性值赋予给lesson
			lesson[k] = $(this).val();
		});
		//console.log(lesson);  //[15,14]

		//判断空的情况，没有选取删除的课时
		if(lesson.length <1){
			alert('请选取被删除的课时');
			return false;
		}

		//利用ajax去服务器删除数据
		$.ajax({
			url:'/admin/lesson/delall',
			data:{'ids':lesson},
			dataType:'json',
			type:'post',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			},
			success:function(msg){
				if(msg.success===true){

					//通过dom的方式，把对应的tr给删除 lesson=[15,14]
					$.each(lesson,function(k,v){
						//v是单元制，分表代表 14 、15
						//k是单元序号
						$('#lesson_ck_'+v).parents('tr').remove();
					});
					alert('删除成功');
				}else{
					alert('删除失败');
				}
			}
		});
	}

}


$(function(){
    //使用mydatatable"全局"变量把dataTable给接收起来，以便子级页面调用
	mydatatable = $('.table-sort').dataTable({
		"order": [[ 1, "desc" ]],
		"stateSave": false,//状态保存
		"columnDefs": [
			{"targets": [0,8],"orderable": false}// 制定列不参与排序
		],

		"lengthMenu": [ 4,8,16,32 ],
		"paging": true,
		"info":     true,
		"searching": true,
		"ordering": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
		    "url": "{{ url('admin/lesson/index') }}",
		    "type": "POST",
		    'headers': { 
		    	'X-CSRF-TOKEN' : '{{ csrf_token() }}' 
		    },
		},

		//给各个"td"填充内容
		"columns": [
		    {'data':'a',"defaultContent": "<input type='checkbox' class='xiuzheng'>"},
		    {'data':'lesson_id'},
		    {'data':'lesson_name'},
		    {'data':'course.course_name'},
            {"defaultContent": ""},
//		    {'data':'course.profession.pro_name'},
		    {"defaultContent": ""},
		    {'data':'teacher_ids'},
		    {'data':'created_at'},
		    {'data':'b',"defaultContent": "",'className':'td-manager'},
		],
		"createdRow":function(row,data,dataIndex){
		    //该方法会"遍历"每个新生成的tr
		    //此处，可以对生成好的tr、td进行二次优化，改造
			//row:就是生成的tr的dom对象，设置为$(row)就变为jquery对象
            //data:服务器端传递回来的每条 数据记录
			//dataIndex:是tr的下标索引号码

			//① 给最后td设置功能按钮
			var anniu = "";
			//判断启用、停用按钮
			if(data.is_ok=='启用'){
				anniu += '<span class="label label-success radius">已启用</span>&nbsp;<a style="text-decoration:none" onClick="lesson_stop(this,'+data.lesson_id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>';
			}else{
                anniu += '<span class="label label-defaunt radius">已停用</span>&nbsp;<a style="text-decoration:none" onClick="lesson_start(this,'+data.lesson_id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>';
			}
			
			anniu += '<a title="编辑" href="javascript:;" onclick="lesson_edit(\'编辑\',\'/admin/lesson/xiugai/'+data.lesson_id+'\',4,\'\',510)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a><a title="删除" href="javascript:;" onclick="lesson_del(this,1)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
			$(row).find('td:eq(8)').html(anniu);

			//② 给tr设置class属性
			$(row).addClass('text-c');

			//③ 制作封面图显示
			var img = "<img src='"+data.cover_img+"' alt='没有图片' width='200' height='100' />";
			$(row).find('td:eq(4)').html(img);

			//④ 制作“播放”按钮
			var btn = '<input class="btn btn-success-outline radius" onclick="play_video(\'播放视频\',\'/admin/lesson/play/'+data.lesson_id+'\',\'\',510)" type="button" value="播放">';
			$(row).find('td:eq(5)').html(btn);


			//⑤把第1列复选框设计为：<input type="checkbox" class='xiuzheng' id="lesson_ck_主键" value=课时主键值 />
			$(row).find('td:eq(0) input').val(data.lesson_id);  //设置value值
			$(row).find('td:eq(0) input').attr('id','lesson_ck_'+data.lesson_id); //设置id属性
		},
	});
});
/*课时-播放视频*/
function play_video(title,url,w,h){
    layer_show(title,url,w,h);
}

/*课时-添加*/
function lesson_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*课时-查看*/
function lesson_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}


/*课时-停用
* obj:是停用按钮a标签的dom对象
* id:代表被停用的课时的主键id值
* */
function lesson_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "{{url('admin/lesson/start_stop')}}"+'/'+id,
			dataType: 'json',
			headers:{
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
			data:{'flag':1},
			success: function(data){
				//$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="lesson_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
				//$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');

				//① 标识信息调换，去除旧的、添加新的
				$(obj).parent().find('span').remove(); //去旧
				$(obj).parent().prepend('<span class="label label-defaunt radius">已停用</span>')//来新
				//② 按钮调换，去旧迎新
				$(obj).before('<a style="text-decoration:none" onClick="lesson_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>'); //迎新					//迎新
				$(obj).remove(); //删除本身的a按钮，去旧


				layer.msg('已停用!',{icon: 5,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*课时-启用*/
function lesson_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
            type: 'POST',
            url: "{{url('admin/lesson/start_stop')}}"+'/'+id,
            dataType: 'json',
            headers:{
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data:{'flag':2},
			success: function(data){
                //① 标识信息调换，去除旧的、添加新的
                $(obj).parent().find('span').remove(); //去旧
                $(obj).parent().prepend('<span class="label label-success radius">已启用</span>')//来新
                //② 按钮调换，去旧迎新
                $(obj).before('<a style="text-decoration:none" onClick="lesson_stop(this,'+id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>'); //迎新					//迎新
                $(obj).remove(); //删除本身的a按钮，去旧


                layer.msg('已启用!',{icon: 1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
/*课时-编辑*/
function lesson_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*课时-删除*/
function lesson_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script> 
@endsection
