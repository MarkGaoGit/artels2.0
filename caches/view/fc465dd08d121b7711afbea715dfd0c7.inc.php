<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<div class="mui-content">
    	<ul class="address-lists bg-white mui-clearfix" data-id="address_box">

    </ul>
    	<div class="padding-lr margin-top">
    		<a data-id="address_add" href="<?php echo url('member/address/add');?>" class="mui-btn mui-btn-primary full hd-h4">添加新收货地址</a>
    	</div>
</div>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/order.js?v=<?php echo HD_VERSION;?>"></script>
<script>
hd_order._address();

/* 添加新收货地址 */
$("[data-id='address_add']").on("tap" ,function() {
var key = localStorage.getItem('hdkey');
var _hddatas = $.parseJSON(localStorage.getItem('hddatas'));
window.location.href = '<?php echo url("member/address/add" ,array("referer" => urlencode($_SERVER["REQUEST_URI"])));?>';
})

/* 选择收货地址 */
$("[data-id='address']").on("tap" ,function(){
// 读取localStorage已有数据
hdkey = localStorage.getItem('hdkey');
_hddatas = JSON.parse(localStorage.getItem('hddatas'));
_hddatas[hdkey]._addressid_ = $(this).data('addressid');
_hddatas[hdkey]._district_ = $(this).data('district');
localStorage.setItem('hddatas',JSON.stringify(_hddatas));
// 重新获取收货地址的物流
var delivery_url = '<?php echo url("order/order/get_deliverys",array("skuids" => $_GET[skuids])) ?>';
hd_order._get_deliverys(delivery_url ,$(this).data('district'));
window.location.href = _hddatas[hdkey].referer;
});
</script>