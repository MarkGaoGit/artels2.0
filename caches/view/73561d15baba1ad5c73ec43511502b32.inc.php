<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('total Art');
</script>


<div class="container crumbs clearfix topb"></div>

<div class="article-detail" >

    <div class="article-content margin-large-bottom">
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

    <div class="more text-center  border-top-bottom-666 text-big-big"><a class="text-gray-666" href="/index.php?m=misc&c=index&a=article_lists&cid=<?php echo $_GET['cid'];?><?php if($_GET['types'] == 'hotelnews') { ?>&types=hotelnews<?php } elseif($_GET['types'] == 'recruit') { ?>&types=recruit<?php } ?>">查看更多文章</a></div>

</div>
<div class="clear"></div>

<?php include template('artels-footer','common');?>

<script>
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});


</script>
