<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('会员专享');
</script>
<!--面包屑-->
<div class="container crumbs clearfix"></div>

<div class="margin-bottom item-blue-top content1200 ">
    <div class="item-title padding-left fff content1200 vip-top ">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;<a href="<?php echo url('goods/index/vip');?>">会员专享</a></span>
    </div>
    <div class='content hotel-logo content1200'>
        <img src="<?php echo __ROOT__ ?>template/default/statics/images/vip.jpg" alt="">
    </div>
</div>

<div class="mvip content1200 text-default">
    <div class="mvip-left fl">
        <h3 class="strong text-big-small text-white text-center">会员专享</h3>
        <ul class="text-center">
            <li class="border-bottom-d4 vip-gaishu">会员概述</li>
            <li class="border-bottom-d4 vip-levels">会员等级</li>
            <li class="border-bottom-d4 vip-quanyi">会员权益</li>
            <li class="vip-zhangcheng">会员章程</li>
        </ul>
    </div>
    <div class="vips-right">
        <!-- 艺境会员概述-->
        <div class="mvip-right-vipgs fr margin-big-bottom margin-large-large-top gaishu">
            <!-- Path : haidao\template\default\statics\images -->
            <img src="<?php echo __ROOT__ ?>template/default/statics/images/yjvipgaishu.jpg" alt="">
        </div>

        <!-- 会员等级-->
        <div class="vip-level fr margin-big-bottom margin-large-large-top level" >
            <!-- 鼠标移动上去颜色变白 增加-->
            <ul class="text-center">
                <li>
                    <div class=" ye-vip vips">E会员</div>
                </li>
                <li>
                    <div class="yueke-vip evip ye-vip">悦客会员</div>
                </li>
            </ul>

            <div class="yueke margin-large-top">
                <!-- Path : haidao\template\default\statics\images -->
                <img src="<?php echo __ROOT__ ?>template/default/statics/images/yueke.jpg" alt="">
            </div>
            <p class="margin-large-top text-gray text-middle ">凡入住宝龙酒店集团旗下自创品牌连锁酒店（艺筑酒店、艺悦酒店、艺悦精选酒店、艺珺酒店、宝龙客栈），均可以免费办理成为E会员</p>
        </div>

        <!-- 艺境会员权益-->
        <div class="vip-rights fr margin-big-bottom margin-large-large-top quanyi">
            <!-- Path : haidao\template\default\statics\images -->
            <img src="<?php echo __ROOT__ ?>template/default/statics/images/yjvipquanyi.jpg" alt="">
        </div>

        <!-- 艺境会员章程-->
        <div class="constitution fr margin-big-bottom margin-large-large-top zhangcheng">
            <!-- Path : haidao\template\default\statics\images -->
            <img src="<?php echo __ROOT__ ?>template/default/statics/images/yjvipzhangcheng.jpg" alt="">
        </div>
    </div>



</div>
<div class="clear"></div>

<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    $('.evip').on('mouseover',function(){
        $('.mvip p').css({ display: 'block' });
    });
    $('.evip').on('mouseout',function(){
        var yueke = $('.yueke-vip').css('display');
        if(yueke == 'block'){
            $('.mvip p').css({ display: 'block' });
        }else{
            $('.mvip p').css({ display: 'none' });
        }

    });
    $('.yueke-vip').on('mouseover',function(){
        $('.ye-vip').removeClass('evip');
        $('.mvip .yueke').css({ display: 'block' });
    });
    $('.yueke-vip').on('mouseout',function(){
        $('.mvip .yueke').css({ display: 'none' });
        $('.mvip p').css({ display: 'block' });
        $('.vips').addClass('evip');
    });

    //左边菜单点击 右边显示

    $('.vip-gaishu').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.mvip-left ul li ').not($(this)).css({'color': '#666666'});
        $('.vips-right .gaishu').show();
        $('.vips-right .level').hide();
        $('.vips-right .quanyi').hide();
        $('.vips-right .zhangcheng').hide();
    });
    $('.vip-levels').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.mvip-left ul li ').not($(this)).css({'color': '#666666'});
        $('.vips-right .gaishu').hide();
        $('.vips-right .level').show();
        $('.vips-right .quanyi').hide();
        $('.vips-right .zhangcheng').hide();
    });
    $('.vip-quanyi').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.mvip-left ul li ').not($(this)).css({'color': '#666666'});
        $('.vips-right .gaishu').hide();
        $('.vips-right .level').hide();
        $('.vips-right .quanyi').show();
        $('.vips-right .zhangcheng').hide();
    });
    $('.vip-zhangcheng').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.mvip-left ul li ').not($(this)).css({'color': '#666666'});
        $('.vips-right .gaishu').hide();
        $('.vips-right .level').hide();
        $('.vips-right .quanyi').hide();
        $('.vips-right .zhangcheng').show();
    });




</script>
