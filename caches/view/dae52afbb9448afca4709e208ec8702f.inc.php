<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<!-- 登录 -->
<div class="layout border-top">
<div class="container padding-big  border-gray-white clearfix">
<div class="double-line reg-list text-default clearfix">
<form action="<?php echo url('register');?>" name="register" method="post">

<div class="list margin-big-top">
<span class="label">姓名<span class="text-red text-big">*</span>：</span>
<div class="content">
<input class="input radius fl" type="text" name="nickname" placeholder="请输入您的姓名！" datatype="nickname" ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入您的姓名" />
</div>
</div>
<div class="list margin-big-top">
<span class="label">性别<span class="text-red text-big">*</span>：</span>
<div class="content">
<label><input type="radio" name="sex" checked value="1">先生</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><input type="radio" name="sex" value="2">女士</label>
</div>
</div>
<div class="list margin-big-top">
<input type="hidden" name="url_forward" value="<?php echo $_GET['url_forward'];?>">
<span class="label">用户名<span class="text-red text-big">*</span>：</span>
<div class="content">
<input class="input radius fl" type="text" name="username" datatype="username" placeholder="请输入您的用户名！" nullmsg="请填写用户名，由3-15个字符组成" errormsg="请填写用户名，由3-15个字符组成" ajaxurl="<?php echo url('ajax_register_check');?>" />
</div>
</div>
<div class="list margin-big-top">
<span class="label">登录密码<span class="text-red text-big">*</span>：</span>
<div class="content">
<input class="input radius fl" type="password" name="password" placeholder="请输入登陆密码" datatype="*" ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入登陆密码" />
</div>
</div>
<div class="list margin-big-top">
<span class="label">确认密码<span class="text-red text-big">*</span>：</span>
<div class="content">
<input class="input radius fl" type="password" name="pwdconfirm" placeholder="请输入确认密码" datatype="*" nullmsg="请输入确认密码" recheck="password" />
</div>
</div>
<div class="list margin-big-top">
<span class="label">手机<span class="text-red text-big">*</span>：</span>
<div class="content">
<input class="input radius fl " type="text" name="mobile" onblur="checkml($(this))" placeholder="请输入您的手机号码！"  ajaxurl="<?php echo url('ajax_register_check');?>" nullmsg="请输入手机号码" />
</div>
</div>
                    <div class="list margin-big-top">
                        <span class="label">邮箱：</span>
                        <div class="content">
                            <input class="input radius fl " type="text" name="email" onblur="checkem($(this))" placeholder="请输入您的邮箱地址！" />
                        </div>
                    </div>
                    <div class="list margin-big-top user-id-no">
                        <span class="label">身份证：</span>
                        <div class="content">
                            <input class="input radius fl" type="text" name="id_no" onfocus="nitceHide()" onblur="checkid($(this))" placeholder="请输入您的身份证号码"  />
                        </div>
<span class="notice validform_checktip validation-tips">为了加快您办理入住手续的时间 请填写有效身份证号</span>
                    </div>
                    <div class="list margin-big-top">
                        <span class="label">验证问题：</span>
                        <div class="content">
                            <select name="question" id="question" style="width:250px;border-radius:4px; color:#000;">
                                <?php if(is_array($question)) foreach($question as $r) { ?>                                <option value="<?php echo $r['id'];?>"><?php echo $r['question'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="list margin-big-top">
                        <span class="label">验证答案：</span>
                        <div class="content">
                            <input class="input radius fl " type="text" name="question-result" placeholder="验证答案可帮助您找回您的密码！" />
                        </div>
                    </div>
                    
                    
                    
                    <div class="list hidden">
                        <span class="label"></span>
                        <div class="content text-small">
                                <input class="va-m" type="checkbox" checked/> 同意 <a class="text-main reg-xy" href="javascript:;">《网站服务协议》</a>
                        </div>
                    </div>
                    <div class="list">
                        <span class="label"></span>
                        <div class="content reg-btn">
                            <input class="cheng-button bg-sub text-big regb" type="submit" name="dosubmit" value="注册" />
                        </div>
                    </div>
</form>
</div>
</div>
</div>
<div id="xy" class="popup-item">
<textarea class="fl layout textarea padding text-gray border-none" readonly="readonly" style="height:300px;">
</textarea>
</div>
<!--底部-->
    <?php include template('artels-footer','common');?>


<script type="text/javascript">
        $('.logo').css({'opacity' : '1'});

        //检测邮箱
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

        //检测手机号
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

        //检测身份证
function checkid(_this){

// 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是    校验位，可能为数字或字符X
var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
if(_this.val()){
if (!reg.test(_this.val())) {
_this.nextAll().empty();
_this.css({'border-color':'#f85738'});
_this.after('<span class="validform_checktip validation-tips"><i></i>身份证号码填写不正确</span>');
$('.regb').attr({'disabled' : 'true'});
                    showStatus();
return false;
} else {
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
                    showStatus();
return true;
}
}else{
_this.nextAll().empty();
_this.css({'border-color':'#ccc'});
$('.regb').removeAttr('disabled');
                showStatus();
return true;
}

}

        //身份证提醒
        function nitceHide(){
            $('.user-id-no .notice ').hide();
        }

        function showStatus(){
            var showStatus = $('.user-id-no .content .validation-tips').is(":visible");
            console.log(showStatus);
            if(showStatus){
                $('.user-id-no .notice ').hide();
            }else{
                $('.user-id-no .notice ').show();
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
content:ret.message,
callback:function() {
window.location.href=ret.referer;
}
});
}
}
})

/*仿刷新：检测是否存在cookie*/
if($.cookie("reg_captcha")){
reget($.cookie("reg_captcha"));
}
$("input[name=mobile]").live('blur',function(){
var ajaxurl = $("input[name=vcode]").attr('ajaxurl');
$("input[name=vcode]").attr('ajaxurl',ajaxurl+'&mobile='+$(this).val());
})
$("#sendsms").live("click",function(){
var mobile = $('input[name="mobile"]').val();
var checkurl = "<?php echo url('member/public/ajax_register_check');?>";
$.post(checkurl,{name:'mobile',param:mobile},function(ret){
if(ret.status == 1){
var ajaxurl="<?php echo url('member/public/register_validate');?>";
$.post(ajaxurl,{'mobile':mobile},function(data){
},'json');
$("[name=vcode]").removeAttr("readonly disabled");
reget(60);
}else{
$.tips({
icon:'error',
content:'手机号有误',
callback:function() {}
});
}
},'json');
})
//重新获取验证码
function reget(count){
var mobj = $('input[name="mobile"]');
var btn = $("#sendsms");
var count = count;
var resend = setInterval(function(){
count--;
if (count > 0){
btn.val(count+"秒后重新获取");

mobj.attr('readonly',true);
$.cookie("reg_captcha", count, {path: '/', expires: (1/86400)*count});
}else {
clearInterval(resend);
mobj.removeAttr('disabled readonly');
btn.val("重获验证码").removeAttr('disabled').css({'cursor':'','background':'#046bb3'});
}
}, 1000);

btn.attr('disabled',true).css({'cursor':'not-allowed','background':'#989898'});
}
$(function(){
$(".reg-xy").click(function(){
top.dialog({
title: '用户协议',
content: $("#xy"),
width: 600,
cancelValue: '关闭',
cancel: function(){
}
}).showModal();
})
});
$(".va-m").click(function(){
if($(".va-m").prop("checked")){
$(".reg-btn .button").val("注册").css("background","#00447c");
$(".reg-btn .button").attr("disabled",false);
}else{
$(".reg-btn .button").val("请同意网站服务协议").css("background","rgb(152, 152, 152)");
$(".reg-btn .button").attr("disabled",true);
}
});
</script>