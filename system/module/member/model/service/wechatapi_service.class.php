<?php
/**
 * [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * 微信授权API接口文件
 * Author : gaokang
 * time : 2016-10-31
 */

class wechatapi_service extends service {
    public function __construct() {

        //宝龙艺境 mqbaolongyijing@sina.com
        $this->appid = 'wx5055a410afd056bd';
        $this->appSecret = '16954f1377e2e4341bfece7572bfb6ac';

        //模板消息
        $this->orderAddOk = '2ewDbC7YkNwLGiyIF1vWK7rOc1KkQrnxp8WIUV-Z9mU';      //酒店订单预订成功 但未支付 即订单确认
        $this->orderPayOk = 'fo8VZOe-33oKHbeR0KFRjdWEC_rKcL7cdMQ4Czca3qs';      //预订成功并且预订单已经支付
        $this->orderCencelOk = 'QHyGAqYMVqY1ruBDXcrXAaxrDr4xpNGV6Kk6cY-V4Ds';   //预订订单取消成功
    }

    /*
     * 获取微信Code
     * @url [String] 授权回调地址
     * @notice 此方法需要用户 授权
     * **/
    public function getCode($url = ''){
        //微信授权
        $auth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=" . $url . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        header('Location:' . $auth);
    }

    /*
     * 获取微信Code
     * @url [String] 授权回调地址
     * @state [String] 类型区分
     * @notice 此方法静默获取 不需要用户授权
     * **/
    public function getCodeSilence($url = '', $state='STATE'){
        //微信授权
        $auth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=" . $url . "&response_type=code&scope=snsapi_base&state=" . $state . "#wechat_redirect";
        header('Location:' . $auth, true, 301);
    }

    /*
     * 获取用户openId 以及 用户信息
     * @code [String] 用户授权之后获取的Code
     * @return [Array] 用户openId 用户信息
     * **/
    public function getOpenIdUserMsg($code){
        //获取用户openid
        $user_openid ="https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appid . "&secret=" . $this->appSecret . "&code=" . $code ."&grant_type=authorization_code";
        $result = file_get_contents($user_openid);
        $user_msg = json_decode($result , true);

        //获取用户信息
        $getUserMsg = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $user_msg['access_token'] . '&openid=' . $user_msg['openid'] . '&lang=zh_CN';
        $userResult = file_get_contents($getUserMsg);
        $userInfo = json_decode($userResult , true);
        return $userInfo;
    }

    /*
     * 获取用户openId
     * @code [String] 用户授权之后获取的Code
     * @return [Array] 用户openId
     * **/
    public function getOpenId($code){
        $user_openid = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appid . "&secret=" . $this->appSecret . "&code=" . $code ."&grant_type=authorization_code";
        $result = file_get_contents($user_openid);
        $openid = json_decode($result , true);
        return $openid;
    }

    /*
     * 微信公众号发送模板消息
     * @sendData    [Array] 发送的消息数组 没有 url 和 模板ID 信息
     * @tmpMsgType  [int]   消息类别 1订单预订成功  2预订单付款成功 3取消预订单成功
     * @return      [Array] 返回信息
     * **/
    public function sendWecahtTmpMsg( $sendData, $tmpMsgType ){
        //获取access_token
        $accessTokenArr = $this->getAccessToken();
        $accessToken = $accessTokenArr['access_token'];
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $accessToken;
        //判断消息类型
        switch( $tmpMsgType ) {
            case 1:
                $sendData['template_id'] = $this->orderAddOk;
                break;
            case 2:
                $sendData['template_id'] = $this->orderPayOk;
                break;
            case 3:
                $sendData['template_id'] = $this->orderCencelOk;
                break;
        }
        $postData = json_encode( $sendData );
        $data = $this->request_post( $url, $postData );
        return $data;

    }



    /*
     * 获取access_token
     * @return [Array] access_token
     * **/
    public function getAccessToken(){
        $getUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appSecret ;
        $result = file_get_contents($getUrl);
        $accessToken = json_decode($result , true);
        return $accessToken;
    }


    /*
     * 模拟POST提交方式
     * @url [String] 接口地址
     * @post_data [array]  提交数据信息
     * @return [json]   请求结果
     * **/
    private function request_post($url = '', $post_data ) {
        if ( empty( $url ) || empty( $post_data ) ) {
            return false;
        }

        if( is_array( $post_data ) ){
            $o = "";
            foreach ( $post_data as $k => $v )
            {
                $year = substr( date( 'Y-m', time() ), 1, 4 );
                $finds = stripos( $v, $year );
                if($finds){
                    $o.= "$k=" .  $v . "&" ;
                }else{
                    $o.= "$k=" . urlencode( $v ). "&" ;
                }

            }
            $post_data = substr( $o, 0, -1 );
        }


        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }


}