<?php if(!defined('IN_APP')) exit('Access Denied');?>
<div class="header container">
    <div class="logo fl" style="z-index:20;">
         <img width="150px" height="52px" src="<?php $cache = cache('setting'); echo $cache['site_logo'] ? __ROOT__.$cache['site_logo'] : __ROOT__.'template/default/statics/images/logo.png' ?>" />
    </div>
</div>
<script>
    $('.logo img').on('click',function(){
        window.location.href = '/index.php';
    })
</script>