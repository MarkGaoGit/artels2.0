<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
$('title').html('我的购物车');
</script>
<!-- 头部 -->
<div class="header container">
<div class="margin-bottom item-blue-top content1200 art">
<div class="artlogo fl">
<img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt="">
</div>
</div>
<div class="clear"></div>
</div>
<!--坐标位置-->
<div class="layout">
<div class="container clearfix">
<div class="fl cart-address text-default text-gray-666">我的购物车</div>
</div>
<div class="container cart-wrap check-fun" id="lists-box">
<div class="margin-big-bottom border border-gray-white">
<div class="tr"><div class="text-center lh-heigth">loading...</div></div>
</div>
<script type="text/javascript">hd_cart._lists();</script>
</div>
</div>
<div id="fixed ">
<div class="layout cart-btn-wrap padding-top padding-bottom ">
<div class="container text-default cart-settle clearfix">
<label class="fl margin-big-left margin-big-right checkbox text-gray-666">
<input id="all_check" class="margin-right check_all " type="checkbox" checked="checked" />全选
</label>
<a href="<?php echo url('goods/index/works');?>" class="text-gray-666 aho">继续购物</a>
<?php if(($carts[sku_counts] > 0)) { ?>
&nbsp;| &nbsp;<a id="clears" href="javascript:;" class="text-gray-666 aho">清空购物车</a>
<?php } ?>
<em class="sold-box hidden">&nbsp;| <a id="clear_sold_out" href="javascript:;">清除已售罄商品</a></em>
<div class="fr text-right">
<p class="fl">总价（不含运费）：<span class="text-mix h3">￥<em data-id="totle">0.00</em></span></p>
<a class="cart-btn fr text-big-small  cheng-button <?php if((count($carts['all_count']) == 0)) { ?>gray-btn<?php } ?>" data-id="settlement" href="javascript:;">结算</a>
</div>
</div>
</div>
</div>
<?php include template('artels-footer','common');?>

<script>
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});

$(function(){
var $height = $(".cart-btn-wrap").outerHeight(true);
var $top = $("#fixed").offset().top;
if($(window).height()<$top){
$(".cart-btn-wrap").addClass("fixed-cart");
}
function scrollFixed(){
if($("#fixed")==undefined) return false;
var t = $top - $(window).height() + $height;
if($(window).scrollTop()>t){
$(".cart-btn-wrap").removeClass("fixed-cart");
}else{
$(".cart-btn-wrap").addClass("fixed-cart");
}
}
scrollFixed();
$(window).scroll(function(){
scrollFixed();
})
$(window).resize(function(){
scrollFixed();
});

$(".spec-hand").live('click',function(){
top.dialog({
url : "<?php echo url('order/cart/goods_spec')?>"+"&sku_id="+$(this).parents(".tr").data("skuid"),
data: $(this).parents(".tr").data("skuid"),
title: 'loading',
width: 880,
onclose: function () {
if(this.returnValue){	// 确定修改skuid后回调
// 修改购物车数据
$.getJSON("<?php echo url('order/cart/change_skuid') ?>", {old_skuid: this.returnValue[0] , new_skuid: this.returnValue[1].sku_id}, function(ret) {
if (ret.status == 1) {
hd_cart._lists();	// 重新载入购物车列表信息
}
});
// return false;
// resetCartList(this.returnValue);
}
}
})
.showModal();
});
function resetCartList(c){
var $o = $("#"+c[0]);
var $json = c[1];
if($json.imgs!=''){
var $imgs = eval($json.imgs);
$o.find(".cart-pic img").attr("src",$imgs[0]);
}
//$o.find(".cart-info p:first-child").html($json.sku_name);
var specall = eval($json.spec);
var spectxt = '';
$.each(specall,function(){
spectxt += '<span class="text-main">'+this.name+'：</span>'+this.value+'&emsp;';
})
$o.find(".cart-info p:last-child").html(spectxt+'<span class="spec-hand"><b></b><em>修改</em></span>');
$o.find(".cart-info .title span").remove();
$o.find(".shop_price").html($json.shop_price);
var $total = parseFloat($json.shop_price*$o.find(".input").val());
$o.find(".cart-total span:first-child").html($total.toFixed('2'));
$o.attr("id",$json.sku_id);
}
})
</script>