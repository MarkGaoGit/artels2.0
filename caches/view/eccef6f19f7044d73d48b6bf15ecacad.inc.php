<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'goods'); ?>
<body>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    window.onload = function(){
        // 获取屏幕高度、 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
            client_40 = parseInt(client_h) * 0.334,
            client_60 = parseInt(client_h) *0.666;
        $('.baseline').css({'height' : client_h });
        $('.m-main').css({'min-height' : client_h});
        $('.head').css({'min-height' : client_40});
        $('.head img').css({'height' : client_40});
        $('.nav ul').css({'min-height' : client_60});
        $('#menu-wrapper').css({'margin-top':'-3px'});

    }
</script>
<section class="container indexs">
    <div class="baseline">
        <div class="head" >
            <a href="<?php echo url('goods/index/mobilePinPai');?>">
                <img src="<?php echo SKIN_PATH;?>statics/images/index-head.jpg" alt="" style="width:100%;" >
            </a>
        </div>
        <div class="nav">
            <div class="mui-row">
            <ul class="mui-table-view mui-grid-view">
                <li class="mui-table-view-cell mui-media mui-col-xs-6">
                    <a href="<?php echo url('goods/index/booking');?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/index-search.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6">
                    <a href="<?php echo url('goods/index/vip');?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/index-member.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6" >
                    <a href="<?php echo url('goods/index/totalArt');?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/index-total.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-6">
                    <a href="<?php echo url('goods/index/about');?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/index-about.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>