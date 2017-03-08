<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<div class="mui-content">
    <ul class="mui-table-view layout-list-common comment-form margin-none">
    	<li class="padding border-bottom mui-text-center">
    		<span class="service-apply-ok"></span>
    		<h2 class="hd-h3 margin-tb strong">订单支付成功</h2>
    	</li>
    	<li class="padding">
    		<span class="hd-h5">订单号：<em class="text-org"><?php echo $order_sn;?></em></span>
    	</li>
    	<li class="padding">
    		<span class="hd-h5">支付金额：<em class="text-org"><?php echo $order['real_amount'];?></em></span>
    	</li>
    </ul>
    <div class="padding">
    	<a href="<?php echo url('member/order/index');?>" class="mui-btn full mui-btn-primary hd-h4">查看订单</a>
    </div>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
