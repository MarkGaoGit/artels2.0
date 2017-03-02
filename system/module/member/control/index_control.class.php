<?php
class index_control extends cp_control
{
    public function _initialize() {
        parent::_initialize();
        $this->api = $this->load->service('goods/api');
        $this->member_see = $this->load->table('member/member_see');
    }

    public function index(){
        //预订列表
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['cardNo'] = $_SESSION['userInfo']['cardNo'];
        $order = $this->api->findResrvList($data);

        //积分
        $sc['cardId'] = $_SESSION['userInfo']['cardId'];
        $score = $this->api->getPointList($sc);

        include_once DOC_ROOT . 'config.inc.php';
        include_once DOC_ROOT . 'uc_client/client.php';
        $ucdata['card_id'] = $_SESSION['userInfo']['cardId'];
        $ucdata['card_no'] = $_SESSION['userInfo']['cardNo'];
        $ucdata['point_balance'] = $score['pointBalance'];
        $ucdata['point_charge'] = $score['pointCharge'];
        $ucdata['card_point_list'] = serialize($score['cardPointList']);
        uc_lvyun_integral($ucdata);

        //CRM用户余额未触发
//        $test['cardno'] = '213100000026';
//        $test['cardbalance'] = '7691.88';
//        $test['cardfreezebalance'] = '0.00';
//        $test['cardintegral'] = '111130';
//        $test['othbala'] = '1.00';
//        uc_crm_message($test);

        //收藏的艺术品
        $favorite = $this->load->service('member/member_favorite')->set_mid($this->member['id'])->lists(array(), 10);

        //电子券列表 暂无此功能
        /*
        $cardNo = $_SESSION['userInfo']['cardNo'];
        $coupon = $this->api->findCouponDetailListByCardNo($cardNo);

        */
        $SEO = seo('会员中心');

        $this->load->librarys('View')->assign('coupon',$coupon);
        $this->load->librarys('View')->assign('favorite',$favorite);
        $this->load->librarys('View')->assign('this',$this->member);
        $this->load->librarys('View')->assign('score',$score);
        $this->load->librarys('View')->assign('order',$order['resrvList']);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('index');
    }

    /*
     * AJAX 查询订单列表
     * **/
    public function ajax_order(){
        $post = $_POST;
        $get = $_GET;
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['cardNo'] = $_SESSION['userInfo']['cardNo'];
        $data['arr'] = $post['arr'];
        $data['dep'] = $post['dep'];
        $order = $this->api->findResrvList($data);
        if($get['type'] == 'mobilemenu'){
            $SEO = seo('预订房间列表');
            $this->load->librarys('View')->assign('order',$order['resrvList']);
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('order_list');
            exit;
        }
        echo json_encode($order['resrvList']);
    }

    /*
     * AJAX 查询积分
     * **/
    public function ajax_scroce(){
        $post = $_POST;
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $sc['cardId'] = $_SESSION['userInfo']['cardId'];
        $sc['beginDate'] = $post['arr'];
        $sc['endDate'] = $post['dep'];
        $score = $this->api->getPointList($sc);
        echo json_encode($score['cardPointList']);
    }

    /*
     * AJAX 取消订单
     * **/
    public function ajax_cencel_order(){
        $post = $_POST;
        $cencel['crsNo'] = $post['crs'];
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $cencel['cardNo'] = $_SESSION['userInfo']['cardNo'];
        $result = $this->api->cancelbook($cencel);
        if($result['resultCode'] != 0){
            echo json_encode($result['resultMsg']);
        }else{
            echo 1;
        }
    }

    /*
     * AJAX 查看订单详情
     * */
    public function ajax_orderDetail(){
        $post = $_POST;
        $get = $_GET;
        $data['crsNo'] = $post['crsNo'] ? $post['crsNo'] : $get['crs'];
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['cardNo'] = $_SESSION['userInfo']['cardNo'];
        $result = $this->api->findResrvGuest($data);
        if($get['type'] == 'details'){
            $SEO = seo('预订订单详情');
            if($result['resultCode'] != 0 || !$result){
                $result['guest'] = '暂无此订单详细信息！';
            }
            $this->load->librarys('View')->assign('order',$result['guest']);
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('order_resv');
            exit;
        }
        if($result['resultCode'] != 0 || !$result){
            echo false;
        }
        echo json_encode($result['guest']);
    }

    /*
     * AJAX修改手机号码
     * **/
    public function ajax_verifyMobileApply(){
        $post = $_POST;
        $data['newMobile'] = $post['newMobile'];
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['memberId'] = $_SESSION['userInfo']['memberId'];
        $result = $this->api->verifyMobile($data);
        if($result['resultCode'] != 0 || !$result){
            echo json_encode($result['resultMsg']);
        }else{
            echo json_encode($result);
        }
    }


    /*
     * AJAX修改邮箱
     * **/
    public function ajax_verifyEmail(){
        $post = $_POST;
        $data['newEmail'] = $post['newEmail'];
        $_SESSION['userInfo'] = unserialize($this->member['ly_msg']);
        $data['memberId'] = $_SESSION['userInfo']['memberId'];
        $result = $this->api->verifyEmail($data);
        if($result['resultCode'] != 0 || !$result){
            echo json_encode($result['resultMsg']);
        }else{
            echo json_encode($result);
        }
    }

    /*
     * AJAX去看看
     * **/
    public function gosee(){
        $post = $_POST;
        $map['spu_id'] = $_POST['pid'];
        $map['uid'] = $this->member['id'];
        $seemsg = $this->member_see->where($map)->select();
        if($seemsg){
            $map['numbers'] = ++$seemsg[0]['numbers'];
            $map['id'] = $seemsg[0]['id'];
            $r = $this->load->table('member_see')->update($map, FALSE);
            if($r > 0){
                echo 1;
                exit;
            }
        }

        $post['user_name'] = $this->member['username'];
        $lvyunmsg = unserialize($this->member['ly_msg']);
        $post['name'] = $lvyunmsg['name'];
        $post['mobile'] = $this->member['mobile'];
        $post['card_no'] = $this->member['cardNo'];
        $post['uid'] = $this->member['id'];
        $post['spu_id'] = $post['pid'];
        $data = $this->member_see->create($post);
        $result = $this->member_see->add($data);
        if($result > 0){
            echo 1;
        }
    }



    public function get_rec_data(){
        if(empty($_GET['formhash']) || $_GET['formhash'] != FORMHASH) showmessage('_token_error_');
        $data = array();
        $data = $this->load->service('goods/goods_sku')->lists(array('order'=>'rand()'),array('limit'=>10));
        $result = $data['lists'];
        foreach ($result as $key => $value) {
            $result[$key]['goods_url'] = url('goods/index/detail',array('sku_id'=>$value['sku_id']));
            $result[$key]['format_thumb'] = thumb($value['thumb'],500,500);
        }
        showmessage('success','',1,$result);
    }
    public function clear_history(){
        if(empty($_GET['formhash']) || $_GET['formhash'] != FORMHASH) showmessage('_token_error_');
        $r = $this->load->service('goods/goods_sku')->clear_history();
    }
}