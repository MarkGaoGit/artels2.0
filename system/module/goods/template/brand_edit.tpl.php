<?php include template('header','admin');?>
	<body>
		<div class="fixed-nav layout">
			<ul>
				<li class="first">商品品牌设置</li>
				<li class="spacer-gray"></li>
			</ul>
			<div class="hr-gray"></div>
		</div>
		
		<div class="content padding-big have-fixed-nav">
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-box clearfix" id="form">
				<?php echo Form::input('text', 'name', $info['name'], '作家姓名：', '请填写姓名。',array('validate' => 'required')); ?>
				<?php echo Form::input('text', 'us_name', $info['us_name'], '英文名：', '请填写艺术家 英文名 例：MR. TONG ZHANGFA'); ?>
				<?php echo Form::input('textarea','descript', $info['descript'], '艺术家描述：', '请填写艺术家的描述信息。'); ?>
				<?php echo Form::input('file','logo', $info['logo'], 'Logo：','请上传LOGO或艺术家头像，用于前台展示。',array('preview'=>$info['logo'])); ?>
				<?php echo Form::input('file','logomobile', $info['logomobile'], 'LogoMobile：','请上传LOGO或艺术家头像，用于手机展示。 <b style="color:red; font-size:15px;">正方形必须！</b>',array('preview'=>$info['logomobile'])); ?>
				<?php echo Form::input('text', 'url', $info['url'], '作家网址：暂时忽略','请填写品牌网址，以http://开头。'); ?>
				<?php echo Form::input('text', 'sort', $info['sort'] ? $info['sort'] : 100, '排序：', '请填写自然数。 列表将会根据排序进行由小到大排列显示。'); ?>
				<?php echo Form::input('enabled','isrecommend',isset($info['isrecommend']) ? $info['isrecommend'] : '1',  '是否推荐：', '请设置艺术家是否为推荐品牌。', array('colspan' => 2)); ?>
				<?php echo Form::input('textarea','profile', $info['profile'], ' 艺术家简介：', '请填写艺术家的简介信息。输入'.htmlspecialchars('<br/>').'换行'); ?>
				<?php echo Form::input('textarea','write_view', $info['write_view'], ' 艺术家创作观点：', '请填写艺术家创作观点。输入'.htmlspecialchars('<br/>').'换行'); ?>
				<?php echo Form::input('textarea','exhibition', $info['exhibition'], ' 艺术家个人展览记录：', '请填写艺术家个人展览记录。输入'.htmlspecialchars('<br/>').'换行'); ?>
			</div>
			<div class="padding">
				<input type="hidden" name="id" value="<?php echo $info['id']?>">
				<input type="submit" name="dosubmit" class="button bg-main" value="确定" />
				<input type="button" class="button margin-left bg-gray" value="返回" />
			</div>
			</form>
		</div>
		<script type="text/javascript">
			$(window).otherEvent();
		</script>
	</body>
</html>