<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
$('title').html('订单提交');
</script>
<script type="text/javascript">
var setting = {};
setting = <?php echo json_encode($setting);?>;
var skuids = '<?php echo $_GET["skuids"] ?>';
var delivery_url = '?m=order&c=order&a=get_deliverys&skuids='+ skuids;
</script>
<!-- 头部 -->
<div class="header container">

</div>
<div class="layout border-top cart-btn-wrap">
<!--坐标位置-->
<div class="container clearfix">
</div>
<!--订单结算内容-->
<div class="container order-settlement clearfix margin-top">
<dl class="settlement-lists layout border-bottom border-black">
<dt id="notice">选择收货地址：</dt>
<dd>
<div class="choose-address-lists clearfix" data-model="districts">

<?php $i = 0; ?><?php if(is_array($address)) foreach($address as $addr) { ?><div class="address-list adddiv <?php if(($addr['isdefault']==1)) { ?>choose<?php } ?>" data-district="<?php echo $addr['district_id'];?>" data-addresid="<?php echo $addr['id'];?>">
<div class="name border-bottom border-black">
<span class="city text-ellipsis" title="<?php echo $addr['_area'];?>"><?php echo $addr['_area'];?></span>
<span class="name-text margin-small-left text-ellipsis" title="<?php echo $addr['name'];?> 收">（<?php echo $addr['name'];?> 收）</span>
<a class="fr text-sub <?php if(($addr['isdefault']!=1)) { ?>hidden<?php } ?> update" data-iframe="true" href="<?php echo url('member/address/edit',array('id'=>$addr['id']));?>">修改</a>
</div>
<div class="detail">
<p><?php echo $addr['address'];?></p>
</div>
</div>
<?php $i++ ; ?>
<?php } ?>
<a class="address-list new-address" data-iframe="true" href="<?php echo url('member/address/add');?>"><i></i>添加新地址</a>
</div>
</dd>
</dl>
<dl class="settlement-lists layout border-bottom border-black padding-big-bottom" data-model="pays">
<dt>选择支付方式：</dt>
<dd class="item-checked"><?php if(is_array($pay_type)) foreach($pay_type as $k => $v) { ?><div class="item" data-id="<?php echo $k;?>">
<a href="javascript:;"><?php echo $v;?></a>
</div>
<?php } ?>
</dd>
</dl>
<dl class="settlement-lists layout">
<dt>配送清单：<a class="fr text-main text-gray-666 aho " href="<?php echo url('order/cart/index');?>">返回购物车修改</a></dt>
</dl>
<div class="fl layout padding-big-left padding-big-right border-bottom border-black clearfix"><?php if(is_array($carts['skus'])) foreach($carts['skus'] as $sellerid => $cart) { ?><div class="bill-wrap" data-sellerid="<?php echo $sellerid;?>">
<div class="goods-bill ">
<dl class="settlement-lists logistics layout border-bottom border-gray-white">
<dt>选择配送方式：</dt>
<dd class="item-checked" data-event="balance" data-model="delivery">
<?php if((empty($carts['deliverys'][$sellerid]))) { ?>
<p class="margin-bottom text-mix">您所选择的收货地址暂时无法配送</p>
<?php } else { ?>
<?php $i = 0; ?><?php if(is_array($carts['deliverys'][$sellerid])) foreach($carts['deliverys'][$sellerid] as $delivery) { ?><div class="item <?php if(($i == 0)) { ?>selected<?php } ?>" delivery-district-id="<?php echo $delivery['delivery_id'];?>">
<a href="javascript:;"><?php echo $delivery['_delivery']['name'];?></a>
</div>
<?php $i++; ?>
<?php } ?>
<?php } ?>
</dd>
</dl>

<div class="fl bill-ohter">
<input class="fl input border-gray-white" type="text" data-model="remarks" placeholder="请填写给商家的留言" />
</div>
</div>
<div class="settlement-cart-wrap cart-wrap text-default clearfix"><?php if(is_array($cart[sku_list])) foreach($cart[sku_list] as $v) { ?><div class="tr sku" data-skuid="<?php echo $v['_sku_']['sku_id'];?>">
<div class="cart-pic margin-large-left"><img src="<?php echo $v['_sku_']['thumb'];?>" /></div>
<div class="cart-info">
<p class="text-ellipsis"><?php if($v['_sku_']['brand']['name']) { ?><?php echo $v['_sku_']['brand']['name'];?>——<?php } ?><?php echo $v['_sku_']['name'];?></p>
<p class="text-ellipsis">尺寸：
<!--不知道为什么$v['_sku_']['spec'][0]['value']-->
<!--直接这样拿值 就不显示了 扯淡。。-->
<?php
$arrs = $v['_sku_']['spec'][0];
if($arrs){
$sparr = explode('/', $arrs['value']); echo $sparr[0];
}
?>
</p>
</div>
<div class="cart-price text-center">
<span>￥<?php echo $v['_sku_']['prom_price'];?></span>

</div>
<div class="cart-nums text-center">
<span>x &nbsp;&nbsp;&nbsp;<?php echo $v['number'];?></span>
</div>
<div class="cart-total text-center" data-model="sku_shop_price">
<br>
<span class="text-mix"><?php echo $v['prices'];?></span>
<?php if($v[_promos]) { ?>
<p class="text-small text-gray hidden">优惠：<em>0.00</em></p>
<?php } ?>
</div>
<div class="fl margin-top layout text-small text-lh-small" data-model="give"></div>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
</div>
<?php if(($setting['invoice_enabled'] == 1)) { ?>
<?php } ?>
<div class="settlement-lists layout settlement-total text-right text-gray-666 border-bottom border-gray-white padding-bottom">
<p>共 <span class="text-mix" data-model="counts"><?php echo $carts['sku_numbers'];?></span> 件商品　商品总额：<span class="text-right" data-model="sku_total"><?php echo $carts['sku_total'];?></span></p>
<p>总运费：<span class="text-right" data-model="deliverys_total"><?php echo $carts['deliverys_total'];?></span></p>
<p>发票税额：<span class="text-right" data-model="invoice_tax"><?php echo $carts['invoice_tax'];?></span></p>
<p>活动优惠：<span class="text-right text-mix" data-model="promot_total"><?php echo $carts['promot_total'];?></span></p>
<!-- <p>优惠券优惠：<span class="text-right text-mix">-0.00</span></p> -->
</div>
<div class="settlement-lists layout clearfix">
<div class="fr padding-big-top padding-big-bottom text-right cart-settle">
<p class="fl h3">应付订单总额：<span class='text-mix'>￥</span><span class="text-mix" data-model="real_amount"><?php echo $carts['real_amount'];?></span></p>
<a class="cart-btn fr text-default cheng-button" id="submit"><b>提交订单</b></a>
</div>
</div>
</div>
</div>

<!--底部-->
<?php include template('artels-footer','common');?>
<script>
$(function(){
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});
hd_order._get();

$('[data-iframe]').live('click',function(){
top.dialog({
url : $(this).attr('href'),
data: $(this).parents(".tr").data('id'),
title: 'loading',
width: 690,
onclose: function () {
if(this.returnValue&&this.returnValue=='ok'){
window.location.reload();
}
}
})
.showModal();
return false;
})
//发票切换
$(".receipt-choose .item").click(function(){
if($(this).index()==0){
$(".receipt-content").addClass("hidden");
}else{
$(".receipt-content").removeClass("hidden");
}
});
//优惠券选择
$(".coupon .choose-coupon").click(function(){
if($(this).parents(".coupon").hasClass("choose")){
$(this).parents(".coupon").removeClass("choose");
}else{
$(this).parents(".coupon").addClass("choose");
}
});
$(".coupon-content .item").click(function(){
$(".coupon-content-box").eq($(this).index()).removeClass("hidden");
$(".coupon-content-box").not($(".coupon-content-box").eq($(this).index())).addClass("hidden");
});

// 多的收货地址隐藏
if ($("[data-model=districts] .adddiv").length > 7) {
$("#notice").html('选择收货地址：<span class="show-add">显示全部地址</span>');
$("[data-model=districts] .adddiv:gt(6)").addClass('hidden');
}

/* 点击收货地址 */
$("[data-model=districts] div.address-list").live("click",function(){
// 隐藏/显示修改
$(this).addClass("choose").siblings().removeClass("choose");
$("[data-model=districts] .name a").addClass('hidden');
$("[data-model=districts]").find(".choose .name a").removeClass('hidden');
hd_order._get_deliverys($(this).data('district'));
});

/* 得到订单数据 */
$("[data-event='balance']").live("click", function(){
hd_order._get();
});

$("[data-model='order_proms']").live("change", function(){
hd_order._get();
});

/* 商品促销 */
$("[data-model=sku_proms]").find('.cart-btn').click(function() {
var $_this = $(this).parents("[data-model=sku_proms]"),
$_input = $_this.find("input[type=radio]:checked");
$_this.addClass("hidden");
if($_input.data('type') == 'amount_discount' || $_input.data('type') == 'number_discount') {
$_this.parents('.cart-price').siblings("[data-model='sku_shop_price']").find("p > em").html('-' + $_input.data('discount'));
$_this.parents('.cart-price').siblings("[data-model='sku_shop_price']").find("p").removeClass('hidden');
} else {
$_this.parents('.cart-price').siblings("[data-model='sku_shop_price']").find("p").addClass('hidden');
}
});

/* 点击发票 */
$("#invoice .receipt-choose .item").live("click",function() {
hd_order._invoice($(this));
})

})
</script>
<script type="text/javascript" src="template/default/statics/js/order.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript">hd_order.init();// 初始化订单</script>