<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'goods'); ?>
<body>
<?php include template('artels-menu-header', 'common'); ?>
<script>
    mui.init({
        pullRefresh: {
            container: '#refreshContainer', //待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
            up: {
                contentrefresh: "正在加载...", //可选，正在加载状态时，上拉加载控件上显示的标题内容
                contentnomore: '没有更多艺术家了', //可选，请求完毕若没有更多数据时显示的提醒内容；
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
    var url = "<?php echo url('goods/index/ajaxWorks')?>";
    function add_more(){
        var param = {
            limit : 6,
            page : page,
            is_ajax : true,
            map : map
        };
        pull_get_lists(param,url,'up');
    }
    function refresh_page(){
        var param = {
            limit : 6,
            page : 1,
            is_ajax : true,
            map : map
        };
        pull_get_lists(param,url,'down');
    }
    function pull_get_lists(param,url,type){
        $.get(url,param,function(ret){
            if(ret){
                var _html = '';
                $.each(ret,function(i,item){
                    _html += '<li class="mui-table-view-cell mui-media text-center w47 border">';
                    _html += '<a href="/index.php?m=goods&c=index&a=artist&id= ' + item.id + ' ">';
                    _html += '<img src="' + item.logomobile +'" class="artist-header" alt="">';
                    _html += '<p class="text-black hd-h4 margin-top-15 margin-small-bottom">' + item.name + '</p>';
                    _html += '<p class="text-black hd-h5">' + item.us_name + '</p>';
                    _html += '</a></li>';
                });
                if(type == 'up'){
                    $('.artist-lists').append(_html);
                    winloads();
                    page = page*1 + 1;
                    mui('#refreshContainer').pullRefresh().endPullupToRefresh(false);
                }else{
                    $('.artist-lists').html(_html);
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
    function winloads(){
        // 获取屏幕高度、 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
                li_h = client_h * 0.333333,
                li_20_h = client_h - 20;
        $('.nav').css({'min-height':li_20_h});
        $('.nav ul').css({'min-height':li_20_h});
        $('.mui-media').css({'min-height':li_h});
    }
    mui('body').on('tap','a',function(){document.location.href=this.href;});
</script>
<div class="artist">
    <div id="refreshContainer" class="mui-content mui-scroll-wrapper">
        <div class="mui-scroll has-scorll-top">
            <div class="nav">
                <ul class="mui-table-view mui-grid-view artist-lists">
                    <?php if(is_array($artist)) foreach($artist as $r) { ?>                        <li class="mui-table-view-cell mui-media text-center w47 border">
                            <a href="<?php echo url('goods/index/artist',array('id' => $r['id']));?>">
                                <img src="<?php echo $r['logomobile'];?>" class="artist-header" alt="">
                                <p class="text-black hd-h4 margin-top-15 margin-small-bottom"><?php echo $r['name'];?></p>
                                <p class="text-black hd-h5"><?php echo $r['us_name'];?></p>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>