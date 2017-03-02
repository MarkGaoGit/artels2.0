<?php if(!defined('IN_APP')) exit('Access Denied');?>
<div class="marsk"></div>
    <div class="header container">
<script>
var url = window.location.href;
$(".site-menu li").each(function(){
if($(this).children().attr('href') == url){
$(this).children().attr('class','text-sub');
}
})
var cart_jump = <?php $cache = cache('setting'); echo json_encode($cache['cart_jump'])?>;
$('input[type=submit]').bind('click',function(){
if($('[name=keyword]').val() == ''){
return false;
}
})
</script>