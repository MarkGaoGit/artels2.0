<?php include template('header','admin');?>
<script type="text/javascript" src="./statics/js/goods/goods_add.js" ></script>
<div class="fixed-nav layout">
	<ul>
		<li class="first">设置</li>
		<li class="spacer-gray"></li>
		<li class="goods-step">1.填写基本信息</li>
		<li>&nbsp;&nbsp;&nbsp;→&nbsp;&nbsp;&nbsp;</li>
		<li>2.设置规格</li>
		<li>&nbsp;&nbsp;&nbsp;→&nbsp;&nbsp;&nbsp;</li>
		<li>3.上传图册</li>
		<li>&nbsp;&nbsp;&nbsp;→&nbsp;&nbsp;&nbsp;</li>
		<li>4.编辑类型</li>
		<li>&nbsp;&nbsp;&nbsp;→&nbsp;&nbsp;&nbsp;</li>
		<li>5.完善详情</li>
	</ul>
	<div class="hr-gray"></div>
</div>
<div class="content padding-big have-fixed-nav">
	<form action="<?php echo url('goods_add',array('id' => $_GET['id']))?>" method="post" name="release_goods">
		<div class="padding-lr">
			<div class="form-group">
				<span class="label">酒店 或 艺术商品分类：</span>
				<div class="box ">
					<input class="goods-class-text input hd-input input-readonly" id="choosecat" name="catname" value="<?php echo $info['catname']?>" tabindex="0"  nullmsg="请选择酒店 或 艺术商品分类" datatype="*" readonly="readonly" type="text" placeholder="请选择酒店 或 艺术商品分类" data-reset="false" />
					<input class="goods-class-btn" type="button" value="选择" onclick="setClass()" data-reset="false" />
					<input type="hidden" name="catid" value="<?php echo $info['catid']?>">
					<input type="hidden" name="cat_format" value="<?php echo $info['cat_format']?>">
				</div>
				<p class="desc">选择酒店 或 艺术商品所属分类，一个酒店&艺术商品只能属于一个分类</p>
			</div>
		</div>
		<div class="form-box goods-form">
			<?php echo Form::input('text', 'name', $info['name'],'酒店 或 艺术商品名称：','酒店 或 艺术商品名称不能为空，最长不能超过200个字符',array('datatype'	=> '*','nullmsg'	=> '酒店&艺术商品名称不能为空')); ?>
			<input type="hidden" name="id" value="<?php echo $info['id']?>">
			<div class="form-group" style="z-index: 2;">
				<span class="label">艺术家选择：</span>
				<div class="box" style="width: 256px;">
					<div class="form-select-edit select-search-text-box">
						<div class="form-buttonedit-popup">
							<input class="input" type="text" value="<?php echo $info['brandname']?>" readonly="readonly" data-reset="false">
							<span class="ico_buttonedit"></span>
							<input type="hidden" name="brand_id" value="<?php echo $info['brand_id']?>" data-reset="false">
						</div>
						<div class="select-search-field border border-main">
							<input class="input border-none" autocomplete="off" type="text" id="brandname" value="" placeholder="请输入品牌名称" data-reset="false" />
							<i class="ico_search"></i>
						</div>
						<div class="listbox-items brand-list">
							<?php foreach ($info['extra'] AS $brand) {?>
								<span class="listbox-item" data-val="<?php echo $brand['id']?>"><?php echo $brand['name']?></span>
							<?php }?>
						</div>
					</div>
				</div>
				<p class="desc">选择艺术家 仅限于艺术品使用</p>
			</div>
			<?php echo Form::input('text', 'warn_number', isset($info['warn_number']) ? $info['warn_number'] : 5,  '库存警告：', '库存警告',array('datatype'	=> 'n','errormsg' => '库存警告只能为数字')); ?>
			<?php echo Form::input('enabled','status', isset($info['status']) ? $info['status'] : '1','是否上架预：','设置当前酒店是否上架，默认为是，如选择否，将不在前台显示',array('itemrows' => 2)); ?>
			<?php echo Form::input('text', 'sort', isset($info['sort']) ? $info['sort'] : 100, '位置排序：','请填写自然数，酒店列表将会根据排序进行由小到大排列显示',array('datatype'	=> 'n','errormsg' => '排序只能为数字')); ?>
			<?php echo Form::input('text', 'keyword', $info['keyword'], 'WIFI状态：', '是否有WIFI覆盖'); ?>
			<?php echo Form::input('textarea','description', $info['description'], '酒店地址','酒店详细地址 精确到号即可，例：山东省海阳市海滨西路9号'); ?>


			<?php echo Form::input('text', 'subtitle', $info['subtitle'], '城市代码 或 艺术标题：', '酒店城市地址代码 大写 <br/>若是艺术品则填写为标题，例：没有电源，谈何网络？',array('color' => $info['style'] ? $info['style'] : '', 'key' => 'style')); ?>
			<?php echo Form::input('text', 'ysp_descript01', $info['ysp_descript01'], '艺术品描述01：', '艺术品第一段简短的描述<br/>若添加的为酒店 请滞空',array('color' => $info['style01'] ? $info['style01'] : '', 'key' => 'style01')); ?>
			<?php echo Form::input('text', 'ysp_descript02', $info['ysp_descript02'], '艺术品描述02：', '艺术品第二段简短的描述<br/>若添加的为酒店 请滞空',array('color' => $info['style02'] ? $info['style02'] : '', 'key' => 'style02')); ?>


			<?php echo Form::input('radio','web_style', isset($info['web_style']) ? $info['web_style'] : '0','前台显示样板：',
				'<img src=" template/default/statics/images/web01.jpg" width="170" >&nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web02.jpg" width="170" >&nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web03.jpg" width="170" > &nbsp;&nbsp;&nbsp;&nbsp;
				<img src=" template/default/statics/images/web04.jpg" width="170" >',
				array('items' => array('1'=>1,'2'=>2,'3'=>3,'4'=>4), 'colspan' => 4,)); ?>



			<?php echo Form::input('radio','is_index', isset($info['is_index']) ? $info['is_index'] : '0','首页是否显示：','是否在首页显示此作品',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_hotel', isset($info['is_hotel']) ? $info['is_hotel'] : '0','是否是酒店：','是否是酒店 默认否 若不是酒店则是艺术商品',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_open', isset($info['is_open']) ? $info['is_open'] : '1','酒店是否营业：','酒店是否营业 默认是',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('radio','is_derivative', isset($info['is_derivative']) ? $info['is_derivative'] : '0','是否是衍生品：','是否是艺术衍生品 默认否 ',array('items' => array('1'=>'是','0'=> '否'), 'colspan' => 2,)); ?>
			<?php echo Form::input('text', 'hotel_name', $info['hotel_name'], '艺术品 或 衍生品所在房间：', '艺术品 或 衍生品所在酒店的名称'); ?>
			<?php echo Form::input('text', 'room_num', $info['room_num'], '艺术品 或 衍生品所在区域：', '艺术品 或 衍生品所在酒店的区域 若是房间请填写房间号'); ?>
			<div class="form-group" style="z-index: 2;">
				<span class="label">房间类型选择：</span>
				<div class="box" style="width: 256px;">
					<div class="form-select-edit select-search-text-boxx">
						<div class="form-buttonedit-popup">
							<input class="input" type="text" value="<?php echo $info['room_code']?>" readonly="readonly" data-reset="false">
							<span class="ico_buttonedit"></span>
							<input type="hidden" name="room_code" value="<?php echo $info['room_code']?>" data-reset="false">
						</div>
						<div class="listbox-items brand-list" style="top:26px;">
							<?php foreach ($rcode AS $k => $v) {?>
								<span class="listbox-itemd" data-val="<?php echo $rcode[$k]['code_des'].'-'.$rcode[$k]['code']?>"><?php echo $rcode[$k]['code_des'].'-'.$rcode[$k]['code']?></span>
							<?php }?>
						</div>
					</div>
				</div>
				<p class="desc">房间类型选择 仅限于艺术品 & 衍生品使用</p>
			</div>
			<?php echo Form::input('textarea','hotel_descript', $info['hotel_descript'], '酒店简介：','酒店简单介绍最多300字 默认为空<br/>若添加的是艺术品 请滞空'); ?>
			<?php echo Form::input('textarea','hotel_class_content', $info['hotel_class_content'], '酒店类介绍：','酒店类介绍默认为空输入'.htmlspecialchars('<br/>').'换行'); ?>
		</div>

		<div class="padding">
			<input type="submit" id="release" class="button bg-main" value="下一步" />
			<a href="<?php echo url('index')?>"><input type="button" class="button margin-left bg-gray" data-reset="false" value="返回" /></a>
		</div>
	</form>
</div>
<script type="text/javascript" src="./statics/js/haidao.validate.js?v=5.3.2" ></script>
<script>
	$('.form-group:last-child').addClass('last-group');
	$(function(){
		var release_goods = $("[name=release_goods]").Validform({
			ajaxPost:true,
			callback:function(result) {
				if(result.status == 1){
					var nexturl = "<?php echo url('goods_add',array('step' => 1,'id' => $_GET['id']))?>";
					window.location = nexturl;
				}else{
					alert(result.message);
				}
			}
		});
	})
	var url = "<?php echo url('goods_add',array('id'=>$_GET['id']))?>";
	setInterval("auto_save(url)",30000);
	//弹窗
	function setClass(){
		var url = "<?php echo url('category/category_popup')?>";
		var pid = $('input[name=catid]').val();
		var pname = $('#choosecat').val();
		var pvalue = $('input[name=cat_format]').val();
		var data = [pid,pname,pvalue];
		top.dialog({
			url: url,
			title: '加载中...',
			data: data,
			width: 930,
			onclose: function () {
				if(this.returnValue){
					var catname = this.returnValue.html().replace(/&gt;/g,'>');
					$('#choosecat').val(catname);
					var catids = this.returnValue.attr('data-id').split(',');
					var catid = catids[catids.length-1];
					$('input[name=cat_format]').val(this.returnValue.attr('data-id'));
					$('input[name=catid]').val(catid);
				}
			}
		})
			.showModal();
	}
	$('.select-search-field').click(function(e){
		e.stopPropagation();
	});
	//buttonedit-popup-hover
	$('.select-search-text-box .form-buttonedit-popup').click(function(){
		if(!$(this).hasClass('buttonedit-popup-hover')){
			$(this).parent().find('.select-search-field').show();
			$(this).parent().find('.select-search-field').children('.input').focus();
			$(this).parent().find('.listbox-items').show();
		}else{
			$(this).parent().find('.select-search-field').hide();
			$(this).parent().find('.listbox-items').hide();
		}
	});
	$('#brandname').live('keyup',function(){
		var url = "<?php echo url('ajax_brand')?>";
		var brandname = this.value;
		$.post(url,{brandname:brandname},function(data){
			$('.brand-list').children('.listbox-item').remove();
			if(data.status == 1){
				var html = '';
				$.each(data.result,function(i,item){
					html += '<span class="listbox-item" data-val="' + i + '">' + item + '</span>';
				})
				$('.brand-list').append(html);
			}else{
				var html = '<span class="listbox-item">未搜索到结果</span>';
				$('.brand-list').append(html);
			}
		},'json')
	})
	$(".select-search-text-box .listbox-items .listbox-item").live('click',function(){
		$(this).parent().prev('.select-search-field').children('.input').val();
		$(this).parent().prev('.select-search-field').hide();
		$('.select-search-text-box .form-buttonedit-popup .input').val($(this).html());
		$('input[name=brand_id]').val($(this).attr('data-val'));
	});

	$(".select-search-text-boxx .listbox-items .listbox-itemd").live('click',function(){
		$(this).parent().prev('.select-search-field').children('.input').val();
		$(this).parent().prev('.select-search-field').hide();
		$('.select-search-text-boxx .form-buttonedit-popup .input').val($(this).html());
		$('input[name=room_code]').val($(this).attr('data-val'));
	});

</script>
</body>
</html>
