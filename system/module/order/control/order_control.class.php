<?php
/**
 * 		前台订单控制器
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
Core::load_class('init','goods');
class order_control extends init_control {

    public function _initialize() {
        parent::_initialize();
        if ($this->member['id'] == 0) {
            $url_forward = $_GET['url_forward'] ? $_GET['url_forward'] : urlencode($_SERVER['REQUEST_URI']);
            showmessage(lang('_not_login_'), url('member/public/login',array('devs' => 'pc','url_forward'=>$url_forward)),0);
        }
        $this->table = $this->load->table('order/order');
        $this->service = $this->load->service('order/order');
        $this->service_cart = $this->load->service('order/cart');
        $this->service_delivery = $this->load->service('order/delivery');
        $this->spu_db = $this->load->table('goods/goods_spu');
        $this->api = $this->load->service('goods/api');
        $this->memcache = $this->load->service('goods/memcache');
        $this->wechat = $this->load->service('member/wechatapi');
        $this->member_model = $this->load->table('member/member');
    }

    /*
     *酒店房间预订
     * */
    public function reserveroom(){

        $get = $_GET;
        if($get['hid']){
            $hid = $get['hid'];
            $map['id'] = $hid;
            $hotelMsgJson = $this->memcache->get( 'hotelMsg'.$hid );
            $hotelMsg = json_decode($hotelMsgJson, true);
        }elseif($get['hotelMsg']){
            $hotelName = $get['hotelMsg'];
            $map['name'] = $hotelName;
            $hotelMsgJson = $this->memcache->get( 'hotelMsg'.$hotelName );
            $hotelMsg = json_decode($hotelMsgJson, true);
        }

        if( empty($hotelMsg) ){
            $hotelMsg = $this->spu_db->where($map)->find();
            $hotelMsgJson = json_encode($hotelMsg);
            $types = $get['hid'] ? $get['hid'] : $hotelName;
            $this->memcache->set( 'hotelMsg'.$types, $hotelMsgJson, false );
        }


        $name = $hotelMsg['name'];
        $rc = $get['rc'];
        $rtype = $this->api->resultApi($rc);

        $lvyunHotel = $this->memcache->get( 'lvyunHotelList' );
        $hlist = json_decode( $lvyunHotel, true );
        if( !$hlist ){
            $hlist = $this->api->webSyncHotel();
            $data = json_encode($hlist);
            $this->memcache->set('lvyunHotelList' , $data, false, 1200);
        }
        $nameList = $hlist['hotelList'];
        foreach($nameList as $k=>$v){
            if($nameList[$k]['descript'] == $name){
                $hotelIds = $nameList[$k]['id'];
            }
        }

        $SEO = seo('预订房间');
        $this->load->librarys('View')->assign('hotelIds' , $hotelIds);
        $this->load->librarys('View')->assign('rtype' , $rtype);
        $this->load->librarys('View')->assign('hotelMsg' , $hotelMsg);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('reserveroom');
    }

    /*
     * 提交预定订单
     * **/
    public function orderAdd(){
        $post = $_POST;
        $mobileObject = new mobile;
        //手机端的时间与姓名处理
        $post['m-name'] ? $name = $post['m-name'] : $name = $post['surname'] . $post['names'];
        if($post['m-name']){
            $post['arr'] = $post['arr'] .'+';
            $post['dep'] = $post['dep'] .'+';
        }
        $hotelNameStr = explode( '|', $post['hotel-list'] );
        $hotelName = $hotelNameStr[1];

        //处理手机订单的价格 和房间类型
        if( strpos( $post['rmtype'] , '*') ){
            $rmTypePrice = explode( '*' , $post['rmtype'] );
            $type = $rmTypePrice[0];    //房型
            $roomDes = $rmTypePrice[1]; //房型的中文
            $roomPrice = (float)$rmTypePrice[2];   //房间单日价格
        }else{
            $type = $post['rmtype']; //PC端
        }

        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['arr'] = $post['arr'] . '18%3A00%3A00';
        $data['dep'] = $post['dep'] . '14%3A00%3A00';
        $data['rmtype'] = $type;
        $data['rateCode'] = $_SESSION['userInfo']['rateCode'] ;
        $data['rmNum'] = $post['rmNum'];
        $data['rsvMan'] = $name;
        $data['mobile'] = $post['mobile'];
        $data['idNo'] = $post['id_no'];
        $data['cardNo'] = $_SESSION['userInfo']['cardNo'] ;
        $data['adult'] = $post['c_num'];
        $data['remark'] = $post['rev'];
        $data['hotelIds'] = $post['hotelId'];

        $order_number = $this->api->book($data);
        if($order_number['resultCode'] !=0){
            if( $mobileObject->isMobile() ){
                $url = url('goods/index/booking');
            }else{
                $url = url('goods/index/index');
            }
            showmessage($order_number['resultMsg'],$url );
        }elseif($post['m-name']){
            $this->load->librarys('View')->assign('order_msg',$order_number);
            $this->load->librarys('View')->assign('post',$_POST);
            $this->load->librarys('View')->display('order_add_ok');
        }

        //发送微信模板消息
//        if( $mobileObject->isMobile() && ){} 是否是手机 并且是否是微信
        $arr = strtotime( substr( $post['arr'], 0, strlen( $post['arr'] ) -1 ) );
        $dep = strtotime( substr( $post['dep'], 0, strlen( $post['dep'] ) -1 ) );
        ( $dep - $arr ) / 3600 / 24 > 0 ? $day = ( $dep - $arr ) / 3600 / 24  : $day = 1;
        $orderPrice = (int)$day * (int)$post['rmNum'] * $roomPrice;     //几天 X 房间数 X 单价
        $map['cardNo'] = $_SESSION['userInfo']['cardNo'] ;
        $usermsg = $this->member_model->where($map)->find();

        $sendData = array();
        $sendData['touser'] = $usermsg['openid'];
        $sendData['url'] = 'http://new.artels.cn/index.php?m=member&c=index&a=ajax_orderDetail&type=details&crs=' . $order_number['crsNo'];
        $sendData['topcolor'] = '#FF0000';
        $sendData['data']['first']['value'] = '您已成功预订' . $hotelName . '！';
        $sendData['data']['order']['value'] = $order_number['crsNo'];
        $sendData['data']['Name']['value'] = $name;
        $sendData['data']['datein']['value'] = substr( $post['arr'], 0, strlen( $post['arr'] ) -1 );
        $sendData['data']['dateout']['value'] = substr( $post['dep'], 0, strlen( $post['dep'] ) -1 );
        $sendData['data']['number']['value'] = $post['rmNum'];
        $sendData['data']['roomtype']['value'] = $roomDes;
        $sendData['data']['pay']['value'] = $orderPrice;
        $sendData['data']['remark']['value'] = '房间将保留置入住当日XXXXXX,如需修改或取消订单,请联系客服400-XXX-XXX。';

        $this->wechat->sendWecahtTmpMsg( $sendData, 1 );

        //加入了绿云订单到UCenter
        include_once DOC_ROOT . 'config.inc.php';
        include_once DOC_ROOT . 'uc_client/client.php';
        $data['arr'] = $post['arr'];
        $data['dep'] = $post['dep'];
        $data['order_number'] = $order_number['crsNo'];
        $uc_order_id = uc_lvyun_order($data);


    }

    /* 购物车结算 */
    public function settlement() {
        // 会员收货地区id，便于加载配送物流
        $district_id = $this->member['_address'][0]['district_id'];
        $skuids = $_GET['skuids'];
        if (isset($_GET['district_id']) && is_numeric($_GET['district_id'])) {
            $district_id = (int) $_GET['district_id'];
        }
        $pay_type = (int) $_GET['pay_type'];
        $deliverys = (array) $_GET['deliverys'];
        $order_prom = (array) $_GET['order_prom'];
        $sku_prom = (array) $_GET['sku_prom'];
        $remarks = (array) $_GET['remarks'];
        $invoices = (array) $_GET['invoices'];
        // 购物车商品
        $carts =  $this->service->create($this->member['id'], $skuids , $district_id, $pay_type, $deliverys, $order_prom, $sku_prom, $remarks, $invoices, false);
        if (empty($carts)) showmessage(lang('order/clearing_goods_no_exist'),url('member/order/index', array('type' => 1)));
        // 收货地址
        $address = $this->member['_address'];
        foreach ($address as $k => $val) {
            $area = $this->load->service('admin/district')->fetch_position($val['district_id']);
            $address[$k]['_area'] = $area[2].' '.$area[3];
        }
        // 读取后台设置
        $setting = $this->load->service("admin/setting")->get_setting();
        // 支付方式
        $pay_type = array();
        switch ($setting['pay_type']) {
            case 2:
                $pay_type = array(1 => '在线支付');
                break;
            case 3:
                $pay_type = array(2 => '货到付款');
                break;
            default:
                $pay_type = array(1 => '在线支付',2 =>'货到付款');
                break;
        }
        // 所有一级地区
        $districts = $this->load->service('admin/district')->get_children();
        $SEO = seo('核对订单信息');

        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->assign('s',$s);
        $this->load->librarys('View')->assign('setting',$setting);
        $this->load->librarys('View')->assign('districts',$districts);
        $this->load->librarys('View')->assign('pay_type',$pay_type);
        $this->load->librarys('View')->assign('carts',$carts);
        $this->load->librarys('View')->assign('address',$address);
        $this->load->librarys('View')->display('cart_settlement');
    }

    public function get() {
        // 会员收货地区id，便于加载配送物流
        $district_id = $this->member['_address'][0]['district_id'];
        $skuids = $_GET['skuids'];
        if (isset($_GET['district_id']) && is_numeric($_GET['district_id'])) {
            $district_id = (int) $_GET['district_id'];
        }
        $pay_type = (int) $_GET['pay_type'];
        $deliverys = (array) $_GET['deliverys'];
        $order_prom = (array) $_GET['order_prom'];
        $sku_prom = (array) $_GET['sku_prom'];
        $remarks = (array) $_GET['remarks'];
        $invoices = (array) $_GET['invoices'];
        $result =  $this->service->create($this->member['id'], $skuids , $district_id, $pay_type, $deliverys, $order_prom, $sku_prom, $remarks, $invoices, false);
        if($result === false) {
            showmessage($this->service->error);
        } else {
            showmessage($this->service->error, url('index'), 1, $result);
        }
    }

    public function ajax_settlement(){
        showmessage(lang('_operation_success_'),url('order/order/settlement'),1);
    }
    /* 根据地区id获取下级地区 */
    public function ajax_get_district_childs() {
        $id = (int) $_GET['id'];
        $result = $this->load->service('admin/district')->get_children($id);
        $this->load->librarys('View')->assign('result',$result);
        $result = $this->load->librarys('View')->get('result');
        echo json_encode($result);
    }

    /* 获取商家物流信息 */
    public function get_deliverys() {
        unset($_GET['page']);
        $deliverys = array();
        $deliverys = $this->service_delivery->get_deliverys($_GET['district_id'] , $_GET['skuids']);
        $this->load->librarys('View')->assign('deliverys',$deliverys);
        $deliverys = $this->load->librarys('View')->get('deliverys');
        echo json_encode($deliverys);
    }

    /* 获取该物流的支付方式 */
    public function get_methods() {
        $delivery = $this->service_delivery->get_by_id($_GET['delivery_id']);
        $this->load->librarys('View')->assign('delivery',$delivery);
        $delivery = $this->load->librarys('View')->get('delivery');
        echo json_encode($delivery['method']);
    }

    /* 获取物流费用 */
    public function get_payable() {
        $payable = $this->load->table('order/delivery_district')->where(array("id" => $_GET['id']))->find();
        $this->load->librarys('View')->assign('payable',$payable);
        $payable = $this->load->librarys('View')->get('payable');
        echo json_encode($payable);
    }

    /**
     * 创建订单
     * @param 	array
     * @return  [boolean]
     */
    public function create() {
        // 会员收货地区id，便于加载配送物流
        $district_id = $this->member['_address'][0]['district_id'];
        $skuids = $_GET['skuids'];
        if (isset($_GET['district_id']) && is_numeric($_GET['district_id'])) {
            $district_id = (int) $_GET['district_id'];
        }
        $pay_type = (int) $_GET['pay_type'];
        $deliverys = (array) $_GET['deliverys'];
        $order_prom = (array) $_GET['order_prom'];
        $sku_prom = (array) $_GET['sku_prom'];
        $remarks = (array) $_GET['remarks'];
        $invoices = (array) $_GET['invoices'];
        $result =  $this->service->create($this->member['id'], $skuids , $district_id, $pay_type, $deliverys, $order_prom, $sku_prom, $remarks, $invoices, true);
        if (!$result) {
            showmessage($this->service->error);
        }
        showmessage(lang('order/order_create_success'),url('order/order/detail',array('order_sn'=>$result)),1,'json');
    }

    public function detail() {
        $order_sn = trim($_GET['order_sn']);
        if (empty($order_sn)) showmessage(lang('_error_action_'));
        $order = $this->table->detail($order_sn)->output();
        if ($this->member['id'] != $order['buyer_id']) {
            showmessage(lang('pay/no_promission_view'));
        }
        if ($order['pay_type'] == 1 && $order['pay_status'] != 0) {
            showmessage(lang('order/order_not_pay_status'));
        }
        if($order['real_amount'] == 0) {
            redirect(url('order/order/pay_success',array('sn'=>$sn)));
        }
        if (checksubmit('dosubmit')) {
            $result = $this->service->detail_payment($_GET['order_sn'],$_GET['balance_checked'],$_GET['pay_code'],$_GET['pay_bank']);
            if ($result == FALSE) showmessage($this->service->error);
            $gateway = $result['gateway'];
            // 已支付成功的订单跳转到成功页面
            if ($result['pay_success'] == 1) {

                //Ucenter订单插入
                include_once DOC_ROOT . 'config.inc.php';
                include_once DOC_ROOT . 'uc_client/client.php';
                $order['pay_status'] = 1;
                $order['pay_method'] = $order['_pay_type'];
                $order['pay_time'] = time();
                uc_artels_order($order);
                redirect($gateway['url_forward']);exit;
            }
            $SEO = seo('收银台 - 会员中心');
            if (defined('MOBILE') && $gateway['gateway_type'] == 'redirect') {
                redirect($gateway['gateway_url']);
            }
            include template('cashier', 'pay');
        } else {
            if ($order['pay_type'] == 2) {	// 货到付款
                include template('order_success');
                return FALSE;
            }
            // 后台设置-余额支付 1:开启，0：关闭
            $setting = $this->load->service('admin/setting')->get_setting();
            $balance_pay = $setting['balance_pay'];
            $member_info = $this->member;
            $pays = $setting['pays'];
            $payments = $this->load->service('pay/payment')->getpayments(defined('MOBILE') ? 'wap' : 'pc', $pays);
            $SEO = seo('订单支付');
            $this->load->librarys('View')->assign('order',$order);
            $this->load->librarys('View')->assign('order_sn',$order_sn);
            $this->load->librarys('View')->assign('setting',$setting);
            $this->load->librarys('View')->assign('balance_pay',$balance_pay);
            $this->load->librarys('View')->assign('member_info',$member_info);
            $this->load->librarys('View')->assign('pays',$pays);
            $this->load->librarys('View')->assign('payments',$payments);
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('detail_payment');
        }
    }

    /* 获取支付状态 */
    public function get_pay_status() {
        $order_sn = $_GET['order_sn'];
        $order = $this->table->detail($order_sn)->output();
        if (!$order || $order['buyer_id'] != $this->member['id']) {
            showmessage(lang('pay/no_promission_view'));
        }
        if ($order['_status']['now'] == 'pay') {
            showmessage(lang('pay/order_paid'),url('order/order/pay_success',array('order_sn'=>$order_sn)),1,'json');
        } else {
            showmessage(lang('order/order_no_pay'));
        }
    }

    /* 支付成功 */
    public function pay_success() {
        $order_sn = $_GET['order_sn'];
        $order = $this->table->detail($order_sn)->output();
        if (!$order) showmessage(lang('order/order_not_exist'));
        if ($order['buyer_id'] != $this->member['id']) showmessage(lang('order/no_promission_view'));
        $SEO = seo('支付成功');
        $this->load->librarys('View')->assign('order',$order);
        $this->load->librarys('View')->assign('order_sn',$order_sn);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('order_success');
    }

    /* 移动端 => 选择收货地址 */
    public function settlement_address() {
        $SEO = seo('选择收货地址');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('settlement_address');
    }

    /* 移动端 => 选择支付&配送方式  */
    public function settlement_delivery() {
        $SEO = seo('选择支付配送');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('settlement_delivery');
    }

    /* 移动端 => 发票信息  */
    public function settlement_invoice() {
        $SEO = seo('发票信息');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('settlement_invoice');
    }

    /* 移动端 => 订单促销 */
    public function settlement_order() {
        $SEO = seo('选择订单促销');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('settlement_order');
    }

    /* 移动端 => 商品促销 */
    public function settlement_goods() {
        $SEO = seo('选择商品促销');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('settlement_goods');
    }

    /* 获取会员收货地址 */
    public function get_address() {
        $data = $this->load->table('member/member_address')->fetch_all_by_mid($this->member['id'], 'isdefault DESC');
        foreach ($data as $k => $val) {
            $area = $this->load->service('admin/district')->fetch_position($val['district_id']);
            $data[$k]['_area'] = $area[2].' '.$area[3];
        }
        $this->load->librarys('View')->assign('data',$data);
        $data = $this->load->librarys('View')->get('data');
        echo json_encode($data