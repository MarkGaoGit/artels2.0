<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<div class="margin-big-top layout">
<div class="container border border-gray-white member clearfix">
<div class="right shoucang padding-big-left padding-big-right check-fun">
<div class="member-order-top margin-top margin-bottom small-search clearfix">
<div class="fl padding-small-top margin-big-top">
<div class="border-left border-middle border-sub padding-left">我的收藏</div>
</div>
<div class="fr search border margin-big-top">
<form class="clearfix" name="form-search" action="<?php echo __APP__;?>" method="get">
<input type="hidden" name="m" value="member">
<input type="hidden" name="c" value="favorite">
<input type="hidden" name="a" value="index">
<input class="input border-none bg-none fl" type="text" name="sku_name" placeholder="请输入商品名称" value="<?php echo $_GET['sku_name'];?>">
<input class="button text-small text-white radius-none border-none bg-gray-white fr cearch" type="submit" value="搜索">
</form>
</div>
</div>
<div class="padding border bg-gray-white">
<label class="margin-right"><input class="margin-right va-m check-switch" type="checkbox" />全部</label>
<a class="margin-large-left margin-right text-sub " href="javascript:;">加入购物车</a>|
<a class="margin-left text-sub" href="<?php echo url('member/favorite/delete');?>" data-ajax="true">取消收藏</a>
</div>

<!--商品列表-->
<div class="collect-list list-wrap fav-lists">
<ul class="list-h clearfix"><?php if(is_array($lists)) foreach($lists as $r) { ?><li class="fl">
<div class="lh-wrap">
<div class="p-img">
<a href="<?php echo url('goods/index/worksDetail',array('sku_id'=>$r['sku_id']));?>"><img src="<?php echo $r['_sku']['thumb'];?>" width="240" height="240" /></a>
</div>
<div class="p-name check-child padding-left" style="height:30px;">
<input type="checkbox" name="sku_id[]" value="<?php echo $r['sku_id'];?>" />
<a href="<?php echo url('goods/index/worksDetail',array('sku_id'=>$r['sku_id']));?>"><?php echo $r['sku_name'];?></a>
</div>
<div class="p-price margin moneys">
<span class="text-mix">￥<?php echo $r['_sku']['shop_price'];?></span>
</div>
<div class="p-hand text-right margin-big-bottom">
<div class="short-share" style="width:84%;margin-left:8%;">
<?php if($r['_sku']['number'] > 0) { ?>
<a class="button fl add_cart" data-id="<?php echo $r['sku_id'];?>">加入购物车</a>
<?php } else { ?>
<span class="fl">商品已售罄</span>
<?php } ?>
<a class="button " id="cancel_favorite" data-id="<?php echo $r['sku_id'];?>" >取消收藏</a>
</div>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<?php if($lists) { ?>
<div class="paging margin-top padding-tb clearfix" data-id="<?php echo $_GET['id'];?>" data-price="<?php echo $_GET['price'];?>" data-brandId="<?php echo $_GET['brand_id'];?>" >
<?php echo $pages?>
</div>
<?php } ?>
</div>
</div>
</div>
<?php include template('artels-footer','common');?>


<script type="text/javascript">

$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});

var url = "<?php echo url('order/cart/cart_add')?>";

$(function(){
//点击到指定页
$(".paging .button").click(function(){
jump_to_page(this);
});
//回车到指定页
$(".paging input[name=page]").live('keyup',function(e){
if(e.keyCode == 13){
jump_to_page(this);
}

});
});




$('.add_cart').bind('click',function(){
var url = "<?php echo url('order/cart/cart_add')?>";
var params = {};
sku_id = parseInt($(this).attr("data-id"));
nums = 1;
params[sku_id] = nums;
$.getJSON(url,{params:params},function(ret){
if(ret.status == 0) {
$.tips({
icon:'error',
content:ret.message,
callback:function() {
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
})
})
$('.margin-large-left').bind('click',function(){
var url = "<?php echo url('order/cart/cart_add')?>";
var params = {};
$('input[name="sku_id[]"]:checked').each(function(){
var sku_id = $(this).val();
params[sku_id] = 1;
})
$.getJSON(url, {params:params}, function(ret) {
if(ret.status == 0) {
$.tips({
icon:'error',
content:ret.message,
callback:function() {

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
})
})
$('#cancel_favorite').live('click',function(){
var sku_id = $(this).data('id');
var url = "<?php echo url('member/favorite/delete')?>";
$.getJSON(url,{sku_id:sku_id},function(ret){
if(ret.status == 0) {
$.tips({
icon:'error',
content:ret.message,
callback:function() {

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
})
})
$('[data-ajax]').click(function() {
var sku_id = [];
$('input[name="sku_id[]"]:checked').each(function(){
sku_id.push($(this).val());
})
if(sku_id.length == 0) {
top.dialog({
title: '消息提示',
width: 300,
content: '<div class="padding-large text-center">请选择商品</div>',
okValue: '确定',
ok: function(){
},
})
.showModal();
return false;
}
$.getJSON($(this).attr('href'), {sku_id:sku_id}, function(ret) {
if(ret.status == 0) {
$.tips({
icon:'error',
content:ret.message,
callback:function() {

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
})
return false;
})
</script>