<?php if(!defined('IN_APP')) exit('Access Denied');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
    <meta name="description" content="<?php echo $SEO['keywords'];?>">
    <meta name="keywords" content="<?php echo $SEO['description'];?>">
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/mui.min.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/haidao.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/haidao.mobile.css?v=<?php echo HD_VERSION;?>"/>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/mui.min.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/jquery-2.1.1.min.js?v=<?php echo HD_VERSION;?>" ></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/haidao.slider.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
</head>