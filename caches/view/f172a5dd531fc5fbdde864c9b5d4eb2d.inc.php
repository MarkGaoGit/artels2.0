<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper', 'common'); ?>

<script type="text/javascript" src="template/default/statics/js/index.js?v=<?php echo HD_VERSION;?>"></script>
<script>
    $('body').addClass('body-bgimg');
</script>
<!-- 头部 -->
<!-- 登录 -->

<div class="layout login-wrap">
    <div class="container clearfix">
        <div class="login-mask logingg"></div>
        <div class="login-main logingg">
            <a href="<?php echo __APP__;?>"><div class="login-logo"></div></a>
            <div class="text-white text-default" style="margin:60px 0 0 30px;" >尊敬的客户<br/>请您先注册成为宝龙酒店集团会员，尊享更多会员礼遇</div>
            <div class="padding-big fr login-box  " style="margin-top:-170px;">
                <form action="<?php echo url('login');?>" method="POST" name="login_form">
                    <input type="hidden" name="url_forward" value="<?php echo $_GET['url_forward'];?>">
                    <div class="list clearfix">
                        <div class="m-t-15 margin-bottom">登录名：</div>
                        <input class="input radius" type="text" name="username" value="" datatype="s2-15|mobile|email" placeholder="用户名/手机号" nullmsg="请输入用户名/手机号" errmsg="格式不正确"/>
                        <span class="validform_checktip"></span>
                    </div>
                    <div class="list">
                        <div class="m-t-15 margin-bottom">密码：<a class="fr text-white" href="<?php echo url('forget_password',array('url_forward'=>$_GET['url_forward'])); ?>">忘记密码？</a></div>
                        <input class="input radius" type="password" value="" name="password" placeholder="请输入登录密码" datatype="*" nullmsg="请输入密码"/>
                        <span class="validform_checktip" style="display:block;"></span>
                    </div>
                    <input class="margin-big-top chengs-button bg-sub fl  text-big" onclick="clearCookie()" type="submit" value="登录" name="dosubmit"/>
                    <a href="<?php echo url('member/public/register');?>" class="chengs-button margin-big-top text-big show fr">注册</a>
                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $('.logo').css({'opacity' : '1'});
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var path = 'path=/;';
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + path + expires;
    }

    function clearCookie() {
        setCookie('yD9rv_member_auth', "", 1);
    }

    var login = $("form[name=login_form]").Validform({
        showAllError:true,
        ajaxPost:true,
        callback:function(ret) {
            if(ret.status == 0) {
                $.tips({
                    icon:'error',
                    content:ret.message,
                    callback:function() {
                        return false;
                    }
                });
            } else {
                $.tips({
                    icon:'success',
                    content:ret.message
                });
                window.location.href = ret.referer;
            }
        }
    })
</script>

