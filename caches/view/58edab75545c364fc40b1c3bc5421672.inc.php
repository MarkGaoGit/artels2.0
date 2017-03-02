<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('header', 'common'); ?>
<?php include template('artels-menu-header', 'common'); ?>
<script type="text/javascript" src="<?php echo SKIN_PATH;?>statics/js/booking.js?v=<?php echo HD_VERSION;?>"></script>

<section class="container text-left hotel-booking">
    <div class="baseline hd-h4">
        <h3 class="text-main hd-h2 margin">酒店预订 BOOKING</h3>

        <form action="<?php echo url('order/order/orderAdd');?>" method="post" class="booking">
            <select name="hotel-list" id="hotel-list"  class="input-box" style="height:53px;">
                <option value="defaults">酒店 Hotels </option>
                <?php if(is_array($hotelList)) foreach($hotelList as $r) { ?>                    <?php if($r['name'] != "海阳宝龙度假酒店") { ?>
                        <option value="<?php echo $r['subtitle'];?>|<?php echo $r['name'];?>" data-mobile="<?php echo $r['hotel_mobile'];?>" ><?php echo $r['name'];?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <select name="rmtype" id="room-list" class="input-box" style="height:53px;"><option value="defaults">房间 Room </option></select>
            <input type="hidden" name="hotelMobile" class="hotel-mobile">

            <span class="mui-icon icons mui-icon-location-filled"></span>

            <button id='check-in-time'  data-options='{"type":"date","beginYear":2016,"endYear":2115}' class="btn padding-left-15 margin-bottom-15 mui-btn mui-btn-block hd-h4 input-box text-left">入住时间</button>
            <span class="mui-icon-extra mui-icons-times1 icons mui-icon-extra-calendar" ></span>

            <input type="hidden"  name="arr" class="check-in-time" value="">
            <input type="hidden"  name="dep" class="check-out-time" value="">

            <button id='check-out-time'  data-options='{"type":"date"}' class="btn padding-left-15 margin-bottom-15 mui-btn mui-btn-block hd-h4 input-box text-left">退房时间</button>
            <span class="mui-icon-extra mui-icons-times2 icons mui-icon-extra-calendar" ></span>

            <div class="mui-input-row input-box bg-white margin-bottom-15" >
                <label>客房 Rooms</label>
                <div class="mui-numbox" data-numbox-min="1" data-numbox-max="5">
                    <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                    <input class="mui-input-numbox" name="rmNum"  type="number" />
                    <button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
                </div>
            </div>
            <div class="mui-input-row input-box bg-white margin-bottom-15">
                <label>成人 Adults</label>
                <div class="mui-numbox" data-numbox-min="1">
                    <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                    <input class="mui-input-numbox" name="c_num"  type="number" />
                    <button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
                </div>
            </div>
            <div class="mui-input-row input-box bg-white margin-bottom-15" >
                <input type="text" name="m-name" class="m-name" placeholder="入住人姓名">
            </div>
            <div class="mui-input-row input-box bg-white margin-bottom-15" >
                <input type="text" name="mobile" value="<?php echo $_SESSION['userInfo']['mobile'];?>" placeholder="入住人电话">
            </div>
            <div class="mui-input-row input-box bg-white margin-bottom-15" >
                <input type="text" name="rev" value="<?php echo $_GET['hotelMsg'];?><?php echo $_GET['roomnumbers'];?><?php echo $_GET['rm'];?>" placeholder="备注">
            </div>
            <input type="hidden" name="hotelId" value="" class="hotelid">
            <input type="hidden" name="id_no" value="<?php echo $_SESSION['userInfo']['idNo'];?>" >
            <input type="submit" class="yd-btn input-box booking-btn" value="预订 BOOKING">
        </form>

    </div>
</section>
<?php include template('artels-menu-footer', 'common'); ?>
</body>
</html>
