<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'goods'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    window.onload = function(){
        // 获取屏幕高度、 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
                tops = parseInt(client_h) * 0.26214,
                sg = parseInt(client_h) * 0.3696;
        $('.head img').css({'height': tops});
        $('.nav .mui-media ').css({'height' : sg});

    }
</script>
<section class="container vips">
    <div class="baseline bg-white">
        <div class="head" >
            <a href="javascript:;">
                <img src="<?php echo SKIN_PATH;?>statics/images/vip-banner.jpg" alt="" style="width:100%;" >
            </a>
        </div>
        <div class="nav">
            <div class="mui-row">
            <ul class="mui-table-view mui-grid-view">
                <li class="mui-table-view-cell mui-media mui-col-xs-6 " style="border-right:1px solid #cfa762; border-bottom:1px solid #cfa762;">
                    <a href="<?php echo url('goods/index/vip',array('pages'=>'gaishu'));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/gaishu.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6" style="border-bottom:1px solid #cfa762;">
                    <a href="<?php echo url('goods/index/vip',array('pages'=>'vip'));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/vip.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6" style="border-right:1px solid #cfa762;" >
                    <a href="<?php echo url('goods/index/vip',array('pages'=>'quanyi'));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/quanyi.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6" >
                    <a href="<?php echo url('goods/index/vip',array('pages'=>'zhangcheng'));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/zhangcheng.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>