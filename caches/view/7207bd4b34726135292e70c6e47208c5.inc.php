<?php if(!defined('IN_APP')) exit('Access Denied');?>
<span class="mui-icon mui-icon-back gobacks" onclick="javaScript:history.back(-1);"></span>
<div id="info"></div>
</div>

</div>
<div id="menu-wrapper" class="menu-wrapper hidden bg-main">
    <div id="menu" class="menu artels-menu">
        <ul class="mui-table-view  hd-h4 bg-main text-main">
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo __APP__;?>" class="text-main">首页 Index</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('goods/index/booking');?>" class="text-main">酒店预订 Booking</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('misc/index/article_lists',array('types'=>'recruit'));?>" class="text-main">诚聘英才 Recruit</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('misc/index/article_lists',array('types'=>'hotelnews'));?>" class="text-main">酒店新闻 Htoel News</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('member/index/ajax_order',array('type'=>'mobilemenu'));?>" class="text-main">订单查询 Order</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('goods/index/totalArt');?>" class="text-main">艺术生活 Total Art</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('goods/index/vip');?>" class="text-main">会员专享 Members</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('goods/index/about');?>" class="text-main">关于我们 About Us</a>
            </li>
            <li class="mui-table-view-cell border-bottom-menu">
                <a href="<?php echo url('member/index/index');?>" class="text-main">个人中心 Center</a>
            </li>
        </ul>
    </div>
</div>
<div id="menu-backdrop" class="menu-backdrop"></div>
<script>
    mui.init({
        swipeBack:true //启用右滑关闭功能
    });
    var menuWrapper = document.getElementById("menu-wrapper");
    var menu = document.getElementById("menu");
    var menuWrapperClassList = menuWrapper.classList;
    var backdrop = document.getElementById("menu-backdrop");
    var info = document.getElementById("info");

    backdrop.addEventListener('tap', toggleMenu);
    //    document.getElementById("menu-btn").addEventListener('tap', toggleMenu);
    document.getElementById("icon-menu").addEventListener('tap',toggleMenu);
    //下沉菜单中的点击事件
    mui('#menu').on('tap', 'a', function() {
        toggleMenu();
        window.location.href = this.href;
    });
    var busying = false;

    function toggleMenu() {
        if (busying) {
            return;
        }
        busying = true;
        if (menuWrapperClassList.contains('mui-active')) {
            document.body.classList.remove('menu-open');
            menuWrapper.className = 'menu-wrapper fade-out-up animated';
            menu.className = 'menu bounce-out-up animated';
            setTimeout(function() {
                backdrop.style.opacity = 0;
                menuWrapper.classList.add('hidden');
            }, 500);
        } else {
            document.body.classList.add('menu-open');
            menuWrapper.className = 'menu-wrapper fade-in-down animated mui-active';
            menu.className = 'menu bounce-in-down animated';
            backdrop.style.opacity = 1;
        }
        setTimeout(function() {
            busying = false;
        }, 500);
    }
</script>