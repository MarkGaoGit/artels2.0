<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<!-- 头部 -->
<div class="header container">
</div>
<!--坐标位置-->
<div class="layout border-top cart-btn-wrap">
<div class="container order text-default">
<div class="padding-small order-container">
<div class="order-ok-wrap padding-top padding-big-bottom padding-large-left padding-large-right">
<div class="text-center order-tip">
<?php if(($order[pay_type] == 1)) { ?>
<div class="order-info text-gray-666  padding-small-top padding-small-bottom padding-large-left padding-large-right ">
<p>订单已经支付成功，我们会尽快为您发货！ <span class="text-sub">订单号：<?php echo $order_sn;?></span></p>
<p>已付订单总额：<span class="text-mix">￥<?php echo $order['real_amount'];?></span></p>
<p class="text-sub">我们会尽快确认订单，感谢您的支持</p>
</div>
<?php } else { ?>
<div class="order-info text-gray-666 padding-small-top padding-small-bottom padding-large-left padding-large-right ">
<p>订单提交成功，我们会尽快为您发货！ <span class="text-sub">订单号：<?php echo $order_sn;?></span></p>
<p>应付订单总额：<span class="text-mix">￥<?php echo $order['real_amount'];?></span></p>
<p class="text-sub">您选择了货到付款，请在收货后进行付款</p>
</div>
<?php } ?>
<a class="view-order cart-btn chengs-button" href="<?php echo url('member/order/index');?>">查看订单</a>
</div>
</div>
</div>
</div>
</div>

<!--底部-->
<?php include template('artels-footer','common');?>
<script>
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});
</script>