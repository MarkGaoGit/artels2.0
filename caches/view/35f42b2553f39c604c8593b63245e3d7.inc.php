<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
    $('title').html('艺术家与作品');
</script>
<!--面包屑-->
<div class="container crumbs clearfix topb"></div>

<!--logo-->
<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo fl">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>
</div>
<div class="clear"></div>
<!--艺术家信息-->
<div class="art-zj">
    <img class="header" src="<?php echo $artmsg['logo'];?>" alt="">
    <p class="text-big-small text-black margin-big-top"><?php echo $artmsg['us_name'];?> <?php echo $artmsg['name'];?></p>
    <p class="text-small text-gray-666 margin-top " style="margin-left:100px;"><?php echo count($works);?>件作品</p>
    <ul class="text-gray-666 text-big parentck ">
        <li class="border-right onck text-black art-zy" data-id="1">主页</li>
        <li class="border-right onck art-jj" data-id="2">简介</li>
        <li class="border-right onck art-czgd" data-id="3">创作观点</li>
        <li class="art-zpj onck" data-id="4">作品集</li>
    </ul>
</div>
<div class="clear"></div>

<!--艺术家简介-->
<div class="art-profile padding-big hidden text-big ">
    <p class="profile"><?php echo $artmsg['profile'];?></p>
    <p class="margin-top ">个人展览</p>
    <p><?php echo $artmsg['exhibition'];?></p>
</div>
<div class="clear"></div>

<!--艺术家创作观点-->
<div class="art-write padding-big hidden text-big ">
    <p class="profile"><?php echo $artmsg['write_view'];?></p>
</div>
<div class="clear"></div>

<!--艺术家作品集-->
<div class="art-lists art-list art-works hidden ">
    <ul class="art-ysp-list">
        <?php if(is_array($works)) foreach($works as $r) { ?>            <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>">
                <li class="art-ysp ">
                    <img class="lazy" data-original="<?php echo $r['thumb'];?>" alt="">
                    <p class="text-big text-black"><?php echo $r['name'];?></p>
                    <p class="text-small text-gray-666  padding-small-top"><?php echo $r['specs_specs']['0'];?></p>
                    <p class="text-small text-gray-666  padding-small-top"><?php echo $r['specs_specs']['1'];?></p>
                </li>
            </a>
        <?php } ?>
    </ul>
</div>
<div class="clear"></div>

<!--作品列表-->
<div class="art-list art-work ">
    <ul class="art-ysp-list">
        <?php if(is_array($works)) foreach($works as $k => $r) { ?>            <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>">
                <li class="art-ysp <?php if($k > 7) { ?> hidden <?php } ?>">
                    <img  class="lazy" data-original="<?php echo $r['thumb'];?>" alt="">
                    <p class="text-big text-black"><?php echo $r['name'];?></p>
                    <p class="text-small text-gray-666  padding-small-top"><?php echo $r['specs_specs']['0'];?></p>
                    <p class="text-small text-gray-666  padding-small-top"><?php echo $r['specs_specs']['1'];?></p>
                </li>
            </a>
        <?php } ?>
    </ul>
</div>
<div class="clear"></div>

<!-- 艺术资讯 艺术教育 小块文章列表-->
<div class="art-article">
    <ul class="samll-aricel-list">
        <?php if(is_array($news)) foreach($news as $r) { ?>        <li class="small-list">
            <a href="<?php echo url('misc/index/article_detail',array('id'=>$r['id']));?>">
                <img height="170" width="390" data-original="<?php echo $r['thumb'];?>" class="margin-small-bottom lazy" >
                <h5 class="strong"><?php echo $r['title'];?></h5>
                <p class="text-gray-666"><?php echo $r['keywords'];?><a href="#" class="fr">[更多内容]</a></p>
                <?php if($r['category_id'] == 1) { ?>
                <img class="tatile-img" src="<?php echo __ROOT__ ?>template/default/statics/images/zl.jpg" alt="">
                <?php } else { ?>
                <img class="tatile-img" src="<?php echo __ROOT__ ?>template/default/statics/images/zx.jpg" alt="">
                <?php } ?>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>

<div class="art-more text-center  border-top-bottom-666 text-large"><a class="text-gray-666" href="<?php echo url('goods/index/works');?>">查看更多艺术家</a></div>
<!-- 艺术家 -->

<div class=" artist margin-big-bottom">
    <div class=" artist-slider ">
        <ul class="artist-list">
            <?php if(is_array($art)) foreach($art as $r) { ?>            <li class="item" >
                <img  class="lazy" data-original="<?php echo $r['logo'];?>" date-id="<?php echo $r['id'];?>">
                <div class="message text-white artisty" date-id="<?php echo $r['id'];?>">
                    <p class="text-big-small"><?php echo $r['name'];?></p>
                    <p class="text-small"><?php echo $r['descript'];?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="btn btn-left text-large"><</div>
    <div class="btn btn-right text-large">></div>
</div>
<div class="clear"></div>

<div class="art-nav text-big" style="top:238px;">
    <a href="<?php echo url('goods/index/totalArt');?>">
        <img class="art-nav-logo" src="<?php echo __ROOT__ ?>template/default/statics/images/artback.jpg" alt="">
    </a>
</div>
<script src="<?php echo __ROOT__ ?>template/default/statics/js/clicks.js"></script>


<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});


    /*左右移动作家*/
    var rcnm = function(e){
        var lefts = $('.artist-list').css('left');
        var lfp = parseInt(lefts.substring(0,lefts.length-2));
        var lengatr = "<?php echo count($artist); ?>";
        var totalw = (parseInt(lengatr) * 1200) - (1200 * 5);
        var totals = '-' + totalw;
        if(lfp == totals || lfp < totals){
            return;
        }
        var lft = lfp - 1200;
        $('.artist-list').animate({
            'left': lft + 'px'
        },400);
    };

    var lcnm = function(e){
        var lefts = $('.artist-list').css('left');
        var lfp = parseInt(lefts.substring(0,lefts.length-2));
        if(lfp == 0 || lfp > 0){
            return;
        }
        var lft = lfp + 1200;
        $('.artist-list').animate({
            'left': lft + 'px'
        },400);
    }
    $('.btn-right').skygqOneDblClick({oneclick:rcnm});
    $('.btn-left').skygqOneDblClick({oneclick:lcnm});


    /*作家简介*/
    $('.artist-list li').on('mouseover',function(){
        $(this).css({'border' : '5px solid #00b4bc'});
        $(this).children('div').toggle();
    });
    $('.artist-list li').on('mouseout',function(){
        $(this).css({'border' : '5px solid #fff'});
        $(this).children('div').toggle();
    });

    $('.pic-list').on('mouseover',function(){
        $(this).children('.works-marsk').show();
        $(this).children('.pic-message').show();

    });

    $('.pic-list').on('mouseout',function(){
        $(this).children('.works-marsk').hide();
        $(this).children('.pic-message').hide();
    });

    /*作家详情页跳转*/
    $('.artisty').on('click',function(){
        var ids = $(this).attr('date-id'),
                url = "/index.php?m=goods&c=index&a=artist&id="+ids;
        window.location.href = url;
    });


    function shows(i){
        var num = parseInt(i) +1;
        $('.ajax-pic-list .pic-list:nth-child('+ num+')').children('.works-marsk').show();
        $('.ajax-pic-list .pic-list:nth-child('+ num+')').children('.pic-message').show();
    }
    function hides(i){
        var num = parseInt(i) +1;
        $('.ajax-pic-list .pic-list:nth-child('+ num+')').children('.works-marsk').hide();
        $('.ajax-pic-list .pic-list:nth-child('+ num+')').children('.pic-message').hide();
    }

    /*导航显示切换*/
    $('.onck').on('click',function(){
        var did = $(this).attr('data-id'),
                lileng = $('.parentck').children();
        var lilengs = parseInt(lileng.length);
        for(var i = 1; i<=lilengs; i++){
            var dids = $('.parentck li:nth-child('+ i +')').attr('data-id');
            if(did == dids){
                $('.parentck li:nth-child('+ i +')').addClass('text-black');
            }else{
                $('.parentck li:nth-child('+ i +')').removeClass('text-black');
            }
        }
        switch (did){
            case '1':
                $('.art-work').css({'display' : 'block '});
                $('.art-article').css({'display' : 'block'});
                $('.art-profile').css({'display' : 'none'});
                $('.art-write').css({'display' : 'none'});
                $('.art-lists').css({'display' : 'none'});
                break;

            case '2':
                $('.art-work').css({'display' : 'none'});
                $('.art-article').css({'display' : 'none'});
                $('.art-profile').css({'display' : 'block'});
                $('.art-write').css({'display' : 'none'});
                $('.art-lists').css({'display' : 'none'});
                $('.art-profile').removeClass('hidden');
                break;
            case '3':
                $('.art-work').css({'display' : 'none'});
                $('.art-article').css({'display' : 'none'});
                $('.art-profile').css({'display' : 'none'});
                $('.art-write').css({'display' : 'block'});
                $('.art-lists').css({'display' : 'none'});
                $('.art-write').removeClass('hidden');
                break;
            case '4':
                $('.art-work').css({'display' : 'none'});
                $('.art-article').css({'display' : 'none'});
                $('.art-profile').css({'display' : 'none'});
                $('.art-write').css({'display' : 'none'});
                $('.art-lists').css({'display' : 'block'});
                $('.art-lists').removeClass('hidden');
                break;
        }
    });

</script>
