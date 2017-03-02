<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('宝龙艺境酒店');
</script>


<div class="container crumbs clearfix topb"></div>

<div class="margin-bottom item-blue-top content1200 about-top">
    <div class="item-title padding-left fff content1200 vip-top ">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;<a href="<?php echo url('goods/index/about');?>">关于我们</a></span>
    </div>
    <div class='content hotel-logo content1200'>
        <img src="<?php echo __ROOT__ ?>template/default/statics/images/about.jpg" alt="">
    </div>
    <div class="about-nav text-big-small text-center text-white">
        <ul style="top:535px;">
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'powerlong'));?>"><li data-types="1">宝龙集团</li></a>
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'powerlonghotel'));?>"><li data-types="2">宝龙酒店集团</li></a>
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'pinpai'));?>"><li data-types="3">酒店品牌</li></a>
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'hotelnews'));?>"><li class="<?php if($_GET['types'] == 'news') { ?> bg-main<?php } ?>" data-types="4">新闻中心</li></a>
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'recruit'));?>"><li class="<?php if($_GET['types'] == 'recruit') { ?> bg-main<?php } ?>" data-types="5">诚聘英才</li></a>
            <a class="text-white" href="<?php echo url('goods/index/about',array('part' => 'contact'));?>"><li data-types="6">联系我们</li></a>
        </ul>
    </div>
    <div class="about-mask bg-main" style="top:535px;"></div>
</div>


<div class="article-detail">
    <div class="article-content margin-large-bottom" style="padding-top:50px; width:800px;" >
        <p class="h2 text-center text-gray-666 layout margin-large-bottom"><?php echo $title;?></p>
        <p class="text-default text-center margin-big-bottom text-main margin-top">发表在 &nbsp;<?php echo $category;?> &nbsp;<?php echo date('Y-m-d H:i:s',$dataline);?></p>
        <div class="contents-news padding-small-left padding-small-right" style="margin-top: -20px;">
            <?php echo $content;?>
        </div>
        <div class="see-num margin-large-large-top ">
            <img src="<?php echo __ROOT__ ?>template/default/statics/images/see-colour.jpg" class="fl" alt="">
            <span class="fl text-default"><?php echo $hits;?></span>
        </div>
    </div>
</div>
<div class="clear"></div>


<?php include template('artels-footer','common');?>

<script>
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});


</script>
