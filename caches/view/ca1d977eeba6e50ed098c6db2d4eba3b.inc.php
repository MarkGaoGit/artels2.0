<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/region-selection.js?v=<?php echo HD_VERSION;?>"></script>
<div class="mui-content">
    <form name="ajax_district" action="<?php echo url('member/address/edit');?>" method="POST">
    	<div class="mui-input-group add-address">
        <div class="mui-input-row">
            <label>收货人</label>
            <input type="text" class="mui-input-clear" value="<?php echo $address['name'];?>"  placeholder="请输入收货人地址" name="name"/>
        </div>
        <div class="mui-input-row">
            <label>手机号码</label>
            <input type="text" class="mui-input-clear" value="<?php echo $address['mobile'];?>" placeholder="请输入手机号码" name="mobile"/>
        </div>
        <div class="mui-input-row">
            <label>邮政编码</label>
            <input type="number" class="mui-input-clear" value="<?php echo $address['zipcode'];?>" placeholder="请输入邮政编码" name="zipcode"/>
        </div>
        <div class="mui-input-row">
            <label>所在地区</label>
<input class="district-text-id" type="hidden" name="district_id" value="<?php echo $address['district_id'];?>">
            <span class="input district-text-show"><?php echo implode(" ",$address['full_district']);?></span>
        </div>
        <div class="mui-input-row">
            <label>详细地址</label>
            <input type="text" class="mui-input-clear" value="<?php echo $address['address'];?>" placeholder="请输入详细地址" name="address"/>
        </div>
    </div>
    	<div class="padding-lr margin-top">
<input type="hidden" name="id" value="<?php echo $address['id'];?>" />
<input type="hidden" name="default" value="<?php echo $address['isdefault'];?>" />
<button type="submit" class="mui-btn mui-btn-primary  full hd-h4">确认修改</button>
    		<button type="button" class="margin-top mui-btn mui-btn-primary full hd-h4 site-default">设为默认收货地址</button>
    		<button type="button" class="margin-top mui-btn mui-btn-danger full  hd-h4 delete">删除收货地址</button>
    	</div>
    </form>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
<script>
var _referer = '<?php echo urldecode($_GET["referer"]);?>';
var ajax_district=$("form[name=ajax_district]").Validform({
ajaxPost:true,
callback:function(ret){
if(ret.status == 1){
$.tips({content:ret.message});
var url = _referer || ret.referer;
window.location.href = url;
}else{
$.tips({content:ret.message});
}
}
});

$.regionSelect({
url: "<?php echo url('ajax_district');?>",
id: "<?php echo $address['district_id'];?>",
autor: $(".district-text-show"),
callback: function(id,name){
$(".district-text-id").val(id[id.length-1]);
var html = '';
$.each(name, function() {
html += this + " ";
});
$(".district-text-show").html(html)
}
});

$(".delete").bind('click',function(){
if(confirm('确定删除该地址')){
var isdefault = '<?php echo $address['isdefault']?>';
if(isdefault == 1){
$.tips({content:'默认地址不能删除'});
return false;
}
var ajaxurl = '<?php echo url('delete')?>';
var id = '<?php echo $_GET['id']?>';
$.post(ajaxurl,{id:id},function(ret){
if(ret.status == 1){
$.tips({content:ret.message});
window.location.href = ret.referer;
}else{
$.tips({content:ret.message});
}
},'json');
}
})
$(".site-default").on('tap',function(){
$("input[name=default]").val(1);
$.tips({content:'设置默认地址成功'});
});
</script>
