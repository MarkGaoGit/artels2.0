$(function(){
    window.onload = function(){
        // 获取屏幕的高度 宽度 clientHeight clientWidth
        var client_h = parseInt(document.documentElement.clientHeight) - 44,
            client_25 = parseInt(client_h) * 0.25;
        $('.m-hotel-list .list-top').css({'min-height': client_25});
        $('.m-hotel-list .menu-s').css({'min-height': client_25});
    }

    $('.m-hotel-list li:nth-child(1) .menu-s').addClass('bg-hotel-img1');
    $('.m-hotel-list li:nth-child(2) .menu-s').addClass('bg-hotel-img2');
    $('.m-hotel-list li:nth-child(3) .menu-s').addClass('bg-hotel-img3');
    $('.m-hotel-list li:nth-child(4) .menu-s').addClass('bg-hotel-img4');
    $('.m-hotel-list li:nth-child(5) .menu-s').addClass('bg-hotel-img5');
    $('.m-hotel-list li:nth-child(1) .mui-table-view').addClass('hotel-list-bg1');
    $('.m-hotel-list li:nth-child(2) .mui-table-view').addClass('hotel-list-bg2');
    $('.m-hotel-list li:nth-child(3) .mui-table-view').addClass('hotel-list-bg3');
    $('.m-hotel-list li:nth-child(4) .mui-table-view').addClass('hotel-list-bg4');
    $('.m-hotel-list li:nth-child(5) .mui-table-view').addClass('hotel-list-bg5');
});

