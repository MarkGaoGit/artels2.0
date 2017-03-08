<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('商品详情');
</script>
<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/detail.js?v=<?php echo HD_VERSION;?>" ></script>
<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/jquery.jqzoom.js?v=<?php echo HD_VERSION;?>" ></script>

<!--logo-->
<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo fl">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>
</div>
<div class="clear"></div>


<div class="product-info container content1200 border-gray-white clearfix">
    <div class="preview">
        <div id="spec-n">
            <div class="jqzoom"><img class="lazy" src="<?php echo $goods['img_list'][0]?>" width="386" height="386" /></div>
        </div>
        <div id="showDetails" style="display: none;">
            <img src="<?php echo $goods['img_list'][0]?>" id="showImgBig" alt="" width="338" height="338" />
        </div>
        <div class="slider" id="spec-list">
            <a href="javascript:;" class="slider-control border prev btn text-big-small"><</a>
            <a href="javascript:;" class="slider-control border next btn text-big-small">></a>
            <div class="slider-items">
                <ul class="lh img-ls">
                    <?php foreach ($goods['img_list'] AS $list_img){?>
                    <li><img class="lazy imgs" src="<?php echo $list_img;?>"   width="74" height="74" /></li>
                    <?php }?>
                </ul>
            </div>
        </div>

    </div>
    <div class="item-info fr">
        <div class="name margin-bottom">
            <h1 class="text-large text-ellipsis"><?php echo $goods['brand']['name'];?>——<?php echo $goods['name'];?></h1><br>
            <span class="promo-price text-mix" style="font-size:30px;">&yen;<?php echo $goods['shop_price'];?></span>
        </div>
        <div class="summary">
            <p class="margin-bottom"><?php echo $goods['brand']['write_view'];?></p>
            <?php if(is_array($goods['specnames'])) { ?>
                <?php if(is_array($goods['specnames'])) foreach($goods['specnames'] as $k => $r) { ?>                    <p class="margin-bottom "><span class="strong"><?php echo $goods['specnames'][$k];?>&nbsp;&nbsp;&nbsp;</span><?php echo $goods['size_texture'][$k];?></p>
                <?php } ?>
            <?php } else { ?>
                <p class="margin-bottom "><span class="strong"><?php echo $goods['specnames']['0'];?>&nbsp;&nbsp;&nbsp;</span><?php echo $goods['size_texture']['0'];?></p>
            <?php } ?>
            <p class="margin-top"><span class="strong ">所在酒店：</span><?php echo $goods['hotel_name'];?> <?php echo $goods['room_num'];?></p>
        </div>
        <div class=" ">
            <div class="see fl margin-right" pid="<?php echo $goods['id'];?>" roomcode="<?php echo $goods['roomtype'];?>" codes="<?php echo $goods['typecode'];?>" sid="<?php echo $goods['hotelmsg']['id'];?>" cid="<?php echo $goods['hotelmsg']['catid'];?>" hotelName="<?php echo $goods['hotel_name'];?>" roomNum="<?php echo $goods['room_num'];?>">
                <img class="padding-small-left" src="<?php echo __ROOT__ ?>template/default/statics/images/see-colour-big.jpg" alt="">
                <p class=" text-default marign-small-left">去看看</p>
            </div>

                <?php if($favorite) { ?>
                    <div class="nolike fl margin-left" style="cursor: pointer;" data-id="<?php echo $goods['sku_id'];?>">
                        <img class="padding-small-left" height="18" src="<?php echo __ROOT__ ?>template/default/statics/images/ilike.png" alt="">
                        <p class=" text-default marign-small-left">已收藏</p>
                    </div>
                <?php } else { ?>
                    <div class="ilike fl margin-left" style="cursor: pointer;" date-id="<?php echo $goods['id'];?>">
                        <img class="padding-small-left" height="18" src="<?php echo __ROOT__ ?>template/default/statics/images/love.png" alt="">
                        <p class=" text-default marign-small-left">收藏</p>
                    </div>
                <?php } ?>
        </div>
        <div class="clear"></div>
        <?php if($goods[number] > 0) { ?>
        <div class="item-btn cheng-button text-big-small" data-event="cart_add" data-skuids="<?php echo $goods['sku_id'];?>">
             加入购物车
        </div>
        <?php } else { ?>
        <div class=" layout">
            <a class="fl  w25 button bg-gray" href="javascript:;">
                <i class="margin-right icon-cart va-m">
                    <svg width="14" height="14" viewBox="0 0 1024 1024">
                        <g>
                            <path d="M 143.123 602.62 l 194.878 -1.892 l 47.3 -342.457 l 348.132 -1.892 l 49.193 196.77 h 98.384 l -51.083 -293.262 l -541.118 1.892 l -49.192 342.456 h -96.493 Z M 300.161 40.689 c 0 0 0 0 0 0 c 0 -42.842 34.731 -77.572 77.572 -77.572 c 42.841 0 77.573 34.731 77.573 77.572 c 0 0 0 0 0 0 c 0 42.841 -34.731 77.573 -77.573 77.573 c -42.841 0 -77.572 -34.731 -77.572 -77.573 Z M 667.213 40.689 c 0 -42.842 34.731 -77.572 77.573 -77.572 s 77.572 34.731 77.572 77.572 c 0 42.841 -34.731 77.573 -77.572 77.573 c -42.841 0 -77.573 -34.731 -77.573 -77.573 Z" transform="translate(0 812) scale(1 -1)" fill="#fff"></path>
                        </g>
                    </svg></i>商品已售罄
            </a>
        </div>
        <?php } ?>
    </div>
    <div class="clear"></div>
    <hr>
    <div class="goods-content goods-msg">
        <?php echo $goods['content'];?>
    </div>
</div>
<div class="art-nav text-big" style="top:238px;">
    <a href="javascript:;" onclick="history.go(-1)">
        <img class="art-nav-logo" src="<?php echo __ROOT__ ?>template/default/statics/images/go_-1.png" alt="">
    </a>
</div>
</div>

<?php include template('artels-footer','common');?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/goods/jquery.md5.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__ ?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>" ></script>

<script>

    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    //我喜欢
    $('.ilike').on('click',function(){
        var pid = $(this).attr('date-id'),
                url = "<?php echo url('member/favorite/add');  ?>";
        $.post(url,{pid:pid},function(data){
            if(data['status'] != 0){
                $(this).children('span').css({'background' : 'url{../template/default/statics/images/ilike.png) no-repeat}'});
                $.tips({
                    icon:'success',
                    content:'收藏成功',
                    callback:function() {
                        window.location.reload();
                    }
                });
            }else{
                alert(data['message']);
            }
        },'json');
    });

    //取消我喜欢
    $('.nolike').live('click',function(){
        var sku_id = $(this).data('id');
        var url = "<?php echo url('member/favorite/delete')?>";
        $.getJSON(url,{sku_id:sku_id},function(ret){
            if(ret.status == 0) {
                $.tips({
                    icon:'error',
                    content:ret.message,
                    callback:function() {

                    }
                });
            } else {
                $.tips({
                    icon:'success',
                    content:ret.message,
                    callback:function() {
                        window.location.reload();
                    }
                });
            }
        })
    })

    //去看看
    $('.see').on('click',function(){
        var pid = $(this).attr('pid'),
                sid = $(this).attr('sid'),
                cid = $(this).attr('cid'),
                roomcode = $(this).attr('roomcode'),
                codes = $(this).attr('codes'),
                hotelMsg = $(this).attr('hotelName'),
                roomnumbers = $(this).attr('roomNum') + '号房间',
                url = "<?php echo url('member/index/gosee');  ?>";
        $.post(url,{pid:pid},function(data){
            if(data == 1){
                window.location.href= "?m=order&c=order&a=reserveroom&rm="+ roomcode +"&rc=" + codes + '&hotelMsg=' + hotelMsg + '&roomnumbers=' + roomnumbers;
            }else{
                if(confirm(data.message)){
                    window.location.href = "?m=member&c=public&a=login";
                }
            }

        },'json');
    });


</script>

<script>
    $(".timer").timer();
    $('.goods-comment-btn').bind('click',function(){
        var url_forward = $(this).data('url');
        var comment = "<?php echo url('comment/index/ajax_comment_index')?>";
        $.get(comment,{url_forward:url_forward},function(ret){
            if(ret.status == 0) {
                $.tips({
                    icon:'error',
                    content:ret.message,
                    callback:function() {
                        window.location.href = ret.referer;
                    }
                });
            }else{
                window.location.href = ret.referer;
            }
        },'json')
    })
    //初始货品
    var product_json = <?php echo json_encode($goods['sku_arr'])?>;
    var shop_price = "<?php echo $goods['prom_price']?>";
    var spec_id = "<?php echo $goods['spec_id']?>";
    var sku_obj = <?php echo ($goods['spec']) ? $goods['spec'] : "[]";?>;
    var sku_json = "<?php echo $goods['spec_str']?>";
    var sku_url = "<?php echo url('goods/index/detail')?>";
    var list_url = "<?php echo url('goods/index/lists',array('id'=>$goods['catid']))?>";
    var comment_url = "<?php echo url('comment/index/ajax_comment')?>";
    $(function(){
        var lists = '<div class="hd-toolbar-tab hd-tbar-tab-backlist">'
                +		'<a href="'+ list_url +'"><i class="tab-ico"></i></a>'
                +		'</div>';
        $('.hd-toolbar-footer').append(lists);
        $(".fr li a").attr('data-ajax','true');
        var $a=$("#comment_tab").find('a').eq(0);

        ajax_record(1);
        ajax_comment(1,$a);

        var seecont_url="<?php echo url('goods/consult/ajax_cont')?>";
        $.get(seecont_url,{spu:<?php echo $goods['spu_id']?>},function(result){
        $(".consult-total").html(result);
    },'json');

    var $len=$(".product-info .lh li").length;
    if($len<4){
        $(".product-info .slider .next").addClass("disabled");
    }
    })
    $('#comment_tab a').live('click', function() {
        var data_load=$(this).data('load');
        if(data_load){
            return false;
        }
        ajax_comment(1,this);
    });
    $('#pro-all-comment .comment_pages a:not(".button")').live('click', function() {
        var page = $.urlParam('page', $(this).attr('href'));
        ajax_comment(page,this);
        return false;
    });
    $('.record-pages .button').live('click', function() {
        var $parent=$(this).closest(".comment_pages");
        var this_page=$parent.find('.current span').html();
        var go_page=$parent.find('input').val();
        if(this_page == go_page){
            return false;
        }
        ajax_record(go_page,this);
        return false;
    });

    $('#pro-all-comment .button').live('click', function() {
        var $parent=$(this).closest(".comment_pages");
        var this_page=$parent.find('.current span').html();
        var go_page=$parent.find('input').val();
        if(this_page == go_page){
            return false;
        }
        ajax_comment(go_page,this);
        return false;
    });


    $.urlParam = function(name, url){
        var url = url || window.location.href;
        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
        if(!results) return false;
        return results[1] || 0;
    }

    $('#pro-buy-record .record-pages a:not(".button")').live('click', function() {
        var page = $.urlParam('page', $(this).attr('href'));
        ajax_record(page);
        return false;
    })
    if($('.prom_group').length > 0){
        $('.prom_group').find('.tab li').eq(0).addClass('current');
        $('.group_list').eq(0).removeClass('hidden');
        $('.prom_group').find('.tab li').live('click',function(){
            $(this).addClass('current').siblings('li').removeClass('current');
            $('.group_list[data-id = "' + $(this).data('id') + '"]').removeClass('hidden').siblings('.group_list').addClass('hidden');
        });

        $(".group_list").each(function(){
            if($(this).find(".lh .parts-item").length<=4){
                $(this).find(".slider-control").addClass("hidden");
            }
        });

        function getPrice(){
            $(".group_list").each(function(){
                var $this = $(this);
                var $suit = $this.find(".fitting-suit-info");
                var market_price = "<?php echo $goods['market_price']?>";
                var number = 1,
                        market_price = parseFloat(market_price),
                        total_price = parseFloat(shop_price);
                skuids = "<?php echo $goods['sku_id']?>";
                $(this).find(".check-items").each(function(){
                    if($(this).children(".check-item").is(":checked")){
                        number += 1;
                        market_price +=  parseFloat($(this).find(".text-mix em").data("market"));
                        total_price +=  parseFloat($(this).find(".text-mix em").html());
                        skuids += ',' + $(this).find(".text-mix em").attr("data-id");
                    }
                });

                $suit.find(".total_num").html(number);
                $suit.find(".price").html(total_price.toFixed(2));
                $suit.find(".item-btn").attr("data-skuids",skuids);
                $suit.find(".market").html(market_price.toFixed(2));
            });
        }
        getPrice();

        $('.fitting-suit-items .check-item').bind('click',function(){
            getPrice();
        })
    }
    //促销满额
    $(".promotion-dom").hover(function(){
        $(".promotion-box").addClass("promotion");
        $(".promotion-icon").removeClass("promotion-icon").addClass("promotion-icon-up");
    },function(){
        $(".promotion-box").removeClass("promotion");
        $(".promotion-icon-up").removeClass("promotion-icon-up").addClass("promotion-icon");
    });

</script>