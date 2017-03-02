<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
        <section class="container room-list">
            <div class="baseline">
                <div class="text-center padding">
                    <?php if($_GET['cat_id'] == 3) { ?>
                    <img src="<?php echo __ROOT__ ?>template/default/statics/images/artelsjx.png" alt="">
                    <?php } elseif($_GET['cat_id'] == 2) { ?>
                    <img src="<?php echo __ROOT__ ?>template/default/statics/images/artels.png" alt="">
                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                    <img src="<?php echo __ROOT__ ?>template/default/statics/images/yizhu.png" alt="">
                    <?php } elseif($_GET['cat_id'] == 5) { ?>
                    <img src="<?php echo __ROOT__ ?>template/default/statics/images/kezhan.png" alt="">
                    <?php } ?>
                </div>
                <!--轮播图-->
                <div class="mui-slider">
                    <div class="mui-slider-group ">
                        <?php if(is_array($msg)) foreach($msg as $r) { ?>                        <div class="mui-slider-item text-center">
                            <a href="#"><img src=
                                    <?php if($_GET['sid'] == 6) { ?>
                                        <?php echo SKIN_PATH;?>statics/images/<?php echo $r['rmtype'];?>-m-6.jpg
                                    <?php } else { ?>
                                        <?php echo SKIN_PATH;?>statics/images/kt.jpg
                                    <?php } ?>
                                    /></a>
                            <p class="text-main hd-h3 margin-tb"><?php echo $r['descript'];?></p>
                            <h2 class="hd-h2 text-f85738">&yen;<b><?php echo $r['rate1'];?></b></h2>
                            <p class="hd-h3 text-main margin-tb"><?php echo $hotel['name'];?></p>
                            <p class="text-black text-left hotel-desc"><?php echo $hotel['hotel_descript'];?></p>
                            <a href="<?php echo url('goods/index/hotelListBooking',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelname' => $hotel['name']));?>" class="yd-btn margin-big-top">预订 BOOKING</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>

<script>

////    轮播图
    var gallery = mui('.mui-slider');
    gallery.slider({
        interval:1500//自动轮播周期，若为0则不自动播放，默认为0；
    });
</script>




</body>
</html>
