<?php if(!defined('IN_APP')) exit('Access Denied');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if($SEO['title']) { ?> <?php echo $SEO['title'];?> <?php } else { ?>ARTELS<?php } ?></title>
    <meta name="description" content="<?php echo $SEO['keywords'];?>">
    <meta name="keywords" content="<?php echo $SEO['description'];?>">
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/mui.min.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/haidao.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/mui.picker.min.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/haidao.mobile.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/icons-extra.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_PATH;?>statics/css/app.css?v=<?php echo HD_VERSION;?>"/>
    <link rel="shortcut icon" href="<?php echo __ROOT__;?>template/default/statics/images/favicon.ico">

    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/mui.min.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/haidao.slider.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/jquery-2.1.1.min.js?v=<?php echo HD_VERSION;?>" ></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/haidao.js?v=<?php echo HD_VERSION;?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/mui.picker.min.js?v=<?php echo HD_VERSION;?>"></script>
    <style type="text/css">
        body { background-color: <?php $wap_global = cache('wap_global');echo $wap_global['bgcolor'] ? $wap_global['bgcolor']:'#eee'?>; }
        .header { background-color: <?php echo $wap_global['headbg'] ? $wap_global['headbg'] :'#0068b7'?>; box-shadow: none; }
        .header{ height:5rem; background-color: #05457a; color:#fff; text-align: center; order: 0; flex-shrink: 0; }
        .header img { text-align:left !important; position:absolute; left:30px; top:30px;}
        .header span { display:block; height:100%; line-height: 5rem; font-size:18px;}
    </style>
</head>
<body>
