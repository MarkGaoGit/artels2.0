<?php if(!defined('IN_APP')) exit('Access Denied');?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $SEO['title'];?></title>
<meta name="Keywords" content="<?php echo $SEO['keywords'];?>" />
<meta name="Description" content="<?php echo $SEO['description'];?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>template/default/statics/css/haidao.css?v=<?php echo HD_VERSION;?>" />
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>template/default/statics/css/public.css?v=<?php echo HD_VERSION;?>" />
<script type="text/javascript" src="<?php echo __ROOT__;?>template/default/statics/js/jquery-1.7.2.min.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>template/default/statics/js/haidao.web.general.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>template/default/statics/js/common.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>template/default/statics/js/member.order.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/dialog/dialog-plus-min.js?v=<?php echo HD_VERSION;?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>statics/js/dialog/ui-dialog.css?v=<?php echo HD_VERSION;?>" />
<script type="text/javascript" src="<?php echo __ROOT__;?>template/default/statics/js/cart.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript"> hd_cart.init(); </script>
<link rel="shortcut icon" href="<?php echo __ROOT__;?>template/default/statics/images/favicon.ico">
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/date/WdatePicker.js?v=<?php echo HD_VERSION;?>"></script>

<?php echo $site_rewrite_other;?>
<!--[if gte IE 8]> 
<link type="text/css" rel="stylesheet" href="<?php echo __ROOT__;?>template/default/statics/css/compatible.css" />
<![endif]-->
<script>
$('img .lazy').lazyload();
</script>
</head>
<body>
