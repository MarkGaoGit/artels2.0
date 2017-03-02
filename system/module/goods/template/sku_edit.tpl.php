<?php include template('header','admin');?>
<script type="text/javascript" src="./statics/js/goods/goods_add.js" ></script>
<link type="text/css" rel="stylesheet" href="./statics/js/upload/uploader.css" />
<script type="text/javascript" src="./statics/js/upload/uploader.js"></script>
<div class="fixed-nav layout">
	<ul>
		<li class="first">酒店&艺术商品设置</li>
		<li class="spacer-gray"></li>
		<li><a class="current" href="javascript:;">基本信息</a></li>
		<li><a href="javascript:;">酒店&艺术商品价格</a></li>
		<li><a href="javascript:;">酒店&艺术商品图册</a></li>
		<li><a href="javascript:;">酒店&艺术商品详情</a></li>
	</ul>
	<div class="hr-gray"></div>
</div>
<div class="content padding-big have-fixed-nav">
	<form action="<?php echo url('sku_edit')?>" method="post" name="sku_edit">
		<div class="form-box margin-bottom goods-form sku-tab clearfix">
			<?php echo Form::input('text', 'sku_name', $info['sku_name'],'酒店 或 艺术商品名称：','酒店 或 艺术商品标题名称不能为空，最长不能超过200个字符',array('datatype'	=> '*','nullmsg'	=> '酒店&艺术商品名称不能为空')); ?>
			<input type="hidden" name="sku_id" value="<?php echo $info['sku_id']?>">
			<?php echo Form::input('text', 'warn_number', isset($info['warn_number']) ? $info['warn_number'] : 5,  '库存警告：', '库存警告',array('datatype'	=> 'n','errormsg' => '库存警告只能为数字')); ?>
			<?php echo Form::input('enabled','status', isset($info['status']) ? $info['status'] : '1','是否上架：','设置当前酒店是否上架，默认为是，如选择否，将不在前台显示',array('itemrows' => 2)); ?>
			<?php echo Form::input('enabled','show_in_lists', isset($info['show_in_lists']) ? $info['show_in_lists'] : '1','是否前台页面展示：','是否前台页面展示',array('itemrows' => 2)); ?>
			<?php echo Form::input('text', 'keyword', $info['keyword'] ? $info['keyword'] : '', 'WIFI状态：', '是否有WIFI覆盖'); ?>
			<?php echo Form::input('textarea','description', $info['description'] ? $info['description'] : '', '酒店地址：','酒店详细地址 精确到号即可，例：山东省海阳市海滨西路9号'); ?>

			<?php echo Form::input('text', 'subtitle', $info['subtitle'], '城市代码 或 艺术标题：', '酒店城市地址代码 大写 <br/>若是艺术品则填写为标题，例：没有电源，谈何网络？',array('color' => $info['style'] ? $info['style'] : '', 'key' => 'style')); ?>
			<?php echo Form::input('text', 'ysp_descript01', $info['ysp_descript01'], '艺术品描述01：', '艺术品第一段简短的描述<br/>若添加的为酒店 请滞空',array('color' => $info['style01'] ? $info['style01'] : '', 'key' => 'style01')); ?>
			<?php echo Form::input('text', 'ysp_descript02', $info['ysp_descript02'], '艺术品描述02：', '艺术品第二段简短的描述<br/>若添加的为酒店 请滞空',array('color' => $info['style02'] ? $info['style02'] : '', 'key' => 'style02')); ?>


			<?php echo Form::input('radio','web_style', isset($info['web_style']) ? $info['web_style'] : '0','前台显示样板：','
				<img src=" template/default/statics/images/web01.jpg" width="170" >&nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web02.jpg" width="170" >&nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web03.jpg" width="170" > &nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web04.jpg" width="170" >',array('items' => array('1'=>1,'2'=>2,'3'=>3,'4'=>4), 'colspan' => 4,)); ?>


			<?php echo Form::input('radio','is_index', isset($info['is_index']) ? $info['is_index'] : '0','首页是否显示：','是否在首页显示此作品 默认否',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_hotel', isset($info['is_hotel']) ? $info['is_hotel'] : '0','是否是酒店：','是否是酒店 默认否 若不是酒店则是艺术商品',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_open', isset($info['is_open']) ? $info['is_open'] : '1','酒店是否营业：','酒店是否营业 默认是',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_derivative', isset($info['is_derivative']) ? $info['is_derivative'] : '0','是否是衍生品：','是否是衍生品 默认否',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('text', 'hotel_name', $info['hotel_name'] ? $info['hotel_name'] : '', '艺术品 或 衍生品所在酒店：', '艺术品&衍生品所在酒店的名称'); ?>
			<?php echo Form::input('text', 'room_num', $info['room_num'] ? $info['room_num'] : '', '艺术品 或 衍生品所在区域：', '艺术品&衍生品所在酒店的区域 若是房间请填写房间号'); ?>
			<?php echo Form::input('textarea','hotel_descript', $info['hotel_descript'] ? $info['hotel_descript'] : '', '酒店简介：','酒店简单介绍最多300字 默认为空<br/>若添加的是艺术品 请滞空'); ?>
			<?php echo Form::input('textarea','hotel_class_content', $info['hotel_class_content'] ? $info['hotel_class_content'] : '', '酒店类介绍：','酒店类介绍默认为空输入'.htmlspecialchars('<br/>').'换行'); ?>

		</div>
		<div class="form-box margin-bottom sku-tab hidden clearfix">
			<?php echo Form::input('text', 'shop_price', $info['shop_price'],'销售价格：','酒店标题名称不能为空，最长不能超过200个字符',array('datatype'	=> 'price','nullmsg'	=> '价格格式错误')); ?>
			<?php echo Form::input('text', 'market_price', $info['market_price'],'市场价格：','酒店标题名称不能为空，最长不能超过200个字符',array('datatype'	=> 'price','nullmsg'	=> '价格格式错误')); ?>
			<?php echo Form::input('text', 'number', $info['number'],'酒店库存：','酒店标题名称不能为空，最长不能超过200个字符',array('datatype'	=> 'n','nullmsg'	=> '库存必须为数字')); ?>
			<?php echo Form::input('radio', 'status_ext', $info['status_ext'] ? $info['status_ext'] : 0, '促销状态：', '表单描述', array('items' => array('取消', '促销', '热卖','新品','推荐'), 'colspan' => 3)); ?>
		</div>
		<div class="padding sku-tab hidden">
			<div class="upload-pic-wrap border bg-white">
				<div class="title border-bottom bg-gray-white text-default">
					<b>酒店图片</b>
				</div>
				<div class="upload-pic-content clearfix">
					<?php if(!empty($info['img_list'])){?>
						<?php foreach ($info['img_list'] AS $url) {?>
							<div class="box">
								<img src="<?php echo $url?>" />
								<div class="operate">
									<i>×</i>
									<a href="javascript:;">默认主图</a>
									<input type="hidden" name="images[]" value="<?php echo $url?>"/>
								</div>
							</div>
						<?php }?>
					<?php }?>
					<div class="loadpic" >
						<label class="load-button" id="upload"></label>
					</div>
				</div>
			</div>
		</div>
		<div class="padding sku-tab hidden">
			<?php echo Form::editor('content', $info['content'], '', '', array('mid' => $this->admin['id'], 'path' => 'goods')); ?>
		</div>
		<div class="padding">
			<input type="submit" id="release" class="button bg-main" value="提交" />
			<a href="<?php echo url('index')?>"><input type="button" class="button margin-left bg-gray" data-reset="false" value="返回" /></a>
		</div>
	</form>
</div>
<script type="text/javascript" src="./statics/js/haidao.validate.js?v=5.3.2" ></script>
<script>
	$(function(){
		var sku_edit = $("[name=sku_edit]").Validform({
			ajaxPost:false,
		});
	})
	$(".box").live('mouseover',function(){
		$(this).children('.operate').show();
	}).live('mouseout',function(){
		$(this).children('.operate').hide();
	});

	$('.operate a').live('click',function(){
		if($(this).parents(".upload-pic-content").find('.box').length > 1 && !$(this).parents(".box").hasClass("set")){
			$(this).parents(".upload-pic-content").find('.box:first').before($(this).parents(".box"));
		}
		$(this).parents(".box").addClass('set').siblings().removeClass('set');
	});

	$('.operate i').live('click',function(){
		$(this).parents('.box').remove();
	});
	/*上传图片*/
	var uploader = WebUploader.create({
		auto:true,
		fileVal:'upfile',
		// swf文件路径
		swf: './statics/js/upload/uploader.swf',
		// 文件接收服务端。
		server: "<?php echo url('upload')?>",
		// 选择文件的按钮。可选
		formData:{
			code : '<?php echo $attachment_init; ?>'
		},
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: {
			id: '#upload',
		},
		accept:{
			title: '图片文件',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		},
		thumb:{
			width: '110',
			height: '110'
		},
		chunked: false,
		chunkSize:1000000,
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false
	});
	uploader.onUploadSuccess = function( file, response ) {
		$('#'+file.id).find('.loading').hide();
		var pickid = this.options.pick.id;
		var obj = eval("(" + response._raw + ")")
		var result = obj.result;
		if(result.url.length > 0) {
			var html =  '<img src="'+ result.url +'" />'
				+		'<div class="operate">'
				+		'<i>×</i>'
				+		'<a href="javascript:;">默认主图</a>'
				+		'</div>'
				+		'<input type="hidden" name="images[]" value="'+ result.url +'"/>';
			$('#'+file.id).append(html);
		}
	}
	uploader.onUploadError = function(file, reason) {
		alert(reason);
	}
	uploader.onError = function( code ) {
		alert( '图片已在列表，请勿重复上传！');
	};
	uploader.onUploadProgress = function(file, percentage) {

	};
	uploader.onFileQueued = function(file) {
		var pickid = this.options.pick.id;
		var html = 		'<div class="box" id="' + file.id + '">'
			+		'<div class="loading">'
			+		'<em>上传中...</em>'
			+		'<span></span>'
			+		'</div>';
		+		'</div>';
		$(pickid).parent().before(html);
	};

	$(".fixed-nav li a").click(function(){
		$(".fixed-nav li a").removeClass("current");
		$(this).addClass("current");
		console.log($(this).index("a"))
		$(".sku-tab").eq($(this).index("a")).removeClass("hidden").siblings(".sku-tab").addClass("hidden");
	})
</script>
</body>
</html>
