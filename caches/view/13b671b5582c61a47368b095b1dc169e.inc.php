<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('艺术生活');
</script>
<!--面包屑-->
<div class="container crumbs clearfix"></div>
<!--logo-->
<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>

    <!-- 商品内容-->
    <div class="art-content">
        <ul>
            <?php if(is_array($goods)) foreach($goods as $r) { ?>                <li>
                    <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>">
                        <img class="main-image lazy" style="top:<?php echo $r['img_top'];?>; left:<?php echo $r['left'];?>; <?php if($r['top'] == '220px' || $r['top'] == '222px' || $r['top'] == 0) { ?> width:250px; height:250px;<?php } else { ?><?php } ?>" data-original="<?php echo $r['thumb'];?>" alt="">
                        <p class="text-large titles" style="top:<?php echo $r['top'];?>; color:<?php echo $r['style'];?>;"><?php echo $r['subtitle'];?></p>
                        <p class="text-default contents-01" style="top:<?php echo $r['top'];?>; color:<?php echo $r['style01'];?>;"><?php echo $r['ysp_descript01'];?></p>
                        <p class="text-small contents-02" style="top:<?php echo $r['top'];?>; color:<?php echo $r['style02'];?>;"><?php echo $r['ysp_descript02'];?></p>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="clear"></div>

<!--右边固定的菜单-->
<div class="art-nav text-big">
    <img class="art-nav-logo" src="<?php echo __ROOT__ ?>template/default/statics/images/art-nav-logo.png" alt="">
    <ul>
        <?php if(is_array($artNav)) foreach($artNav as $r) { ?>            <li><a href="<?php echo $r['url'];?>"><?php echo $r['name'];?></a></li>
        <?php } ?>
    </ul>
</div>
<div class="nav-marsk"></div>

<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    /*导航的显示与隐藏*/
    $('.art-nav-logo').on('click',function(){
        $('.art-nav ul li').toggle();
    });

    $('.art-nav ul li:last').css({'border':'none'});

    $('img .lazy').lazyload();

</script>
