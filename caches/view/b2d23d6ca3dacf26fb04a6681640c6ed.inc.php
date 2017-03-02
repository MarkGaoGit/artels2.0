<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/goods_detail.js"></script>
<script type="text/javascript">
    mui.init();
    var goods = {
        "spu_id"      : "<?php echo $goods['spu_id'];?>",
        "sku_id"      : "<?php echo $goods['sku_id'];?>",
        "number" 		  : "<?php echo $goods['number'];?>",
        // 促销类型
        "prom_type"   :"<?php echo $goods['prom_type'];?>"
    };
    var theme_path = "<?php echo THEME_PATH;?>";

    //图片高度暂时不用
    window.onload = function(){
        // 获取屏幕的高度 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
                client_25 = parseInt(client_h) * 0.57;
        $('.goods-img').css({'max-height': client_25});
    }



</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>"></script>
<div class="hd-detail-content mobile-work-css">
    <div id="hd_detail">
        <div id="head_wrap" class="hd-scroll-wrapper">
            <div class="hd-scroller padding-bottom">
                <div class="mui-slider bg-white">
                    <div class="mui-slider-group" >
                        <?php if(is_array($goods[img_list])) foreach($goods[img_list] as $img) { ?>                        <div class="mui-slider-item" style="height:414px;" >
                            <a href="javascript:;" ><img  src="<?php echo SKIN_PATH;?>statics/images/loading.gif" class="lazy goods-img" data-original="<?php echo $img;?>" /></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="mui-slider-indicator">
                        <?php if(is_array($goods[img_list])) foreach($goods[img_list] as $k => $img) { ?>                        <div class="mui-indicator <?php if($k == 0) { ?>mui-active<?php } ?>"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="basic-info list-col-10 margin-bottom mui-clearfix ">
                    <span class="pro-title text-black hd-h4 margin-left-15">
                        <?php if($goods['is_derivative'] != 1) { ?>
                            <?php echo $goods['brand']['name'];?> — <?php echo $goods['name'];?>
                        <?php } else { ?>
                            <?php echo $goods['name'];?> &nbsp;&nbsp; <?php echo $goods['hotel_name'];?> <?php echo $goods['room_num'];?>
                        <?php } ?>
                    </span>
                    <br/><br/>
                    <div class="pro-price hd-h3 margin-left-15">
                        <span class="price-org">￥<?php echo $goods['prom_price'];?></span>
                        <span class="fr text-center margin-left hx-btn gosee " roomcode="<?php echo $goods['roomtype'];?>" codes="<?php echo $goods['typecode'];?>" hotelName="<?php echo $goods['hotel_name'];?>" roomNum="<?php echo $goods['room_num'];?>" date-id="<?php echo $goods['id'];?>" sid="<?php echo $goods['hotelmsg']['id'];?>" cid="<?php echo $goods['hotelmsg']['catid'];?>" yspadd="<?php echo $goods['hotel_name'];?><?php echo $goods['room_num'];?>">
                            <span class="mui-icon mui-icon-eye text-d3"></span><br>
                            <span class="hd-h5">去看看</span>
                        </span>
                        <?php if($favorite) { ?>
                            <span class="fr text-center hx-btn nolike" data-id = "<?php echo $goods['sku_id'];?>">
                                <span class="mui-icon-extra mui-icon-extra-heart-filled text-loves"></span><br>
                                <span class="hd-h5">已收藏</span>
                            </span>
                        <?php } else { ?>
                            <span class="fr text-center hx-btn ilike" date-id = "<?php echo $goods['id'];?>">
                                <span class="mui-icon-extra mui-icon-extra-heart-filled text-d3"></span><br>
                                <span class="hd-h5">我喜欢</span>
                            </span>
                        <?php } ?>
                    </div>
                </div>
                <?php if($goods[prom_type] == 'goods' && $goods[prom_id] > 0) { ?>
                <div class="border-bottom margin-top bg-white">
                    <?php if(is_array($goods_proms[rules])) foreach($goods_proms[rules] as $rule) { ?>                    <div class="padding hd-h4 border-top">
                        <span class="mui-pull-left"><em class="text-org">促&nbsp;&nbsp;&nbsp;&nbsp;销</em>：</span>
                        <span class="margin-large-left padding-large-left mui-block"><?php echo $rule['title'];?></span>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <ul class="mui-table-view margin-top">
                    <li class="mui-table-view-cell">
                        <a class="text-black" href="javascript:;"><?php echo $goods['specarr']['0']['name'];?>：<?php echo $goods['specarr']['0']['value'];?></a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right"
                           href="<?php if($goods['is_derivative'] != 1) { ?><?php echo url('goods/index/artzp',array('page'=>2));?><?php } else { ?><?php echo url('goods/index/derivative',array('cid'=>9));?><?php } ?>">
                            点击查看全部<?php if($goods['is_derivative'] !=1 ) { ?>作品<?php } else { ?>衍生品<?php } ?></a>
                    </li>
                </ul>
                <div class="detail-tips">
                    <p class="mui-text-center">继续拖动，查看详情</p>
                    <p class="mui-text-center padding-bottom"><em class="mui-icon mui-icon-arrowup"></em></p>
                </div>
            </div>
        </div>
        <div id="bottom_wrap" class="hd-scroll-wrapper">
            <div class="hd-scroller">
                <div class="pulldown">
                    <p class="mui-text-center"></p>
                </div>
                <div class="goods-intro">
                    <div id="detail" class="mui-control-content goods-detail mui-active">
                        <script>
                            var $detail = '<?php echo $goods['content'];?>';
                            $detail = $detail.replace(/ src/g, ' src="<?php echo SKIN_PATH;?>statics/images/loading.gif" class="de-lazy" data-original');
                            $("#detail").html($detail);
                        </script>
                    </div>
                    <div id="comment" class="mui-control-content goods-evaluate">
                        <div class="top mui-clearfix">
                            <span class="mui-pull-left">只有购买过该商品的用户才能评论</span>
                            <span class="mui-btn mui-btn-primary mui-pull-right comment_btn" data-url="<?php echo urlencode($_SERVER['REQUEST_URI']);?>">我要评论</span>
                        </div>
                        <ul class="comment-lists margin-none padding-lr list-col-10 mui-clearfix">

                        </ul>
                        <a class="top mui-block border-bottom mui-text-center text-black more" href="javascript:;" data-mark="comment">点击查看更多</a>
                    </div>
                    <div id="consult" class="mui-control-content goods-consult">
                        <div class="top mui-clearfix">
                            <span class="mui-pull-left">对商品有任何疑问可在线咨询</span>
                            <a class="mui-btn mui-btn-primary mui-pull-right" href="<?php echo url('goods/consult/add',array('sku_id'=>$_GET['sku_id']))?>">我要咨询</a>
                        </div>
                        <ul class="comment-lists margin-none padding-lr list-col-10 mui-clearfix"></ul>
                        <a class="top mui-block border-bottom mui-text-center text-black more" href="javascript:;" data-mark="consult">点击查看更多</a>
                        <!--<div class="user-list-none mui-text-center">
                            <img src="<?php echo SKIN_PATH;?>statics/images/ico_34.png" />
                            <p class="text-black hd-h4 margin-top">没有查询到记录</p>
                        </div>-->
                    </div>
                </div>
            </div>

            <div id="detail-nav" class="mui-row bg-white padding-lr">
                <span class=" w100 text-center active" data-scroll="0"><a href="javascript:;" data-id="detail">图文介绍</a></span>
                <!--<span class="mui-col-xs-4" data-scroll="0"><a href="javascript:;" data-id="comment">规格参数</a></span>-->
                <!--<span class="mui-col-xs-4" data-scroll="0"><a href="javascript:;" data-id="consult">包装售后</a></span>-->
            </div>
        </div>
    </div>
</div>

<nav class="mui-bar mui-bar-tab ysp-footer foot-bar">
    <a class="mui-tab-item mui-active" style="width:10%;" href="<?php echo __APP__;?>">
        <span class="mui-icon mui-icon-home margin-little-bottom"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a class="mui-tab-item" style="width:10%;"  href='<?php echo url("order/cart/index");?>'>
        <span class=" mui-icon mui-icon-extra-cart margin-little-bottom ">
        </span>
        <span class="mui-tab-label">购物车</span>
    </a>
    <a class="mui-tab-item" style="width:10%;"  id="alertBtn" href="javascript:;">
        <span class="mui-icon mui-icon-extra mui-icon-extra-custom margin-little-bottom"></span>
        <span class="mui-tab-label">客服</span>
    </a>
    <a class="mui-tab-item m-cart-add bg-white border-cheng hd-h4" style="width:35%;" id="join-cart" href="javascript:;">
        <span class="mui-tab-label text-f85738">加入购物车</span>
    </a>
    <a class="mui-tab-item m-now-buy bg-orange text-white hd-h4" style="width:35%;"  id="buy" data-event="buy_now" data-skuids="<?php echo $goods['sku_id'];?>" href="javascript:;">
        <span class="mui-tab-label">立即购买</span>
    </a>
</nav>
<div id="spec" class="hd-cover">
    <div class="body">
        <?php if(is_array($goods['specs'])) foreach($goods['specs'] as $specs) { ?>        <?php if(!is_null($specs['id'])) { ?>
        <dl class="goods-spec-item">
            <dt><?php echo $specs['name'];?>：</dt>
            <dd>
                <?php if(is_array(explode(',',$specs['value']))) foreach(explode(',',$specs['value']) as $k => $spec) { ?>                    <span data-id="<?php echo $specs['id'];?>" data-name="<?php echo $specs['name'];?>" data-value="<?php echo $spec;?>"><?php echo $spec;?></span>
                <?php } ?>
            </dd>
        </dl>
        <?php } ?>
        <?php } ?>
        <div class="padding-left-15 padding-right-15 padding-big-bottom">
            <h2 class="border-top padding-tb">数量</h2>
            <div class="number mui-clearfix">
                <button class="num-btn num-decrease disabled">-</button>
                <input class="num-input" type="number" data-max="<?php echo $goods['number'] ? $goods['number'] : 1?>" value="1" />
                <button class="num-btn num-increase">+</button>
            </div>
        </div>
    </div>
    <div class="summary">
        <div class="img">
            <img src="<?php echo $goods['thumb'];?>" />
        </div>
        <div class="main">
            <span class="text-org mui-h4">￥<em><?php echo $goods['prom_price'];?></em></span>
            <div class="hd-h5 margin-small-top"><span class="stock">库存 <em><?php echo $goods['number'];?></em>件</span></div>
        </div>
        <a class="close mui-icon mui-icon-plus"></a>
    </div>
    <div class="option">
        <?php if($goods[number] > 0) { ?>
        <button class="mui-btn mui-btn-primary full hd-h4 radius-none">确定</button>
        <?php } else { ?>
        <button class="mui-btn mui-btn-primary full hd-h4 radius-none disabled">商品已售罄</button>
        <?php } ?>
    </div>
</div>
<div class="cover-decision"></div>
<div class="comment-slider hide">
    <div class="mui-slider">
        <div class="mui-slider-group"></div>
    </div>
</div>
<input type="hidden" value="<?php echo $setting['com_mobile'];?>" class="kf-mobile">
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/detail.js"></script>

<?php include template('artels-menu-footer', 'common'); ?>

</body>
</html>

<script>
    document.getElementById("alertBtn").addEventListener('tap', function() {
        var mask = mui.createMask();//callback为用户点击蒙版时自动执行的回调；
        mask.show();//显示遮罩
//        mask.close();//关闭遮罩
        var client_h = parseInt(document.documentElement.clientHeight);
        var mobiles = $('.kf-mobile').val();
        $('.mui-backdrop').css({'line-height': client_h + 'px'});
        $('.mui-backdrop').html('电话：' + mobiles);
    });

    //取消我喜欢
    $('.nolike').on('click',function(){
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

    //我喜欢
    $('.ilike').on('click',function(){
        var pid = $(this).attr('date-id'),
                url = "<?php echo url('member/favorite/add');  ?>";
        $.post(url,{pid:pid},function(data){
            if(data['status'] != 0){
                $.tips({
                    icon: 'success',
                    content: '收藏成功',
                    callback:function() {
                        window.location.reload();
                    }
                });
            }else{
                $.tips({
                    icon: 'error',
                    content: data['message']
                });
            }
        },'json');
    });

    //去看看
    $('.gosee').on('click',function(){
        var pid = $(this).attr('date-id'),
                sid = $(this).attr('sid'),
                cid = $(this).attr('cid'),
                roomcode = $(this).attr('roomcode'),
                codes = $(this).attr('codes'),
                hotelMsg = $(this).attr('hotelName'),
                roomnumbers = $(this).attr('roomNum') + '号房间',
                url = "<?php echo url('member/index/gosee');  ?>";
        $.post(url,{pid:pid},function(data){
            if(data == 1){
                window.location.href= "?m=goods&c=index&a=hotelListBooking&rm="+ roomcode +"&rc=" + codes + '&hotelname=' + hotelMsg + '&roomnumbers=' + roomnumbers;
            }else{
                $.tips({
                    icon: 'error',
                    content: data['message'],
                    callback:function() {
                        window.location.href = "?m=member&c=public&a=login";
                    }
                });
            }

        },'json');
    });



</script>

<script type="text/javascript">
    var product_json = <?php echo json_encode($goods['sku_arr'])?>;
    var sku_obj = <?php echo $goods['spec'] ? $goods['spec'] : "[]";?>;
    var sku_json = "<?php echo $goods['spec_str']?>";
    var sku_id = "<?php echo $goods['sku_id']?>";

    $(".de-lazy").each(function(){
        $(this).attr("src", $(this).data("original"));
    })

    //加入收藏
    mui(".foot-bar").on('tap','.collect-btn',function(){
        var $_this = $(this);
        var _this = $(this).find('.mui-icon');
        var url = "<?php echo url('member/favorite/delete')?>";
        if($_this.hasClass('cancel_favorite')){
            $.post(url,{sku_id:sku_id},function(ret){
                if(ret.status == 1){
                    $('.collect-btn img').attr('src','<?php echo SKIN_PATH;?>statics/images/ico_35.png');
                    $('.collect_text').text('收藏');
                    $_this.removeClass('cancel_favorite');
                }else{
                    return false;
                }
            },'json');
        }else{
            var url = "?m=member&c=favorite&a=add";
            var sku_price = _this.attr('data-price');
            var url_forward =  _this.data('url');
            $.post(url,{sku_id:sku_id,sku_price:sku_price,url_forward:url_forward},function(data){
                if(data.status == 1){
                    $('.collect-btn img').attr('src','<?php echo SKIN_PATH;?>statics/images/ico_35a.png');
                    $('.collect_text').text('取消收藏');
                    $_this.addClass('cancel_favorite');
                }else{
                    $.tips({
                        content:data.message,
                        callback:function() {
                            if(data.message == '请登录后操作'){
                                window.location.href = data.referer;
                            }
                        }
                    });
                }
            },'json');
        }
    });
    //评价商品
    mui("#comment").on('tap','.comment_btn',function(){
        var url_forward = $(this).data('url');
        var comment = "<?php echo url('comment/index/ajax_comment_index')?>";
        $.get(comment,{url_forward:url_forward},function(ret){
            if(ret.status == 0) {
                $.tips({
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
    var detail = new hdTouch();

    $(function(){

        var page = {
            comment : 1,
            consult : 1
        };
        var cart_nums = 0;
        goods_detail.init();
        $('.mui-control-item').on('tap','a',function(){
            var obj = $(this).data('id');
            $(".goods-intro .mui-control-content").removeClass("mui-active");
            $("#"+obj).addClass("mui-active");
        })
        mui('.option').on('tap','.mui-btn',function(){
            if(!$(this).hasClass('disabled')){
                var url = window.location.href;
                var strCart = new RegExp('#cart'),
                        strBuy = new RegExp('#buy');
                if(strCart.test(url)){
                    goods_detail.cart_add();
                }else if(strBuy.test(url)){
                    goods_detail.buy_now($('#buy'));
                }
            }
        });
        mui("#detail-nav").on('tap','span',function(e){
            $.each($("#detail-nav").children("span"), function() {
                if($(this).hasClass("active")){
                    var matrix = $("#detail-nav").prev().css('-webkit-transform').split(")")[0].split(", ")
                    $(this).data("scroll", parseFloat(Math.round(matrix[5])));
                }
            });
            detail._slideTo(document.getElementById("bottom_wrap").children[0], $(this).data('scroll'), 0);
            var _id = $(this).children("a").data("id");
            $(this).addClass("active").siblings().removeClass("active");
            $(".goods-intro .mui-control-content").removeClass("mui-active");
            $('#'+_id).addClass("mui-active");
        });
        mui(".mui-control-content").on('tap','.more',function(){
            //add_more();
            var mark = $(this).data("mark");
            loadLists(mark);
        })

        function loadLists(mark){
            if(mark==''||mark==undefined||!mark) return false;
            if(mark=="comment"){
                $.getJSON('?m=comment&c=index&a=ajax_comment', {
                    spu_id : goods.spu_id,
                    page : page.comment,
                    limit : 5,
                }, function(ret) {
                    if(ret.lists && ret.lists!=undefined) {
                        $.each(ret.lists,function(i,item){
                            //item.imgs图片名称
                            var reply_content = ''
                            if(this.reply_content){
                                reply_content = '<div class="admin-text">'
                                        +'		<p><span class="text-blue">商家回复：</span>'
                                        + 		this.reply_content
                                        +'		</p>'
                                        +'	 </div>'
                            }
                            var imgs_html = '';
                            if(item.imgs.length>0){
                                var imgs = '';
                                $.each(item.imgs, function() {
                                    imgs += '<span><img src="'+this+'"/></span>';
                                });
                                imgs_html += '<div class="comment-imgs mui-clearfix drag-box">'+imgs+'</div>';
                            }
                            var content = '<li data-id="'+this.id+'">'
                                    +'	<div class="full">'
                                    +'		<span class="head"><img src="'+this.avatar+'" /></span>'
                                    +'		<span>'+this.username+'</span>'
                                    +'	</div>'
                                    +'	<div class="user-text">'
                                    +'		<p>'+this.content+'</p>'
                                    +'	</div>'
                                    +	imgs_html
                                    +	reply_content
                                    +'	<p class="hd-h6 text-gray">'+this._datetime+'</p>'
                                    +'</li>';
                            $('#comment .comment-lists').append(content);
                        })
                    }
                    if(ret.lists&&ret.lists.length>=5){
                        page.comment++;
                    }else{
                        $("#"+mark).find(".more").html("没有更多了");
                        $("#"+mark).find(".more").data("mark","");
                    }
                });
            }
            if(mark=="consult"){
                $.getJSON('?m=goods&c=index&a=get_consult', {
                    spu_id : goods.spu_id,
                    page : page.consult,
                    limit : 5,
                }, function(ret) {
                    if(ret.lists && ret.lists!=undefined) {
                        $.each(ret.lists,function(i,item){
                            var reply_content = '';
                            if(this.reply_content){
                                reply_content ='	<div class="admin-text">'
                                        +'		<p><span class="text-blue">商家回复：</span>'+ this.reply_content +'</p>'
                                        +'	 	</div>'
                            }
                            var username = this.username ? this.username : '游客';
                            var content = '<li data-id="'+this.id+'">'
                                    +'	<div class="full">'
                                    +'		<span class="head"><img src="'+this.avatar+'" /></span>'
                                    +'		<span>'+username+'</span>'
                                    +'	</div>'
                                    +'	<div class="user-text">'
                                    +'		<p>'+this.question+'</p>'
                                    +'	</div>'
                                    + 	reply_content
                                    +'	<p class="hd-h6 text-gray">'+this._datetime+'</p>'
                                    +'</li>';
                            $('#consult .comment-lists').append(content);
                        })
                    }
                    if(ret.lists&&ret.lists.length>=5){
                        page.consult++;
                    }else{
                        $("#"+mark).find(".more").html("没有更多了");
                        $("#"+mark).find(".more").data("mark","");
                    }
                });
            }
        }

        loadLists("comment");
        loadLists("consult");

    });
    $(".number").numberSet();

    mui("#comment").on('tap','.comment-imgs span',function(){
        var imgs =  $(this).parent(".comment-imgs").find("img");
        var lists = '';
        var index = $(this).index();
        $.each(imgs, function() {
            lists += '<div class="mui-slider-item"><img src="'+$(this).attr("src")+'" /></div>'
        });
        $(".comment-slider").removeClass("hide").find(".mui-slider-group").html(lists);
        mui('.comment-slider').slider().gotoItem(index);
    });

    mui(".comment-slider").on('tap','.mui-slider-item',function(){
        $(".comment-slider").addClass("hide");
    });

</script>