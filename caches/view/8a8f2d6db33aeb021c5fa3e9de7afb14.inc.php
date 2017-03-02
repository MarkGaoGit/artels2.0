<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<style>
.mui-bar-nav~.mui-content .mui-pull-top-pocket { top:76px;}
</style>
<script type="text/javascript">
      	//mui.init();
mui.init({
        pullRefresh: {
            container: '#refreshContainer', //待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
            up: {
                contentrefresh: "正在加载...", //可选，正在加载状态时，上拉加载控件上显示的标题内容
                contentnomore: '没有更多数据了', //可选，请求完毕若没有更多数据时显示的提醒内容；
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
var url = "<?php echo url('member/order/get_orders')?>";
    function add_more(){
    	if($(".user-list-none").length>0) return false;
    		var param = {
    			id : "<?php echo $_GET['id'];?>",
    			sort : "<?php echo $result['order'];?>",
    			limit : 5,
    			page : page,
    			map : map
};
pull_get_lists(param,url,'up');
    	}
    
    function refresh_page(){
    	var param = {
    			id : "<?php echo $_GET['id'];?>",
    			sort : "<?php echo $result['order'];?>",
    			limit : 5,
    			page : 1,
    			map : map
};
pull_get_lists(param,url,'down');
    }
function pull_get_lists(param,url,type){
$.get(url,param,function(ret){
    			if(ret.orders && ret.orders.length > 0){
    				var _html = '';
    				var link = "<?php echo url('goods/index/detail')?>";
    				$.each(ret.orders,function(i,item){
    					_html += '<li class="order-list list-col-10">';
_html += '<div class="order-stuats padding-tb strong list-item">';
_html += '	<span>订单号：'+ item.sn +'</span>';
_html += '	<span class="mui-pull-right text-org">';
if (item._showsubs == 'true') {
_html += '已拆分';
} else {
_html += item._status.wait_ch;
}
_html += '	</span>';
_html += '</div>';

if (item._showsubs == 'true') {
_html += '	<div class="padding-small-top padding-small-bottom list-item">';
_html += '		<span>商品属不同商家或在不同库房，故拆分物流配送。</span>';
_html += '	</div>';								
} else {
var _length = 0;
$.each(item._subs[0]._group ,function(i, el) {
_length++;
});								
if (_length > 1) {
    _html += '    	<div class="padding-small-top padding-small-bottom list-item">';
    _html += '    		<span>商品在不同库房，故拆分物流配送。</span>';
    _html += '    	</div>';

}
}
_html += '<!-- 循环子订单 -->';
$.each(item._subs ,function(i, sub) {
_html += '	<div class="padding-tb mui-text-right list-item">';
_html += '		<!-- <span class="margin-big-right">共 8 件商品</span> -->';
$.each(sub._skus, function(j,val){
_html += ' 		<a href="/index.php?m=goods&c=index&a=worksDetail&sid=' + val.spu_id +'"><span class="margin-big-right fl hd-h5 text-black">' + val.sku_name + '</span></a>'
});
_html += '		<span>订单总额：<b class="text-org">￥'+ item.real_amount +'</b></span>';
_html += '	</div>';
$.each(sub._group ,function(o_d_id, v) {
_html += '		<div class="order-pic padding-top list-item mui-clearfix">';
$.each(v.lists ,function(index, sku) {
if (o_d_id > 0) {
_html += '				<a href="?m=member&c=order&a=detail&sub_sn='+ sub.sub_sn +'&o_d_id='+ o_d_id +'" class="img-full" data-skuid="'+sku.sku_id+'" data-nums="'+ sku.buy_nums +'">';
} else {
_html += '				<a href="?m=member&c=order&a=detail&sub_sn='+ sub.sub_sn +'" class="img-full" data-skuid="'+sku.sku_id+'" data-nums="'+ sku.buy_nums +'">';
}
_html += '					<img src="'+ sku.sku_thumb +'" onerror="javascript:this.src=./statics/images/default_no_upload.png"/>';
_html += '				</a>';
});
_html += '		</div>';
_html += '		<div class="order-hand padding-tb mui-text-right list-item" data-sub_sn="'+ sub.sub_sn +'">';
if (o_d_id > 0) {
_html += '				<a href="?m=member&c=order&a=detail&sub_sn='+ sub.sub_sn +'&o_d_id='+ o_d_id +'" class="mui-btn hd-btn-gray">查看订单</a>';
_html += '				<a href="?m=member&c=order&a=delivery&o_d_id='+ o_d_id +'" class="mui-btn hd-btn-gray">查看物流</a>';
} else {
_html += '        		<a href="?m=member&c=order&a=detail&sub_sn='+ sub.sub_sn +'" class="mui-btn hd-btn-gray">查看订单</a>';
}
if (item.status == 1 && item.pay_type ==1 && item.pay_status == 0) {
    		_html += '            	<a href="?m=order&c=order&a=detail&order_sn='+ item.sn +'" class="mui-btn hd-btn-gray">支付订单</a>';
}

if (sub.status == 1 && sub.confirm_status!=2) {
    		_html += '            	<a data-action="cancel" href="javascript:;" class="mui-btn hd-btn-blue">取消订单</a>';
}

if (sub.finish_status == 2 || item.status != 1) {
    		_html += '            	<a data-action="again" href="javascript:;" class="mui-btn hd-btn-gray">再次购买</a>';
}
if (sub.status==1 && o_d_id > 0 && v.delivery.isreceive == 0) {
   			_html += '            	<a data-action="finish" href="javascript:;" o-d-id="'+ o_d_id +'" class="mui-btn hd-btn-blue">确认收货</a>';
}

_html += '		</div>';
});
});

_html += '</li>';
});
if(type == 'up'){
$('.order-lists').append(_html);
page = page*1 + 1;
mui('#refreshContainer').pullRefresh().endPullupToRefresh(false);
}else{
$('.order-lists').html(_html);
page = 2;
mui('#refreshContainer').pullRefresh().endPulldownToRefresh(false);
mui('#refreshContainer').pullRefresh().refresh(true);
}
    			}else{
if(type == 'up'){
mui('#refreshContainer').pullRefresh().endPullupToRefresh(true);
}else{
mui('#refreshContainer').pullRefresh().endPulldownToRefresh(true);
}
    			}
    		},'json')
}
    </script>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/member.order.js"></script>
<div class="hd-grid filter-items bg-white text-main">
<div class="hd-col-xs-e5 w25">
<a href="<?php echo url('member/order/index');?>" class="filter-item <?php if(!isset($_GET[type])) { ?>current<?php } ?>">全部</a>
</div>
<div class="hd-col-xs-e5 w25">
<a href="<?php echo url('member/order/index',array('type'=>1));?>" class="filter-item <?php if(($_GET[type] == 1)) { ?>current<?php } ?>">待付款</a>
</div>
<div class="hd-col-xs-e5 w25">
<a href="<?php echo url('member/order/index',array('type'=>3));?>" class="filter-item <?php if(($_GET[type] == 3)) { ?>current<?php } ?>">待发货</a>
</div>
<div class="hd-col-xs-e5 w25">
<a href="<?php echo url('member/order/index',array('type'=>4));?>" class="filter-item <?php if(($_GET[type] == 4)) { ?>current<?php } ?>">待收货</a>
</div>
</div>
<div id="refreshContainer" class="mui-content mui-scroll-wrapper">
  	<div class="mui-scroll has-scorll-top">
<ul class="order-lists mui-clearfix" style="margin-top: 32px;"><?php if(is_array($orders)) foreach($orders as $r) { ?><li class="order-list list-col-10">
<div class="order-stuats padding-tb strong list-item">
<span>订单号：<?php echo $r['sn'];?></span>
<span class="mui-pull-right text-org"><?php if(($r[_showsubs] == TRUE)) { ?>已拆分<?php } else { ?><?php echo ch_status($r[_status][wait]);?><?php } ?></span>
</div>
<!-- 循环子订单 --><?php if(is_array($r['_subs'])) foreach($r['_subs'] as $sub) { ?><div class="padding-tb mui-text-right list-item"><?php if(is_array($sub['_skus'])) foreach($sub['_skus'] as $sku) { ?><a href="<?php echo url('goods/index/worksDetail',array('sid' => $sku['spu_id']));?>"><span class="margin-big-right fl hd-h5 text-black"><?php echo $sku['sku_name'];?></span></a>
<?php } ?>
<span>订单总额：<b class="text-org">￥<?php echo $r['real_amount'];?></b></span>
</div><?php if(is_array($sub[_group])) foreach($sub[_group] as $o_d_id => $v) { ?><div class="order-pic padding-top list-item mui-clearfix"><?php if(is_array($v[lists])) foreach($v[lists] as $sku) { ?><?php if(($o_d_id > 0)) { ?>
<a href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn],'o_d_id' =>$o_d_id));?>" class="img-full" data-skuid="<?php echo $sku['sku_id'];?>" data-nums="<?php echo $sku['buy_nums'];?>">
<?php } else { ?>
<a href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn]));?>" class="img-full" data-skuid="<?php echo $sku['sku_id'];?>" data-nums="<?php echo $sku['buy_nums'];?>">
<?php } ?>
<img src="<?php echo $sku['sku_thumb'];?>" onerror="javascript:this.src='./statics/images/default_no_upload.png';"/>
</a>
<?php } ?>
</div>
<div class="order-hand padding-tb mui-text-right list-item" data-sub_sn="<?php echo $sub['sub_sn'];?>">
<?php if(($o_d_id > 0)) { ?>
<a href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn],'o_d_id' =>$o_d_id));?>" class="mui-btn hd-btn-gray">查看订单</a>
<a href="<?php echo url('member/order/delivery',array('o_d_id' =>$o_d_id));?>" class="mui-btn hd-btn-gray">查看物流</a>
        	<?php } else { ?>
        		<a href="<?php echo url('member/order/detail',array('sub_sn' =>$sub[sub_sn]));?>" class="mui-btn hd-btn-gray">查看订单</a>
        	<?php } ?>
<?php if(($r[status] == 1 && $r[pay_type] == 1 && $r[pay_status] == 0)) { ?>
                	<a href="<?php echo url('order/order/detail',array('order_sn'=>$r[sn]));?>" class="mui-btn hd-btn-gray">支付订单</a>
                <?php } ?>
                <?php if(($sub[status] == 1 && $sub[confirm_status]!=2)) { ?>
                	<a data-action="cancel" href="javascript:;" class="mui-btn hd-btn-blue">取消订单</a>
                <?php } ?>
                <?php if(($sub[finish_status] == 2 || $r[status] != 1)) { ?>
                	<a data-action="again" href="javascript:;" class="mui-btn hd-btn-gray">再次购买</a>
                <?php } ?>
                <?php if(($sub['status']==1 && $o_d_id > 0 && $v['delivery']['isreceive'] == 0)) { ?>
                	<a data-action="finish" href="javascript:;" o-d-id="<?php echo $o_d_id;?>" class="mui-btn hd-btn-blue">确认收货</a>
                <?php } ?>
</div>
<?php } ?>
<?php } ?>
</li>
<?php } ?>
<!-- 无订单时 -->
<?php if((!$orders)) { ?>
<li class="user-list-none mui-text-center">
<img src="<?php echo SKIN_PATH;?>statics/images/bg_3.png" />
<p class="margin-top text-black hd-h5">您还没有相关的订单</p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php include template('artels-menu-footer', 'common'); ?>

</body>
</html>