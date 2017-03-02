<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<!--坐标位置-->
<div class="layout border-top cart-btn-wrap" >
<div class="container order border border-gray-white text-default" style="margin-top:130px;">
<div class="order-info bg-gray-white padding-small-top padding-small-bottom padding-large-left padding-large-right border-bottom">
<p>订单提交成功，请您尽快付款！ <span class="text-sub">订单号：<?php echo $gateway['order_sn'];?></span></p>
<p>应付订单总额：<span class="text-mix">￥<?php echo $gateway['total_fee'];?></span></p>
<p class="text-sub">您选择了微信扫码付款，请使用微信扫一扫功能扫码下方二维码完成付款</p>
</div>
<div class="padding-small order-container scan-code">
<div class="ecode-wrap">
<div class="ecode-pic border text-center">
<div data-model="qrcode" style="width:260px;height:260px;margin:0 auto;"></div>
</div>
<div class="ecode-text margin-big-top">
<span class="text-white">请使用微信扫一扫<br />扫描二维码支付</span>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/jquery.qrcode.min.js?v=<?php echo HD_VERSION;?>"></script>
<script type='text/javascript'>
var gateway = <?php echo json_encode($gateway);?>

if(gateway.gateway_type == 'qrcode') {
$("[data-model='qrcode']").qrcode({
render: "table",
width: 260,
height:260,
text: gateway.gateway_url
});
setInterval("checkStatus()",3000);
} else {
window.location.href  = gateway.gateway_url;
}
function checkStatus(){
$.getJSON('<?php echo url("pay/index/ajax_check")?>',{order_sn:'<?php echo $gateway['order_sn']?>'},function(ret){
if(ret.status==1){
location.href = '<?php echo $gateway['url_forward'];?>';
}
})
}
</script>
<!--底部-->
<?php include template('artels-footer','common');?>
<script>
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});
</script>