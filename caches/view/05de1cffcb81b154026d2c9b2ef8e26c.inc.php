<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>statics/js/upload/uploader.css?v=<?php echo HD_VERSION;?>" />
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/upload/uploader.js?v=<?php echo HD_VERSION;?>"></script>
<div class=" layout">
<div class="container border border-gray-white member clearfix">

<div class="right ">
<div class=" margin-large-left padding-left process clearfix" style="margin-top:100px;">
<!--退货退款 开始-->
<?php if(!$_GET['type']) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请退货退款</span>
</div>
</div>
</li>
<li class="process-list">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家处理退货申请</span>
</div>
</div>
</li>
<li class="process-list">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家退货给卖家</span>
</div>
</div>
</li>
<li class="process-list proce-left">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家确认收货，退款完成</span>
</div>
</div>
</li>
</ul>
<?php } ?>
<!--退货退款 结束-->
<!--仅退款 开始-->
<?php if($_GET['type'] == 'refund' || $refund) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家处理退货申请</span>
</div>
</div>
</li>
<li class="process-list proce-left">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">退款完成</span>
</div>
</div>
</li>
</ul>
<?php } ?>
<!--仅退款 结束-->
</div>
<div class=" padding-big-left padding-big-right padding-big-bottom clearfix" style="margin-top:10px;">
<dl class="settlement-lists layout padding-none">
<dt>选择售后方式：</dt>
<dd class="item-checked">
<div class="item <?php if(!$_GET['type']) { ?>selected<?php } ?>" data-id="return">
<i></i>
<a href="<?php echo url('return_refund',array('id'=>$_GET['id']));?>">退货退款</a>
</div>
<div class="item <?php if($_GET['type'] == 'refund') { ?>selected<?php } ?>" data-id="refund">
<i></i>
<a href="<?php echo url('return_refund',array('id'=>$_GET['id'],'type' => 'refund'));?>">仅退款</a>
</div>
</dd>
</dl>
</div>
<div class="margin-big-left margin-big-right margin-big-bottom tabs-scroll">
<div class="border border-light-gray padding-big ">
<form class="double-line clearfix" <?php if($_GET['type'] == 'refund') { ?>action="<?php echo url('ajax_refund');?>"<?php } else { ?>action="<?php echo url('ajax_return');?>"<?php } ?> method="post" name="ajax_return">
<div class="list">
<span class="label">退货退款原因：</span>
<div class="content">
<select name="cause">
<option value="">请选择退货退款原因</option>
<option value="外观/参数等与描述不符">外观/参数等与描述不符</option>
<option value="商品发错货">商品发错货</option>
<option value="产品质量/故障">产品质量/故障</option>
<option value="效果不好或不喜欢">效果不好或不喜欢</option>
<option value="收到商品少件/破损/污渍">收到商品少件/破损/污渍</option>
<option value="假冒商品">假冒商品</option>
<option value="其他">其他</option>
</select>
</div>
</div>
<div class="list">
<span class="label">退款金额：</span>
<div class="content">
<input class="input" type="text" name="amount"/>
最多可退款金额：<span class="text-mix"><?php echo $price;?></span>
</div>
</div>
<div class="list">
<span class="label">原因：</span>
<div class="content">
<textarea class="textarea layout" name="desc" placeholder="请说明详细原因"></textarea>
</div>
</div>
<div class="list">
<span class="label">上传凭证：</span>
<div class="content">
<ul class="pic-rank-1 ul_return">
<li class="add show">
<label class="layout show" style="position: relative; height:100%;cursor: pointer;">
<div id="add_return"></div>
</label>
</li>
</ul>
</div>
</div>
<div class="list">
<span class="label"></span>
<div class="content">
<input type="hidden" name="type" value="2" />
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<input type="submit" class="fl cservice  cheng-btn ajax_return" value="提交申请">
</div>
</div>
</form>
</div>
</div>
<div class="padding-big-left padding-big-right padding-big-bottom">
<p>售后说明：<span class="text-mix">每个商品&订单您只有一次售后维权的机会</span></p>
<p>1. <b>退货退款</b></p>
<p>申请条件：若为商品问题，或者不想要了且与卖家达成一致退货，请选择“退货退款”选项，退货后请保留物流底单。</p>
<p class="text-sub">退货流程：1.申请退货 >2.卖家发送退货地址给买家 >3.买家退货并填写退货物流信息 >4.卖家确认收货，退款成功</p>
<p>2. <b>仅退款</b></p>
<p>申请条件：若您未收到货，或已收到货且与卖家达成一致不退货仅退款时，请选择“仅退款”选项。</p>
<p class="text-sub">退款流程：1.申请退款 > 2. 卖家同意退款申请>3.退款成功</p>
</div>
</div>
</div>
</div>
<?php include template('artels-footer','common');?>
</body>
</html>
<script>

/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});


$(function(){
var id = 'return';
$(".tab-trigger .item").click(function(){
$(".tabs-wrap").stop().animate({marginLeft:"-"+$(this).index()*928+"px"},100);
id = $(this).data('id');
})
$('.ajax_return').bind('click',function(){
var ajax_return = $("form[name=ajax_return]").Validform({
showAllError:true,
ajaxPost:true,
callback:function(ret) {
if(ret.status == 0) {
$.tips({
icon:'error',
content:ret.message,
callback:function() {
return false;
}
});
} else {
$.tips({
icon:'success',
content:ret.message,
callback:function() {
window.location.reload();
}
});					
}
}
})
})

var uploader = WebUploader.create({
        auto:true,
        fileNumLimit:10,
        fileVal:'upfile',
        // swf文件路径
        swf: '<?php echo __ROOT__;?>statics/js/upload/uploader.swf',
        // 文件接收服务端。
        server: "<?php echo url('attachment/index/upload')?>",
        // 选择文件的按钮。可选
        formData:{
            file : 'upfile',
            upload_init : '<?php echo $attachment_init ?>'
        },
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: {
            id: '#add_return',
            multiple:true
        },
        // 压缩图片大小
        compress:false,
        accept:{
            title: '图片文件',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        chunked: false,
        chunkSize:1000000,
        resize: false
    })

    uploader.onUploadSuccess = function(file, response) {
    	if(response.status == 1) {
    		$('#add_return').parents('.ul_return').prepend('<li><a class="pic-center" href="'+ response.result.url +'" target="_blank"><img src="'+response.result.url+'"></a><input type="hidden" name="imgs[]" value="' + response.result.url + '"/><i class="pic-close text-center text-white">×</i></li>');
    	} else {
    		top.dialog({
title: '消息提示',
width: 300,
content: '<div class="padding-large text-center">'+response.message+'</div>',
okValue: '确定',
ok: function(){
},

})
.showModal();
    		return false;
    	}
    	$("li").hover(function(){
$(".pic-close").eq($(this).index()).show();
},function(){
$(".pic-close").eq($(this).index()).hide();
});
$(".pic-close").click(function(){
$(this).closest("li").remove();
});
    }


})
</script>