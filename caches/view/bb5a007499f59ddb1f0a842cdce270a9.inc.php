<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    window.onload = function(){
        // 获取屏幕的高度 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
                client_25 = parseInt(client_h) * 0.25;
        $('.baseline').css({'min-height':client_h});
        $('.mui-slider-group').css({'min-height':client_25});
        $('.mui-slider-group .title-img').css({'height':client_25});
    }
</script>
        <section class="container total-misc">
            <div class="baseline bg-main">
                <?php if(is_array($news)) foreach($news as $r) { ?>                    <div class="mui-slider-group "style="margin-top:-4px;">
                        <div class="article-list  ">
                            <a href="<?php echo url('misc/index/article_detail',array('id'=>$r['id']));?>">
                                <img class="title-img" src="<?php echo $r['thumb'];?>">
                                <p class="mui-slider-title text-white"><?php echo $r['title'];?></p>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>

</body>
</html>
