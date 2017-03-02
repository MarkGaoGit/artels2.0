<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>

        <section class="container order-ok text-center">
            <div class="baseline bg-white padding-large">
                <h3 class="hd-h4 margin">订单号：<span class="text-f85738 strong hd-h3"><?php echo $order_msg['crsNo'];?></span></h3>
                <h3 class="hd-h4 margin">如需了解更多信息，欢迎致电我们。电话：<?php echo $post['hotelMobile'];?></h3>
                <h3 class="hd-h4 margin">预订成功，请您提前安排出行。</h3>
                <a href="<?php echo __APP__;?>" class="yd-btn hd-h3 lh-40">返回首页</a>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
