<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/member.order.js?v=<?php echo HD_VERSION;?>"></script>

<div class="mui-content has-footer-bar order-pic">
    <div class="bg-white border-bottom padding-lr">
    	<div class="order-lh-40 border-bottom order-detail-info">
    		<span class="icon-15 mui-pull-left margin-small-right"><img src="<?php echo SKIN_PATH;?>statics/images/ico_20.png" /></span>
    		<span class="mui-pull-left margin-small-right">订单状态：<em class="text-org"><?php echo ch_status($detail[_status][wait]);?></em></span>
    		<span class="text-ellipsis mui-block mui-text-right">订单号：<em class="text-org"><?php if(($detail['_showsubs'] == true)) { ?><?php echo $detail['sub_sn'];?><?php } else { ?><?php echo $detail['order_sn'];?><?php } ?></em></span>
    	</div>
    	<div class="padding-tb ">
    		<div class="full hd-h4">
    			<span class=" mui-pull-left w50 text-ellipsis">收货人：<?php echo $detail['_main']['address_name'];?></span>
    			<span class="mui-pull-right text-ellipsis w50 mui-text-right">电话：<?php echo $detail['_main']['address_mobile'];?></span>
    		</div>
    		<div style="clear: both;"></div>
    		<p class="text-black margin-top">收货地址：<?php echo $detail['_main']['address_detail'];?></p>
    	</div>
    </div>
    <div class="list-col-10 padding">
    	<div class="padding-bottom border-bottom">
<span class="hd-h4">支付方式</span>
<span class="mui-pull-right"><?php if($detail[pay_type] == 1) { ?>在线支付<?php } else { ?>货到付款<?php } ?></span>
</div>
<div class="padding-top">
<span class="hd-h4">配送方式</span>
<span class="mui-pull-right"><?php if(($detail['_delivery'][delivery_name])) { ?><?php echo $detail['_delivery']['delivery_name'];?><?php } else { ?>-<?php } ?></span>
</div>
    </div>
    <!--<div class="list-col-10 padding">-->
    	<!--<div class="padding-bottom border-bottom">-->
<!--<span class="hd-h4">发票信息</span>-->
<!--</div>-->
<!--<div class="padding-top text-ellipsis">-->
<?php if($detail[_main][invoice_title]) { ?>
<!--<span class="hd-h4">发票抬头：<?php if(($detail[_main][invoice_title])) { ?><?php echo $detail['_main']['invoice_title'];?><?php } else { ?>-<?php } ?></span>-->
<!--<br />-->
<!--<span class="hd-h4">发票内容：<?php if($detail[_main][invoice_content]) { ?><?php echo $detail['_main']['invoice_content'];?><?php } else { ?>-<?php } ?></span>-->
<?php } else { ?>
<!--无-->
<?php } ?>
<!--</div>-->
    <!--</div>-->
<ul class="custom-goods-items custom-goods-row row1 custom-list-goods margin-top mui-clearfix">
<li class="goods-item-list bg-white">
<div class="padding-tb hd-h5">
<span class=" padding-small-left mui-block">买家留言：<?php if($detail[remark]) { ?><?php echo $detail['remark'];?><?php } else { ?>-<?php } ?></span>
</div>
</li>
<?php if(($detail[promotion] && $detail[promotion][name])) { ?>
    		<li class="mui-pull-left full bg-white">
    			<div class="padding-tb margin-lr-15 border-bottom">
    			<span class="bg-orange promotion-btn">订单促销</span>
    			<span><?php echo $detail['promotion']['name'];?></span>
    		</div>
    		</li>
<?php } ?><?php if(is_array($detail[_skus])) foreach($detail[_skus] as $sku) { ?>    	<li class="goods-item-list">
    		<div class="list-item">
    			<div class="list-item-pic">
<a href="<?php echo url('goods/index/worksDetail',array('sid' => $sku['spu_id']));?>"><img src="<?php echo $sku['sku_thumb'];?>"></a>
</div>
<div class="list-item-bottom">
<div class="list-item-title">
<a href="<?php echo url('goods/index/worksDetail',array('sid' => $sku['spu_id']));?>" data-skuid="<?php echo $sku['sku_id'];?>" data-nums="<?php echo $sku['buy_nums'];?>"><?php echo $sku['sku_name'];?> <?php echo $sku['_sku_spec'];?></a>
</div>
<div class="list-item-text hd-h6">
<span class="text-ellipsis"><em class="price-org hd-h4">￥<?php echo $sku['sku_price'];?></em> × <?php echo $sku['buy_nums'];?></span>
<?php if(($sku[_showserver] == 'true')) { ?>
<span class="mui-pull-right">
<a href="<?php echo url('member/service/return_refund',array('id' => $sku[id]));?>" class="mui-btn hd-btn-gray">申请售后</a>
</span>
<?php } ?>
</div>
</div>
</div>
<?php if(($sku[promotion] && $sku[promotion][title])) { ?>
<div class="padding-tb margin-lr-15 border-top">
    			<span class="bg-red promotion-btn">商品促销</span>
    			<span><?php echo $sku['promotion']['title'];?></span>
    		</div>
<?php } ?>
</li>
<?php } ?>
    </ul>
    <div class="padding-lr bg-white order-detail-price mui-clearfix">
    	<ul class="order-settle border-bottom">
<li>
<span class="hd-h4">应付总额</span>
<span class="mui-pull-right text-org strong">￥<?php echo $detail['real_price'];?></span>
</li>
<li>
<span>+运费</span>
<span class="mui-pull-right text-org strong">￥<?php echo $detail['delivery_price'];?></span>
</li>
<!--<li>-->
<!--<span>+发票税额</span>-->
<!--<span class="mui-pull-right text-org strong">￥<?php echo $detail['_main']['invoice_tax'];?></span>-->
<!--</li>-->
<!-- <li>
<span>- 订单促销</span>
<span class="mui-pull-right text-org strong">￥0.00</span>
</li> -->
</ul>
<div class="order-total mui-text-right">
<span class="hd-h4 strong">实付款：<em class="text-org">￥<?php echo $detail['_main']['paid_amount'];?></em></span><br/>
<span class="text-gray">下单时间：<?php echo date('Y-m-d H:i:s' ,$detail[system_time]);?></span>
</div>
    </div>
</div>
<nav data-sub_sn="<?php echo $detail['sub_sn'];?>" class="mui-bar mui-bar-tab padding-lr cart-footer-bar"> 
<?php if(($detail[status] == 1 && $detail[pay_type] == 1 && $detail[pay_status] == 0)) { ?>
<a href="<?php echo url('order/order/detail',array('order_sn' => $detail[order_sn]));?>" class="mui-pull-right mui-btn mui-btn-primary">立即付款</a>
        <?php } ?>
<?php if(($detail[status] == 1 && $detail[confirm_status]!=2)) { ?>
<a data-action="cancel" href="javascript:;" class="mui-pull-right mui-btn">取消订单</a>
        <?php } ?>
<?php if(($detail[finish_status] == 2 || $detail[status] != 1)) { ?>
    	<a data-action="again" class="mui-pull-right mui-btn" href="javascript:;">再次购买</a>
    <?php } ?>
    <?php if((!empty($detail[_delivery]))) { ?>
    	<a class="mui-pull-right mui-btn" href="<?php echo url('member/order/delivery',array('o_d_id' => $detail[_delivery][id]));?>">查看物流</a>
    	<?php if(($detail[_delivery][isreceive] == 0)) { ?>
    		<a data-action="finish" href="javascript:;" class="mui-pull-right mui-btn mui-btn-primary" o-d-id="<?php echo $detail['_delivery']['id'];?>">确认收货</a>
    	<?php } ?>
<?php } ?>
</nav>
<?php include template('artels-menu-footer', 'common'); ?>

</body>
</html>