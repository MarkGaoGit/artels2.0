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
                    if(id == 'arr'){
                        result.innerText = '开始时间: ' + rs.text;
                        hids.value = rs.text;
                    }else{
                        result.innerText = '结束时间: ' + rs.text;
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

    $('.yd-btn').on('click',function(){
        $(this).val('正在查询....');
        var url = "/index.php?m=goods&c=index&a=ajaxOrder",
            arr = $('.arr').val(),
            dep = $('.dep').val(),
            cardNo = $('.cardNo').val();
        //if(!arr || !dep){
        //    alert('请选择起止日期');
        //}
        $.post(url,{arr:arr,dep:dep,cardNo:cardNo},function(data){
            console.log(data);
            if(data == '' || data == null){
                $('.yd-btn').val('查询 Search');
                alert('此日期区间内暂无订单信息');
            }else{
                $('.yd-btn').val('查询 Search');
                $('.orders .tr-one').nextAll().empty();
                for(var i=0; i < data.length;i++){
                    var html = '<tr>'+
                        '<td>' + data[i]['crsNo'] + '</td>'+
                        '<td>' + data[i]['arr'] + '</td>'+
                        '<td>' + data[i]['dep'] + '</td>'+
                        '<td>' + data[i]['hotelDescript'] + '</td>'+
                        '</tr>';
                    $('.orders').append(html);
                }

                $('.orders tr:odd').css({'background':'#fff'});
                $('.orders tr td').css({'padding':'6px 8px'});
            }
        },'json');
    });

});

