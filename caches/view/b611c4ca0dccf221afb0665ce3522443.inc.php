<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>statics/js/upload/uploader.css?v=<?php echo HD_VERSION;?>" />
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/upload/uploader.js?v=<?php echo HD_VERSION;?>"></script>
<div class="margin-big-top layout">
<div class="container border border-light-gray member clearfix">
<div class="right padding-top">
<div class="clear"></div>
<div class="margin-big-top margin-large-left margin-bottom padding-left process clearfix">
<!--退货退款 开始-->
<?php if($servers['return_id'] && !$servers['refund_id']) { ?>
<?php if($servers['status'] == -1) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list proce-left all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家已取消退款</span>
</div>
</div>
</li>
</ul>
<?php } elseif($servers['status'] == -2) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list proce-left all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家已拒绝退款</span>
</div>
</div>
</li>
</ul>
<?php } else { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请退货退款</span>
</div>
</div>
</li>
<li class="process-list all">
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
<?php } ?>
<!--退货退款 结束-->
<!--仅退款 开始-->
<?php if($servers['refund_id'] && !$servers['return_id']) { ?>
<?php if($servers[status] == -1) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list proce-left all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家已取消退款</span>
</div>
</div>
</li>
</ul>
<?php } elseif($servers[status] == -2) { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list proce-left all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家已拒绝退款</span>
</div>
</div>
</li>
</ul>
<?php } else { ?>
<ul class="margin-big-left">
<li class="process-list proce-right all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">买家申请仅退款</span>
</div>
</div>
</li>
<li class="process-list all">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">卖家处理退货申请</span>
</div>
</div>
</li>
<li class="process-list proce-left <?php if($servers[status] == 2) { ?>all<?php } ?>">
<div class="proce"></div>
<div class="node">
<div class="item">
<span class="text-drak-grey">退款完成</span>
</div>
</div>
</li>
</ul>
<?php } ?>
<?php } ?>
<!--仅退款 结束-->
</div>
<div class="margin-big-left margin-big-right margin-big-bottom tabs-scroll">
<div class="border border-light-gray padding-big ">
<div class="double-line clearfix">
<div class="list">
<?php if($servers['refund_id'] && !$servers['return_id']) { ?>
<?php if($servers[status] == 0) { ?>
<b class="text-default">您已申请成功，等待卖家处理</b>
<?php } elseif($servers[status] == -2) { ?>
<b class="text-default">您的退款申请失败，请联系人工处理</b>
<?php } elseif($servers[status] == -1) { ?>
<b class="text-default">您的退款申请已取消！</b>
<?php } else { ?>
<b class="text-default">您的退款申请已退款成功</b>
<?php } ?>
<?php } else { ?>
<?php if($servers['status'] == 0) { ?>
<b class="text-default">您已申请成功，等待卖家处理</b>
<?php } elseif($servers['status'] == -2) { ?>
<b class="text-default">您的退货申请失败，请联系人工处理</b>
<?php } elseif($servers['status'] == -1) { ?>
<b class="text-default">您的退货申请已取消！</b>
<?php } else { ?>
<b class="text-default">您的申请已通过，请退货并填写退货信息</b>
<?php } ?>
<?php } ?>
<p class="text-gray">·如果卖家同意，您可以退货给卖家并完成退款</p>
<p class="text-gray">·如果卖家拒绝，需要您修改退货并退款申请</p>
<p class="text-gray">·每个商品&订单您只有一次售后维权的机会</p>
</div>
<div class="list margin-top">
<?php if($servers['refund_id'] && !$servers['return_id']) { ?>
<?php if($servers['status'] == 0) { ?>
<input type="submit" class="fl margin-right button bg-gray" disabled="disabled" value="等待卖家处理">
<input type="submit" class="fl button bg-gray cancel_refund_delivery" value="取消退货申请">
<?php } ?>
<?php } else { ?>
<?php if($servers['status'] == 0) { ?>
<input type="submit" class="fl margin-right button bg-gray" disabled="disabled" value="等待卖家处理">
<input type="submit" class="fl button bg-gray cancel_return_delivery" value="取消退货申请">
<?php } elseif($servers['status'] == 1) { ?>
<a class="fl margin-right padding-lr cheng-btn" href="<?php echo url('return_refund',array('id'=>$_GET['id'],'type' => 'delivery'));?>">退货并填写退货信息</a>
<input type="submit" class="fl padding-lr cheng-btn cancel_return_delivery" value="取消退货申请">
<?php } ?>
<?php } ?>
</div>
</div>
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
$('.cancel_return_delivery').bind('click',function(){
var url = "<?php echo url('ajax_return_cancel')?>";
var id = "<?php echo $_GET['id']?>";
$.dialogConfirm({
content: '每件商品仅有一次售后机会，是否确认取消?',
callback: function(){
$.post(url,{id:id},function(ret){
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
},'json')
}
})
})
$('.cancel_refund_delivery').bind('click',function(){
var url = "<?php echo url('ajax_refund_cancel')?>";
var id = "<?php echo $_GET['id']?>";
$.dialogConfirm({
content: '每件商品仅有一次售后机会，是否确认取消?',
callback: function(){
$.post(url,{id:id},function(ret){
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
},'json')
}
})
})
})
</script>