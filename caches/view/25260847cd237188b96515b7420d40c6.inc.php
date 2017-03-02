<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/art.js?v=<?php echo HD_VERSION;?>"></script>

        <section class="container art-one">
            <div class="baseline bg-main text-center hd-h4">
                <!--导航-->
                <div class="mui-slider ">
                    <div class="padding-bottom">
                        <img src="<?php echo $artmsg['logomobile'];?>" class="margin-big-top art-header"alt="">
                        <p class="text-big-small text-black margin-big-top"><span class="hd-h3"><?php echo $artmsg['name'];?></span><br/><?php echo $artmsg['us_name'];?> </p>
                    </div>
                </div>
                <nav class="nav text-big w80">
                    <span class="navck text-black art-zy" data-num="1" >简介</span>
                    <span>|</span>
                    <span class="navck art-jj" data-num="2">创作观点</span>
                    <span>|</span>
                    <span><a href="<?php echo url('goods/index/artZpj');?>">作品集</a></span>
                    <span>|</span>
                    <span><a href="<?php echo url('misc/index/mobile_article_lists');?>">文章</a></span>
                </nav>
                <!--艺术家简介-->
                <div class="art-profile w80 text-left margin-big-top margin-left-b10 ">
                    <p class="profile text-black padding-big-bottom" style="border-bottom:1px dashed #000;"><?php echo $artmsg['profile'];?></p>
                    <p class="margin-big-top text-black ">个人展览</p>
                    <p class="text-black show margin-large-bottom"><?php echo $artmsg['exhibition'];?></p>
                </div>
                <div class="art-write w80 margin-big-top margin-left-b10 hide text-left ">
                    <p class="profile text-black"><?php echo $artmsg['write_view'];?></p>
                </div>
            </div>
        </section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
