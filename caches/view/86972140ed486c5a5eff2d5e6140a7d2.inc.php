<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/pinpai.js?v=<?php echo HD_VERSION;?>"></script>

        <section class="container pinpai">
            <div class="baseline">
                <div class="mui-card">
                    <ul class="mui-table-view m-hotel-list">
                        <?php if(is_array($catHotelList)) foreach($catHotelList as $r) { ?>                            <li class="mui-table-view-cell mui-collapse list-top">
                                <a class="mui-navigate-right text-center  menu-s" href="#">
                                    <p class="hd-h3 text-white  hotel-names" >
                                        <span class="hd-h4"><?php echo $r['cat']['name'];?></span>
                                    </p>
                                </a>
                                <ul class="mui-table-view">
                                    <?php if(is_array($r['hotel'])) foreach($r['hotel'] as $d) { ?>                                        <li class="mui-table-view-cell mui-media">
                                            <a href="javascript:;" class="m-c">
                                                <img class="mui-media-object mui-pull-left" src="<?php echo $d['thumb'];?>">
                                                <div class="mui-media-body text-white hd-h4 hotel-name" >
                                                    <?php echo $d['name'];?>
                                                </div>
                                                <?php if($d['is_open'] == 1) { ?>
                                                    <a href="<?php echo url('goods/index/hotelDetail',array('cat_id'=>$r['cat']['id'],'sid' => $d['id']));?>" class="yd-btn pinpai-yd-btn fr ">预订</a>
                                                <?php } else { ?>
                                                    <a href="javascript:;" class="not-btn pinpai-yd-btn fr ">敬请期待</a>
                                                <?php } ?>
                                                <span class="clear"></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>

<script>



</script>




</body>
</html>
