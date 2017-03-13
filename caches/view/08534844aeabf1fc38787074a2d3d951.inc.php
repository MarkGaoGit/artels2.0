<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('预订房间');
</script>
<!--面包屑-->
<div class="container crumbs clearfix">
</div>
<!--list-->
<div class="item-two-column container clearfix reserve-content">
    <div class="margin-bottom item-blue-top reserve-room">
        <div class="item-title padding-left fff">
            <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
            <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;酒店预订&nbsp;&nbsp;>&nbsp;&nbsp;预订</span>
        </div>
        <div class='reserve'>
        </div>
    </div>

    <div class="fl right goods-list-wrap step-01">
        <div class="reserve-step">
            <ul>
                <li class="step-01-01" ></li>
                <li class="step-01-02"></li>
                <li class="step-01-03"></li>
            </ul>
        </div>
        <div class="reserve-msg text-default">
            <table cellpadding="3">
                <tr>
                    <td width="90" >客房类型：</td>
                    <td colspan="4" class="room-type strong text-left">
                        <?php echo $_GET['rm'];?>
                    </td>
                </tr>
                <tr>
                    <td>入住日期：</td>
                    <td>
                        <span class="check-time"  onClick="WdatePicker({minDate:'%y-%M-{%d}'})" ></span>
                    </td>
                    <td>
                        <span class="icon-time icon" ></span>
                    </td>
                </tr>
                <tr>
                    <td>退房日期：</td>
                    <td>
                        <span class="checkout-time" onClick="WdatePicker({minDate:'%y-%M-{%d}'})"></span>
                    </td>
                    <td>
                        <span class="icon-time icon"></span>
                    </td>
                </tr>
                <tr>
                    <td class="kfa-num">客房数量：</td>
                    <td class="room-num-list" colspan="4">
                        <ul>
                            <li><label>
                                <span class="room-num-mask" style="border:2px solid #00447c;"><input type="radio" class="radios" checked name="room-num"><defaultnum>1</defaultnum>间</span>
                            </label></li>
                            <li><label>
                                <span class="room-num-mask"><input type="radio" class="radios" name="room-num"><defaultnum>2</defaultnum>间</span>
                            </label></li>
                            <li><label>
                                <span class="room-num-mask"><input type="radio" class="radios" name="room-num"><defaultnum>3</defaultnum>间</span>
                            </label></li>
                            <li><label>
                                <span class="room-num-mask"><input type="radio" class="radios" name="room-num"><defaultnum>4</defaultnum>间</span>
                            </label></li>
                            <li><label>
                                <span class="room-num-mask"><input type="radio" class="radios" name="room-num"><defaultnum>5</defaultnum>间</span>
                            </label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">成人：&nbsp;&nbsp;&nbsp;</td>
                    <td width="124">

                        <span class=' c-r room-num'>1</span>
                        <span class=' c-p plus nums-button'></span>
                        <span class=' c-m minus nums-button'></span>
                    </td>
                    <td width="70" class="text-right">儿童：&nbsp;</td>
                    <td>

                        <span class=' e-r room-num'>0</span>
                        <span class=' e-p plus nums-button'></span>
                        <span class=' e-m minus nums-button'></span>
                    </td>
                </tr>
            </table>

            <p class="strong show text-big user-res-msg">客人信息</p>

            <table cellpadding="3"  class="res-user-msg">
                <tr>
                    <td width="100" class="text-right"><small class="text-red">*</small>入住人：</td>
                    <td width="220">
                        <input type="text" name="surname" class="surname" placeholder="拼音姓/英文姓" value="">
                    </td>
                    <td>
                        <input type="text" name="name" class="names" placeholder="拼音名/英文名" value="">
                    </td>
                </tr>
                <tr>
                    <td width="100" class="text-right"><small class="text-red">*</small>身份证号：</td>
                    <td colspan="2">
                        <input type="text" name="id_no" class="id_no" value="<?php echo $_SESSION['userInfo']['idNo'];?>" >
                    </td>
                </tr>
                <tr>
                    <td width="100" class="text-right"><small class="text-red">*</small>手机号码：</td>
                    <td>
                        <input type="text" name="mobile" class="mobile" value="<?php echo $_SESSION['userInfo']['mobile'];?>">
                    </td>
                    <td class="text-small">
                        <!--订单提交后，我们会将预订信息发送至您的手机-->
                    </td>
                </tr>
                <tr>
                    <td width="100" class="text-right"><small class="text-red">*</small>会员卡号：</td>
                    <td colspan="2">
                        <input type="text" name="card_no" class="card_no" value="<?php echo $_SESSION['userInfo']['cardNo'];?>">
                    </td>
                </tr>
                <tr width="100" height="100">
                    <td class="rev-add text-right" >备注：</td>
                    <td colspan="2">
                        <textarea name="rev" rows="4" cols="65" class="rev text-small"><?php echo $_GET['hotelMsg'];?>---<?php echo $_GET['roomnumbers'];?>---<?php echo $_GET['rm'];?></textarea>
                    </td>
                </tr>

            </table>

            <div class="res-step-next strong text-big text-white ">下一步</div>
        </div>
    </div>

    <div class="fl right goods-list-wrap step-02">
        <div class="reserve-step">
            <ul>
                <li class="step-02-01"></li>
                <li class="step-02-02"></li>
                <li class="step-01-03"></li>
            </ul>
        </div>
        <div class="reserve-msg text-default">
            <p class="strong show text-default user-res-msg">客人信息</p>
            <table cellpadding="3">
                <tr>
                    <td width="100" class="text-right">客房类型</td>
                    <td colspan="4" class=" padding-d-left room-type strong text-left"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right">入住日期</td>
                    <td colspan="4" class="padding-d-left step-02-check-time"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right" >退房日期</td>
                    <td colspan="4" class="padding-d-left step-02-checkout-time" ></td>
                </tr>
            </table>

            <p class="strong show text-default user-res-msg margin-d-top">客人信息</p>

            <table cellpadding="3"  class="res-user-msg">
                <tr>
                    <td width="100" class="text-right">姓</td>
                    <td class="padding-d-left step-02-surname" width="220"></td>
                    <td class="padding-d-left">名</td>
                    <td class="step-02-names"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right">身份证号码</td>
                    <td class="padding-d-left step-02-id-no"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right">手机号码</td>
                    <td class="padding-d-left step-02-mobile"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right">会员卡号</td>
                    <td class="padding-d-left step-02-card-no"></td>
                </tr>
                <tr>
                    <td  class="text-right">客房数量</td>
                    <td class="padding-d-left step-02-kfnum"></td>
                </tr>
                <tr>
                    <td  class="text-right">成人</td>
                    <td class="padding-d-left step-02-chengnum"></td>
                    <td width="100" class="padding-d-left">儿童</td>
                    <td class="step-02-ernum"></td>
                </tr>
                <tr>
                    <td  class="text-right">备注</td>
                    <td class="padding-d-left rev" colspan="3" ></td>
                </tr>

            </table>

            <p class="strong show text-default user-res-msg margin-d-top">价格信息</p>
            <table cellpadding="3"  class="res-user-msg">
                <tr>
                    <td width="100" class="text-right">房间单价</td>
                    <td class="padding-d-left">&yen;<span class="room-price"></span>元</td>
                    <td><span class="order-money text-big-small" rowspan="2">订单总价&nbsp;&nbsp;&nbsp;<span class="text-default">&yen;</span><span class="text-money text-big-big orders-money"></span>&nbsp;元</td>
                </tr>
                <tr>
                    <td width="100" class="text-right">入住天数</td>
                    <td class="padding-d-left days"></td>
                </tr>
                <tr>
                    <td width="100" class="text-right"><p></p></td>
                </tr>
                <tr>
                    <td colspan="6" class="text-indent40 text-big">需要到酒店前台支付&yen;<span class="text-big-big reception-price"></span> 元<br/>
                                <span class="text-small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;酒店将会为您保留无担保预订的房间到入住当日下午六时
                                </span>
                    </td>
                </tr>
            </table>

            <input type="hidden" value="<?php echo $_GET['rc'];?>" name="roomtype" class="roomtype">
            <input type="hidden" value="<?php echo $hotelMsg['subtitle'];?>" name="cityCode" class="cityCode">
            <input type="hidden" value="<?php echo $hotelIds;?>" name="hotelId" class="hotelId">

            <div class="next-two ">
                <div class="res-step-next order-back strong text-big text-white fl">返回上一步</div>
                <div class="res-step-next order-add strong text-big text-white fl">提交订单</div>
            </div>

        </div>
    </div>
    <div class="fl right goods-list-wrap step-03">
        <div class="reserve-step">
            <ul>
                <li class="step-02-01"></li>
                <li class="step-01-02"></li>
                <li class="step-03-03"></li>
            </ul>
        </div>
        <div class="reserve-msg text-default">
            <div class="res-ok text-default">
                <p>订单号：<span class="text-big-small strong order-number"></span></p>
                <p>如需了解更多信息，欢迎致电我们。电话：<?php echo $hotelMsg['hotel_mobile'];?></p>
                <p>预订成功，请您提前安排出行。</p>
            </div>
            <a href="<?php echo url('goods/index/index');?>" class="res-step-next strong text-big text-white">返回首页</a>
        </div>
    </div>
    <div class="left fr left-step-01-02">
        <div class="res-hotel-msg text-indent20 bg-00447c text-white">酒店信息</div>
        <div class="res-hotel-img">
            <img src="<?php echo $hotelMsg['thumb'];?>"  alt="">
        </div>
        <div class="hotel-add-name border-bottoms margin-big-left">
            <h3 class="strong"><?php echo $hotelMsg['name'];?></h3>

            <p class="hotel-address"><?php echo $hotelMsg['description'];?></p>
        </div>
        <div class="res-hotel-disp border-bottoms margin-big-left margin-big-top">
            <h4 class="strong margin-small-bottom">
                <?php echo $_GET['rm'];?>
            </h4>
            <p>房间描述:<br/><?php echo $hotelMsg['keyword'];?></p>
        </div>
        <div class="res-hotel-disp margin-big-left margin-big-top">
            <h4 class="strong margin-small-bottom">酒店介绍</h4>
            <p><?php echo $hotelMsg['hotel_descript'];?></p>
        </div>
    </div>
    <div class="left fr left-step-03">
        <div class="res-hotel-msg text-indent20 bg-00447c text-white">艺术生活</div>
        <div>
            <ul class="text-indent20 margin-big-top text-default">
                <li>艺术生活艺术生活艺术生活</li>
                <li>艺术生活艺术生活艺术生活艺术生活艺术生活</li>
                <li>艺术生活艺术生活艺术生活艺术生活艺术生活</li>
                <li>艺术生活艺术生活艺术生活艺术生活艺术生活</li>
            </ul>
        </div>
    </div>
</div>
<?php include template('artels-footer','common');?>

<script type="text/javascript" src="<?php echo __ROOT__ ?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>" ></script>

<script>
    /*去除首页LOGO透明度*/
    $('.logo').css({'opacity' : '1'});
    $('.artels-footer').css({'top':'0'});
    $('.artels-record').css({'top':'0'});
    $('.reserve-content').css({'margin-bottom' : '40px'});

    var now = new Date();
    var year = now.getFullYear();       //年
    var month = now.getMonth() + 1;     //月
    var day = now.getDate();            //日
    var clock = year + "-";
    if(month < 10) {
        clock += "0";
    }
    clock += month + "-";
    var tomorrow = day + 1 ;
    if(tomorrow < 10){
        tomorrow += "0";
    }
    if(day < 10) {
        clock += "0";
    }

    clock += day;
    $('.check-time').html(clock);

    function getDay(day){
        var today = new Date();

        var targetday_milliseconds=today.getTime() + 1000*60*60*24*day;

        today.setTime(targetday_milliseconds); //注意，这行是关键代码

        var tYear = today.getFullYear();
        var tMonth = today.getMonth();
        var tDate = today.getDate();
        tMonth = doHandleMonth(tMonth + 1);
        tDate = doHandleMonth(tDate);
        return tYear+"-"+tMonth+"-"+tDate;
    }
    function doHandleMonth(month){
        var m = month;
        if(month.toString().length == 1){
            m = "0" + month;
        }
        return m;
    }
    var tdays = getDay(1);


    $('.checkout-time').html(tdays);
    $('.radios').on('click',function(){
        var li_num = $(".room-num-list ul > li").length;
        for(var i=1; i<= li_num; i++){
            var check_status = $('.room-num-list ul li:nth-child(' + i+ ') .radios ').attr('checked');
            $('.room-num-list li:nth-child(' + i + ') .room-num-mask ').css({'border' : '1px solid #c1bfc0'});
            if(check_status == 'checked'){
                $('.room-num-list li:nth-child(' + i+ ') .room-num-mask ').css({'border' : '2px solid #00447c'});
                var room_nums = $('.room-num-list ul li:nth-child(' + i+ ') defaultnum ').html();
                $('.c-r').html(room_nums);
            }
        }
    });
    $('.c-p').on('click',function(){
        var roomNum = parseInt($('.c-r').html());
        var roomVal = roomNum + 1 ;
        $('.c-r').html(roomVal);
    });

    $('.c-m').on('click',function() {
        var roomNum = parseInt($('.c-r').html());
        var roomVal = roomNum - 1;
        if (roomNum == 1) {
            roomVal = 1;
        };
        $('.c-r').html(roomVal);
    });
    $('.e-p').on('click',function(){
        var roomNum = parseInt($('.e-r').html());
        var roomVal = roomNum + 1 ;
        $('.e-r').html(roomVal);
    });

    $('.e-m').on('click',function() {
        var roomNum = parseInt($('.e-r').html());
        var roomVal = roomNum - 1;
        if (roomNum < 1) {
            roomVal = 0;
        };
        $('.e-r').html(roomVal);
    });

    $('.step-01 .id_no').on('blur' ,function(){
        var id_no = $('.id_no').val().length;
        if(id_no != 18){
            alert('身份证信息有误，请重新填写！');
            location.reload();
        }
    });
    $('.step-01 .mobile').on('blur' ,function(){
        var mobile = $('.mobile').val();
        var reg=/^1[0-9]{10}/;
        if(!reg.test(mobile)){
            alert("您输入的手机号码不正确，请重新输入！");
            location.reload();
        }
    });

    $('.step-01 .res-step-next').on('click',function(){
        var room_type = $('.step-01 .room-type').html(),
                check_time = $('.check-time').html(),
                checkout_time = $('.checkout-time').html(),
                c_num = $('.c-r').html(),
                e_num = $('.e-r').html(),
                surname = $('.surname').val(),
                names = $('.names').val(),
                id_no = $('.id_no').val(),
                mobile = $('.mobile').val(),
                card_no = $('.card_no').val(),
                hotelId = $('.hotelId').val(),
                rev = $('.rev ').val();
        for(var i=0; i<= 5; i++){
            var check_status = $('.room-num-list ul li:nth-child(' + i+ ') .radios ').attr('checked');
            if(check_status == 'checked'){
                var room_nums = $('.room-num-list ul li:nth-child(' + i+ ') defaultnum ').html();
            }
        }

        if(check_time > checkout_time){
            alert('退房日期不合理，请重新填写！');
            location.reload();
        }

        if(check_time && checkout_time && surname && names && id_no && mobile && card_no && room_nums > 0){
            /*
             * 上面用户信息输入验证没有问题 进入下一步
             * */
            //先获取房价价格
            var cityCode = $('.cityCode').val(),
                    rmtype = $('.roomtype').val(),
                    url = "<?php echo url('goods/index/ajax_room_price');?>";
            $.post(url,{check_time:check_time,checkout_time:checkout_time,cityCode:cityCode,rmtype:rmtype,hotelIds:hotelId},function(data){
                if(data){
                    $('.room-price').html(data['rate1']);

                    $('.step-01').hide();
                    $('.step-02').show();
                    $('.step-02 .room-type').html(room_type);
                    $('.step-02-check-time').html(check_time);
                    $('.step-02-checkout-time').html(checkout_time);
                    $('.step-02-surname').html(surname);
                    $('.step-02-names').html(names);
                    $('.step-02-id-no').html(id_no);
                    $('.step-02-mobile').html(mobile);
                    $('.step-02-card-no').html(card_no);
                    $('.step-02-kfnum').html(room_nums);
                    $('.step-02-chengnum').html(c_num);
                    $('.step-02-ernum').html(e_num);
                    $('.step-02 .rev').html(rev);
                    function daysBetween(DateOne,DateTwo){
                        var OneMonth = DateOne.substring(5,DateOne.lastIndexOf ('-'));
                        var OneDay = DateOne.substring(DateOne.length,DateOne.lastIndexOf ('-')+1);
                        var OneYear = DateOne.substring(0,DateOne.indexOf ('-'));

                        var TwoMonth = DateTwo.substring(5,DateTwo.lastIndexOf ('-'));
                        var TwoDay = DateTwo.substring(DateTwo.length,DateTwo.lastIndexOf ('-')+1);
                        var TwoYear = DateTwo.substring(0,DateTwo.indexOf ('-'));

                        var cha=((Date.parse(OneMonth+'/'+OneDay+'/'+OneYear) - Date.parse(TwoMonth+'/'+TwoDay+'/'+TwoYear))/86400000 -0);
                        return Math.abs(cha);
                    }


                    var day = daysBetween(check_time,checkout_time);
                    var days = day + '天';
                    $('.step-02 .days').html(days);
                    var room_count = parseInt(room_nums);
                    var order_price = ( parseFloat(data['rate1']) * day * room_count);
                    $('.orders-money').html(order_price);
                    $('.reception-price').html(order_price);
                }
            },'json');
        }else{
            alert('您填写的信息不完整，请重新填写您的预订信息!');
            location.reload();
        }
    });

    /*
     * 返回上一步
     * **/
    $('.step-02 .order-back').on('click',function(){
        $('.step-01').show();
        $('.step-02').hide();
    });

    /*
     * 确认信息之后执行 第三步
     * */
    $('.step-02 .order-add').on('click',function(){
        var room_type = $('.step-01 .room-type').html(),
                check_time = $('.check-time').html(),
                checkout_time = $('.checkout-time').html(),
                c_num = $('.c-r').html(),
                e_num = $('.e-r').html(),
                surname = $('.surname').val(),
                names = $('.names').val(),
                id_no = $('.id_no').val(),
                mobile = $('.mobile').val(),
                card_no = $('.card_no').val(),
                rmtype = $('.roomtype').val(),
                hotelIds = $('.hotelId').val(),
                rev = $('.rev ').val();
        for(var i=0; i<= 5; i++){
            var check_status = $('.room-num-list ul li:nth-child(' + i+ ') .radios ').attr('checked');
            if(check_status == 'checked'){
                var room_nums = $('.room-num-list ul li:nth-child(' + i+ ') defaultnum ').html();
            }
        }
        var url = "<?php echo url('order/order/orderAdd');?>",
                now_url = window.location.href;
        $.post(
                url,
                {
                    arr : check_time + '+',
                    dep : checkout_time + '+',
                    rmtype : rmtype,
                    rmNum : room_nums,
                    surname : surname,
                    names : names,
                    mobile : mobile,
                    id_no : id_no,
                    c_num : c_num,
                    rev : rev,
                    hotelId : hotelIds,
                },
                function(data){

                    if(data['resultCode'] != 0){
                        alert('订单提交失败，失败原因：'+data['message']);
                        window.location.href = now_url;
                    }else{

                        $('.order-number').html(data['crsNo']);
                        $('.step-01').hide();
                        $('.step-02').hide();
                        $('.left-step-01-02').hide();
                        $('.step-03').show();
                        $('.left-step-03').show();
                    }

                },'json');
    });



</script>

</body>
</html>
