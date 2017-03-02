<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<!--商品详情-->
<!--<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/detail.js?v=<?php echo HD_VERSION;?>" ></script>-->
<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/jquery.jqzoom.js?v=<?php echo HD_VERSION;?>" ></script>


<!--面包屑-->
<div class="container crumbs clearfix"></div>
<div class="margin-bottom item-blue-top hotel-name content1200">
    <div class="item-title padding-left fff content1200">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;品牌列表</span>
    </div>
</div>
<div class="clear"></div><?php if(is_array($hotel_class)) foreach($hotel_class as $r) { ?>    <div class="pinpai-list content1200">
        <a name="<?php echo $r['maodian'];?>" id="<?php echo $r['maodian'];?>"></a>
        <img data-original="<?php echo $r['imgs']['1'];?>" class="fl lazy" alt="">
        <div class="pinpai-logo fr">
            <!-- 尺寸220 x 70-->
            <img src="<?php echo $r['imgs']['2'];?>" alt="">
        </div>
        <div class="clear"></div>

        <div class="descript text-656d78 text-default fl">
            <p class="text-large margin-big-bottom "><?php echo $r['hotel_content']['0'];?></p>
            <p class="margin-big-bottom"><?php echo $r['hotel_content']['1'];?></p>
            <p><?php echo $r['hotel_content']['2'];?><br/><?php echo $r['hotel_content']['3'];?><br/><?php echo $r['hotel_content']['4'];?></p>
            <p class="margin-top">

                <?php if(is_array($r['hotelList'])) foreach($r['hotelList'] as $k => $d) { ?>                    <?php if($d['is_open'] == 1) { ?>
                        <?php if($k != 0) { ?><?php } else { ?>已开业酒店：<?php } ?><?php echo $d['name'];?>&nbsp;&nbsp;&nbsp;
                    <?php } else { ?>
                        <?php if($k != 0) { ?><?php } else { ?>筹备中酒店：<?php } ?><?php echo $d['name'];?>&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                <?php } ?>
            </p>
        </div>
        <div class="res fr">
            <?php if($r['is_open'] == 1) { ?>
                <a href="<?php echo url('goods/index/lists',array('id'=>$r['catid']));?>" class="cheng-button text-big-small">立即预定</a>
            <?php } else { ?>
                <a href="javascript:;" class="disabled-button text-big-small">敬请期待</a>
            <?php } ?>
        </div>
        <div class="clear"></div>

        <div class=" views margin-big-bottom">
            <div class=" views-slider ">
                <ul class="artist-list">
                    <?php if(is_array($r['lb'])) foreach($r['lb'] as $t) { ?>                        <li class="item" >
                            <img height="190" width="380" class="lazy" data-original="<?php echo $t;?>" >
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="btn btn-left text-large"></div>
            <div class="btn btn-right text-large"></div>
            <div class="btn btn-lefts text-large" data-leg="<?php echo count($r['lb']);?>"><</div>
            <div class="btn btn-rights text-large">></div>
        </div>
        <div class="clear"></div>

    </div>
<?php } ?>
<?php include template('toolbar','common');?>
<?php include template('artels-footer','common');?>
<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});
    $('title').html('品牌列表');


    /*左右移动作家*/
    $('.btn-lefts').on('click',function(){
        var lefts = $(this).prevAll('.views-slider').children('.artist-list').css('left');
        var lfp = parseInt(lefts.substring(0,lefts.length-2));
        var lengatr = $(this).attr('data-leg');
        var totalw = (parseInt(lengatr) * 410) - (410 * 3);
        var totals = '-' + totalw;
        if(lfp == totals){
            return;
        }
        var lft = lfp - 410;
        $(this).prevAll('.views-slider').children('.artist-list').animate({
            'left': lft + 'px'
        },400);

    });
    $('.btn-rights').on('click',function(){
        var lefts = $(this).prevAll('.views-slider').children('.artist-list').css('left');
        var lfp = parseInt(lefts.substring(0,lefts.length-2));

        if(lfp == 0){
            return;
        }
        var lft = lfp + 410;
        $(this).prevAll('.views-slider').children('.artist-list').animate({
            'left': lft + 'px'
        },400);

    });

</script>
