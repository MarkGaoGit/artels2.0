<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<input type="hidden" class="titles" value="<?php echo $_GET['types'];?>">
<script>
    var types = $('.titles').val();
    var _title = '';
    if(types == 'hotelnews'){
        _title = '酒店新闻';
    }else if(types == 'recruit'){
        _title = '诚聘英才';
    }else{
        _title = 'total Art';
    }
    $('title').html(_title);
</script>

<!--面包屑-->
<div class="container crumbs clearfix topb"></div>

<!--logo-->

<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>
</div>
<div class="art-article">

    <!-- 艺术资讯 艺术教育 小块文章列表-->
    <h2 class="text-gray-666 margin-bottom">
        <?php if($_GET['cid'] == 1) { ?>
        艺术展览
        <?php } elseif($_GET['cid'] == 2) { ?>
        艺术资讯
        <?php } elseif($_GET['cid'] == 3) { ?>
        艺术教育
        <?php } ?>
    </h2>
    <ul class="samll-aricel-list">
        <?php if(is_array($news)) foreach($news as $k => $r) { ?>        <?php if($r['category_id'] == $_GET['cid']) { ?>
        <li class="small-list">
            <a href="/index.php?m=misc&c=index&a=article_detail&id=<?php echo $r['id'];?>&cid=<?php echo $_GET['cid'];?><?php if($_GET['types'] == 'hotelnews') { ?>&types=hotelnews<?php } elseif($_GET['types'] == 'recruit') { ?>&types=recruit<?php } ?>">
                <img height="170" width="390" data-original="<?php echo $r['thumb'];?>" class="margin-small-bottom lazy" >
                <h5 class="strong"><?php echo $r['title'];?></h5>
                <p class="text-gray-666" style="width:390px; height:75px; overflow:hidden; "><?php echo $r['keywords'];?></p>
            </a>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
    <ul class="article-list margin-big-bottom">
        <?php if(is_array($education)) foreach($education as $k => $r) { ?>        <?php if($r['category_id'] == $_GET['cid']) { ?>
        <li class="margin-big-bottom article-top-list">
            <a href="<?php echo url('misc/index/article_detail',array('id'=>$r['id'],'cid'=>$_GET['cid']));?>">
                <div class="article-left <?php if($k%2 == 0) { ?> fr <?php } else { ?> fl <?php } ?>">
                    <h4 class="strong"><?php echo $r['title'];?></h4><br>
                    <p class="text-small text-gray-666"><?php echo $r['keywords'];?></p>
                </div>
                <div class="article-right <?php if($k%2 == 0) { ?> fl <?php } else { ?> fr <?php } ?>">
                    <img width="790" height="300" class="lazy" data-original="<?php echo $r['thumb'];?>" alt="">
                </div>
            </a>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>

</div>
<div class="clear"></div>

<div class="nav-marsk"></div>



<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});


</script>
