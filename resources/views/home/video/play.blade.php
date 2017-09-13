<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>直播</title>
    <style>
    *{
        margin: 0 auto;
    }
    body{
       background: #083525;
       background: rgba(8, 53, 37, 0.9)
	   /* opacity: 0.5; */
    }
    .video{
        width:900px;
        height:548px;
        background-color:#083525;
        clear:both;
        margin-top: 100px;
        index: 1000px;
        
    }
    @media  (max-width:1200px ){
                   .video{
                        width:900px;
                        height:548px;
                   }
            }
            /*还有小于992px*/
            @media  (max-width:992px ){
                .video{
                        width:500px;
                        height:448px;
                }
            }
            /*还有小于768是移动设备*/
            @media  (max-width:768px ){
                .video{
                        width:500px;
                        height:348px;
                }
            }
    </style>
    </style>
    <!-- <script type="text/javascript" src="/ckplayer/ckplayer.js"></script> -->
    <script src="/chplayer/chplayer.js"></script>
</head>
<body>
    <div class="video text-center"  id="show_video">
    </div>
    <script>
//     var flashvars={
//         f:'{{$pullurl}}',       //拉流地址
//         i:'/storage/video/fj.jpg',//视频封面图
//         // d:'/storage/video/timg.jpg|/storage/video/timg1.jpg',//暂停时播放的广告图片
//         v:'60',//默认音量，0-100之间
//         p:'0',//视频默认0是暂停，1是播放
//         lv:'0',//是否是直播流，=1则锁定进度栏
//         c:0,
//         b:1,
// };
// var params={bgcolor:'#083525',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
// CKobject.embedSWF('/ckplayer/ckplayer.swf','show_video','ckplayer_a1','100%','100%',flashvars,params);

var videoObject = {
        container: '#show_video',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        video:'{{$pullurl}}'//视频地址
    };
var player=new chplayer(videoObject);
</script>
</body>
</html>