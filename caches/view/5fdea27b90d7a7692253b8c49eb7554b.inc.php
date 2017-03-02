<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<script type="text/javascript" src="template/default/statics/js/index.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="template/default/statics/js/jquery.cookie.js?v=<?php echo HD_VERSION;?>"></script>
<!--Banner-->
        <?php include template('login','common');?>
        <?php include template('logintoper','common');?>
<div class="banner">
<div class="shade-slider">
<ul class="box">
<?php
	$taglib_misc_focus = new taglib('misc','focus');
	$data = $taglib_misc_focus->lists(array('order'=>'sort ASC'), array('limit'=>'20','cache'=>'084399cac6745350d12ad62046eb9112,3600'));
?><?php if(is_array($data)) foreach($data as $r) { ?><li class="item"><a href="<?php echo $r['url'];?>" <?php if($r[target] == 1) { ?> target="_blank" <?php } ?> ><img src="<?php echo $r['thumb'];?>" width="1200" /></a></li>
<?php } ?>

</ul>
                <!-- 快速搜索酒店预订 -->
                <div class="fast-find">
                    <form action="index.php?m=goods&c=index&a=lists" method="post" class='select-from' name="fast-find">
                        <span class="find-condition">入住城市</span>
                        <input type='text' name='city' class="city-input click-city"   autocomplete="off" />
                        <input type='hidden' name='citys' class="citys" autocomplete="off" />
                        <span class="icon-add icon"></span>
                        <div class="hotel-add text-default">
                            <ul style="width:200px;">
                                <?php if(is_array($city)) foreach($city as $r) { ?>                                <li city-code="<?php echo $r['cityCode'];?>"><?php echo $r['name'];?></li>
                                <?php } ?>
                            </ul>
                        </div>


                        <span class="find-condition">入住时间</span>
                        <input type="text" name="check-time" class="banner-checktime" autocomplete='off' onClick=" $('.select-hotel-button').removeAttr('disabled');WdatePicker()" >
                        <span class="icon-time icon" ></span>

                        <span class="find-condition">退房时间</span>
                        <input type="text" name="checkout-time" class="banner-checktimeout" onClick=" $('.select-hotel-button').removeAttr('disabled');WdatePicker()" >
                        <span class="icon-time icon" ></span>
                        <input type="submit" name="submit" value="马上搜索" onClick="selectChick(2)" class="button select-hotel-button">
                    </form>
                </div>
</div>
</div>
<!--Banner end-->

<!--content-->
        <?php include template('nav','common');?>
<div class="hd-toolbar-footer">
<div class="hd-toolbar-tab hd-tbar-tab-top margin-bottom">
<a href="#"><i class="tab-ico"></i></a>
</div>
</div>

        <?php include template('artels-footer','common');?>
<?php echo runhook('global_footer', '');?>
</body>
</html>
<script type="text/javascript" src="<?php echo __ROOT__ ?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>" ></script>

<script type="text/javascript">
    var url = "<?php echo url('goods/index/ajax_goods')?>";
    $(function(){
        if($('.goods_lists .current').attr('data-ajax') == 1) return;
        ajax_statusext($('.goods_lists .current').attr('data-id'));
    })
    $(".mask a").live('click',function(){
        $(".mask").hide();
    });
    $('.change_goods').live('click',function(){
        ajax_like('rand',6,500);
    });
    $('.text-default li').live('mouseenter',function(){
        if($(this).attr('data-ajax') == 1) return;
        var catid = $(this).attr('data-id');
        ajax_goods(catid,8,220);
    });

    $('.goods_lists li').live('click',function(){
        if($(this).attr('data-ajax') == 1) return;
        ajax_statusext($(this).attr('data-id'));
    });

    $('.nav .nav-li').on('click',function(){
        var ids = $(this).attr('data-id');
        var navs = $('.nav').children();
        var navleg = parseInt(navs.length);
        for(var i=1;i<=navleg;i++){
            var nowid = $('.nav .nav-li:nth-child('+ i +')').attr('data-id');
            if(ids == nowid){
                $('.nav .nav-li:nth-child('+ i +')').css({
                    'width':'240px',
                    'height':'62px',
                    'line-height': '56px',
                    'position':'relative',
                    'top':'8px',
                    'background':'#e6e6e6',
                    'color':'#00437c',
                    'font-size':'16px'
                });
            }else{
                $('.nav .nav-li:nth-child('+ i +')').css({
                    'width':'240px',
                    'height':'62px',
                    'line-height': '56px',
                    'position':'relative',
                    'top':'8px',
                    'background':'#00437c',
                    'color':'#fff',
                    'font-size':'16px'
                });
            }
        }

    });


    function ajax_statusext(ids){
        if(!ids){
            ids = '5';
        }
        var html = '';
        var root = "<?php echo __ROOT__ ?>";
        switch (ids){
            case '1':
                html = "<div class='content'></div>";
                break;
            case '2':
                html ="<div class='content brand'>" +
                        "<ul>"+
                        "<li><a href='"+
                        "/index.php?m=goods&c=index&a=pinpai#HZBJ"
                        +" '> <img src='" + root +"template/default/statics/images/junhotel.png ' /> </a>"+
                        "</li>"+
                        "<li><a href='"+
                        "/index.php?m=goods&c=index&a=pinpai#YTSDM"
                        +" '> <img src='" + root +"template/default/statics/images/artelsjx.png ' /> </a>"+
                        "</li>"+
                        "<li><a href='"+
                        "/index.php?m=goods&c=index&a=pinpai#HZFYM"
                        +"'> <img src='" + root +"template/default/statics/images/artels.png ' /> </a>"+
                        "</li>"+
                        "<li><a href='"+
                        "/index.php?m=goods&c=index&a=pinpai#QDSDM"
                        +"'> <img src='" + root +"template/default/statics/images/yizhu.png ' /> </a>"+
                        "</li>"+
                        "<li><a href='"+
                        "/index.php?m=goods&c=index&a=pinpai#PLSDM"
                        +"'> <img src='" + root +"template/default/statics/images/kezhan.png ' /> </a>"+
                        "</li>"+
                        "</ul>"+
                        "</div>";
                break;
            case '3':
                html = "<div class='content reserve m-t40-r34'>" +
                        "<ul>"+
                        "<form action='index.php?m=goods&c=index&a=lists' class='select-from' method='post' name='check'> "+
                        "<li>"+
                        "<span>入住城市</span> <br/>"+
                        "<input type='text' name='nav-city' id='city-input' class='select-city-hotel' onclick='cityBlock()'  autocomplete='off' />"+
                        "<input type='hidden' name='nav-citys' class='nav-citys' />"+
                        "<span class='icon-add icon'></span>"+
                        "<div class='hotel-add text-default'>" +
                        "<ul style='width:200px;'>" +
                        "<?php if(is_array($city)) foreach($city as $k => $r) { ?>"+
                        "<li city-code='" + "<?php echo $r['cityCode'];?>" +"' onclick='addHml(<?php echo $k;?>)' ><?php echo $r['name'];?></li>" +
                        "<?php } ?>"+
                        "</ul>" +
                        "</div>" +
                        "</li>"+
                        "<li>"+
                        "<span>入住时间</span><br/>"+
                        "<input type='text' name='check-time' onfocus='rgl(1)' class='navCheck' onClick='WdatePicker()' id='reserve-check-time' autocomplete='off' >"+
                        "<span class='icon-time icon'></span>"+
                        "</li>"+
                        "<li>"+
                        "<span>退房时间</span><br/>"+
                        "<input type='text' name='checkout-time' onfocus='rgl(2)' onClick='WdatePicker()' class='navCheckout' id='reserve-checkout-time' autocomplete='off' >"+
                        "<span class='icon-time icon'></span>"+
                        "</li>"+
//                            "<li>"+
//                                "<span>房间</span><br/>"+
//                                "<span class='minus nums-button'></span>"+
//                                "<input type='text' name='room-num' value='1' class='room-num'/>"+
//                                "<span class='font-gd'>间</span>"+
//                                "<span class='plus nums-button'></span>"+
//                            "</li>"+
                        "<li>"+
                        "<input type='submit' name='button' value='立即预定' onClick='selectChick(1)' class='check select-hotel-button'/>"+
                        "</li>"+
                        "</form>"+
                        "</ul>"+
                        "</div>";
                break;
            case '4':
                html = "<div class='content vip'>" +
                        "<div class='discount-5'>" +
                        "<h2>周多任</h2>" +
                        "<a class='text-main' style='text-decoration:underline;' href='index.php?m=goods&c=index&a=totalArt'>看好你哟！></a>" +
                        "</div>" +
                        "<div class='vip-right about'>" +
                        "<ul>" +
                        "<li>" +
                        "<h3>没有电源，谈何网络？</h3>" +
                        "<p>在这幅作品里每个人都能找到自己</p>"+
                        "<p><a class='text-default strong text-main' href='index.php?m=goods&c=index&a=totalArt'>更多信息 ></a></p>" +
                        "</li>" +
                        "<li>" +
                        "<h3>我拍照，你介意吗？</h3>" +
                        "<p>两位艺术家就这么面无表情而举重若轻为我们演绎了一幕幕是非恩怨</p>" +
                        "<p><a class='text-default strong text-main' href='index.php?m=goods&c=index&a=totalArt'>更多信息 ></a></p>" +
                        "</li>" +
                        "</ul>" +
                        "</div>" +
                        "</div>";
                break;
            case '5':
                html = "<div class='content vip'>" +
                        "<div class='discount-5'>" +
                        "<h2>悦享优惠</h2>" +
                        "<a  style='text-decoration:underline;' class='text-default strong text-main' href='javascript:;'>查看所有优惠 ></a>" +
                        "</div>" +
                        "<div class='vip-right'>" +
                        "<ul>" +
                        "<li>" +
                        "<h3>宝龙酒店集团会员</h3>" +
                        "<p>查看会员多重尊贵福利 入住即享 </p>"+
                        "<p><a class='text-default strong text-main'  href='index.php?m=goods&c=index&a=vip'>更多信息 ></a></p>" +
                        "</li>" +
                        "<li>" +
                        "<h3>艺术人文</h3>" +
                        "<p>查看缤纷多彩的酒店周边艺术人文景点  随心乐享</p>" +
                        "<p><a class='text-default strong text-main'  href='javascript:;'>更多信息 ></a></p>" +
                        "</li>" +
                        "</ul>" +
                        "</div>" +
                        "</div>";
                break;
            case '6':
                html = "<div class='content vip aboutss'>" +
                        "<div class='discount-5'>" +
                        "<h2>宝龙集团</h2>" +
                        "<a class='text-default strong text-main'  style='text-decoration:underline;'  href='index.php?m=goods&c=index&a=about&part=powerlong'>更多信息 ></a></a>" +
                        "</div>" +
                        "<div class='vip-right about'>" +
                        "<ul>" +
                        "<li>" +
                        "<h3>宝龙酒店集团</h3>" +
                        "<p>宝龙地产五大产业之一，主营业务：国际品牌酒店、自创品牌连锁酒店和餐厅。</p>"+
                        "<p><a class='text-default strong text-main'  href='index.php?m=goods&c=index&a=about&part=powerlonghotel'>更多信息 ></a></p>" +
                        "</li>" +
                        "<li>" +
                        "<h3>酒店品牌</h3>" +
                        "<p>艺珺、艺悦、艺悦·精选、艺筑、宝龙客栈品牌</p>" +
                        "<p><a class='text-default strong text-main'  href='index.php?m=goods&c=index&a=about&part=pinpai'>更多信息 ></a> </p>" +
                        "</li>" +
                        "</ul>" +
                        "</div>" +
                        "</div>";
                break;
        };
        for(var i= 1; i<=6; i++){
            if(ids != i){
                $('.statusext_box .content').remove();
                $('.tab .current').addClass('hover-color');
            }
        }

        $('.statusext_box').append(html);

        $('.reserve .plus').on('click',function(){
            var roomNum = parseInt($('.reserve .room-num').val());
            var roomVal = roomNum + 1 ;
            $('.reserve .room-num').val(roomVal);
        });

        $('.reserve .minus').on('click',function(){
            var roomNum = parseInt($('.reserve .room-num').val());
            var roomVal = roomNum - 1 ;
            if(roomNum == 1){
                roomVal = 1;
            }
            $('.reserve .room-num').val(roomVal);
        });

    }

    function ajax_like(order,limit,length,type){
        $.get(url,{order:order,limit:limit,length:length},function(ret){
            if(!ret.lists) return;
            var html = '';
            $.each(ret.lists,function(i,item){
                html += '<li class="index-pic-1">'
                        +		'<div class="img"><a href="'+ item.url +'"><img class="lazy" src="<?php echo SKIN_PATH;?>statics/images/lazy.gif" data-original="'+ item.thumb +'" width="150" height="150" /></a></div>'
                        +			'<div class="text">'
                        +				'<div class="title text-ellipsis"><a href="'+ item.url +'">'+ item.sku_name +'</a></div>'
                        +				'<div class="price">￥'+ item.prom_price +'</div>'
                        +			'</div>'
                        +		'</li>';
            })
            $('.guess_like').html(html);
            $('.guess_like img.lazy').lazyload({
                effect : "fadeIn"
            });
        },'json');
    }
    function ajax_goods(catid,limit,length){
        $.get(url,{catid:catid,limit:limit,length:length},function(ret){
            if(!ret.lists){
                $('.text-default li[data-id="'+ catid +'"]').attr('data-ajax',1);
                return;
            }
            var html = '';
            if(ret.lists.length > 0){
                $.each(ret.lists,function(i,item){
                    html += '<li class="index-pic-2">'
                            +		'<div class="img"><a href="'+ item.url +'"><img class="lazy" src="<?php echo SKIN_PATH;?>statics/images/lazy.gif" data-original="'+ item.thumb +'" width="218" height="218" /></a></div>'
                            +		'<div class="text">'
                            +			'<div class="title"><a href="'+ item.url +'">'+ item.sku_name +'</a></div>'
                            +			'<div class="price">￥'+ item.prom_price +'</div>'
                            +		'</div>'
                            +	'</li>'
                })
                $('.left ul[data-id="' + catid + '"]').html(html);
                $('.left ul[data-id="' + catid + '"] img.lazy').lazyload({
                    effect : "fadeIn"
                });
                ajax_top(catid,'sales',10,100);
            }
        },'json');
    }
    function ajax_top(catid,order,limit,length){
        $.get(url,{catid:catid,order:order,limit:limit,length:length},function(ret){
            if(!ret.lists){
                return;
            }
            var html = '';
            if(ret.lists.length > 0){
                $.each(ret.lists,function(i,item){
                    var li_html = i < 1 ? '<li class="hover">' : '<li>';
                    var top_num = i < 9 ? '0' + (i*1+1) : i+1;
                    html += li_html
                            +		'<div class="no-num"><span class="text-mix">NO.' + top_num + '</span></div>'
                            +		'<div class="img"><a href="'+ item.url +'"><img class="lazy" src="<?php echo SKIN_PATH;?>statics/images/lazy.gif" data-original="'+ item.thumb +'" width="97" height="97" /></a></div>'
                            +		'<div class="text">'
                            +			'<div class="title"><a href="'+ item.url +'">'+ item.sku_name +'</a></div>'
                            +			'<div class="price"><span>￥'+ item.prom_price +'</span></div>'
                            +		'</div>'
                            +	'</li>'
                })
                $('.right ul[data-id="' + catid + '"]').html(html);
                $('.right ul[data-id="' + catid + '"] img.lazy').lazyload({
                    effect : "fadeIn"
                });
                $('.text-default li[data-id="'+ catid +'"]').attr('data-ajax',1);
            }
        },'json');
    }
    function current(){
        var d = new Date();
        var year = d.getFullYear(),
                month = d.getMonth() < 10 ? '0'+(d.getMonth() + 1) : d.getMonth() + 1,
                date = d.getDate() < 10 ? '0'+d.getDate() : d.getDate(),
                hours = d.getHours() < 10 ? '0'+d.getHours() : d.getHours(),
                minutes = d.getMinutes() < 10 ? '0'+d.getMinutes() : d.getMinutes(),
                seconds = d.getSeconds() < 10 ? '0'+d.getSeconds() : d.getSeconds();
        return  year+'-'+month+'-'+date+' '+hours+':'+minutes+':'+seconds;
    }
    setInterval(function(){$("#time").html(current)},1000);

    function rgl(name){
        $('.select-hotel-button').removeAttr('disabled');
        if(name == 1){
            var classsName = '.navCheck';
        }else{
            var classsName= '.navCheckout';
        }
       var disadd = $(classsName).offset();
        if(disadd.top > 100){
            var heights = $(document).height();
            $(document).scrollTop(heights);
            WdatePicker();
        }
    }
</script>

<script>
    $('.fast-find .city-input').on('focus',function(){
        $('.fast-find .hotel-add').css({ display : 'block' });
        $('.select-hotel-button').removeAttr('disabled');
    });


    $('.fast-find .hotel-add ul li').on('click' ,function(){
        var html = $(this).html(),
                cityCode = $(this).attr('city-code');
        $('.fast-find .city-input').val(html);
        $('.fast-find .citys').val(cityCode);
        $('.fast-find .hotel-add').css({ display : 'none' });
    });

    function cityBlock(){
        $('.reserve .hotel-add').css({ display : 'block' });
        $('.select-hotel-button').removeAttr('disabled');
    }

    function addHml(k){
        var ks = parseInt(k) + 1;
        var html = $('.reserve .hotel-add ul li:nth-child(' + ks +')').html(),
                cityCode = $('.reserve .hotel-add ul li:nth-child(' + ks +')').attr('city-code');
        $('#city-input').val(html);
        $('.nav-citys').val(cityCode);
        $('.reserve .hotel-add').css({ display : 'none' });
    }

    function selectChick(nums){
        if(nums == 1){
            var citys = $('.select-city-hotel').val(),
                checkTime = $('.navCheck').val(),
                checkTimeOut = $('.navCheckout').val();
        }
        if(nums == 2){
            var citys = $('.city-input').val(),
                checkTime = $('.banner-checktime').val(),
                checkTimeOut = $('.banner-checktimeout').val();
        }
        if(!citys || !checkTime || !checkTimeOut || checkTime > checkTimeOut ){
            alert('输入信息有误，请重新填写！');
            $('.select-hotel-button').attr({'disabled':'true'});
        }

    }


$('.checkin-time').on('click',function(){
$('.hotel-add').css({'display':'none'});
})
</script>
