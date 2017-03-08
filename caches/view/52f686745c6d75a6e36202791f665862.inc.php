<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
        <section class="container works-one-works">
            <div class="baseline">
                <div class="text-center margin-big  hd-h3">
                    <p class="text-black ">WORKS</p>
                    <p class="text-black ">作品集</p>
                </div>

                <div class="content w90 text-left margin-left-b5 hd-h4">
                    <?php if(is_array($works)) foreach($works as $r) { ?>                            <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>">
                                <img class="title-img w100" src="<?php echo $r['thumb'];?>">
                                <p class="text-white w100 works-name"><?php echo $r['name'];?></p>
                            </a><br>
                    <?php } ?>
                </div>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
