<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<!--商品详情-->
<!--<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/detail.js?v=<?php echo HD_VERSION;?>" ></script>-->
<script type="text/javascript" src="<?php echo __ROOT__ ?>template/default/statics/js/jquery.jqzoom.js?v=<?php echo HD_VERSION;?>" ></script>
<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('title').html('酒店信息');
</script>

<!--面包屑-->
<div class="container crumbs clearfix"></div>


<div class="margin-bottom item-blue-top hotel-name content1200 ">
    <div class="item-title padding-left fff content1200">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;酒店预订</span>
    </div>
    <div class='content hotel-logo content1200'>
        <?php if($_GET['cat_id'] == 3) { ?>
        <img src="<?php echo $imgsrc;?>artelsjx.png" alt="">
        <?php } elseif($_GET['cat_id'] == 2) { ?>
        <img src="<?php echo $imgsrc;?>artels.png" alt="">
        <?php } elseif($_GET['cat_id'] == 4) { ?>
        <img src="<?php echo $imgsrc;?>yizhu.png" alt="">
        <?php } elseif($_GET['cat_id'] == 5) { ?>
        <img src="<?php echo $imgsrc;?>kezhan.png" alt="">
        <?php } elseif($_GET['cat_id'] == 44) { ?>
        <img src="<?php echo $imgsrc;?>junhotel.png" alt="">
        <?php } ?>
    </div>
</div>
<div class="margin-bottom item-blue-top content1200 banner-img">
    <img class="lazy" src="
            <?php if($_GET['sid'] == 5) { ?>
                <?php echo $imgsrc;?>qdyz-header.jpg
            <?php } elseif($_GET['sid'] == 6) { ?>
                <?php echo $imgsrc;?>axyz-header.jpg
            <?php } elseif($_GET['sid'] == 7) { ?>
                <?php echo $imgsrc;?>plkz-header.jpg
            <?php } ?>
            " alt="">
</div>

<div class="content1200 room-type-list">
    <ul>
        <?php if(is_array($msg)) foreach($msg as $k => $r) { ?>        <li>
            <!-- 11111111111111111111-->
            <?php if($k == 0) { ?>
            <div class="room-list-1 hotel-add-name fl">
                <h2><?php echo $hotel['name'];?></h2>
                <p class="hotel-address"><?php echo $hotel['description'];?></p>
                <p class="hotel_descript"><?php echo $hotel['hotel_descript'];?></p>
            </div>
            <?php } elseif($k == 1) { ?>
            <div class="room-list-4 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 6) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } ?>
                alt="">
            </div>
            <?php } elseif($k == 2) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 6) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 3) { ?>
            <div class="room-list-4 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 4) { ?>
            <div class="room-list-4 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 5) { ?>
            <div class="room-list-4 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } ?>

            <!--222222222222222222-->

            <?php if($k == 0) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 6) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 1 ) { ?>
            <div class="room-list-3 fl"
                 style="background:
                        <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                        <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #37966a
                        <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #7ecef4
                        <?php } ?>
                        ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #37966a
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #7ecef4
                                    <?php } ?>
                                    ;">
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } elseif($k == 2) { ?>
            <div class="room-list-4 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 6) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>4.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 3) { ?>
            <div class="room-list-3 fl"
                 style="background:
                        <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                        <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #ca3b44
                        <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #eb6ea5
                        <?php } ?>
                    ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #ca3b44
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #eb6ea5
                                    <?php } ?>
                                    ;" >
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } elseif($k == 4) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 5) { ?>
            <div class="room-list-3 fl"
                 style="background:
                        <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                         <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #6ba4d6
                        <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #7ecef4
                         <?php } ?>
                        ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #6ba4d6
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #7ecef4
                                    <?php } ?>
                                    ;"  >
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } ?>


            <!--3333333333333333333333333-->
            <?php if($k == 0) { ?>
            <div class="room-list-3 fl"
                 style="background:
                        <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                         <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #ca3b44
                         <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #f08307
                         <?php } ?>
                        ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #ca3b44
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #f08307
                                     <?php } ?>
                                    ;" >
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } elseif($k == 1) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 6) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 2) { ?>
            <div class="room-list-3 fl"
                 style="background:
                         <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                         <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #6ba4d6
                         <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #7fbe26
                         <?php } ?>
                         ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #6ba4d6
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #7fbe26
                                    <?php } ?>
                                    ;" >
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } elseif($k == 3) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } elseif($k == 4) { ?>
            <div class="room-list-3 fl"
                 style="background:
                        <?php if($_GET['cat_id'] == 5) { ?>
                            #d1be7b
                        <?php } elseif($_GET['cat_id'] == 4) { ?>
                            #37966a
                        <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                            #f08307
                        <?php } ?>
                        ;" >
                <p class=" text-big-big"><?php echo $r['descript'];?></p>
                <table height="60" width="290">
                    <tr>
                        <td>平均价格：<?php echo $r['avgRate1'];?></td>
                        <td>房间剩余：<?php echo $r['avail'];?>间</td>
                    </tr>
                    <tr>
                        <td>上网方式：<?php echo $hotel['keyword'];?></td>
                        <td>早餐：
                            <?php if($r['packages'] == 1) { ?>
                            单早
                            <?php } elseif($r['packages'] == 2) { ?>
                            双早
                            <?php } else { ?>
                            无
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <div class="money-check">
                        <span class="text-big">
                            &yen;
                            <strong class="text-large"><?php echo $r['rate1'];?></strong>
                        </span>
                    <a style="color:#f85738" href="<?php echo url('order/order/reserveroom',array('rc' => $r['rmtype'],'rm' => $r['descript'],'hid' => $_GET['sid'],'hotelMsg' => $_GET['hotelMsg']));?>">
                        <button class="check text-default strong"
                                style="color:
                                    <?php if($_GET['cat_id'] == 5) { ?>
                                        #d1be7b
                                    <?php } elseif($_GET['cat_id'] == 4) { ?>
                                        #37966a
                                    <?php } elseif($_GET['cat_id'] == 3 || $_GET['cat_id'] == 2) { ?>
                                        #f08307
                                    <?php } ?>
                                    ;" >
                            预订
                        </button>
                    </a>
                </div>
            </div>
            <?php } elseif($k == 5) { ?>
            <div class="room-list-2 fl">
                <img class="lazy" data-original=
                    <?php if($_GET['sid'] == 5) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } elseif($_GET['sid'] == 7) { ?>
                        <?php echo $imgsrc;?><?php echo $r['rmtype'];?><?php echo $hotel['id'];?>2.jpg
                    <?php } ?>
                    alt="">
            </div>
            <?php } ?>
        </li>

        <?php } ?>
    </ul>
</div>
<div class="clear"></div>

<div class="hotel-message content1200">
    <?php if($hotel['name'] == '青岛艺筑酒店') { ?>
    <div class="hotel-policy">
        <span class="policy strong text-default fl">酒店政策</span>
        <div class="message fl">
            <p class="text-big">儿童加床</p>
            <table height="30" width="700" >
                <tr>
                    <td class="border-b-t">儿童</td>
                    <td>在不加床的情况下免费入住。如果加床将按照成人标准收费，100元/张/天。</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="hotel-service">
        <div class="message fr">
            <table height="130" width="826">
                <tr>
                    <td class="w104 text-middle">基本设施</td>
                    <td>电梯  客房服务  免费停车场  免费WIFI  免费大堂公用电脑 220V交流电  120V交流电  浴缸（部分房间）  行李寄存  餐厅  会议室  棋牌室</td>
                </tr>
                <tr>
                    <td class="w104 text-middle">安全设施 </td>
                    <td>房间应急信息  房间消防系统  应急照明  防毒面罩</td>
                </tr>
                <tr>
                    <td class="w104 text-middle">商务设施</td>
                    <td>商务中心  传真机  复印机  投影仪</td>
                </tr>
            </table>
        </div>
        <span class="service strong text-default fl">设施服务</span>
    </div>
    <?php } elseif($hotel['name'] == '蓬莱宝龙客栈') { ?>
    <div class="hotel-service">
        <div class="message fr">
            <table height="130" width="826">
                <tr>
                    <td class="w104 text-middle">基本设施</td>
                    <td>电梯 客房服务 220付交流电 24小时不间断电源 餐厅 麻将套房 对客休闲上网区 行李免费寄存 免费停车场 24小时前台 免费有线及无线网络</td>
                </tr>
                <tr>
                    <td class="w104 text-middle">安全设施 </td>
                    <td>房间消防喷淋及烟感报警器 楼层消防栓及安全巡查扫描点位 应急照明指示 安全监控探头</td>
                </tr>
                <tr>
                    <td class="w104 text-middle">商务设施</td>
                    <td>复印机 电脑 传真机 </td>
                </tr>
            </table>
        </div>
        <span class="service strong text-default fl">设施服务</span>
    </div>
    <?php } elseif($hotel['name'] == '安溪艺筑酒店') { ?>
    <div class="hotel-policy">
        <span class="policy strong text-default fl">酒店政策</span>
        <div class="message fl">
            <p class="text-big">儿童加床</p>
            <p>•  12岁以上的儿童入住此酒店将按照大人标准收费。</p>
            <p>•  加床政策根据您所选定的客房而有所不同，更多详情欢迎来电垂询：0595-26230666。</p>
        </div>
    </div>
    <div class="hotel-service">
        <div class="message fr">
            <table height="130" width="826">
                <tr>
                    <td class="w104 text-middle">基本设施</td>
                    <td>电梯 保险箱 客房服务 220伏交流电 汽车停车场 室外停车场 安保 停车场24小时前台 室内停车场 高速网络 餐厅 自助洗衣房 大堂电脑区 自助咖啡 </td>
                </tr>
                <tr>
                    <td class="w104 text-middle">安全设施 </td>
                    <td>房间的应急信息 房间消防系统 应急照明 </td>
                </tr>
                <tr>
                    <td class="w104 text-middle">商务设施</td>
                    <td>复印机 打印机 投影机 传真机</td>
                </tr>
            </table>
        </div>
        <span class="service strong text-default fl">设施服务</span>
    </div>
    <?php } ?>

</div>
<!--<span class="content1200 strong text-default comment">酒店点评</span>-->

<!--<div class="comment-msg content1200">-->
<!--<div class="message fl">-->
<!--<ul>-->
<!--<li>-->
<!--<div class="user-info fl">-->
<!--<span class="user-header">-->
<!--<img src="<?php echo $imgsrc;?>big_goods_1.jpg" alt="">-->
<!--</span>-->
<!--<h5>用户呢称</h5>-->
<!--</div>-->
<!--<div class="user-comment text-small fr">-->
<!--<p>酒店位置一般，但进出方便，关键是性价比很高，价格比较划算，卫生和设施也很好，早餐品种很多，服务很人性化。</p>-->
<!--&lt;!&ndash; 一星 宽度 22 两星宽度46 三星宽度66 四星宽度86  五星宽度110&ndash;&gt;-->
<!--<i class="icon-star fl" style=" width:110px; height:16px;"></i>-->
<!--<span class="comment-time fr">2016-11-11 11:11</span>-->
<!--</div>-->
<!--</li>-->
<!--<li>-->
<!--<div class="user-info fl">-->
<!--<span class="user-header">-->
<!--<img src="<?php echo $imgsrc;?>big_goods_1.jpg" alt="">-->
<!--</span>-->
<!--<h5>用户呢称</h5>-->
<!--</div>-->
<!--<div class="user-comment text-small fr">-->
<!--<p>酒店位置一般，但进出方便，关键是性价比很高，价格比较划算，卫生和设施也很好，早餐品种很多，服务很人性化。</p>-->
<!--&lt;!&ndash; 一星 宽度 22 两星宽度46 三星宽度66 四星宽度86  五星宽度110&ndash;&gt;-->
<!--<i class="icon-star fl" style=" width:110px; height:16px;"></i>-->
<!--<span class="comment-time fr">2016-11-11 11:11</span>-->
<!--</div>-->
<!--</li>-->
<!--<li>-->
<!--<div class="user-info fl">-->
<!--<span class="user-header">-->
<!--<img src="<?php echo $imgsrc;?>big_goods_1.jpg" alt="">-->
<!--</span>-->
<!--<h5>用户呢称</h5>-->
<!--</div>-->
<!--<div class="user-comment text-small fr">-->
<!--<p>酒店位置一般，但进出方便，关键是性价比很高，价格比较划算，卫生和设施也很好，早餐品种很多，服务很人性化。</p>-->
<!--&lt;!&ndash; 一星 宽度 22 两星宽度46 三星宽度66 四星宽度86  五星宽度110&ndash;&gt;-->
<!--<i class="icon-star fl" style=" width:110px; height:16px;"></i>-->
<!--<span class="comment-time fr">2016-11-11 11:11</span>-->
<!--</div>-->
<!--</li>-->
<!--<li>-->
<!--<div class="user-info fl">-->
<!--<span class="user-header">-->
<!--<img src="<?php echo $imgsrc;?>big_goods_1.jpg" alt="">-->
<!--</span>-->
<!--<h5>用户呢称</h5>-->
<!--</div>-->
<!--<div class="user-comment text-small fr">-->
<!--<p>酒店位置一般，但进出方便，关键是性价比很高，价格比较划算，卫生和设施也很好，早餐品种很多，服务很人性化。</p>-->
<!--&lt;!&ndash; 一星 宽度 22 两星宽度46 三星宽度66 四星宽度86  五星宽度110&ndash;&gt;-->
<!--<i class="icon-star fl" style=" width:110px; height:16px;"></i>-->
<!--<span class="comment-time fr">2016-11-11 11:11</span>-->
<!--</div>-->
<!--</li>-->
<!--<li>-->
<!--<div class="user-info fl">-->
<!--<span class="user-header">-->
<!--<img src="<?php echo $imgsrc;?>big_goods_1.jpg" alt="">-->
<!--</span>-->
<!--<h5>用户呢称</h5>-->
<!--</div>-->
<!--<div class="user-comment text-small fr">-->
<!--<p>酒店位置一般，但进出方便，关键是性价比很高，价格比较划算，卫生和设施也很好，早餐品种很多，服务很人性化。</p>-->
<!--&lt;!&ndash; 一星 宽度 22 两星宽度46 三星宽度66 四星宽度86  五星宽度110&ndash;&gt;-->
<!--<i class="icon-star fl" style=" width:110px; height:16px;"></i>-->
<!--<span class="comment-time fr">2016-11-11 11:11</span>-->
<!--</div>-->
<!--</li>-->
<!--</ul>-->
<!--&lt;!&ndash;<div class="page fr">&ndash;&gt;-->

<!--&lt;!&ndash;</div>&ndash;&gt;-->
<!--</div>-->
<!--<div class="comment-dashboard fr">-->
<!--<div class="comment-e">-->
<!--<div class="bg"></div>-->
<!--<div id="rount" class="rount"></div>-->
<!--<div class="bg2"></div>-->
<!--<div id="rount2" class="rount2"></div>-->
<!--<div id="num" class="num">-->
<!--<span class="nums strong"></span>-->
<!--<span class="comment-nums">来自37早点评</span>-->
<!--</div>-->
<!--<input type="hidden" id="points" min="0" max="100" step="1" value="" />-->
<!--</div>-->
<!--<ul>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:80%;"></div>-->
<!--</div>-->
<!--<span class="fl">环境和清洁度</span>-->
<!--<span class="fr score c-ec text-middle strong">8.0</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:93%;"></div>-->
<!--</div>-->
<!--<span class="fl">位置</span>-->
<!--<span class="fr score c-ad text-middle strong">9.3</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:80%;"></div>-->
<!--</div>-->
<!--<span class="fl">服务</span>-->
<!--<span class="fr score c-se text-middle strong">8.0</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:90%;"></div>-->
<!--</div>-->
<!--<span class="fl">餐饮</span>-->
<!--<span class="fr score c-fo text-middle strong">9.0</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:90%;"></div>-->
<!--</div>-->
<!--<span class="fl">设施</span>-->
<!--<span class="fr score c-fa text-middle strong">9.0</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:76%;"></div>-->
<!--</div>-->
<!--<span class="fl">客房舒适度</span>-->
<!--<span class="fr score c-rc text-middle strong">7.6</span>-->
<!--</li>-->
<!--<li>-->
<!--<div class="comment-dimension">-->
<!--<div class="comment-bg" style="width:86%;"></div>-->
<!--</div>-->
<!--<span class="fl">性价比</span>-->
<!--<span class="fr score c-pr text-middle strong">8.6</span>-->
<!--</li>-->
<!--</ul>-->

<!--</div>-->
<!--</div>-->

<?php include template('artels-footer','common');?>

<script>

    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});
    var cEc = parseFloat($('.c-ec').html()),
            cAd = parseFloat($('.c-ad').html()),
            cSe = parseFloat($('.c-se').html()),
            cFo = parseFloat($('.c-fo').html()),
            cFa = parseFloat($('.c-fa').html()),
            cRc = parseFloat($('.c-rc').html()),
            cPr = parseFloat($('.c-pr').html());

    var avgScore = (( cEc + cAd + cSe + cFo + cFa + cRc + cPr ) / 7 ).toFixed(1);
    var avgScore1 = avgScore * 10;
    $('.nums').html(avgScore);
    $('#points').val(avgScore1);
    /*评价圆环*/
    function round(){
        var n = $('#points').val();
        if(n<=50){
            $('#rount').css({ webkitTransform : 'rotate(' + 3.6 * n + 'deg)' });
            $('#rount2').css({ display : 'none' });
        }else{
            $('#rount').css({ webkitTransform : 'rotate(180deg)' });
            $('#rount2').css({ display : 'block' });
            $('#rount2').css({ webkitTransform : 'rotate(' + 3.6 * (n-50) + 'deg)' });
        }
    }

    round();
</script>
