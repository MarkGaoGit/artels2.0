<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'goods'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    window.onload = function(){
        // 获取屏幕高度、 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
            client_40 = parseInt(client_h) * 0.537,
            client_60 = parseInt(client_h) *0.463;
        $('.baseline').css({'height' : client_h });
        $('.m-main').css({'min-height' : client_h});
        $('.head').css({'min-height' : client_40});
        $('.head img').css({'height' : client_40});
        $('.nav ul').css({'min-height' : client_60});
        $('#menu-wrapper').css({'margin-top':'-3px'});
        $('title').html('Total Art');
    }
</script>
<section class="container indexs">
    <div class="baseline">
        <div class="head" >
            <a href="javascript:;">
                <img src="<?php echo SKIN_PATH;?>statics/images/totalart.jpg" alt="" class="mui-col-xs-12" >
            </a>
        </div>
        <div class="nav">
            <div class="mui-row">
            <ul class="mui-table-view mui-grid-view">
                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <a href="<?php echo url('goods/index/mworks',array('page'=>2));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/artists.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <a href="<?php echo url('goods/index/artzp',array('page'=>2,'cid'=>'6'));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/works.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <a href="<?php echo url('misc/index/mobile_article_lists',array('cid'=>1));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/events.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <a href="<?php echo url('goods/index/derivative',array('cid' => 9));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/gifts.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <a href="<?php echo url('misc/index/mobile_article_lists',array('cid'=>2));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/news.jpg" alt="">
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <a href="<?php echo url('misc/index/mobile_article_lists',array('cid'=>3));?>">
                        <img src="<?php echo SKIN_PATH;?>statics/images/edu.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>