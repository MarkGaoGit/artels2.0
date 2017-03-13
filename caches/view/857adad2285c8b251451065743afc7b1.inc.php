<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=VjoTDAqKTwpkWWOet6fKibt6t5UwuHjM"></script>
<script>
    $('title').html('查询酒店列表');
</script>
<!--面包屑-->
<div class="container crumbs clearfix">
</div>
<!--list-->
<div class="item-two-column container clearfix margin-bottom">
            <div class="margin-bottom item-blue-top room-list">
                <div class="item-title padding-left fff">
                    <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
                    <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;酒店预订</span>
                </div>
                    <div class='content reserve'>
                        <ul>
                            <form action='index.php?m=goods&c=index&a=lists' method='post' name='check'>
                                <li>
                                    <span>入住城市</span> <br/>
                                    <input type='text' name='list-city' value="<?php echo $post['nav-city'] ? $post['nav-city'] : ($post['list-city'] ? $post['list-city'] : $post['city'])  ; ?>" id='city'  autocomplete="off" />
                                    <input type='hidden' name='list-citys' value="<?php echo $post['nav-citys'] ? $post['nav-citys'] : ($post['citys'] ? $post['citys'] : $post['list-citys']); ?>" class="list-citys" autocomplete="off" />
                                    <span class='icon-add icon'></span>
                                    <div class="hotel-add text-default">
                                        <ul style="width:200px;">
                                            <?php if(is_array($city)) foreach($city as $r) { ?>                                            <li city-code="<?php echo $r['cityCode'];?>"><?php echo $r['name'];?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <span>入住时间</span><br/>
                                    <input type='text' name='check-time' value="<?php echo $post['check-time']?>"  onClick="$('.select-hotel-button').removeAttr('disabled'); WdatePicker({minDate:'%y-%M-{%d}'})" autocomplete="off" id='reserve-check-time' >
                                    <span class='icon-time icon ' ></span>
                                </li>
                                <li>
                                    <span>退房时间</span><br/>
                                    <input type='text' name='checkout-time' value="<?php echo $post['checkout-time']?>" onClick="$('.select-hotel-button').removeAttr('disabled'); WdatePicker({minDate:'%y-%M-{%d}'})" autocomplete="off" id='reserve-checkout-time' >
                                    <span class='icon-time icon' ></span>
                                </li>
                                <li>
                                    <input type='submit' name='button' value='搜 索' onClick="selectChick()" class='check select-hotel-button'/>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            <div class="city-hotel-number text-left text-default">当前城市，为您找到<span class="text-money">
                <?php if($hotelNum) { ?>
                    <?php echo $hotelNum;?>
                <?php } else { ?>
                    <?php echo $hotelListNum;?>
                <?php } ?>
            </span>家酒店</div>

            <div class="fl right goods-list-wrap">
                <!--属性选择-->
                <div class="  item-blue-top selected-type">
                    <div class="list-type-selected clearfix">
                        <?php if(!empty($brands)) { ?>
                        <!--<dl class="item-type hidden">-->
                            <!--<dt>品牌：</dt>-->
                            <!--<dd class="type-name">-->
                                <?php if($_GET['brand_id']) { ?>
                                <!--<a class="hidden" href="<?php echo create_url('brand_id', 0);?>">全部</a>-->
                                <?php } else { ?>
                                <!--<a class="hidden selected" href="javascript:void(0)">全部</a>-->
                                <?php } ?>
                                <!--<?php foreach ($brands AS $brand):?>-->
                                <?php if($_GET['brand_id']==$brand['id']) { ?>
                                <!--<a class="hidden selected" href="javascript:void(0)"><?php echo $brand['name'];?></a>-->
                                <?php } else { ?>
                                <!--<a class="hidden" href="<?php echo create_url('brand_id', $brand['id']);?>"><?php echo $brand['name'];?></a>-->
                                <?php } ?>
                                <!--<?php endforeach?>-->
                            <!--</dd>-->
                            <!--<dd class="more"></dd>-->
                        <!--</dl>-->
                        <?php } ?>
                        <?php if($grades) { ?>
                        <dl class="item-type hidden">
                            <dt>价格：</dt>
                            <dd class="type-name">
                                <?php if($_GET['price']) { ?>
                                <a class="hidden" href="<?php echo create_url('price', '');?>">全部</a>
                                <?php } else { ?>
                                <a class="hidden selected" href="javascript:void(0)">全部</a>
                                <?php } ?>
                                <?php
$current = current($grades);
$end = end($grades);
?>
                                <?php if($current[0] > 1) { ?>
                                <?php $max_price = $current[0] - 1;?>
                                <?php if($_GET['price'] == '0,'.$max_price) { ?>
                                <a class="hidden selected" href="javascript:void(0)"><?php echo $max_price;?>以下</a>
                                <?php } else { ?>
                                <a class="hidden" href="<?php echo create_url('price', '0,'.$max_price);?>"><?php echo $max_price;?>以下</a>
                                <?php } ?>
                                <?php } ?>
                                <?php foreach ($grades AS $grade):?>
                                <?php if($_GET['price'] == implode(',',$grade)) { ?>
                                <a class="hidden selected" href="javascript:void(0)"><?php echo $grade[0].'-'.$grade[1];?></a>
                                <?php } else { ?>
                                <a class="hidden" href="<?php echo create_url('price', implode(',',$grade));?>"><?php echo $grade[0].'-'.$grade[1];?></a>
                                <?php } ?>
                                <?php endforeach?>
                                <?php $min_price = $end[1] + 1;?>
                                <?php if($_GET['price'] == $min_price.',0') { ?>
                                <a class="hidden selected" href="javascript:void(0)"><?php echo $min_price;?>以上</a>
                                <?php } else { ?>
                                <a class="hidden" href="<?php echo create_url('price', $min_price.',0');?>"><?php echo $min_price;?>以上</a>
                                <?php } ?>
                            </dd>
                            <dd class="more"></dd>
                        </dl>
                        <?php } ?>
                        <?php
	$taglib_goods_type = new taglib('goods','type');
	$data = $taglib_goods_type->lists(array('catid'=>$_GET[id]), array('limit'=>'20','cache'=>'97fc4d5ca6f1de52b84a71f247a6485b,3600'));
?>
                        <?php $attrs = array_keys($data);?>
                        <?php if(is_array($data)) foreach($data as $k => $r) { ?>                        <?php if($r[search] == 1) { ?>
                        <!--<dl class="item-type hidden">-->
                            <!--<dt><?php echo $r['name'];?>：</dt>-->
                            <!--<dd class="type-name">-->
                                <?php if($_GET['attr'][$k]) { ?>
                                <!--<a class="hidden" href="<?php echo create_url($k, '', $attrs);?>">全部</a>-->
                                <?php } else { ?>
                                <!--<a class="hidden selected" href="javascript:void(0)">全部</a>-->
                                <?php } ?>
                                <?php if(is_array($r['value'])) foreach($r['value'] as $v) { ?>                                <?php if($_GET['attr'][$k] != base_encode($v)) { ?>
                                <!--<a class="hidden" href="<?php echo create_url($k, $v, $attrs);?>"><?php echo $v;?></a>-->
                                <?php } else { ?>
                                <!--<a class="hidden selected" data-status="true" href="javascript:void(0)"><?php echo $v;?></a>-->
                                <?php } ?>
                                <?php } ?>
                            <!--</dd>-->
                            <!--<dd class="more"></dd>-->
                        <!--</dl>-->
                        <?php } ?>
                        <?php } ?>
                        
                        <?php
	$taglib_goods_type = new taglib('goods','type');
	$data = $taglib_goods_type->specs(array('catid'=>$_GET[id]), array('limit'=>'20','cache'=>'cab80832137833e431746b4f5028c511,3600'));
?>
                        <!--<?php $spec= array_keys($data);?>-->
                        <?php if(is_array($data)) foreach($data as $k => $r) { ?>                        <!--<dl class="item-type hidden">-->
                            <!--<dt><?php echo $r['name'];?>：</dt>-->
                            <!--<dd class="type-name">-->
                                <?php if($_GET['attr'][$k]) { ?>
                                <!--<a class="hidden" href="<?php echo create_url($k, '', $spec);?>">全部</a>-->
                                <?php } else { ?>
                                <!--<a class="hidden selected" href="javascript:void(0)">全部</a>-->
                                <?php } ?>
                                <?php if(is_array($r['value'])) foreach($r['value'] as $v) { ?>                                <?php if($_GET['attr'][$k] != base_encode($v)) { ?>
                                <!--<a class="hidden" href="<?php echo create_url($k, $v, $spec);?>"><?php echo $v;?></a>-->
                                <?php } else { ?>
                                <!--<a class="hidden selected" data-status="true" href="javascript:void(0)"><?php echo $v;?></a>-->
                                <?php } ?>
                                <?php } ?>
                            <!--</dd>-->
                            <!--<dd class="more"></dd>-->
                        <!--</dl>-->
                        <?php } ?>
                        
                    </div>
                </div>
                <!--筛选-->
                <!--商品列表-->
                <div class="list-wrap">
                    <ul class="list-h clearfix">
                        <?php if(is_array($hotelList)) foreach($hotelList as $r) { ?>                        <li class="fl">
                            <div class="lh-wrap hidden-border" style="height:240px;<?php if($r['is_open'] != 1){echo 'border-bottom:1px solid #eee';}?> ">
                                <div class=" fl p-img">
                                    <a href="<?php if($r['is_open'] != 1) { ?>javascript:;<?php } else { ?><?php echo url('goods/index/hotelDetail',array('cat_id'=>$r['catid'],'sid' => $r['id']));?><?php } ?>">
                                        <img class="lazy" src="<?php echo SKIN_PATH;?>statics/images/lazy.gif" width="300" height="180" data-original="<?php echo thumb($r['thumb'],500,500)?>" />
                                    </a>

                                </div>
                                <div class="fl hotel-add-name">
                                    <h3 class="strong"><?php echo $r['name'];?></h3>
                                    <p class="hotel-address"><?php echo $r['description'];?></p>
                                    <p>咨询电话：<?php echo $r['hotel_mobile'];?></p>
                                    <p><?php echo $r['keyword'];?></p>
                                </div>
                                <div class="fr hotel-msg <?php if($r['is_open'] != 1) { ?> text-center text-big <?php } else { ?> text-right text-default<?php } ?>">
                                    <?php if($r['is_open'] != 1) { ?>
                                         <span class="show" style="margin-top:60px;">敬请期待</span>
                                    <?php } else { ?>
                                        <p class="night-right ">会员每晚最低</p>
                                        <span class="price text-right">&yen;
                                            <span class="strong text-large text-money">
                                                <?php if($r['minp']) { ?>
                                                    <?php echo $r['minp'];?>
                                                <?php } else { ?>
                                                    <?php echo $minPrice;?>
                                                <?php } ?>
                                                </span>
                                        </span>

                                        <a href="<?php echo url('goods/index/hotelDetail',array('cat_id'=>$r['catid'],'sid' => $r['id']));?>"><span class="see-msg text-center fr">查看详情</span></a>

                                    <?php } ?>
                                </div>
                                <?php if($r['is_open'] != 1) { ?><?php } else { ?>
                                    <div class="hotel-hidden-msg show fl text-default">
                                    <table width="788" cellpadding="18"  class="text-center">
                                        <tr class="bg-gray-e6 t-header" >
                                            <td class="text-left">房型</td>
                                            <td>活动</td>
                                            <td>早餐</td>
                                            <td>房价</td>
                                            <td></td>
                                        </tr>

                                        <?php if(count($r['msg']) >0) { ?>
                                            <?php if(is_array($r['msg'])) foreach($r['msg'] as $ddt) { ?>                                                <tr class="border-bottom">
                                                    <td  class="text-left">
                                                        <?php echo $ddt['descript'];?>
                                                    </td>
                                                    <td>会员</td>
                                                    <td><?php if($ddt['packages'] == 1) { ?>
                                                            单早
                                                        <?php } elseif($ddt['packages'] == 2) { ?>
                                                            双早
                                                        <?php } else { ?>
                                                            无
                                                        <?php } ?></td>
                                                    <td class="text-money">&yen;
                                                        <?php if($ddt['rate1']) { ?>
                                                            <?php echo $ddt['rate1'];?>
                                                        <?php } else { ?>
                                                            <?php echo $ddt['E3PNH'];?>
                                                        <?php } ?>
                                                    </td>
                                                    <input type="hidden" class="rmtype" value="<?php echo $ddt['rmtype'];?>">
                                                    <td class="t-left"><span><a href="<?php echo url('order/order/reserveroom',array('rc' => $ddt['rmtype'],'rm' => $ddt['descript'],'hid' => $r['id']));?>">预订</a></span></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if(is_array($msg)) foreach($msg as $k => $d) { ?>                                                <tr class="border-bottom">
                                                    <td  class="text-left">
                                                        <?php echo $d['descript'];?>
                                                    </td>
                                                    <td>会员</td>
                                                    <td><?php if($d['packages'] == 1) { ?>
                                                            单早
                                                        <?php } elseif($d['packages'] == 2) { ?>
                                                            双早
                                                        <?php } else { ?>
                                                            无
                                                        <?php } ?></td>
                                                    <td class="text-money">&yen;
                                                        <?php if($d['rate1']) { ?>
                                                            <?php echo $d['rate1'];?>
                                                        <?php } else { ?>
                                                            <?php echo $d['E3PNH'];?>
                                                        <?php } ?>
                                                    </td>
                                                    <input type="hidden" class="rmtype" value="<?php echo $d['rmtype'];?>">
                                                    <td class="t-left"><span><a href="<?php echo url('order/order/reserveroom',array('rc' => $d['rmtype'],'rm' => $d['descript'],'hid' => $r['id']));?>">预订</a></span></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>


                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--分页-->

                <!--<div class="paging margin-top padding-tb clearfix" data-id="<?php echo $_GET['id'];?>" data-page="<?php echo $_GET['page'];?>">-->
                    <!--<?php echo $pages?>-->
                <!--</div>-->

            </div>
            <input type="hidden" name="city" class="now-city" value="<?php echo $_GET['city'] ?>">
            <div class="left fr">
                <!--地图部分-->
<div class="list-category border border-gray-white">
<div class="layout sp-category map" id="hotel-map">
</div>
</div>
<!--列表页广告-->
<?php
	$taglib_ads_ads = new taglib('ads','ads');
	$data = $taglib_ads_ads->lists(array('position'=>'2','order'=>'rand()'), array('limit'=>'1','cache'=>'612ad437dadd62937e96a65f2a22d621,3600'));
?>
<?php if(($data['list'])) { ?>
<div class="margin-top ad fl"><?php if(is_array($data['list'])) foreach($data['list'] as $r) { ?><?php if(empty($r['content'])) { ?>
<a href="javascript:;" >
<img src="<?php echo $data['defaultpic'];?>" />
</a>
<?php } else { ?>
<a href="<?php echo url('ads/index/adv_view',array('id'=>$r['id'],'url'=>$r['link']));?>" title="<?php echo $r['title'];?>">
<img src="<?php echo $r['content'];?>"/>
</a>
<?php } ?>
<?php } ?>
</div>
<?php } ?>

</div>

</div>

    <?php include template('artels-footer','common');?>

<script type="text/javascript" src="<?php echo __ROOT__ ?>statics/js/jquery.lazyload.js?v=<?php echo HD_VERSION;?>" ></script>

        <script>
          /*  $('#city').on('input',function(){
                var name = $(this).val();
                var url = "<?php echo url('goods/index/selectAdd');?>";
                $.post(url,{name:name},function(data){
                    $('.city-name').empty();
                    if(data){
                        for(var i = 0; i < data.length; i++){
                            $('.city-name').append("<li class='city-name-msg' onClick='citys("+i+")'>" + data[i].name + "</li>");
                        }
                        $('.hotel-add').css({ display : 'block' });
                    }
                },'json');
            });
            */

          function selectChick(){
              var citys = $('#city').val(),
                      checkTime = $('#reserve-check-time').val(),
                      checkTimeOut = $('#reserve-checkout-time').val();

              if(!citys || !checkTime || !checkTimeOut || checkTime > checkTimeOut){
                  alert('输入信息有误，请重新填写！');
                  $('.select-hotel-button').attr({'disabled':'true'});
              }
          }


          $('#city').on('focus',function(){
              $('.hotel-add').css({ display : 'block' });
              $('.select-hotel-button').removeAttr('disabled');
          });

          $('.hotel-add ul li').on('click' ,function(){
              var html = $(this).html(),
                      cityCode = $(this).attr('city-code');
              $('#city').val(html);
              $('.list-citys').val(cityCode);
              $('.hotel-add').css({ display : 'none' });
          });
            $('#reserve-check-time').on('focus',function(){
                $('.hotel-add').css({ display : 'none' });
            });

          //去除表格最后一栏的边框
          $('.hotel-hidden-msg table tr:last ').css({'border-bottom' : 'none'});

            /*酒店 房间 型号 价格 详细信息*/
            $('.room-type').on('click',function(){
                var status = $(this).children('i').attr('class');
                if(status == 'down'){
                    $(this).children('i').attr({ class: 'up'});
                    $('.hidden-border').removeClass('bor-bot');
                    $('.hidden-border').addClass('bor-botc');
                    $(this).parent().next('div').show();
                }else{
                    $(this).children('i').attr({ class : 'down'});
                    $('.hidden-border').addClass('bor-bot');
                    $('.hidden-border').removeClass('bor-botc');
                    $(this).parent().next('div').hide();
                }
            });
            $('.reserve .plus').on('click',function(){
                var roomNum = parseInt($('.reserve .room-num').val());
                var roomVal = roomNum + 1 ;
                $('.reserve .room-num').val(roomVal);
            });

            $('.reserve .minus').on('click',function() {
                var roomNum = parseInt($('.reserve .room-num').val());
                var roomVal = roomNum - 1;
                if (roomNum == 1) {
                    roomVal = 1;
                };
                $('.reserve .room-num').val(roomVal);
            });



            /*去除首页LOGO透明度*/
            $('.logo').css({'opacity' : '1'});

            /* 地图 */
            var city = $('.now-city').val();

            var map = new BMap.Map('hotel-map');                  // 创建Map实例
            map.centerAndZoom(city, 17);                          // 创建当前城市坐标
            map.enableScrollWheelZoom();                          //启用滚轮放大缩小
            map.addControl(new BMap.NavigationControl());
            map.addControl(new BMap.MapTypeControl());

            var localSearch = new BMap.LocalSearch(map);
            var hotelLeng = $('.list-h li').length;
            for(var i = 1; i <= hotelLeng; i++){
                var keyword = $('.list-h li:nth-child(' + i +') .hotel-address').html();
                maps(keyword);
            }

            function maps(keyword){
                localSearch.search(keyword);

                localSearch.setSearchCompleteCallback(function (searchResult) {
                    var poi = searchResult.getPoi(0);
                    map.centerAndZoom(poi.point, 17);
                    var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                    map.addOverlay(marker);
                    var content = poi.province + poi.title + "<br/>地址：" + poi.city + poi.address;
                    var infoWindow = new BMap.InfoWindow("<p class='text-default'>" + content + "</p>");
                    marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
                });
            }
        </script>

<script>
$(function(){

//点击到指订页
$(".paging .button").click(function(){
jump_to_page(this);
});
//回车到指订页
$(".paging input[name=page]").live('keyup',function(e){
if(e.keyCode == 13){
jump_to_page(this);
}
});

loadAfterAction();

//展示和隐藏更多属性
$(".item-type .more a").live('click',function(){
var _child = $(this).parent().prev(".type-name").children();
if(!$(this).hasClass("fold")){
$(this).html("收起").addClass("fold");
_child.removeClass("hidden");
}else{
$(this).html("更多").removeClass("fold");
_child.addClass("hidden").slice(0,11).removeClass("hidden");
}
return false;
});



//展示和隐藏更多属性选项
$(".more-type").live('click',function(){
if(!$(this).hasClass("fold")){
$(this).html("收起选项").addClass("fold");
$(".selected-type .item-type").removeClass("hidden");
}else{
$(this).html("更多选项").removeClass("fold");
$(".selected-type .item-type").addClass("hidden").slice(0,5).removeClass("hidden");
}
return false;
});

//				$(".list-h li").hover(function(){
//					$(this).addClass("hover");
//				},function(){
//					$(this).removeClass("hover");
//				});

//筛选条
filterBar();

})

//添加属性选择的更多
function loadAfterAction(){
var flog = true;
$(".item-type").each(function(){
if($(this).find("a[data-status]").length>0&&$(this).index()>4){
flog = false;
}
$(this).children(".type-name").find("a").slice(0,11).removeClass("hidden");
if($(this).children(".type-name").find("a").length>10){
$(this).children(".more").append('<a class="text-sub" href="">更多</a>');
}
});
if($(".item-type").length>5&&flog){
$(".item-type").slice(0,5).removeClass("hidden");
$(".selected-type").after('<a class="more-type" href="">更多选项</a>');
}else{
$(".item-type").removeClass("hidden");
}
}

//筛选条
function filterBar(){
$(window).scroll(function(){
var doctop = $(document).scrollTop();
var _head = $(".list-wrap").offset().top-41;
if(doctop <= _head){
$('.goods-list-wrap').removeClass('filter-bar');
}
if(doctop > _head){
$('.goods-list-wrap').addClass('filter-bar');
}
});
}
            $('.footer-70').css({top:'10px'});
            $('.artels-record').css({top:'10px'});
</script>

</body>
</html>
