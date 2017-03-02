<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
$('title').html('订单详情');
</script>

<div class="margin-big-top layout">
<div class="container border border-gray-white member clearfix">
<div class="right padding-big-left padding-big-right line">
<div class="member-order-top margin-top margin-bottom small-search clearfix">
</div>
<?php if(!empty($detail)) { ?>
<div class="border border-gray-white bg-gray-white padding-small text-default clearfix">
<div class="fl margin-left w60">
<p style="line-height: 40px;">当前订单状态：<?php echo ch_status($detail[_status][wait]);?></p>

</div>
<div class="fr margin-right margin-small-top text-right" sub-sn="<?php echo $detail['sub_sn'];?>">
<?php if(($detail[status] == 1 && $detail[pay_type] == 1 && $detail[pay_status] == 0)) { ?>
<a class="button" href="<?php echo url('order/order/detail',array('order_sn' => $detail[order_sn]));?>" title="点此去支付该订单">支付订单</a>
                <?php } ?>
                <?php if(($detail[status] == 1 && $detail[confirm_status]!=2)) { ?>
                	<a class=" ocel cheng-btn action_cancel" href="javascript:;">取消订单</a>
                <?php } ?>
                <?php if(($detail[finish_status] == 2 || $detail[status] != 1)) { ?>
                	<a style="padding:0 10px;" class=" cheng-btn obtn1 show margin-small-bottom action_again" href="javascript:;">再次购买</a>
                <?php } ?>
<?php if((!empty($detail[_delivery]) && $detail[_delivery][isreceive] == 0)) { ?>
                	<a class="obtn obtn3 show margin-small-bottom action_finish" href="javascript:;" o-d-id="<?php echo $detail['_delivery']['id'];?>">确认收货</a>
<?php } ?>

</div>
</div>
<div class="margin-big-top margin-big-left process clearfix">
<ul>
<?php $i = 1; ?><?php if(is_array($detail[_axis])) foreach($detail[_axis] as $k => $_axi) { ?><li class="process-list <?php if(($i == 1)) { ?>proce-right<?php } elseif(($i == count($detail[_axis]))) { ?>proce-left<?php } ?> <?php if(($_axi!=0)) { ?>all<?php } ?>">
<div class="proce"></div>
<div class="node">
<div class="item">
<span><?php echo ch_status('time_'.$k);?></span>
</div>
</div>
</li>
<?php $i++; ?>
<?php } ?>
</ul>
</div>
<div class="margin-big-top border delivery-wrap clearfix">
<div class="dw-left border-right">
<div class="border-bottom text-lh-large padding-big-left title-tips">
<b class="text-default">订单信息</b>
</div>
<table class="margin-left margin-right margin-small-top margin-small-bottom">
<tr>
<td><span class="dw-label">收货姓名：</span></td>
<td><p><?php echo $detail['_main']['address_name'];?> 收</p></td>
</tr>
<tr>
<td><span class="dw-label">收货地址：</span></td>
<td><p><?php echo $detail['_main']['address_detail'];?></p></td>
</tr>
<tr>
<td><span class="dw-label">联系方式：</span></td>
<td><p><?php echo $detail['_main']['address_mobile'];?></p></td>
</tr>
<tr>
<td><span class="dw-label">买家留言：</span></td>
<td>
<p><?php if($detail[remark]) { ?><?php echo $detail['remark'];?><?php } else { ?>-<?php } ?></p>
</td>
</tr>
<tr class="border-bottom">
<td><span class="dw-label">发票信息：</span></td>
<td>
<?php if($detail[_main][invoice_title]) { ?>
<p>抬头：<?php echo $detail['_main']['invoice_title'];?></p>
<p>内容：<?php if($detail[_main][invoice_content]) { ?><?php echo $detail['_main']['invoice_content'];?><?php } else { ?>-<?php } ?></p>
<?php } else { ?>
<p>-</p>
<?php } ?>
</td>
</tr>
<tr>
<td><span class="dw-label">订单号：</span></td>
<td><p><?php if(($detail['_showsubs'] == true)) { ?><?php echo $detail['sub_sn'];?><?php } else { ?><?php echo $detail['order_sn'];?><?php } ?></p></td>
</tr>
<tr>
<td><span class="dw-label">支付方式：</span></td>
<td>
<p><?php if($detail[pay_type] == 1) { ?>在线支付<?php } else { ?>货到付款<?php } ?></p>
</td>
</tr>
<tr>
<td><span class="dw-label">运费：</span></td>
<td>
<p>￥<?php echo $detail['delivery_price'];?></p>
</td>
</tr>
<?php if(($detail[_main][invoice_title] && $detail[_main][invoice_content])) { ?>
<tr>
<td><span class="dw-label">发票税率：</span></td>
<td>
<p>+￥<?php echo $detail['_main']['invoice_tax'];?></p>
</td>
</tr>
<?php } ?>
<tr>
<td><span class="dw-label">应付金额：</span></td>
<td>
<p><span class="text-mix">￥<?php echo $detail['real_price'];?></span></p>
</td>
</tr>
<tr>
<td><span class="dw-label">实付金额：</span></td>
<td>
<p>
<span class="text-mix">￥<?php echo $detail['_main']['paid_amount'];?></span>
<?php if(($detail[pay_type] == 1)) { ?>
<?php if($detail[pay_status] == 0) { ?>（未支付）<?php } else { ?>（已付款）<?php } ?>
<?php } else { ?>
<?php if(($detail[finish_status] > 0)) { ?>（已付款）<?php } else { ?>（未支付）<?php } ?>
<?php } ?>
</p>
</td>
</tr>
<?php if((!empty($detail['_delivery']))) { ?>
<tr class="border-top">
<td><span class="dw-label">配送方式：</span></td>
<td><p><?php echo $detail['_delivery']['delivery_name'];?></p></td>
</tr>
<tr>
<td><span class="dw-label">配送单号：</span></td>
<td>
<p><?php if($detail['_delivery'][delivery_sn]) { ?><?php echo $detail['_delivery']['delivery_sn'];?><?php } else { ?>-<?php } ?></p>
</td>
</tr>
<?php } ?>
</table>
</div>
<div class="dw-right padding-left padding-big-right">
<p>订单跟踪</p><?php if(is_array($detail[_track])) foreach($detail[_track] as $k => $track) { ?><p <?php if($k == 0) { ?>class="text-sub"<?php } ?>><?php echo date('Y-m-d H:i:s',$track['time']);?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $track['msg'];?></p>
<?php } ?>
</div>
</div>
<div class="margin-big-top margin-big-bottom border order-handle">
<div class="clearfix order-table-info">
<div class="th">
<div class="td1">商品清单</div>
<div class="td2">数量</div>
<div class="td3">单价</div>
<div class="td4">优惠</div>
<div class="td5">操作</div>
</div><?php if(is_array($detail[_skus])) foreach($detail[_skus] as $sku) { ?><div class="td fl" data-skuid="<?php echo $sku['sku_id'];?>" data-number="<?php echo $sku['buy_nums'];?>">
<div class="td1 goods-info">
<div class="goods-pic pic-center"><a href="<?php echo url('goods/index/worksDetail',array('sku_id' => $sku['sku_id']));?>" target="_blank"><img src="<?php echo $sku['sku_thumb'];?>"></a></div>
<div class="goods-text clearfix">
<p class="title"><a href="<?php echo url('goods/index/worksDetail',array('sku_id'=>$sku['sku_id']));?>" ><?php echo $sku['sku_name'];?></a></p>
<p><?php echo $sku['_sku_spec'];?></p>
<?php if(($sku[is_give] == 1)) { ?>
<span class="text-lh-little margin-little-top show"><em class="fl bg-blue padding-small-left padding-small-right text-white">赠品</em></span>
<?php } ?>
<?php if(($sku[promotion])) { ?>
<span class="text-lh-little margin-little-top show text-ellipsis text-gray" title="<?php echo $sku['promotion']['title'];?>"><em class="fl bg-light-red padding-small-left padding-small-right text-white margin-small-right"><?php echo ch_prom($sku[promotion][type]);?></em><?php echo $sku['promotion']['title'];?></span>
<?php } ?>
</div>
</div>
<div class="td2">
<span>×<?php echo $sku['buy_nums'];?></span>
</div>
<div class="td3">
<span class="text-mix">￥<?php echo $sku['sku_price'];?></span>
</div>
<div class="td4">
<span>￥<?php echo $sku['sku_price']*$sku['buy_nums']+$detail['delivery_price']-$detail['_main']['paid_amount']?></span>
</div>
<div class="td5">
<div class="cart-hand">
<?php if(($sku[delivery_status] == 2)) { ?>
<?php if(($sku[_showserver] == 'true')) { ?>
<a class="default-btn chengs-button text-default margin-big-left" href="<?php echo url('member/service/return_refund',array('id' => $sku[id]));?>" target="_blank">售后</a>
<?php } ?>
<?php } ?>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<?php } else { ?>
<div class="border border-gray-white bg-gray-white padding-small text-default clearfix">
<div class="fl margin-left w80">
<p>当前订单不存在...</p>
</div>
</div>
<?php } ?>
</div>
</div>
</div>

<?php include template('artels-footer','common');?>


<script>
/*去除首页LOGO透明度 以及首页的70像素偏差*/
$('.logo').css({'opacity' : '1'});
$('.footer-70').css({'top' : '0'});
$('.artels-record').css({'top' : '0'});
</script>