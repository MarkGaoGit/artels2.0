<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>

<form action="<?php echo url('order/order/detail');?>" method="post" name="dopay">
<input type="hidden" name="order_sn" value="<?php echo $order_sn;?>" />
<input type="hidden" name="balance_checked" value="<?php if(($member_info['money'] > 0)) { ?>1<?php } ?>" />
<input type="hidden" name="pay_code" value="" />
<input type="hidden" name="pay_bank" value="" />
<div class="mui-content">
<ul class="mui-table-view layout-list-common hd-h4 margin-none">
<li class="mui-table-view-cell">订单号：<em class="text-org"><?php echo $order_sn;?></em></li>
</ul>
<ul class="mui-table-view layout-list-common hd-h4 margin-top">
<li class="mui-table-view-cell">应付总额：<em class="text-org">￥<?php echo $order['real_amount'];?></em></li>
<li class="mui-table-view-cell">支付方式：在线支付</li>
<?php if($balance_pay == 1) { ?>
<li class="mui-table-view-cell">
<label data-id="balance_pay">
<div class="hd-checkbox hd-h5">
    				<input type="checkbox" />
    				<span class="label">账户余额：<?php echo sprintf("%.2f",$member_info[money]);?> 元</span>
    			</div>
    			<?php if(($order[real_amount] - $order[balance_amount] > $member_info[money])) { ?>
    			<div class="mui-block padding-large-left" data-id="pay_amount">
    				<span class="text-org hd-h5">您还需在线支付：<em>0</em> 元</span>
    			</div>
    			<?php } ?>
</label>
</li>
<?php } ?>
</ul>
<ul class="pay-lists list-col-10 mui-clearfix" data-id="pays">
<?php if(empty($payments)) : ?>
<li class="pay-list"> 后台暂未开启支付方式 </li>
<?php else: ?><?php if(is_array($payments)) foreach($payments as $pay) { ?><?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false) { ?>
<?php if($pay[pay_code] != 'wechat_js') { ?>
<li class="pay-list">
<label class="mui-block">
<?php if($pay[pay_code] == 'jdpay') { ?>
<div class="hd-radio"><input name="pay_method" data-id="pay_method" type="radio" data-code="<?php echo $pay['pay_code'];?>" data-bank="<?php echo $pay['pay_ico'];?>" /></div>
<div class="pay-icon" style="width: 40%"><img src="<?php echo SKIN_PATH;?>statics/images/banks/<?php echo $pay['pay_ico'];?>.png" /></div>
<?php } else { ?>
<div class="hd-radio"><input name="pay_method" data-id="pay_method" type="radio" data-code="<?php echo $pay['pay_code'];?>" /></div>
<div class="pay-icon"><img src="<?php echo SKIN_PATH;?>statics/images/<?php echo $pay['pay_ico'];?>.png" /></div>
<span class="hd-h5"><?php echo $pay['pay_name'];?></span>
<?php } ?>
<!-- <p class="lh-18"><?php echo $pay['pay_desc'];?></p> -->
</label>
</li>
<?php } ?>
<?php } else { ?>
<?php if($pay[pay_code] != 'ws_wap') { ?>
<li class="pay-list">
<label class="mui-block">
<div class="hd-radio"><input name="pay_method" data-id="pay_method" type="radio" data-code="<?php echo $pay['pay_code'];?>" /></div>
<div class="pay-icon"><img src="<?php echo SKIN_PATH;?>statics/images/<?php echo $pay['pay_ico'];?>.png" /></div>
<span class="hd-h5"><?php echo $pay['pay_name'];?></span>
<!-- <p class="lh-18"><?php echo $pay['pay_desc'];?></p> -->
</label>
</li>
<?php } ?>
<?php } ?>
<?php } ?>
<?php endif; ?>
</ul>
    <div class="margin padding-small">
    	<a data-id="subbtn" href="javascript:;" class="mui-btn mui-btn-blue full hd-h4">确认支付</a>
    </div>
</div>
</form>
</body>
</html>

<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/order-pay.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript">
var order = <?php echo json_encode($order);?>;
var member = <?php echo json_encode($member_info);?>;
hd_pay.init();
</script>