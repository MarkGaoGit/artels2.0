$(function(){
    window.onload = function(){
        var client_h = parseInt(document.documentElement.clientHeight) - 44;
        $('.baseline').css({'min-height' : client_h });
        $('.mui-slider-item').css({'min-height' : client_h });
    }
    $('.navck').on('click',function(){
        var nums = $(this).attr('data-num');
        if(nums == 1){
            $('.art-jj').removeClass('text-black');
            $('.art-zy').addClass('text-black');
            $('.art-profile').addClass('show');
            $('.art-profile').removeClass('hide');
            $('.art-write').addClass('hide');
        }else{
            $('.art-zy').removeClass('text-black');
            $('.art-jj').addClass('text-black');
            $('.art-write').addClass('show');
            $('.art-write').removeClass('hide');
            $('.art-profile').removeClass('show');
            $('.art-profile').addClass('hide');
        }
    })
});

