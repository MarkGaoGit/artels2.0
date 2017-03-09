<?php if(!defined('IN_APP')) exit('Access Denied');?>
﻿<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
    $('title').html('艺术家与作品');
</script>
<link rel="stylesheet" href="<?php echo __ROOT__ ?>template/default/statics/css/work.css">
<!--面包屑-->
<div class="container crumbs clearfix topb"></div>

<!--logo-->
<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo fl">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>
    <div class="art-search fr">
        <form action="<?php echo url('goods/index/works');?>" method="post">
            <input type="text" name="artname" placeholder="请输入作家姓名" class="art-name fl text-default" value="<?php echo $_POST['artname'] ?>">
            <input type="hidden" name="cid" value="<?php echo $_GET['cid'];?>">
            <button  class="fr cheng-btn text-big-small ">搜索</button>
        </form>
    </div>
</div>
<div class="clear"></div>
<!-- 艺术家 -->

<div class=" artist margin-big-bottom">
    <div class=" artist-slider ">
        <ul class="artist-list">
            <?php if(is_array($artist)) foreach($artist as $r) { ?>            <li class="item" >
                <img class="lazy" data-arts="<?php echo $r['name'];?>" data-original="<?php echo $r['logo'];?>" date-id="<?php echo $r['id'];?>">
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

<div style="display:block;" class="where-list fr text-default">
    <div class="types text-orange">
        商品筛选
        <!--<a href="<?php echo url('goods/index/works',array('cid'=>$_GET['cid']));?>" class=" text-orange fr">重置筛选</a>-->
    </div>
    <form action="<?php echo url('goods/index/works',array('cid'=>$_GET['cid']));?>" method="post">
        <div class="list-class list-type lists" style="height:50px;" >
            <span class="fl list-title">分类：</span>
            <ul class="fl">
                <li class="<?php if(empty($get['catid'])) { ?>text-money<?php } ?>">全部</li>
                <?php if(is_array($nav)) foreach($nav as $r) { ?>                <li class="<?php if($get['catid'] == $r['id']) { ?>text-money<?php } ?>" data-catid="<?php echo $r['id'];?>"> <?php echo $r['name'];?></li>
                <?php } ?>
                <input type="hidden" name="catid" class="catid">
            </ul>
            <span class="more text-orange text-center show fr">更多</span>
        </div>
        <div class="list-price list-type lists">
            <span class="fl list-title">价格：</span>
            <ul class="fl">
                <li data-prices="1" class="<?php if($get['prices'] == 1 || empty($get['prices'])) { ?>text-money<?php } ?>">全部</li>
                <li data-prices="2" class="<?php if($get['prices'] == 2) { ?>text-money<?php } ?>">&yen;100 ~ &yen;299</li>
                <li data-prices="3" class="<?php if($get['prices'] == 3) { ?>text-money<?php } ?>">&yen;300 ~ &yen;599</li>
                <li data-prices="4" class="<?php if($get['prices'] == 4) { ?>text-money<?php } ?>">&yen;600 ~ &yen;999</li>
                <li data-prices="5" class="<?php if($get['prices'] == 5) { ?>text-money<?php } ?>">&yen;1000 ~ &yen;2999</li>
                <li data-prices="6" class="<?php if($get['prices'] == 6) { ?>text-money<?php } ?>">&yen;3000以上</li>
            </ul>
            <input type="hidden" name="prices" class="price-order">
        </div>
        <input type="submit" value="确定" class="cheng-btn">
    </form>
</div>
<div class="data-where-list margin-bottom fr">
    <div class="item-blue-top filter">
        <dl>
            <dt>排序方式：</dt>
            <dd ><a class=" sortlink <?php if($_GET['fileds'] == 'id') { ?> text-orange<?php } ?>"  href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'id','types'=>'yshu'));?>">综合</a></dd>
            <dd ><a class=" sortlink <?php if($_GET['fileds'] == 'max_price') { ?> text-orange<?php } ?>"  href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'max_price','types'=>'yshu'));?>">价格</a></dd>
            <dd ><a class=" sortlink <?php if($_GET['fileds'] == 'hits') { ?> text-orange<?php } ?>"   href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'hits','types'=>'yshu'));?>">人气</a></dd>
            <dd class="text-center">您正在观看 <span class="see-art" style="color:#f60;">全部作家</span> 的作品</dd>
        </dl>
    </div>
</div>
<div class="clear"></div>





<div class="picture">
    <?php if(empty($pic) ) { ?>
    您搜索的条件下暂无商品
    <?php } else { ?>

    <div class="carefully_feed max_width_1250">
        <ul class="carefully_feed works ajax-pic-list">
            <?php if(is_array($pic)) foreach($pic as $r) { ?>                <li class="pic-list" date-id="<?php echo $r['id'];?>">
                    <div class="artist_box item">
                        <div class="item-infos">
                            <div class="ch-info-back-warp item-info-back">
                                <div class="ch-info-back msk-msg" onclick="jump_to_workdetail(<?php echo $r['id'];?>)" >
                                    <h3><?php echo $r['name'];?></h3>
                                    <p></p>
                                    <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>" class="btn text-default ">查看作品</a>
                                </div>
                            </div>
                            <div class="img item-info-front pic-message text-white text-small" >
                                <a href="#" >
                                    <img   class="lazy" data-original="<?php echo $r['thumb'];?>" />
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>

<!--下拉加载 需要带的参数-->
<input type="hidden" class="ajax-page" value="2">
<input type="hidden" class="brand-id" value=''>
<input type="hidden" class="sorttype" value="<?php echo $get['types'];?>">
<input type="hidden" class="artname" value="<?php echo $post['artname'];?>">
<input type="hidden" class="catid" value="<?php echo $post['catid'];?>">
<input type="hidden" class="prices" value="<?php echo $post['prices'];?>">
<script>
    $(window).scroll( function() {
        var scrollAdd = $(window).scrollTop();      //滚动条的位置
        var windowHeight = $(document).height();    //页面高度
        var seeHeight = $(window).height();         //能看到的高度

        if( scrollAdd >= ( windowHeight - seeHeight ) ){    //判断是否到底部

            //AJAX请求
            var url = "<?php echo url('goods/index/works',array('load'=>'1'));?>",
                page = $('.ajax-page').val(),
                catid = $('.catid').val(),
                bid = $('.brand-id').val(),
                artname = $('.artname').val(),
                types = $('.sorttype').val(),
                prices = $('.prices').val();
            var nextPage = parseInt( page ) + 1;
            $('.ajax-page').val( nextPage );

            $.get(url,{ page:page , catid:catid, id:bid, prices:prices, artname: artname, types:types },function( data ){
                if( data ){
                    for(var i=0; i < 8; i++){       //8是每页几条
                        var html = '<li class="pic-list" date-id="' + data[i]['id'] + '"><div class="artist_box item"><div class="item-infos"><div class="ch-info-back-warp item-info-back">' +
                            '<div class="ch-info-back msk-msg" onclick="jump_to_workdetail( ' + data[i]['id'] + ')" >' +
                            '<h3> ' + data[i]['name'] + '</h3><p></p>' +
                            '<a href="/index.php?m=goods&c=index&a=worksDetail&sid=' + data[i]['id'] + '" class="btn text-default ">查看作品</a></div></div><div class="img item-info-front pic-message text-white text-small" ><a href="#" >' +
                            '<img   class="lazy" src="' + data[i]['thumb'] + '" /></a></div></div></div></li>';
                        $('.ajax-pic-list').append(html);
                    }
                }
            },'json');

        }


    } );
</script>





<div class="hidden hide">

    <?php if(is_array($shoucang)) foreach($shoucang as $r) { ?>    <div class="hiddens" date-ids="<?php echo $r;?>"></div>
    <?php } ?>
</div>

<div class="clear"></div>

<input type="hidden" class="uid" value="<?php echo $userInfo['id'];?>">

<script src="<?php echo __ROOT__ ?>template/default/statics/js/clicks.js"></script>

<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    //多功能搜搜区域
    $('.list-class li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85738').siblings().removeClass('typsdg').css('color','#666');
        var catid = $(this).data('catid');
        $('.catid').val(catid);

    })
    $('.list-price li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85738').siblings().removeClass('typsdg').css('color','#666');
        var price = $(this).data('prices');
        $('.price-order').val(price);
    })
    $('.list-class .more').on('click',function(){
        $('.list-class ul').css({'overflow' : 'auto'});
        $('.list-class ul').css({'height' : '70px'});
        $('.list-class').css({'height':'70px'});
    });

    //蒙版显示出来 点击块 跳转作品详细
    function jump_to_workdetail(sid){
        window.location.href = "?m=goods&c=index&a=worksDetail&sid=" + sid;
    }
//
//    //不全排序Bug
//    $('.sortlink').on('click',function(){
//        var bid = $('.brand-id').val();
//        var url = $(this).data('href');
//        url =  url + '&bid=' + bid;
//        window.location.href = url;
//    });


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



    /*下面作品*/
    $('.artist .item img').on('click',function(){
        var seeart = $(this).data('arts');
        $('.see-art').html(seeart);

        var ids = $(this).attr('date-id'),
            url = "<?php echo url('goods/index/works');?>";
        $('.brand-id').val(ids);
        $.post(url,{id:ids},function(data){
            if(data){
                //改图片的上下翻转效果
                $('.ajax-pic-list').empty();
                for(var i=0; i < data.length; i++){
                    var uid = $('.uid').val();
                var html = '<li class="pic-list" date-id="' + data[i]['id'] + '"><div class="artist_box item"><div class="item-infos"><div class="ch-info-back-warp item-info-back">' +
                        '<div class="ch-info-back msk-msg" onclick="jump_to_workdetail( ' + data[i]['id'] + ')" >' +
                        '<h3> ' + data[i]['name'] + '</h3><p></p>' +
                        '<a href="/index.php?m=goods&c=index&a=worksDetail&sid=' + data[i]['id'] + '" class="btn text-default ">查看作品</a></div></div><div class="img item-info-front pic-message text-white text-small" ><a href="#" >' +
                        '<img   class="lazy" src="' + data[i]['thumb'] + '" /></a></div></div></div></li>';
                    $('.ajax-pic-list').append(html);
                }


            }else{
                alert('此画家暂无作品！');
            }
        },'json');
    });

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


    /*收藏*/
    function colle(pid){
        var url = "<?php echo url('member/favorite/add');  ?>";
        $.post(url,{pid:pid},function(data){
            if(data['status'] != 0){
                $.tips({
                    icon:'success',
                    content:'收藏成功！'
                });
                var numb = $('.ajax-pic-list').children().length;
                for(var i=0; i<numb; i++){
                    var dateId = $('.ajax-pic-list li:eq('+ i +')').attr('date-id');
                    if(pid == dateId){
                        $('.ajax-pic-list li:eq('+ i +') .collection').css({'background':'url(../template/default/statics/images/love-colcur.png) no-repeat'});
                    }
                }
            }else{
                alert(data['message']);
            }
        },'json');
    }

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
</script>
