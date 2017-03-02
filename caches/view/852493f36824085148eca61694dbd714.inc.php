<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
    <script type="text/javascript">
      	mui.init();
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
    var page = "<?php echo $_GET['page']?>";
var url = "<?php echo url('goods/index/get_lists')?>";
    function add_more(){	
    		var param = {
    			id : "<?php echo $_GET['id'];?>",
    			sort : "<?php echo $result['order'];?>",
    			limit : 10,
    			page : page,
    			map : map
};
pull_get_lists(param,url,'up');
    	}
    function refresh_page(){
    		var param = {
    			id : "<?php echo $_GET['id'];?>",
    			sort : "<?php echo $result['order'];?>",
    			limit : 10,
    			page : 1,
    			map : map
};
pull_get_lists(param,url,'down');
    }
function pull_get_lists(param,url,type){
$.get(url,param,function(ret){
    			if(ret.lists && ret.lists.length > 0){
    				var html = '';
    				$.each(ret.lists,function(i,item){
    					html += '<li class="goods-item-list">'
    +		'<a class="list-item" href="'+ item.url +'">'
+			'<div class="list-item-pic">'
+				'<img src="<?php echo SKIN_PATH;?>statics/images/loading.gif" class="lazy" data-original="'+ item.thumb +'" />'
+			'</div>'
+		'<div class="list-item-bottom">'
+		'<div class="list-item-title">'
+			'<span>'+ item.sku_name +'</span>'
+		'</div>'
+		'<div class="list-item-text">'
+			'<span class="price-org">￥'+item.prom_price+'</span>'
+		'</div>'
+		'</div>'
+		'</a>'
+	'</li>';
})
if(type == 'up'){
$('.custom-goods-row').append(html);
page = page*1 + 1;
mui('#refreshContainer').pullRefresh().endPullupToRefresh(false);
}else{
$('.custom-goods-row').html(html);
page = 2;
mui('#refreshContainer').pullRefresh().endPulldownToRefresh(false);
mui('#refreshContainer').pullRefresh().refresh(true);
}
$("img.lazy").lazyload({
    effect : "fadeIn"
});
    			}else{
    				if(page == 1){
    					var html = '<li class="user-list-none mui-text-center">'
+	'<img src="<?php echo SKIN_PATH;?>statics/images/bg_6.png" />'
+	'<p class="text-black hd-h4">暂无此类商品</p>'
+	'</li>';
$('.custom-goods-row').html(html);
    				}
if(type == 'up'){
mui('#refreshContainer').pullRefresh().endPullupToRefresh(true);
}else{
mui('#refreshContainer').pullRefresh().endPulldownToRefresh(true);
}
    			}
    		},'json')
}
/*mui("#test").on('tap', function() {
var href = this.getAttribute('href');
  //打开关于页面
  mui.openWindow({
    url: href, 
    id:'info'
  });
});*/
    </script>
    <script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>"></script>
    <div class="hd-grid filter-items bg-white">
<div class="hd-col-xs-e5">
<a href="<?php echo create_url('sort','comper,');?>" class="filter-item <?php if($result['sort'] == 'comper') { ?>current<?php } ?>">综合</a>
</div>
<div class="hd-col-xs-e5">
<a href="<?php echo create_url('sort','sale,');?>" class="filter-item <?php if($result['sort'] == 'sale') { ?>current<?php } ?>">销量</a>
</div>
<div class="hd-col-xs-e5">
<a href="<?php echo create_url('sort','shop_price,'.$result['_by']);?>" class="filter-item <?php if($result['sort'] == 'shop_price') { ?>current<?php } ?>">价格</a>
</div>
<div class="hd-col-xs-e5">
<a href="<?php echo create_url('sort','hits,');?>" class="filter-item <?php if($result['sort'] == 'hits') { ?>current<?php } ?>">人气</a>
</div>
<div class="hd-col-xs-e5 filter-more">
<span>筛选</span>
</div>
</div>
<div class="filter-wrap">
<div class="filter-box">
<div class="filter-hand bg-white mui-clearfix">
<a class="mui-pull-left text-gray filter-cancel">取消</a>
    <div class="mui-title">筛选</div>
    <?php $params = array('brand_id'=>$_GET['brand_id'],'price'=>$_GET['price'],'attr'=>$_GET['attr'],'sort'=>$_GET['sort']);
     foreach ($params as $key => $value) {
    	if($key == 'attr'){
    	foreach ($value as $k => $attr) {
    			$attr_params .= '&attr['.$k.']='.$attr;
    	}
    	}else{
    		if($value) $attr_params .= '&'.$key.'='.$value;
    	}
    }?>
    <span class="mui-pull-right filter-sure" data-params="<?php echo $attr_params?>">确认</span>
</div>
<ul class="mui-table-view">
<?php if(!empty($brands)) { ?>
<li class="mui-table-view-cell">
<span class="mui-navigate-right">
品牌
<select name="brand_id" class="mui-select">
                            <option value="-1" selected="select">全部</option>
                            <?php foreach ($brands AS $brand):?>
                            <option value="<?php echo $brand['id'];?>" <?php if($_GET[brand_id] == $brand[id]) { ?>selected="selected"<?php } ?>><?php echo $brand['name'];?></option>
                            <?php endforeach?>
                    	</select>
</span>
</li>
<?php } ?>
<?php if($grades) { ?>
<?php
$current = current($grades);
$end = end($grades);
?>
<li class="mui-table-view-cell">
<span class="mui-navigate-right">
价格
<select name="price" class="mui-select">
                            <option value="-1" selected="">全部</option>
                           <?php $max_price = $current[0] - 1;?>
                            <option value="<?php echo '0,'.$max_price?>" <?php if($_GET[price] == '0,'.$max_price) { ?>selected="selected"<?php } ?>><?php echo $max_price;?>以下</option>
                           <?php foreach ($grades AS $grade):?>
                           	<option value="<?php echo implode(',',$grade)?>" <?php if($_GET[price] == implode(',',$grade)) { ?>selected="selected"<?php } ?>><?php echo $grade[0].'-'.$grade[1]?></option>
                           <?php endforeach?>
                           <?php $min_price = $end[1] + 1;?>
                           <option value="<?php echo $min_price.',0'?>" <?php if($_GET[price] == $min_price.',0') { ?>selected="selected"<?php } ?>><?php echo $min_price;?>以上</option>
                    	</select>
</span>
</li>
<?php } ?>
<?php
	$taglib_goods_type = new taglib('goods','type');
	$data = $taglib_goods_type->lists(array('catid'=>$_GET[id]), array('limit'=>'20','cache'=>'97fc4d5ca6f1de52b84a71f247a6485b,3600'));
?><?php if(is_array($data)) foreach($data as $k => $r) { ?><?php if($r[search] == 1) { ?>
<li class="mui-table-view-cell">
<span class="mui-navigate-right">
<?php echo $r['name'];?>
<select name="attr[<?php echo $k;?>]" class="mui-select">
                            <option value="-1" <?php if(!$_GET[attr][$k]) { ?>selected="selected"<?php } ?>>全部</option>
                            <?php if(is_array($r[value])) foreach($r[value] as $v) { ?>                            <option value="<?php echo $v;?>" <?php if($_GET[attr][$k] == $v) { ?>selected="selected"<?php } ?>><?php echo $v;?></option>
                            <?php } ?>
                    	</select>
</span>
</li>
<?php } ?>
<?php } ?>

<?php
	$taglib_goods_type = new taglib('goods','type');
	$data = $taglib_goods_type->specs(array('catid'=>$_GET[id]), array('limit'=>'20','cache'=>'cab80832137833e431746b4f5028c511,3600'));
?><?php if(is_array($data)) foreach($data as $k => $r) { ?><li class="mui-table-view-cell">
<span class="mui-navigate-right">
<?php echo $r['name'];?>
<select name="attr[<?php echo $k;?>]" class="mui-select">
                            <option value="-1" <?php if(!$_GET[attr][$k]) { ?>selected="selected"<?php } ?>>全部</option>
                            <?php if(is_array($r[value])) foreach($r[value] as $v) { ?>                            <option value="<?php echo $v;?>" <?php if($_GET[attr][$k] == $v) { ?>selected="selected"<?php } ?>><?php echo $v;?></option>
                            <?php } ?>
                    	</select>
</span>
</li>
<?php } ?>

</ul>
</div>
</div>
<!--下拉刷新容器-->
<div id="refreshContainer" class="mui-content mui-scroll-wrapper">
  	<div class="mui-scroll has-scorll-top">
  		<!--数据列表-->
    <ul class="margin-top custom-goods-items custom-goods-row custom-list-goods border-top mui-clearfix"></ul>
  	</div>
</div>
<script>

$(function(){
add_more();
mui(".filter-items").on('tap','.filter-more',function(){
if($(".filter-wrap").hasClass("open")){
$(".filter-wrap").hide(0,function(){
$(".filter-wrap").removeClass("open");
});
}else{
$(".filter-wrap").show(0,function(){
$(".filter-wrap").addClass("open");
});
}
});

mui(".filter-hand").on('tap','.filter-cancel',function(){
$(this).parents(".filter-wrap").removeClass("open").hide();
});

mui(".filter-hand").on('tap','.filter-sure',function(){
var lists_rewrite = '<?php echo json_encode(config('goods#index#lists','rewrite'))?>';
var lists_rewrite = jQuery.parseJSON(lists_rewrite);
var attr_params = $(this).attr('data-params') ? $(this).attr('data-params') : '';
window.location.href = "<?php echo url('goods/index/lists',array('id'=>$_GET['id']));?>" + (lists_rewrite.show == 1 ?attr_params.replace('&','?') :attr_params);
//$(this).parents(".filter-wrap").removeClass("open").hide();
});

$('select').bind('change',function(){
var _this = $('.filter-sure');
var $_select = $(this);
var confirm_params = _this.attr('data-params') ? _this.attr('data-params') : '';
if(confirm_params.indexOf($(this).attr('name')) == -1 && $_select.val() != -1){
_this.attr('data-params',confirm_params + '&' + $_select.attr('name') + '=' + $_select.val());
}else{
var params_arr = confirm_params.split('&');
var new_params = '';
//遍历属性，找出重复选择的项
 	$.each(params_arr,function(i,item){
 		//找到相同name的属性时替换或销毁处理
 		if(item.indexOf($_select.attr('name')) != -1){
 			//如果选择的为全部，则将该属性置空
 			if($_select.val() == -1){
 			params_arr[i] = '';
 		}else{
 				params_arr[i] = '&' + $_select.attr('name') + '=' + $_select.val();
 		}
 		}else{
 			//没有找到的项原样输出
 			item ? params_arr[i] = '&' + item : '';
 		}
 		new_params += params_arr[i];
})
_this.attr('data-params',new_params);
}
})

})

</script>
</body>
</html>
