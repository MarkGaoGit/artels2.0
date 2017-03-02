$(function(){
    (function($) {
        $.init();
        var btns = $('.btn');
        btns.each(function(i, btn) {
            btn.addEventListener('tap', function() {
                var optionsJson = this.getAttribute('data-options') || '{}';
                var options = JSON.parse(optionsJson);
                var id = this.getAttribute('id');
                var result = $('#' + id )[0];
                var hids = $('.' + id)[0];
                var picker = new $.DtPicker(options);
                picker.show(function(rs) {
                    if(id == 'check-in-time'){
                        result.innerText = '入住时间: ' + rs.text;
                        hids.value = rs.text;
                    }else{
                        result.innerText = '退房时间: ' + rs.text;
                        hids.value = rs.text;
                    }
                    picker.dispose();
                });
            }, false);
        });
    })(mui);
    mui.init({
        swipeBack: true //启用右滑关闭功能
    });

    $('.booking').on('submit',function(){
        var  hotel = $('#hotel-list').val(),
            check_in_time = $('.check-in-time').val(),
            check_out_time = $('.check-out-time').val(),
            name = $('.m-name').val();
        if( hotel == 'defaults' ) {
            $.tips({
                icon: 'error',
                content: '请选择您入住的酒店'
            });
            return false;
        }
        var d = new Date();
        var yues = parseInt(d.getMonth()) + 1;
        if( yues < 10 ){
            var yue = '0' + yues;
        }else{
            var yue = yues;
        }
        var str = d.getFullYear()+"-"+yue+"-"+d.getDate();

        function tab(check_in_time,str){
            var a=(Date.parse(str)-Date.parse(check_in_time))/3600/1000;
            if(a > 0){
                return true;
            }else{
                return false;
            }
        }

        var times = tab( check_in_time, str );
        if( times ){
            $.tips({
                icon:'error',
                content:'到店日期必须大于等于今天'
            });
            return false;
        }

        if( !check_in_time ){
            $.tips({
                icon:'error',
                content:'请选择您的到店日期有误'
            });
            return false;
        }



        if ( !check_out_time ){
            $.tips({
                icon:'error',
                content:'请选择您的离开日期'
            });
            return false;
        }

        if(check_out_time <= check_in_time){
            $.tips({
                icon:'error',
                content:'退房日期必须大于入住日期'
            });
            return false;
        }
        if( !name ){
            $.tips({
                icon:'error',
                content:'请输入预订人姓名'
            });
            return false;
        }

        if(hotel && hotel != 'defaults' && check_in_time && check_out_time && name){
            return true;
        }

    });


    $('#hotel-list').change(function(){
        var name_subtitle = $(this).val();
        var nameSubtitle = name_subtitle.split("|");
        var $_this = $(this);
        var $mobile = $('#hotel-list option:selected').data('mobile');
        $('.hotel-mobile').val($mobile);
        $.ajax({
            url:"/index.php?m=goods&c=index&a=selectRoom",
            data:{name:nameSubtitle[1],subtitle:nameSubtitle[0]},
            type:'post',
            success:function(res){
                console.log(res);
                $('.hotelid').val(res[1]);
                $_this.nextAll('select').empty();
                var data = res[0];
                if(typeof(data) != 'object'){
                    $_this.nextAll('select').empty();
                    $_this.next('select').append("<option value='defaults'>房间 Room</option>");
                    return;
                }
                for(var i = 0; i < data.length; i++){
                    $_this.next('select').append("<option value='" + data[i].rmtype + '*' + data[i].descript + '*' + data[i].rate1 + "'>" + data[i].descript + " &nbsp;&nbsp;&nbsp;价格：&yen;" + data[i].rate1 + "</option>");
                }
                $_this.next('select').trigger('change');
            },
            error:function(){
                alert('出错了');
            },
            dataType:'json',
        });
    });


});

