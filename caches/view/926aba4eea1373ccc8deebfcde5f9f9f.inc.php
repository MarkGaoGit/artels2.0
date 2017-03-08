<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'goods'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    mui.init({
        pullRefresh: {
            container: '#refreshContainer', //待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
            up: {
                contentrefresh: "正在加载...", //可选，正在加载状态时，上拉加载控件上显示的标题内容
                contentnomore: '没有更多作品了', //可选，请求完毕若没有更多数据时显示的提醒内容；
                callback: add_more //必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
            },
            down : {
                contentdown : "下拉可以刷新",//可选，在下拉可刷新状态时，下拉刷新控件上显示的标题内容
                contentover : "释放立即刷新",//可选，在释放可刷新状态时，下拉刷新控件上显示的标题内容
                contentrefresh : "正在刷新...",//可选，正在刷新状态时，下拉刷新控件上显示的标题内容
                callback : refresh_page //必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
            }
        }
    });
    var map = jQuery.parseJSON('<?php echo json_encode($_GET);?>');
    var page = "<?php echo $_GET['page'] ?>";
    var url = "<?php echo url('goods/index/ajaxArtZp')?>";
    function add_more(){
        var param = {
            limit : 6,
            page : page,
            map : map
        };
        pull_get_lists(param,url,'up');
    }
    function refresh_page(){
        var param = {
            limit : 6,
            page : 1,
            map : map
        };
        pull_get_lists(param,url,'down');
    }
    function pull_get_lists(param,url,type){
        $.get(url,param,function(ret){
            if(ret){
                var _html = '';
                $.each(ret,function(i,item){
                    _html += '<li class="mui-table-view-cell mui-media text-center w47 border" style="padding:0;">';
                    _html += '<a href="/index.php?m=goods&c=index&a=worksDetail&sid=' + item.id + '">';
                    _html += '<img src="' + item.thumb + '" alt="" class="imgs" style="height:100%; width:100%;">';
                    _html += '</a></li>';
                });
                if(type == 'up'){
                    $('.works-lists').append(_html);
                    winloads();
                    page = page*1 + 1;
                    mui('#refreshContainer').pullRefresh().endPullupToRefresh(false);
                }else{
                    $('.works-lists').html(_html);
                    page = 2;
                    mui('#refreshContainer').pullRefresh().endPulldownToRefresh(false);
                    mui('#refreshContainer').pullRefresh().refresh(true);
                    winloads();
                }
            }else{
                if(type == 'up'){
                    mui('#refreshContainer').pullRefresh().endPullupToRefresh(true);
                    winloads();
                }else{
                    mui('#refreshContainer').pullRefresh().endPulldownToRefresh(true);
                    winloads();
                }
            }
        },'json')
    }

    window.onload = function(){
        winloads();
    }
    function winloads() {
        // 获取屏幕高度、 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
                li_h = client_h * 0.31;
        $('.nav ul li a ').css({'max-height':li_h});
        $('.nav .imgs ').css({'min-height':li_h});
    }
    mui('body').on('tap','a',function(){document.location.href=this.href;});
</script>
<div class="artist">

    <div id="refreshContainer" class="mui-content mui-scroll-wrapper">
        <div class="mui-scroll has-scorll-top" style=" :0;">
            <div class="nav">
                <div class="data-where-lists" style="position:absolute;top:44px;">
                    <dl>
                        <dd>排序方式：</dd>
                        <dd ><a class="<?php if($_GET['fileds'] == 'id') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'id','types'=>'myshu'));?>">综合</a></dd>
                        <dd ><a class="<?php if($_GET['fileds'] == 'max_price') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'max_price','types'=>'myshu'));?>">价格</a></dd>
                        <dd ><a class="<?php if($_GET['fileds'] == 'hits') { ?> text-f85738<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'hits','types'=>'myshu'));?>">人气</a></dd>
                    </dl>
                    <button class="text-main text-center title" id="m-search">查询</button>
                </div>
                <ul class="mui-table-view mui-grid-view works-lists">

                    <?php if(is_array($works)) foreach($works as $r) { ?>                    <li class="mui-table-view-cell mui-media text-center w47 border" style="padding:0;">
                        <a href="<?php echo url('goods/index/worksDetail',array('sid' => $r['id']));?>" >
                            <img src="<?php echo $r['thumb'];?>" alt="" class="imgs" style="height:100%; width:100%;">
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

</div>
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
                <form action="<?php echo url('goods/index/artzp',array('cid'=>$_GET['cid']));?>" method="post">
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
            <a class="show fl text-666" href="<?php echo url('goods/index/artzp',array('cid'=>$_GET['cid']));?>">重置</a>
            <input type="submit" class="search-ok fr " value="确定">
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php include template('artels-menu-footer', 'common'); ?>

<script>

    $('.search-ok').on('click',function(){
       var _url = window.location.href,
               _catid = $('.catid').val(),
               _prices = $('.price-order').val();
        _url += '&catid=' + _catid + '&prices=' + _prices;
        window.location.href = _url;

    });

    $('#m-search').on('click',function(){
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