<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<style>
    .mui-content { background: #fff !important;}
</style>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/derivative.js?v=<?php echo HD_VERSION;?>"></script>

<section class="container ysp">
    <div class="baseline">
        <!--搜索-->
        <div class="mui-input-row mui-search margin-top m-search ">
            <span class="mui-input-clear show w100 text-center margin-bottom hd-h5 text-gray">搜索</span>
        </div>
        <!--轮播图-->
        <div class="mui-slider">
            <div class="mui-slider-group   ">
                <div class="mui-slider-item  ">
                    <a href="<?php echo url('goods/index/worksDetail',array('sid'=>$derivative[0]['id']));?>">
                        <img src="<?php echo $derivative['0']['imgs']['1'];?>" />
                    </a>
                </div>
            </div>
        </div>
        <h3 class="hd-h4 text-center text-666 margin-big"></h3>

        <div class="data-where-list">
            <dl>
                <dd>排序方式：</dd>
                <dd ><a class="<?php if($_GET['fileds'] == 'id') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'id'));?>">综合</a></dd>
                <dd ><a class="<?php if($_GET['fileds'] == 'sales') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'sales'));?>">销量</a></dd>
                <dd ><a class="<?php if($_GET['fileds'] == 'max_price') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'max_price'));?>">价格</a></dd>
                <dd ><a class="<?php if($_GET['fileds'] == 'hits') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'hits'));?>">人气</a></dd>
            </dl>
        </div>
        <?php if($derivative[0]['id']) { ?>
        <ul class="mui-table-view mui-grid-view" style="margin-bottom:90px; margin-left:-6px;">
            <?php if(is_array($derivative)) foreach($derivative as $r) { ?>            <li class="mui-table-view-cell mui-media mui-col-xs-6">
                <a style="height:190px;" href="<?php echo url('goods/index/worksDetail',array('sid'=>$r['id']));?>">
                    <img class="mui-media-object" style="max-height:170px; width:auto;" src="<?php echo $r['thumb'];?>">
                </a>
                <div class="mui-media-body padding-left-15 text-left"><?php echo $r['name'];?>  <?php echo $r['hotel_name'];?></div>
                <span class="text-f85738 hd-h4 text-left padding-left-15" style="display:block; width:100%; ">&yen;<?php echo $r['max_price'];?></span>
            </li>
            <?php } ?>

        </ul>
        <?php } else { ?>
        <div class="w100 hd-h4 text-666 text-center padding-big">暂时没有符合条件的商品</div>
        <?php } ?>
    </div>
</section>
<!--底部快捷按钮-->
<nav class="mui-bar mui-bar-tab ysp">
    <a class="mui-tab-item mui-active" href="<?php echo __APP__;?>">
        <span class="mui-icon mui-icon-home margin-little-bottom"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a class="mui-tab-item" href="<?php echo url('order/cart/index');?>">
        <span class=" mui-icon mui-icon-extra-cart margin-little-bottom "></span>
        <span class="mui-tab-label">购物车</span>
    </a>
    <a class="mui-tab-item" href="<?php echo url('member/index/index');?>">
        <span class="mui-icon mui-icon-contact mui-icon-icon-contact margin-little-bottom"></span>
        <span class="mui-tab-label">我的</span>
    </a>
</nav>

<!--隐藏的多功能搜索-->
<div class="search-list" data-status = "1">
    <div class="left fl"></div>
    <div class="right fr hd-h5 text-666">
        <span class="show bg-header text-white text-center title">搜 索</span>
        <h4 class=" text-main padding-big">商品筛选</h4>
        <div class="class-list ch-list">
            <span class="show fl margin-big-left">分类：</span>
            <ul class="fr">
                <li class="<?php if(empty($get['catid'])) { ?>text-f85738<?php } ?>">全部</li>
                <?php if(is_array($nav)) foreach($nav as $r) { ?>                <li class="<?php if($get['catid'] == $r['id']) { ?>text-f85738<?php } ?>" data-catid="<?php echo $r['id'];?>"> <?php echo $r['name'];?></li>
                <?php } ?>
                <form action="<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid']));?>" method="post">
                    <input type="hidden" name="catid" class="catid">
            </ul>
        </div>
        <div class="price-list ch-list">
            <span class="show fl list-title margin-big-left">价格：</span>
            <ul class="fr">
                <li data-prices="1" class="<?php if($get['prices'] == 1 || empty($get['prices'])) { ?>text-f85738<?php } ?>">全部</li>
                <li data-prices="2" class="<?php if($get['prices'] == 2) { ?>text-f85738<?php } ?>">100 ~ 299元</li>
                <li data-prices="3" class="<?php if($get['prices'] == 3) { ?>text-f85738<?php } ?>">300 ~ 599元</li>
                <li data-prices="4" class="<?php if($get['prices'] == 4) { ?>text-f85738<?php } ?>">600 ~ 999元</li>
                <li data-prices="5" class="<?php if($get['prices'] == 5) { ?>text-f85738<?php } ?>">1000 ~ 2999元</li>
                <li data-prices="6" class="<?php if($get['prices'] == 6) { ?>text-f85738<?php } ?>">3000元以上</li>
            </ul>
            <input type="hidden" name="prices" class="price-order">
        </div>

        <div class="buttons">
            <a class="show fl text-666" href="<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid']));?>">重置</a>
            <input type="submit" class="search-ok fr " value="确定">
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php include template('artels-menu-footer', 'common'); ?>
<img class="scroll-top" src="<?php echo SKIN_PATH;?>statics/images/top.png" style="position: fixed;bottom:87px; right:23px; display:none;">


<script>
    var _text = $('.class-list .text-f85738').html();
    if( _text == '全部' ){
        _text = 'VIEW ALL';
    }
    $('.ysp h3').html(_text);


    $('.m-search').on('click',function(){
        var _status = $('.search-list').attr('data-status');
        if( _status == '1' ){
            $('.search-list').slideDown();
            $('body').eq(0).css('overflow','hidden');
        }
    });


    $('.class-list li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85738').siblings().removeClass('text-f85738').css('color','#666');
        var catid = $(this).data('catid');
        $('.catid').val(catid);

    });
    $('.price-list li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85738').siblings().removeClass('text-f85738').css('color','#666');
        var price = $(this).data('prices');
        $('.price-order').val(price);
    });
    $('.right .bg-header').on('click',function(){
        $('.search-list').slideUp();
    })

</script>

</body>
</html>
