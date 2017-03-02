<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo __ROOT__;?>statics/js/haidao.validate.js?v=<?php echo HD_VERSION;?>"></script>
<script type="text/javascript" src="template/default/statics/js/jquery.cookie.js?v=<?php echo HD_VERSION;?>"></script>
<?php
$setting = cache('setting');
?>
<div class="mui-content">
    <div class="padding bg-white login-wrap">
    	<form class="padding-small  " action="<?php echo url('register');?>" name="register" method="post">
<div class="list">
<input type="text" class="input"  name="nickname" placeholder="请输入您的姓名！" datatype="nickname" ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入您的姓名"/>
</div>
<div class="list text-left">
<label for="sexm"><input type="radio" id="sexm" name="sex" value="1" checked>先生</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for="sexw"><input type="radio" id="sexw" name="sex" value="2">女士</label>
</div>
<div class="list">
       		<input type="text" name="username" class="input error-input" placeholder="请输入您的用户名" datatype="username" nullmsg="请填写用户名，由3-15个字符组成" errormsg="请填写用户名，由3-15个字符组成" ajaxurl="<?php echo url('ajax_register_check');?>"/>
       	</div>
        <div class="list">
        	<input type="password" name="password" class="input" placeholder="请输入登陆密码" datatype="*" ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入登陆密码"/>
        </div>
        <div class="list">
        	<input type="password" name="pwdconfirm" class="input" placeholder="请确认您的密码" datatype="*" nullmsg="请输入确认密码" recheck="password" />
        </div>
<div class="list">
<input type="text" class="input"  name="mobile" onblur="checkml($(this))" placeholder="请输入您的手机号码！"  ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入手机号码"/>
</div>
        <div class="list">
        	<input type="text" class="input" name="email" onblur="checkem($(this))" placeholder="请输入您的邮箱地址！"   nullmsg="请输入您的电子邮箱" ajaxurl="<?php echo url('ajax_register_check');?>"/>
        </div>
<div class="list">
<input type="text" class="input"  name="id_no" onblur="checkid($(this))" placeholder="为了加快您办理入住手续的时间 请填写有效身份证号" ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入您的身份证号码"/>
</div>
        <input type="submit" class="mui-btn full regb" value="立即注册" />
        <a class="mui-btn full margin-top margin-bottom mui-btn-danger" href="<?php echo url('member/public/login');?>">已有账号？登录</a>
    </form>
    </div>
   <!--<ul class="other-login">
    	<li><a class="login_qq login-item" href="#"></a><em class="mui-pull-right">|</em></li>
    	<li><a class="login_sina login-item" href="#"></a><em class="mui-pull-right">|</em></li>
    	<li><a class="login_alipay login-item" href="#"></a></li>
    </ul>-->
</div>
<?php include template('artels-menu-footer', 'common'); ?>

</body>
</html>
<script>

function checkem(_this) {
var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
if(_this.val()){
if (!reg.test(_this.val())) {
_this.nextAll().empty();
_this.css({'border-color':'#f85738'});
_this.after('<span class="validform_checktip validation-tips"><i></i>邮箱填写不正确</span>');
$('.regb').attr({'disabled' : 'true'});
return false;
} else {
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
return true;
}
}else{
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
return true;
}

}

function checkml(_this){
var reg = /^1[3|4|5|7|8]\d{9}$/;
if (!reg.test(_this.val())) {
_this.nextAll().empty();
_this.css({'border-color':'#f85738'});
_this.after('<span class="validform_checktip validation-tips"><i></i>手机号码填写不正确</span>');
$('.regb').attr({'disabled' : 'true'});
return false;
} else {
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
return true;
}
}

function checkid(_this){
// 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是    校验位，可能为数字或字符X
var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
if(_this.val()){
if (!reg.test(_this.val())) {
_this.nextAll().empty();
_this.css({'border-color':'#f85738'});
_this.after('<span class="validform_checktip validation-tips"><i></i>身份证号码填写不正确</span>');
$('.regb').attr({'disabled' : 'true'});
return false;
} else {
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
return true;
}
}else{
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
return true;
}

}
$('.regb').on('click',function(){
if(checkid && checkml && checkem){
$('.regb').removeAttr('disabled');
}else{
$.tips({
icon: 'error',
content: '输入信息有误',
callback: function () {
$('.regb').attr({'disabled': 'true'});
return false;
}
});
$('.regb').attr({'disabled': 'true'});
}
});


var register = $("form[name=register]").Validform({
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
}else{
$.tips({
icon:'success',
content:ret.message
});
window.location.href=ret.referer;
}
}
});
$("input[name=mobile]").bind('blur',function(){
var ajaxurl = $("input[name=vcode]").attr('ajaxurl');
$("input[name=vcode]").attr('ajaxurl',ajaxurl+'&mobile='+$(this).val());
})
/*仿刷新：检测是否存在cookie*/
if($.cookie("reg_captcha")){
reget($.cookie("reg_captcha"));
}
//发送验证码
$("#sendsms").bind("click",function(){
var mobile = $('input[name="mobile"]').val();
var checkurl = "<?php echo url('member/public/ajax_register_check')?>";
$.post(checkurl,{name:'mobile',param:mobile},function(ret){
if(ret.status == 1){
var ajaxurl="<?php echo url('member/public/register_validate')?>";
$.post(ajaxurl,{'mobile':mobile},function(data){
},'json');
$("input[name=vcode]").removeAttr("readonly disabled");
reget(60);
}else{
$.tips({content:ret.message});
}
},'json');
})
function reget(count){
  var mobj = $('input[name="mobile"]');
var btn = $("#sendsms");
var count = count;
var resend = setInterval(function(){
count--;
if (count > 0){
btn.text(count+"s后再试");
mobj.attr('readonly',true);
$.cookie("reg_captcha", count, {path: '/', expires: (1/86400)*count});
}else {
clearInterval(resend);
mobj.removeAttr('disabled readonly');
btn.text("重获验证码").removeAttr('disabled').css({'cursor':'','background':'#046bb3'});
}
}, 1000);

  btn.attr('disabled',true).css({'cursor':'not-allowed','background':'#989898'});
}
</script>
