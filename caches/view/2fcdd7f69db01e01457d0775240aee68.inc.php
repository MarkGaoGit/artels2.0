<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<div class="mui-content">
    	<ul class="member-address mui-table-view layout-list-common margin-none mui-clearfix"><?php if(is_array($lists)) foreach($lists as $r) { ?>        <li class="address-list" data-id="<?php echo $r['id'];?>">
<a href="<?php echo url('member/address/edit',array('id'=>$r['id']));?>" class="mui-block mui-navigate-right padding-big-right">
<?php if($r[isdefault]) { ?>
        	<div class="address-text">
        		<span class="name text-ellipsis"><?php echo $r['name'];?></span>
        			<span class="address-btn margin-small-right">默认</span>
        			<span class="mui-pull-right"><?php echo $r['mobile'];?></span>
        		<p>[默认]<?php echo implode(" ", $r[full_district]);?> <?php echo $r['address'];?>　　<?php if($r[zipcode]) { ?>邮编：<?php echo $r['zipcode'];?> <?php } ?></p>
        	</div>
<?php } else { ?>
<div class="address-text" data-event="default">
        		<span class="name text-ellipsis"><?php echo $r['name'];?></span>
        			<span class="mui-pull-right"><?php echo $r['mobile'];?></span>
        		<p><?php echo implode(" ", $r[full_district]);?> <?php echo $r['address'];?>　　<?php if($r[zipcode]) { ?>邮编：<?php echo $r['zipcode'];?> <?php } ?></p>
        	</div>
<?php } ?>
</a>
        </li>
<?php } ?>
    </ul>
    	<div class="padding-lr margin-top">
    		<a href="<?php echo url('member/address/add');?>" class="mui-btn mui-btn-primary full hd-h4">添加新收货地址</a>
    	</div>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>