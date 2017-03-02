$(function(){
    //    轮播图
    var gallery = mui('.mui-slider');
    gallery.slider({
        interval:1500//自动轮播周期，若为0则不自动播放，默认为0；
    });

    //搜索商品
    $('.mui-input-clear').on('blur',function(){
        var searchs = $(this).val(),
            m = 'mobile',
            url = "<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid'])) ?>";
        $.post(url,{search:searchs,m_s:m},function(data){
            if(data){
                //            console.log(data);
                $('.mui-grid-view').empty();
                for(var i =0; i < data.length; i++ ){
                    console.log(data[i]);
                    var htm = '<li class="mui-table-view-cell mui-media mui-col-xs-6">' +
                        '<a href="' + "{url('goods/index/worksDetail',array('sid'=>"+data[i]['id']+"))}" +'">'+
                        '<img class="mui-media-object" src='+ data[i]['thumb']+'>'+
                        '<div class="mui-media-body padding-left-15 text-left">'+data[i]['name'] + data[i]['hotel_name']+'</div>'+
                        '<span class="text-f85738 hd-h4 text-left padding-left-15" style="display:block; width:100%; ">&yen;'+data[i]['max_price'] +'</span></a></li>';
                    $('.mui-grid-view').append(htm);
                }
            }
        },'json');
    })

    //返回顶部
    $('.scroll-top').on('click',function(){
        $('body,html').animate({scrollTop:0},500);
    })


    $(window).scroll( function() {
        var top = $(window).scrollTop();
        var client_h = parseInt(document.documentElement.clientHeight) * 0.2;
        if(top > client_h) {
            $('.scroll-top').css({'display':'block'});
        }else{
            $('.scroll-top').css({'display':'none'});
        }
    });

});

