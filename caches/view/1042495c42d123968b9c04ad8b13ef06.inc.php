<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('会员中心');
</script>
<!--面包屑-->
<div class="container crumbs clearfix"></div>

<div class="margin-bottom item-blue-top content1200 ">
    <div class="item-title padding-left fff content1200 vip-top ">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;<a href="<?php echo url('member/index/index');?>">会员中心</a></span>
    </div>
    <div class='content hotel-logo content1200'>
        <img src="<?php echo __ROOT__ ?>template/default/statics/images/center.jpg" alt="">
    </div>
</div>

<div class="vip-center content1200 text-default">
    <div class="center-left fl">
        <h3 class="strong text-big-small text-white text-center">会员中心</h3>
        <ul class="text-center">
            <li class="border-bottom-d4 people-center">个人信息</li>
            <li class="border-bottom-d4 order-list">预订列表</li>
            <li class="border-bottom-d4 score-msg">积分信息</li>
            <li class="border-bottom-d4 edit-password">修改密码</li>
            <li class="border-bottom-d4" onClick="window.location.href='?m=member&c=order&a=index'" onmousemove="$('.ysp-order').css({'color':'#00447c'});" onmouseout="$('.ysp-order').css({'color':'#666'});"><a class="ysp-order"  href="javascript:;" target="_blank">艺术品订单</a></li>
            <li onClick="window.location.href='?m=member&c=favorite&a=index'" onmousemove="$('.member-fav').css({'color':'#00447c'});" onmouseout="$('.member-fav').css({'color':'#666'});"><a class="member-fav"  href="javascript:;" target="_blank">我的收藏</a></li>
        </ul>
    </div>

    <div class="center-right fr margin-large-large-top">
        <div class="p-center fr margin-bottom-100">
            <h4 class="text-00447c text-big-small">个人信息</h4>
            <hr class="text-gray">
            <p class="text-middle text-gray margin-big-bottom">尊敬的会员，以下是您的注册个人信息</p>
            <table class="text-center" cellpadding="4">

                <tr>
                    <td class="bg-gray-e6">姓名</td>
                    <td class="bg-gray-white"><?php echo $_SESSION['userInfo']['name'];?></td>
                </tr>
                <tr>
                    <td class="bg-gray-e6 w30" >会员卡号</td>
                    <td class="bg-gray-white"><?php echo $_SESSION['userInfo']['cardNo'];?></td>
                </tr>
                <tr>
                    <td class="bg-gray-e6">账户余额</td>
                    <td class="bg-gray-white"><?php echo $this['money'];?></td>
                </tr>
                <tr>
                    <td class="bg-gray-e6">身份证号</td>
                    <td class="bg-gray-white"><?php echo $_SESSION['userInfo']['idNo'];?></td>
                </tr>
            </table>
            <p class="margin-tb text-gray text-middle">如果您的姓名或证件号码有误，请亲临各酒店前台进行修改</p>
            <table class="text-center" cellpadding="4">
                <tr>
                    <td class="bg-gray-e6 w30">手机号码</td>
                    <td class="bg-gray-white e-mobile"><?php echo $_SESSION['userInfo']['mobile'];?></td>
                    <!--<td class="bg-gray-white">-->
                    <!--<span class="yellow-button text-small edit-mobile">修改手机</span>-->
                    <!--</td>-->
                </tr>
                <tr>
                    <td class="bg-gray-e6">电子邮箱</td>
                    <td class="bg-gray-white e-email"><?php echo $_SESSION['userInfo']['email'];?></td>
                    <!--<td class="bg-gray-white">-->
                    <!--<span class="yellow-button text-small edit-email">修改邮箱</span>-->
                    <!--</td>-->
                </tr>
            </table>
        </div>

        <div class="o-list margin-bottom-100">
            <h4 class="text-00447c text-big-small">预订列表</h4>
            <hr class="text-gray">
            <ul class="margin-big-top">
                <li>开始日期：<span class="o-begin-date s-date border margin-small-top text-middle" onclick="WdatePicker()"></span></li>
                <li>结束日期: <span class="o-end-date s-date border margin-small-top text-middle" onclick="WdatePicker()"></span></li>
                <li><span class="yellow-button show s-select ad-select-oeder">查询</span></li>
            </ul>
            <table class="text-center text-small margin-big-top" cellpadding="4">
                <tr class="ajax-order">
                    <td class="bg-gray-e6">订单号</td>
                    <td class="bg-gray-e6">酒店</td>
                    <td class="bg-gray-e6">房型</td>
                    <td class="bg-gray-e6">房间价格</td>
                    <td class="bg-gray-e6">入店</td>
                    <td class="bg-gray-e6">离店</td>
                    <td class="bg-gray-e6">状态</td>
                    <td class="bg-gray-e6">操作</td>
                </tr>
                <?php if(is_array($order)) foreach($order as $r) { ?>                    <tr  class="bg-gray-white text-gray-666">
                        <td><?php echo $r['crsNo'];?></td>
                        <td><?php echo $r['hotelDescript'];?></td>
                        <td><?php echo $r['rmtypeDescript'];?></td>
                        <td>&yen;<?php echo $r['rate'];?></td>
                        <td><?php echo $r['arr'];?></td>
                        <td><?php echo $r['dep'];?></td>
                        <td><?php echo $r['staDescript'];?></td>
                        <td>
                            <a class="text-gray-666 order-details" date-crsno="<?php echo $r['crsNo'];?>" href="javascript:;">查看详情</a>
                            <?php if($r['sta'] == 'R') { ?>
                            /
                            <a class="text-gray-666 cencel-order" date-crsno="<?php echo $r['crsNo'];?>" href="javascript:;">取消订单</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

            </table>
        </div>

        <div class="s-msg margin-bottom-100">
            <h4 class="text-00447c text-big-small">积分信息</h4>
            <hr class="text-gray">
            <ul class="margin-big-top">
                <li>开始日期：<span class="s-begin-date s-date border margin-small-top text-middle" onclick="WdatePicker()"></span></li>
                <li>结束日期: <span class="s-end-date s-date border margin-small-top text-middle" onclick="WdatePicker()"></span></li>
                <li><span class="yellow-button show s-select ad-select-scroce">查询</span></li>
            </ul>
            <p>积分余额：<?php echo $score['pointBalance'];?></p>
            <p>历史积分：<?php echo $score['pointCharge'];?></p>
            <table class="text-center text-small margin-big-top" cellpadding="4">
                <tr class="ajax-scroce">
                    <td class="bg-gray-e6">积分产生日期</td>
                    <td class="bg-gray-e6">积分失效日期</td>
                    <td class="bg-gray-e6">积分数</td>
                    <td class="bg-gray-e6">来源</td>
                </tr>
                <?php if(is_array($score['cardPointList'])) foreach($score['cardPointList'] as $r) { ?>                <tr  class="bg-gray-white text-gray-666">
                    <td><?php echo $r['pointGenDate'];?></td>
                    <td><?php echo $r['invalidDate'];?></td>
                    <td><?php echo $r['point'];?></td>
                    <td><?php echo $r['src'];?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="c-list" style="margin-bottom: 200px;">
            <h4 class="text-00447c text-big-small">修改密码</h4>
            <hr class="text-gray">
                    <div class="padding-large-top padding-big-bottom">
                        <ul class="save-popup double-line text-left clearfix">
                            <li class="list">
                                <span class="label">旧密码：</span>
                                <div class="content">
                                    <input class="input radius oldpassword" name="oldpassword" datatype="*" autofocus="" type="password" placeholder="请输入原密码！" />
                                </div>
                            </li>
                            <li class="list">
                                <span class="label">新密码：</span>
                                <div class="content">
                                    <input class="input radius newpassword" name="newpassword" datatype="*6-16" type="password" placeholder="请输入6-16位新密码！" />
                                </div>
                            </li>
                            <li class="list">
                                <span class="label">确认新密码：</span>
                                <div class="content">
                                    <input class="input radius newpassword1" name="newpassword1" datatype="*" recheck="newpassword" type="password" placeholder="请再次输入新密码！" />
                                </div>
                            </li>
                            <li class="list">
                                <input type="submit" class="cheng-button edit-pwd-button text-big" value="确认">
                            </li>
                        </ul>
                    </div>
            </div>
    </div>



</div>
<div class="clear"></div>

<input type="hidden" class="edit-order" value="<?php echo $_GET['edit'];?>">

</div>

<div class="dialong text-default edit-mobiles">
    <div class="close"></div>
    <table class="text-center " cellpadding="3">
        <tr>
            <td width="150">订&nbsp;单&nbsp;号</td>
            <td class="text-left order-rsno text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>酒店名称</td>
            <td class="text-left order-hotelname text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态</td>
            <td class="text-left order-status text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>客房类型</td>
            <td class="text-left order-rmtype text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>入住日期</td>
            <td class="text-left order-arr text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>退房日期</td>
            <td class="text-left order-dep text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>预&nbsp;订&nbsp;人</td>
            <td class="text-left order-name text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>预订人证件</td>
            <td class="text-left order-idno text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>预订人电话</td>
            <td class="text-left order-mobile text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>预定房间数</td>
            <td class="text-left rmNum text-indent20 text-gray-666"></td>
        </tr>
        <tr>
            <td>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</td>
            <td height="70" class="text-left remark text-indent20 text-gray-666"></td>
        </tr>
    </table>
    <div class="res-step-next cencel-order">取消订单</div>
    <div class="append"></div>
</div>
<div class="mask"></div>

<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});

    //修改手机号
    $('.edit-mobile').on('click',function(){
        var types = $(this).html();
        if(types == '修改手机'){
            var mobile = $('.e-mobile').html(),
                    html = "<input type='text' class='edit-inputs' value= '"+ mobile +"' name='edit-mobile' />";
            $('.e-mobile').html(html);
            $('.edit-inputs').focus();
            $(this).html('提交修改');
        }else{
            var url = "<?php echo url('member/index/ajax_verifyMobileApply') ?>",
                    newMobile = $('.edit-inputs').val();
            $.post(url,{newMobile:newMobile},function(data){
                if(data){
                    var types = typeof(data);
                    console.log(data);
                    if(types == 'string'){
                        alert('手机号修改失败，失败原因：' + data);
                    }else{
                        alert('手机号修改成功');
                        window.location.href;
                    }
                }
            },'json');
        }


    });

    //修改邮箱
    $('.edit-email').on('click',function(){
        var types = $(this).html();
        if(types == '修改邮箱'){
            var email = $('.e-email').html(),
                    html = "<input type='text' class='edit-e' value= '"+ email +"' name='edit-e' />";
            $('.e-email').html(html);
            $('.edit-e').focus();
            $(this).html('提交修改');
        }else{
            var url = "<?php echo url('member/index/ajax_verifyEmail') ?>",
                    newEmail = $('.edit-e').val();
            $.post(url,{newEmail:newEmail},function(data){
                if(data){
                    var types = typeof(data);
                    console.log(data);
                    if(types == 'string'){
                        alert('邮箱修改失败，失败原因：' + data);
                    }else{
                        alert('邮箱修改成功');
                        window.location.href;
                    }
                }
            },'json');
        }


    });

    //修改密码
    $('.edit-pwd-button').on('click',function(){
        $(this).val('修改中,请稍后。');
        var url = "<?php echo url('member/account/resetpassword') ?>",
               oldpassword = $('.oldpassword').val(),
               newpassword = $('.newpassword').val(),
               newpassword1 = $('.newpassword1').val();
        if(newpassword != newpassword1){
            $.tips({
                icon:'error',
                content:'两次密码输入不一致',
                callback:function() {}
            });
            $('.edit-pwd-button').val('确认');
            return;
        }
        if(newpassword == oldpassword){
            $.tips({
                icon:'error',
                content:'新旧密码相同',
                callback:function() {}
            });
            $('.edit-pwd-button').val('确认');
            return;
        }
        $.post(url,{oldpassword:oldpassword,newpassword:newpassword,newpassword1:newpassword1},function(data){
                if(data){
                    $('.edit-pwd-button').val('确认');
                    alert(data);
                }else{
                    alert('密码修改成功！');
                    window.location.href = "<?php echo url('member/public/login') ?>";
                }

        },'json');
    });


    //时间搜索订单
    $('.ad-select-oeder').on('click',function(){
        var url = "<?php echo url('member/index/ajax_order') ?>",
                arr = $('.o-begin-date').html(),
                dep = $('.o-end-date').html();
        $.post(url,{arr:arr,dep:dep},function(data){
            if(data == ''){
                alert('此日期区间内暂无订单信息');
            }else{
                $('.ajax-order').nextAll().empty();
                for(var i=0; i < data.length;i++){
                    if(data[i]['sta'] == 'R'){
                        var cencel = "/<a class='text-gray-666 cencel-order' date-crsno='" + data[i]['crsNo'] + "' href='javascript:;'>取消订单</a>";
                    }else{
                        var cencel = '';
                    }
                    var html =
                            "<tr  class='bg-gray-white text-gray-666'>" +
                            "<td>" + data[i]['crsNo'] +"</td>" +
                            "<td>" + data[i]['hotelDescript'] + "</td>" +
                            "<td>" + data[i]['rmtypeDescript'] + "</td>" +
                            "<td>&yen;" + data[i]['rate'] + "</td>" +
                            "<td>" + data[i]['arr'] + "</td>" +
                            "<td>" + data[i]['dep'] + "</td>" +
                            "<td>" + data[i]['staDescript'] + "</td>" +
                            "<td><a class='text-gray-666' onclick='var _this = $(this); details(_this)' date-crsno='" +data[i]['crsNo'] +"' href='javascript:;'>查看详情</a>" +
                            cencel +
                            "</td></tr>";
                    $('.o-list table').append(html);
                }
            }
        },'json');
    });

    //时间搜索积分
    $('.ad-select-scroce').on('click',function(){
        var url = "<?php echo url('member/index/ajax_scroce') ?>",
                arr = $('.s-begin-date').html(),
                dep = $('.s-end-date').html();
        $.post(url,{arr:arr,dep:dep},function(data){
            if(data.length == 0 ){
                $.tips({
                    icon:'error',
                    content:'此日期区间内暂无积分信息',
                    callback:function() {}
                });
            }else{
                $('.ajax-scroce').nextAll().empty();
                for(var i=0; i<data.length;i++){
                    var html = "<tr  class='bg-gray-white text-gray-666'>" +
                            "<td>" + data[i]['pointGenDate'] + "</td>" +
                            "<td>" + data[i]['invalidDate'] + "</td>" +
                            "<td>" + data[i]['point'] + "</td>" +
                            "<td>" + data[i]['src'] + "</td>" +
                            "</tr>";
                    $('.s-msg table').append(html);
                }

            }
        },'json');
    });

    //取消订单
    $('.cencel-order').on('click',function(){
        if(confirm('您确定要取消此订单吗？')){
            var url = "<?php echo url('member/index/ajax_cencel_order') ?>",
                    crs = $(this).attr('date-crsno');
            $.post(url,{crs:crs},function(data){
                var type = typeof(data);
                if(type == 'string'){
                    $.tips({
                        icon:'error',
                        content:'订单取消失败,失败原因：\n' + data,
                        callback:function() {}
                    });
                }else{
                    alert('订单取消成功');
                    window.location.href =  "<?php echo url('member/index/index',array('edit'=>'pedit')) ?>";
                }
            },'json');
        }
    });

    //查看订单详情
    $('.order-details').on('click',function(){
        var _this = $(this);
        details(_this);
    });


    function details(_this){
        var crsNo = _this.attr('date-crsno'),
                url = "<?php echo url('member/index/ajax_orderDetail') ?>";
        $.post(url,{crsNo:crsNo},function(data){
            if(data){
                $('.order-rsno').html(data['crsNo']);
                $('.order-hotelname').html(data['hotelDescript']);
                $('.order-status').html(data['staDescript']);
                $('.order-rmtype').html(data['rmtypeDescript']);
                $('.order-arr').html(data['arr']);
                $('.order-dep').html(data['dep']);
                $('.order-name').html(data['rsvMan']);
                $('.order-idno').html(data['idNo']);
                $('.order-mobile').html(data['mobile']);
                if(data['rmNum'] == ""){
                    data['rmNum'] = 0;
                }
                $('.rmNum').html(data['rmNum']);
                $('.remark').html(data['remark']);
                $('.close').attr({'date-status': data['sta']});

                if(data['sta'] != 'R'){
                    $('.dialong .cencel-order').remove();
                    $('.dialong table').css({ 'margin-top': '80px'});
                }
                $('.res-step-next').attr({ 'date-crsno' : data['crsNo']});
                $('.dialong').show();
                $('.mask').show();
            }else{
                $.tips({
                    icon:'error',
                    content:'查询错误，请稍后。。。',
                    callback:function() {}
                });
            }
        },'json');
    }

    $('.close').on('click',function(){
        $('.dialong').hide();
        $('.mask').hide();
        var status = $(this).attr('date-status');
        var cunz = $('.cencel-order').html();
        if(status != 'R' && cunz){
            var html = '<div class="res-step-next cencel-order">取消订单</div>';
            $('.append').append(html);
            $('.dialong table').css({ 'margin-top': '44px'});
        }

    })

    //左边菜单点击 右边显示
    $('.people-center').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.center-left ul li ').not($(this)).css({'color': '#666666'});
        $('.center-right .p-center').show();
        $('.center-right .o-list').hide();
        $('.center-right .s-msg').hide();
        $('.center-right .c-list').hide();
    });
    $('.order-list').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.center-left ul li ').not($(this)).css({'color': '#666666'});
        $('.center-right .p-center').hide();
        $('.center-right .o-list').show();
        $('.center-right .s-msg').hide();
        $('.center-right .c-list').hide();
    });
    $('.score-msg').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.center-left ul li ').not($(this)).css({'color': '#666666'});
        $('.center-right .p-center').hide();
        $('.center-right .o-list').hide();
        $('.center-right .s-msg').show();
        $('.center-right .c-list').hide();
    });
    $('.edit-password').on('click',function(){
        $(this).css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.center-left ul li ').not($(this)).css({'color': '#666666'});
        $('.center-right .p-center').hide();
        $('.center-right .o-list').hide();
        $('.center-right .s-msg').hide();
        $('.center-right .c-list').show();
    });

    var edit_order = $('.edit-order').val();
    if(edit_order == 'pedit'){
        $('.order-list').css({'font-weight' : 'bold', 'color' : '#00447c'});
        $('.center-left ul li ').not($('.order-list')).css({'color': '#666666'});
        $('.center-right .p-center').hide();
        $('.center-right .o-list').show();
        $('.center-right .s-msg').hide();
        $('.center-right .c-list').hide();
    }
</script>
