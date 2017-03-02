<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/region-selection.js?v=<?php echo HD_VERSION;?>"></script>
<div class="mui-content">
    <form name="ajax_district" action="<?php echo url('member/address/add');?>" method="POST">
    	<div class="mui-input-group add-address">
        <div class="mui-input-row">
            <label>收货人</label>
            <input type="text" class="mui-input-clear" value=""  placeholder="请输入收货人地址" name="name"/>
        </div>
        <div class="mui-input-row">
            <label>手机号码</label>
            <input type="text" class="mui-input-clear" value="" placeholder="请输入手机号码" name="mobile"/>
        </div>
        <div class="mui-input-row">
            <label>邮政编码</label>
            <input type="number" class="mui-input-clear" value="" placeholder="请输入邮政编码" name="zipcode"/>
        </div>

        <div class="mui-input-row">
            <label>省</label>
<select name="province"  id='prov' data-type="1">
<option value="">选择所在省份</option><?php if(is_array($province)) foreach($province as $r) { ?><option value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
<?php } ?>
</select>
        </div>
<div class="mui-input-row">
<label>市</label>
<select name="city" id='city'></select>
</div>
<div class="mui-input-row">
<label>区</label>
<select name="area" id='area'></select>
</div>
<div class="mui-input-row">
<label>乡镇</label>
<input class="district-text-id" type="hidden" name="district_id" value="" >
<select name="area" id='areas'></select>
</div>
        <div class="mui-input-row">
            <label>详细地址</label>
            <input type="text" class="mui-input-clear gd-areas" value="" placeholder="请输入详细地址" name="address"/>
        </div>
    </div>
    	<div class="padding-lr margin-top">
    		<button type="submit" class="mui-btn mui-btn-primary full hd-h4">确认添加收货地址</button>
    	</div>
    </form>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
<script>
$('#prov,#city,#area,#areas').change(function(){
var upid = $(this).val();
var $_this = $(this);
if($_this['context']['id'] == 'prov' ){
$('#city').children('option').remove();
$('#area').children('option').remove();
$('#areas').children('option').remove();
}else if($_this['context']['id'] == 'city'  ){
$('#area').children('option').remove();
$('#areas').children('option').remove();
}else if($_this['context']['id'] == 'area' ){
$('#areas').children('option').remove();
}
if(  upid == '110100' || upid == '120100' || upid =='310100' || upid =='500100'){
$('#city').children('option').remove();
$('#city').hide();
}
var sdrt = $("#areas").find("option:selected").val();
$('.district-text-id').val(sdrt);
$.ajax({
url:"/index.php?m=member&c=address&a=three_district",
data:{id:upid},
type:'post',
success:function(data){
if(!data){
return;
}$('#city').show();
for(var i = 0; i < data.length; i++){
switch(data[i]['level']){
case '2':
$('#city').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
break;
case '3':
$('#area').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
break;
case '4':
$('#areas').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
break;
}
}

switch ( $_this['context']['id'] ){
case 'prov':
$('#city').trigger('change');
break;
case 'city':
$('#area').trigger('change');
break;
case 'area':
$('#areas').trigger('change');
break;
}

},
error:function(){},
dataType:'json',
});
});

$('#prov').trigger('change');

$('.gd-areas').on('blur',function(){
var ids = $('.district-text-id').val();
if(!ids){
var $id = $('#areas').children('option :first').val();
$('.district-text-id').val($id);
}
})





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
</script>
