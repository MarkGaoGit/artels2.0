<?php
/**
 * [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * 绿云API接口文件
 * Author : gaokang
 * time : 2016-8-12
 */

class api_service extends service {
	public function __construct() {
		$this->url = "http://121.199.5.4:8090/ipms1";
        $this->salesChannel = "WEB";                    //渠道代码
        $this->hotelIds = '1';                          //酒店ID
        $this->hotelGroupId = '1';                      //默认集团编号
        $this->verifyHost = 'www.artels.cn';            //默认验证网址
        $this->idType = '01';                           //01身份证
        $this->verifyType = '1';                        //验证类别 手机0   邮箱1
	}

    /*
     * 查询房价CRS/queryHotelList
     * @params [array] 查询条件
     * @return [array] message
     * **/
    public function quertHotelList($params){
        $url = $this->url . "/CRS/queryHotelList?";
        $post_data['date'] = $params['date'];
        $post_data['dayCount'] = $params['dayCount'];
        $post_data['cityCode'] = $params['cityCode'];
        $post_data['brandCode'] = $params['brandCode'];
        $post_data['order'] = '';
        $post_data['firstResult'] = '';
        $post_data['pageSize'] = '';
        $post_data['rateCodes'] = '';
        $post_data['salesChannel'] = $this->salesChannel;
        $post_data['hotelIds'] = $params['hotelIds'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data ,true);
    }

    /*
     * 查询当日房价/CRS/rateQueryEveryDay	 用户需登录
     * @params [array] 查询条件
     * @return [array] message
     * **/
    public function rateQueryEveryDay($params){
        $url = $this->url . "/CRS/rateQueryEveryDay?";
        $post_data['rateCode'] = $params['rateCode'];
        $post_data['rmType'] = $params['rmType'];
        $post_data['date'] = $params['date'];
        $post_data['dayCount'] = '1';
        $post_data['salesChannel'] = $this->salesChannel;
        $post_data['&hotelId'] = $params['hotelIds'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data ,true);
    }


    /*
     * 订单提交/CRS/book
     * @params [array] 预订信息
     * @return [array] message
     * **/
    public function book($params){
        $url = $this->url . '/CRS/book?';
        $post_data['arr'] = $params['arr'];
        $post_data['dep'] = $params['dep'];
        $post_data['rmtype'] = $params['rmtype'];
        $post_data['rateCode'] = $params['rateCode'];
        $post_data['rmNum'] = $params['rmNum'];
        $post_data['rsvMan'] = $params['rsvMan'];
        $post_data['sex'] = $params['sex'];
        $post_data['mobile'] = $params['mobile'];
        $post_data['email'] = $params['email'];
        $post_data['idType'] = $this->idType;
        $post_data['idNo'] = $params['idNo'];
        $post_data['cardType'] = $params['cardType'];
        $post_data['cardNo'] = $params['cardNo'];
        $post_data['adult'] = $params['adult'];
        $post_data['remark'] = $params['remark'];
        $post_data['disAmount'] = '0';
        $post_data['salesChannel'] = $this->salesChannel;
        $post_data['hotelId'] = $params['hotelIds'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;


        $data = $this->request_post($url,$post_data);
        return json_decode($data,true);
    }

    /*
     * 预订列表 CRS/findResrvList
     * @params [array] 查询条件
     * @return [array] message
     * **/
    public function findResrvList($params){
        $url = $this->url . '/CRS/findResrvList?';
        $post_data['cardNo'] = $params['cardNo'];
        $post_data['arr'] = $params['arr'];
        $post_data['dep'] = $params['dep'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data,true);
    }

    /*
     * 积分列表 /membercard/getPointList
     * @params [array] 查询条件
     * @return [array] message
     * **/
    public function getPointList($params){
        $url = $this->url .'/membercard/getPointList?';
        $post_data['cardId'] = $params['cardId'];
        $post_data['beginDate'] = $params['beginDate'];
        $post_data['endDate'] = $params['endDate'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data,true);
    }

    /*
     * 用户电子券列表 CRS/findCouponDetailListByCardNo
     * @params [String] 卡ID
     * @return [array] message
     * **/
    public function findCouponDetailListByCardNo($cardNo){
        $url = $this->url .'/CRS/findCouponDetailListByCardNo?';
        $post_data['cardNo'] = $cardNo;
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data,true);
    }

    /*
     * 取消订单 /CRS/cancelbook
     * @params [array] 订单号 会员卡号
     * @return [array] message
     * **/
    public function cancelbook($params){
        $url = $this->url . '/CRS/cancelbook?';
        $post_data['cardNo'] = $params['cardNo'];
        $post_data['crsNo'] = $params['crsNo'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $data = $this->request_post($url,$post_data);
        return json_decode($data,true);
    }

    /*
     * 修改手机号 membercard/verifyMobileApply
     * @params [array] 新手机号  会员ID
     * @return [array] message
     * **/
    public function verifyMobile($params){
        $url = $this->url . '/membercard/verifyMobileApply?newMobile=' . $params['newMobile'];
        $url .= '&memberId=' . $params['memberId'];
        $url .= '&verifyHost=' . $this->verifyHost;
        $url .= '&hotelGroupId=' . $this->hotelGroupId;
        $result = file_get_contents($url);
        $yzr = json_decode($result,true);
        if($yzr['resultCode'] !=0 ){
            return $yzr;
        }

        $url = $this->url . '/membercard/verifyMobile?newMobile=' . $params['newMobile'];
        $url .= '&memberId=' . $params['memberId'];
        $url .= '&verifyCode=' . '';
        $url .= '&hotelGroupId=' . $this->hotelGroupId;
        $results = file_get_contents($url);
        return json_decode($results,true);
    }

    /*
     * 修改邮箱 membercard/verifyMobileApply
     * @params [array] 新邮箱地址  会员ID
     * @return [array] message
     * **/
    public function verifyEmail($params){
        $url = $this->url . '/membercard/verifyEmailApply?newEmail=' . $params['newEmail'];
        $url .= '&memberId=' . $params['memberId'];
        $url .= '&verifyHost=' . $this->verifyHost;
        $url .= '&hotelGroupId=' . $this->hotelGroupId;
        $result = file_get_contents($url);
        $yzr = json_decode($result,true);
        if($yzr['resultCode'] !=0 ){
            return $yzr;
        }

        $url = $this->url . '/membercard/verifyEmail?newEmail=' . $params['newEmail'];
        $url .= '&memberId=' . $params['memberId'];
        $url .= '&verifyCode=' . '';
        $url .= '&hotelGroupId=' . $this->hotelGroupId;
        $results = file_get_contents($url);
        return json_decode($results,true);
    }


    /*
     * 查看订单详情 /CRS/findResrvGuest
     * @params [array] 会员卡号 订单号
     * @return [array] message
     * **/
    public function findResrvGuest($params){
        $url = $this->url . '/CRS/findResrvGuest?';
        $post_data['cardNo'] = $params['cardNo'];
        $post_data['crsNo'] = $params['crsNo'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $result = $this->request_post($url,$post_data);
        return json_decode($result,true);
    }


    /*
     * 非验证性用户注册 membercard/registerMemberCardWithOutVerify
     * @params [array] 用户注册信息
     * @return [array] 用户信息
     * **/
    public function registerMemberCardWithOutVerify($params){
        $url = $this->url . '/membercard/registerMemberCardWithOutVerify?';
        $post_data['name'] = $params['username'];
        $post_data['sex'] = $params['sex'];
        $post_data['mobile'] = $params['mobile'];
        $post_data['email'] = $params['email'];
        $post_data['idType'] = $params['id_no'] ? $this->idType : '';
        $post_data['idNo'] = $params['id_no'];
        $post_data['name'] = $params['nickname'];
        $post_data['verifyType'] = $this->verifyType;
        $post_data['verifyHost'] = $this->verifyHost;
        $post_data['password'] = $params['lvyunpwd'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $result = $this->request_post($url,$post_data);
        return json_decode($result,true);
    }


    /*
      * 绿云会员登录 /membercard/memberLogin
      * @params [array] 用户登录信息
      * @return [array] 用户信息
      * **/
    public function memberLogin($params){
        $url = $this->url . '/membercard/memberLogin?';
        $post_data['loginId'] = $params['loginId'];
        $post_data['loginPassword'] = $params['password'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $result = $this->request_post($url,$post_data);
        return json_decode($result,true);
    }

    /*
      * 绿云会员密码修改 /membercard/updateMember
      * @params [array] 用户密码信息
      * @return [array] 修改信息
      * **/
    public function updateMember($params){
        $url = $this->url . '/membercard/updateMember?';
        $post_data['memberId'] = $params['memberId'];
        $post_data['street'] = $params['street'];
        $post_data['newPassword'] = $params['newPassword'];
        $post_data['oldPassword'] = $params['oldPassword'];
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $result = $this->request_post($url,$post_data);
        return json_decode($result,true);
    }

    /*
      * 同步酒店信息 web/webSyncHotel
      * **/
    public function webSyncHotel(){
        $url = $this->url . '/web/webSyncHotel?';
        $post_data['hotelGroupId'] = $this->hotelGroupId;

        $result = $this->request_post($url,$post_data);
        return json_decode($result,true);
    }



    /*
     * 处理绿云接口返回值
     * @roomList [array] 房间信息列表
     * @rmtype   [array] 房型代码及房型
     * **/
    public function resultApi($roomList,$roomtype){
        $msg = array();
        if(!is_array($roomList)){
            $roomType = $roomList;
            $roomList = array();
            $roomList[0]['rmtype'] = $roomType;
            $roomList[0]['ratecode'] = 'MEM1';
        }
        foreach($roomList as $k=>$v){
            if($roomList[$k]['ratecode'] == 'MEM1'){
                if($roomList[$k]['rmtype'] = $roomtype[$k]['code']){
                    $roomList[$k]['descript'] = $roomtype[$k]['descript'];
                }
                $msg[] = $roomList[$k];
            }
        }
        return $msg;
    }


    /*
     * 处理各酒店的早餐 统一规格 BF1 BF01
     * @msg  [Array] 酒店房型信息
     * @data [Array] 处理后的结果
     * **/
    public function breakfast($msg){
        foreach($msg as $k=>$v){
            if( empty($msg[$k]['packages']) ){
                $msg[$k]['packages'] = '无';
            }
            if( $msg[$k]['packages'] != '无' && !empty($msg[$k]['packages']) ){
                $msg[$k]['packages'] = substr($msg[$k]['packages'],2);
                if(substr($msg[$k]['packages'],0,1) == 0){
                    $msg[$k]['packages'] = substr($msg[$k]['packages'],1).'份';
                }
            }

        }
        return $msg;
    }

    /*
     * 模拟POST提交方式
     * @url [String] 接口地址
     * @post_data [array]  提交数据信息
     * @return [json]   请求结果
     * **/
    private function request_post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v )
        {
            $year = substr(date('Y-m',time()),1,4);
            $finds = stripos($v,$year);
            if($finds){
                $o.= "$k=" .  $v . "&" ;
            }else{
                $o.= "$k=" . urlencode( $v ). "&" ;
            }

        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }


}