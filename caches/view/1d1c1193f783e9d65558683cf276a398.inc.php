<?php if(!defined('IN_APP')) exit('Access Denied');?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <!-- 顶部工具条 -->
    <div class="layout top-tools">
        <div class="site-bar container">
            <!--<ul class="fl">-->
                <!--<li><a class="fun-homepage" href="javascript:;">设为首页</a></li>-->
                <!--<li class="spacer"></li>-->
                <!--<li><a class="fun-favorite" href="javascript:;">收藏本站</a></li>-->
            <!--</ul>-->
            <ul class="fr tools-right">
                <?php if ($this->member['id']): ?>
                <li class="toper-save"><div class="save-reserve"></div><a class="save-button" href="<?php echo url('member/index/index',array('edit'=>'pedit'));?>">查看/取消订单</a></li>
                <li class="spacer"></li>
                <li><a href="<?php echo url('member/index/index');?>">欢迎您，<?php echo $this->member['username'] ?>&nbsp;&nbsp;</a></li>
                <li><a href="<?php echo url('member/index/index');?>">会员中心</a></li>
                <li class="spacer"></li>
                <li><a href="<?php echo url('member/public/logout');?>">退出登录</a></li>
                <?php else: ?>
                <li class="toper-save"><div class="save-reserve"></div><a class="save-button" href="<?php echo url('member/index/index',array('edit'=>'pedit'));?>">查看/取消订单</a></li>
                <li class="spacer"></li>
                <li class="toper-login"><div class="loginpic"></div><a class="login-button" href="<?php echo url('member/public/login');?>">登录</a></li>
                <li class="spacer"></li>
                <li><a href="<?php echo url('member/public/register');?>">免费注册</a></li>
                <?php endif ?>

                <?php
                    if($GLOBALS['_SESSION']['type'] == 'in'){
                        echo $GLOBALS['_SESSION']['synlogin'];
                    }else{
                        echo $GLOBALS['_SESSION']['synloginout'];
                    }
                 ?>
                <!-- <li class="spacer"></li>
                <li><a href="#">手机版</a></li> -->
            </ul>
        </div>
    </div>
</body>
</html>

