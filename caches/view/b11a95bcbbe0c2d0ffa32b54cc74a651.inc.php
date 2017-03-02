<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script type="text/javascript" src="template/default/statics/js/detail-pay.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript">
var order = <?php echo json_encode($order);?>;
var member = <?php echo json_encode($member_info);?>;
hd_pay.init();
</script>
<!-- 头部 -->
<div class="header container">
</div>
<!--坐标位置-->
<div class="layout border-top cart-btn-wrap">
<div class="container order border border-gray-white text-default" style="margin-top:130px;">
<div class="order-info bg-gray-white padding-small-top padding-small-bottom padding-large-left padding-large-right border-bottom">
<p>订单提交成功，请您尽快付款！ <span class="text-sub">订单号：<?php echo $order_sn;?></span></p>
<p>应付订单总额：<span class="text-mix">￥<?php echo $order['real_amount'];?></span></p>
<p class="text-sub">请使用以下支付方式尽快完成付款</p>
</div>
<form action="<?php echo url('order/order/detail');?>" method="post" target="_blank" name="dopay">
<input type="hidden" name="order_sn" value="<?php echo $order_sn;?>" />
<input type="hidden" name="balance_checked" value="<?php if(($member_info['money'] > 0 && $balance_pay == 1)) { ?>1<?php } ?>" />
<input type="hidden" name="pay_code" value="" />
<input type="hidden" name="pay_bank" value="" />
<div class="padding-small order-container">
<?php if($balance_pay == 1) { ?>
<div class="balance border border-middle border-gray-white clearfix <?php if(($member_info['money'] > 0)) { ?>border-main<?php } ?>">
<label class="fl text-small pay-checkbox">
<input class="fl" type="checkbox" data-id="checkbox"/>
<p class="fl">账户余额 <span class="text-big"><?php echo sprintf("%.2f",$member_info[money]);?></span> 元 <p class="text-gray"></p>
</label>
<p class="fl text-small text-gray">【当前订单冻结金额：<span><?php echo sprintf("%.2f",$order[balance_amount]);?></span> 元】</p>
<p class="fr">支付 <b class="text-orange text-big">
<?php if ($member_info['money'] > $order['real_amount']-$order['balance_amount']) : ?>
<?php echo sprintf("%.2f",($order['real_amount'] - $order['balance_amount']));?>
<?php else: ?>
<?php echo sprintf("%.2f",$member_info[money]);?>
<?php endif; ?>
</b> 元</p>
</div>
<?php } else { ?>
<div class="balance" data-balance="0">
</div>
<?php } ?>
<div class="tip-title m-l-15 m-r-15 pays">
<span class="padding-large-left">支付方式</span>
<span class="padding-large-right fr text-red text-little" data-id="pay_amount">您还需在线支付：<em>0.00</em>元</span>
<div class="border border-mix"></div>
</div>
<div class="pay-way item-checked margin padding clearfix pays">
<?php if(empty($payments) && empty($banks)) : ?>
<span class="none_pays">后台暂未开启支付方式</span>
<?php else: ?><?php if(is_array($payments)) foreach($payments as $pay) { ?><div class="item" data-code="<?php echo $pay['pay_code'];?>" data-defaultbank="<?php echo $pay['pay_bank'];?>">
<i></i>
<a class="pic-center border-none" href="javascript:;"><img src="statics/images/banks/<?php echo $pay['pay_ico'];?>.png"/></a>
</div>
<?php } ?>
<?php endif; ?>
</div>
<div class="text-center">
<a class="cart-btn text-default chengs-button" id="subbtn" href="javascript:;">立即支付</a>
<a class="cart-btn text-default chengs-button margin-big-left" id="goback" href="javascript:;">返回上一级</a>
</div>
</div>
</form>
</div>
</div>
<?php include template('artels-footer','common');?>

<!-- 付款信息提示 -->
<div class="padding-large popup-item">
<p class="text-lh-little text-small">请问您完成付款了吗?<br />如没有,请在新打开的网上银行页面进行付款的操作<br />如果遇到问题，请联系客服人员</p>
</div>

<!--完成付款未成功时提示信息-->
<div class="padding-large popup-item">
<p class="text-lh-little text-small">充值失败或未确认！<br />未能收到来自银行的付款成功通知<br />如果您确认在网上银行已付款成功，系统将与所选择的网上银行进行对账。<br />若您的付款得到确认，订单将完成支付。</p>
</div>

<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>statics/js/dialog/ui-dialog.css?v=<?php echo HD_VERSION;?>" />
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/dialog/dialog-plus-min.js?v=<?php echo HD_VERSION;?>"></script>
<script>
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});

$("#goback").on('click',function(){
window.history.go(-1);
});


//付款信息提示
$("#subbtn").live('click',function(){
var top = dialog({
content: '<div class="padding-large"><p class="text-lh-little text-small">请问您完成付款了吗?<br />如没有,请在新打开的网上银行页面进行付款的操作<br />如果遇到问题，请联系客服人员</p></div>',
title: '提示信息',
width: 330,
okValue: '完成付款',
cancelValue: '返回选择其他银行',
ok: function(){
$.getJSON('?m=order&c=order&a=get_pay_status', {order_sn:"<?php echo $order_sn; ?>"}, function(ret) {
if(ret.status == 0) {
top.close();
pay_error();
} else {
window.location.href = ret.referer;
}
});
},
cancel: function(){
return true;
}
})
top.showModal();
return false;
});

//充值提示信息
function pay_error() {
top.dialog({
content: '<div class="padding-large"><p class="text-lh-little text-small">支付失败或未确认！<br />未能收到来自银行的付款成功通知<br />如果您确认在网上银行已付款成功，系统将与所选择的网上银行进行对账。<br />若您的付款得到确认，订单将完成支付。</p></div>',
title: '提示信息',
width: 460,
okValue: '我知道了',
ok: function(){return true;}
})
.showModal();
return false;
}
</script>