<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<div class="margin-big-top layout" style="margin-bottom:70px;">
<div class="container  member clearfix">
<div class="right padding-big-left " >
<div class="member-order-top margin-top margin-bottom small-search clearfix" >
<div class="fl padding-small-top" style="margin-top:50px;">
<ul class="order-menu">
<li><a <?php if((!isset($_GET[type])|| !in_array($_GET[type],array(1,3,4,7)))) { ?>class="current"<?php } ?> href="<?php echo url('member/order/index');?>">全部订单</a></li>
<li><a <?php if(($_GET[type] == 1)) { ?>class="current"<?php } ?> href="<?php echo url('member/order/index',array('type'=>1));?>">待付款(<?php echo $this->counts[pay] ?>)</a></li>
<li><a <?php if(($_GET[type] == 3)) { ?>class="current"<?php } ?> href="<?php echo url('member/order/index',array('type'=>3));?>">待发货(<?php echo $this->counts[delivery] ?>)</a></li>
<li><a <?php if(($_GET[type] == 4)) { ?>class="current"<?php } ?> href="<?php echo url('member/order/index',array('type'=>4));?>">待收货(<?php echo $this->counts[receipt] ?>)</a></li>
<div class="mat"></div>
</ul>
</div>
<div class="fr search border" style="margin-top:50px;">
<form class="clearfix" name="form-search" method="get">
<input type="hidden" name="m" value="member"/>
<input type="hidden" name="c" value="order" />
<input type="hidden" name="a" value="index" />
<input class="input border-none bg-none fl" type="text" placeholder="<?php if($_GET[sn]) { ?><?php echo $_GET['sn'];?><?php } else { ?>请输入订单号<?php } ?>" name="sn" />
<input class="button text-small text-white radius-none border-none bg-gray-white fr" type="submit" value="查询">
</form>
</div>
</div>
<div class="table-wrap">
<div class="order-table-th text-center">
<div class="td"><div class="column-wide">订单详情</div></div>
<div class="td"><div class="column-narrow">收货人</div></div>
<div class="td"><div class="column-narrow">总计</div></div>
<div class="td">
<div class="column-narrow o-stutas-filter">
<div><span class="open">全部状态<b></b></span></div>
<dl class="order-stutas bg-white hidden">
<dt>全部状态<b></b></dt>
<dd <?php if(!isset($_GET[type])) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index');?>">全部状态</a></dd>
<dd <?php if(($_GET[type] == 1)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>1));?>">等待付款</a></dd>
<dd <?php if(($_GET[type] == 2)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>2));?>">等待确认</a></dd>
<dd <?php if(($_GET[type] == 3)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>3));?>">等待发货</a></dd>
<dd <?php if(($_GET[type] == 4)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>4));?>">等待收货</a></dd>
<dd <?php if(($_GET[type] == 5)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>5));?>">交易完成</a></dd>
<dd <?php if(($_GET[type] == 6)) { ?>class="selected"<?php } ?>><b></b><a href="<?php echo url('member/order/index',array('type'=>6));?>">交易取消</a></dd>
</dl>
</div>
</div>
<div class="td"><div class="column-narrow" style="margin-left:136px;">操作</div></div>
</div><?php if(is_array($orders)) foreach($orders as $r) { ?><div class="margin-top order-table border finish-order">
    <div class="split-th split-gray">
        <div class="td order-time"><?php echo date('Y-m-d H:i:s' ,$r[system_time]);?></div>
        <div class="td order-num">
        	订单号：<span class="text-drak-grey"><?php echo $r['sn'];?></span>
        	<i class="arrow"></i>
        </div>
        <?php if(($r[_showsubs] == TRUE)) { ?>
        	<div class="td margin-big-left">商品属不同商家或在不同库房，故拆分为以下订单分开配送，给您带来的不便敬请谅解。</div>
        <?php } else { ?>
        	<?php if((count($r[_subs][0][_group]) > 1)) { ?>
        	<div class="td margin-big-left">商品在不同库房，故拆分为以下分开配送，给您带来的不便敬请谅解。</div>
        	<?php } ?>
        <?php } ?>
    </div>
    <div class="split-th">
        <div class="td order-time">支付方式：<?php echo $r['_pay_type'];?></div>
        <div class="td order-num">订单总额：￥<?php echo $r['real_amount'];?></div>
        <div class="td w30">运费总额：￥<?php echo $r['delivery_amount'];?></div>
        <div class="td">订单状态：<?php if(($r[_showsubs] == TRUE)) { ?>已拆分<?php } else { ?><?php echo ch_status($r[_status][wait]);?><?php } ?></div>
    </div>
    <!-- 促销样式 -->
    <!-- 循环子订单 -->
    <?php if(is_array($r['_subs'])) foreach($r['_subs'] as $sub) { ?>    	<?php if($sub[promotion]) { ?>
    <div class="th split-order">
        <span class="text-mix"><em class="bg-light-red padding-small margin-right text-white">订单促销</em><?php echo $sub['promotion']['title'];?></span>
    </div>
    <?php } ?>
    <?php if(($r[_showsubs] == TRUE)) { ?>
    <div class="th split-order">
        <div class="td order-time"><?php echo date('Y-m-d H:i:s' ,$sub[system_time]);?></div>
        <div class="td order-num">
        	订单号：<span class="text-drak-grey"><?php echo $sub['sub_sn'];?></span>
        </div>
        <div class="td w30">商家名称：<span class="text-drak-grey">平台自营</span></div>
    </div>
    <?php } ?><?php if(is_array($sub[_group])) foreach($sub[_group] as $o_d_id => $v) { ?><div class="line">
        <div class="td order-table-info">
        <?php if(is_array($v[lists])) foreach($v[lists] as $sku) { ?>            <div class="column-wide clearfix" data-skuid="<?php echo $sku['sku_id'];?>" data-number="<?php echo $sku['buy_nums'];?>">
                <div class="goods-pic">
                    <a href="<?php echo url('goods/index/worksDetail',array('sku_id'=>$sku['sku_id']));?>"><img src="<?php echo $sku['sku_thumb'];?>" /></a>
                </div>
                <div class="goods-name">
                    <p class="fl name">
                                                        <a href="<?php echo url('goods/index/worksDetail',array('sku_id'=>$sku['sku_id']));?>"><?php echo $sku['sku_name'];?></a>
                    </p>
                    <p><?php echo $sku['_sku_spec'];?></p>
                    <!-- 商品促销样式 -->
                    <?php if(($sku[is_give] == 1)) { ?>
                    	<span class="text-mix text-lh-little margin-little-top show"><em class="fl bg-blue padding-small-left padding-small-right margin-right text-white">赠品</em></span>
                    <?php } ?>
                    <?php if(($sku[promotion])) { ?>
                    	<span class="text-mix text-lh-little margin-little-top show text-ellipsis"><em class="fl bg-light-red padding-small-left padding-small-right margin-right text-white"><?php echo ch_prom($sku[promotion][type]);?></em><?php echo $sku['promotion']['title'];?></span>
                    <?php } ?>
                </div>
                <div class="service text-gray">
                    <span class="yahei">&times;<?php echo $sku['buy_nums'];?></span>
                </div>
            </div>
        <?php } ?>
        	</div>
        <div class="td column-narrow"><?php echo $r['address_name'];?></div>
        <div class="td column-narrow">
            <b class="yahei">￥<?php echo $v['total_amount'];?></b><br/>
            <!-- <span class="text-gray songti text-small"><?php echo $r['_pay_type'];?></span> -->
        </div>
        <div class="td column-narrow">
        	<span class="text-gray"><?php echo ch_status($v[_status]);?></span>
            <br />
        	<?php if(($o_d_id > 0)) { ?>
        		<span><a class="ahoc" href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn],'o_d_id' =>$o_d_id));?>">订单详情</a></span>
        	<?php } else { ?>
            		<span><a class="ahoc" href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn]));?>">订单详情</a></span>
        	<?php } ?>
            <!-- <span><a href="return&refund.html">退换货</a></span> -->
        </div>
        <div class="td column-narrow">
            <div class="fl padding-left" pay-type="<?php echo $sub['pay_type'];?>" order-sn="<?php echo $r['sn'];?>" sub-sn="<?php echo $sub['sub_sn'];?>">
                <?php if(($r[status] == 1 && $r[pay_type] == 1 && $r[pay_status] == 0)) { ?>
                	<a class="cheng-btn obtn2 show margin-small-bottom" href="<?php echo url('order/order/detail',array('order_sn'=>$r[sn]));?>" title="点此去支付该订单">支付订单</a>
                <?php } ?>
                <?php if(($sub[status] == 1 && $sub[confirm_status]!=2)) { ?>
                	<a class=" cheng-btn obtn1 show margin-small-bottom action_cancel"  href="javascript:;">取消订单</a>
                <?php } ?>
                <?php if(($sub[finish_status] == 2 || $r[status] != 1)) { ?>
                	<a class="cheng-btn obtn1 show margin-small-bottom action_again" href="javascript:;">再次购买</a>
                <?php } ?>
                <?php if(($sub['status']==1 && $o_d_id > 0 && $v['delivery']['isreceive'] == 0)) { ?>
                	<a class="cheng-btn obtn3 show margin-small-bottom action_finish" href="javascript:;" o-d-id="<?php echo $o_d_id;?>">确认收货</a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
<div class="paging margin-top  padding-tb clearfix" data-page="<?php echo $_GET['page'];?>">
<ul class="fr"><?php echo $pages;?></ul>
</div>
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
})
$(window).load(function(){
if($(".finish-order").length<=0){
$(".order-table-th").after('<p class="margin-big-top text-center">暂无订单信息！</p>');
}
})

$(".o-stutas-filter .open").click(function(){
$(".o-stutas-filter .order-stutas").removeClass("hidden");
});
$(".o-stutas-filter .order-stutas dt").click(function(){
$(this).parent().addClass("hidden");
});
$(".o-stutas-filter .order-stutas dd").click(function(){
$(this).addClass("selected").siblings().removeClass("selected");
$(this).parent().addClass("hidden");
});

$(".order-menu li a").bind('mouseover',function(){
var _left = $(this).offset().left-$(".order-menu").offset().left;
$(".mat").stop().animate({left:_left+"px",width:$(this).width()},300);
});
$(".order-menu").bind('mouseleave',function(){
orderMenuAutoSlide(300);
});
function orderMenuAutoSlide(timer){
var num = 0;
var width = 0;
$(".order-menu li").each(function(){
if($(this).children("a").hasClass("current")){
num = $(this).children("a").offset().left;
width = $(this).children("a").width();
}
});
$(".mat").stop().animate({left:num-$(".order-menu").offset().left+"px",width:width},timer).show();
}
orderMenuAutoSlide(0);

//已完成订单的订单删除按钮
$(".finish-order").hover(function(){
$(this).find(".reclaim").show();
},function(){
$(this).find(".reclaim").hide();
});
</script>