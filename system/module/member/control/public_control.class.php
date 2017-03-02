<?php
Core::load_class('init', 'goods');
class public_control extends init_control
{
    public function _initialize() {
        parent::_initialize();
        if($this->member['id'] > 0 && METHOD_NAME !== 'logout' && METHOD_NAME !== 'resetemail') {
            redirect(url('member/index/index'));
        }
        $this->service = $this->load->service('member/member');
        $this->model = $this->load->table('member/member');
        $this->wechat = $this->load->service('member/wechatapi');
        $this->vcode_table = $this->load->table('vcode');
    }

    public function index() {
        error::system_error('_data_type_invalid_');
    }

    public function register() {
        if(checksubmit('dosubmit')) {
            if(!$this->service->register($_GET)) {
                showmessage($this->service->error);
            }
            $url = $_GET['url_forward'] ? urldecode($_GET['url_forward']) : url('member/index/index');
            showmessage(lang('member/register_success'), $url, 1);
        } else {
            $SEO = seo('会员注册');

            $sms_reg = false;
            $sms_enabled = model('notify')->where(array('code'=>'sms','enabled'=>1))->find();
            if($sms_enabled){
                $sqlmap['id'] = 'sms';
                $sqlmap['enabled'] = array('like','%register_validate%');
                $sms_reg = model('notify_template')->where($sqlmap)->find();
            }

            $question = cookie('question');
            $question = authcode($question,'DECODE');
            $wenti = json_decode($question,true);
            if(!$wenti){
                $wenti = model('reg_question')->select();
                $question = json_encode($wenti ,true);
                $auth = authcode($question, 'ENCODE');
                cookie('question', $auth, 86400);
            }

            $this->load->librarys('View')->assign('question',$wenti);
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->assign('sms_reg',$sms_reg);
            $this->load->librarys('View')->display('register');
        }
    }

    public function login() {
        $SEO = seo('会员登录');
        $mobile = new mobile;
        if(checksubmit('dosubmit')) {
            $login = $this->service->login($_GET['username'], $_GET['password']);
            if(!$login) {
                showmessage($this->service->error);
            }
            /* 加上了判断 URL中有CODE也可以跳转到前次链接
            * 高康 2017-02-09 13:31 孟庆楠
            */
            if( strpos($_GET['url_forward'] , 'code') ){
                $_GET['url_forward'] = $_SESSION['urlsgd'];
            }
            $url = $_GET['url_forward'] ? urldecode($_GET['url_forward']) : url('member/index/index');
            showmessage(lang('member/login_success'), $url, 1);
        } else if($mobile->isMobile() && $_GET['jr'] != 'out' && $this->isWechat()) {
            $codes = $_GET['url_forward'];

            //因为有url_forward 需多次解码URL
            $codeurl = urldecode($codes);
            $codeurl = urldecode($codeurl);
            $codeurl = urldecode($codeurl);

            /* 加上了判断 URL中有CODE也可以跳转到前次链接
             * 高康 2017-02-09 13:31 孟庆楠
             */
            if( strpos($codeurl , 'skuids') ){
                $_SESSION['urlsgd'] = $_GET['url_forward'];
            }
            //获取url_forward中的CODE
            $codeArr = explode('&',$codeurl);
            $code = explode('=',$codeArr[1]);
            if($code[0] != 'code'){
                $this->wechatlogin();
            }

            //获取用户openid 以及用户信息
            $userMsg = $this->wechat->getOpenIdUserMsg($code[1]);
            $umsg = json_encode($userMsg);
            $auth = authcode($umsg, 'ENCODE');
            cookie('member_wechat', $auth, 1800);	//存入COOKIE
            $map['openid'] = $userMsg['openid'];
            $userMysqlMsg = $this->model->where($map)->find();
            if($userMysqlMsg['openid']){
                $this->service->login($userMysqlMsg['username'], $userMysqlMsg['pwd']);
                $url = $_GET['url_forward'] ? urldecode($_GET['url_forward']) : url('member/index/index');
                showmessage(lang('member/login_success'), $url, 1);
            }else{
                $this->load->librarys('View')->assign('SEO',$SEO);
                $this->load->librarys('View')->display('login');
            }
        }else{
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('login');
        }
    }

    public function wechatlogin(){
        $callBackUrl = 'http://new.artels.cn/index.php?m=member&c=public&a=login';
        $this->wechat->getCode($callBackUrl);
    }


    public function logout() {
        unset($_SESSION['userInfo']);
        $this->service->logout();
        include_once DOC_ROOT.'config.inc.php';
        include_once DOC_ROOT.'uc_client/client.php';
//        $syncloginout = uc_user_synlogout();
//        $GLOBALS['_SESSION']['synloginout'] = $syncloginout;
//        $GLOBALS['_SESSION']['synlogin'] = '';
//        $GLOBALS['_SESSION']['type'] = 'out';
        redirect(url('member/public/login',array('jr'=>'out')));
    }

    /*找回密码 重构 */
    public function repwd(){
        if(IS_POST){
            if (!is_email($_GET['email'])) showmessage(lang('member/email_format_error'));
            $this->service->femail($_GET['email']);
        }else{
            $SEO = seo(0,"找回密码");
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('repwd');
        }
    }

    /**
     * 忘记密码
     */
    public function forget_password()
    {
        if(IS_POST){
            $username = $_GET['username'];
            if(!is_email($username) && !is_mobile($username)){
                showmessage('邮箱或者电话格式错误','',0);
            }
            $member = $this->service->username_exist($username);
            if (!$member){
                showmessage($this->service->error,'',0);
            }
            $result = $this->service->send_message($username,$member);
            if($result){
                showmessage('验证短信已经发送，请注意查收。','',1);
            }

        }else{
            $SEO = seo('忘记密码');
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('forget_password');
        }
    }
    /*设置新密码*/
    public function setNpwd(){
        if(IS_POST){
            $pwd=$_GET['pwd'];
            $repwd=$_GET['repwd'];
            $mid=$_GET['mid'];
            $salt=$this->service->fetch_by_id($mid);
            $vcode=authcode(base64_decode($_GET['vcode']), 'DECODE', $salt['salt']) ;
            $key=$this->load->table('vcode')->where("mid='$mid' AND vcode='$vcode'")->getField('vcode');
            if($key == $vcode){
                if($pwd !=$repwd){
                    showmessage(lang('member/second_password_different'));
                }else {
                    $data['password']=md5(md5($pwd).$salt['salt']);
                    $re=$this->service->setNpwd($_POST['mid'],$data);
                    if($re){
                        $this->load->table('vcode')->where(array('mid' => $mid,'vcode' => $vcode))->delete();
                        showmessage(lang('_operation_success_'));
                    }else{
                        showmessage(lang('_operation_fail_'));
                    }
                }
            }else if($key != $vcode || empty($key)){
                showmessage(lang('member/error_link'));
            }
        }else{
            $SEO = seo(0,'设置新密码');
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->assign('mid',$_GET['mid']);
            $this->load->librarys('View')->assign('key',$_GET['key']);
            $this->load->librarys('View')->display('repwd');
        }
    }

    /**
     * 检查邮箱
     */
    public function valid_email()
    {
        $email = $_GET['email'];
        $result = $this->service->valid_email($email);
        if(!$result){
            showmessage($this->service->error,'',0);
        }else{
            showmessage('邮箱正常可用','',1);
        }
    }

    /**
     * 重置新密码
     */
    public function reset_password()
    {
        $mid = $_GET['mid'];
        $key = $_GET['key'];
        if(IS_POST){
            $pwd = $_GET['pwd'];
            $repwd = $_GET['repwd'];
//			if(!$pwd || !$repwd){
//				$username = $_GET['username'];
//				$vcode = $_GET['vcode'];
//				$result = $this->service->valid_vcode($vcode,$username);
//				if(!$result){
//					showmessage($this->service->error,'',0);
//				}else{
//					showmessage('验证码正确',url('member/public/reset_password',$result['params']));
//				}
//			}
            if($pwd != $repwd){
                showmessage('确认密码错误，请重新输入','',0);
            }

            if($_GET['types'] == 'question'){
                $key = false;
            }

            $reset_result = $this->service->reset_password($mid,$key,$pwd);
            switch($reset_result){
                case 1:
                    $result = array(
                        'message' => '密码重置失败！',
                        'status' => '0'
                    );
                    echo json_encode($result);
                    exit;
                    break;
                case 2:
                    $result = array(
                        'message' => '密码已重置',
                        'status' => '1',
                        'referer' => '/index.php?m=member&c=public&a=login'
                    );
                    echo json_encode($result);
                    exit;
                    break;
                case 3:
                    $result = array(
                        'message' => '密码不能和近期使用过的密码相同',
                        'status' => '0',
                    );
                    echo json_encode($result);
                    exit;
                    break;
            }
        }else{
            $SEO = seo('重置密码');
            $this->load->librarys('View')->assign('SEO',$SEO);
            $this->load->librarys('View')->display('repwd');
        }
    }

    /*
     * 查询问题  以及用户信息
     * **/
    public function ajax_question(){
        $post = $_POST;
        $map['username'] = $post['username'];
        $data = $this->model->where($map)->find();

        if( empty( $data['id'] ) ) {
            $result = array('error'=>'error');
            echo json_encode($result);
        }else{
            $where['id'] = $data['question_id'];
            $question = model('reg_question')->where($where)->find();
            $result = array(
                'uid' => $data['id'],
                'question_answer' => $data['question_answer'],
                'question' => $question['question']
            );
            echo json_encode($result);
        }
    }


    public function repwds(){
        $SEO = seo('重置密码');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('repwd');
    }




    public function ajax_register_check() {
        $result = $this->service->valid($_GET['name'],$_GET['param']);
        if($result === false){
            showmessage($this->service->error);
        }
        showmessage('', '', 1, array(), 'json');
    }
    public function ajax_register_vcode_check() {
        $result = $this->service->_valid_vcode($_GET['param'],$_GET['mobile']);
        if($result === false){
            showmessage($this->service->error);
        }
        showmessage('', '', 1, array(), 'json');
    }
    /*邮箱验证*/
    public function resetemail(){
        $mid = $vcode = $email ='';
        extract($_GET,EXTR_IF_EXISTS);
        list($mid,$vcode,$email) = json_decode(authcode(base64_decode($vcode),'DECODE'),TRUE);

        $sqlmap = array();
        $sqlmap['mid'] = $mid;
        $sqlmap['action'] = 'resetemail';
        $sqlmap['vcode'] = $vcode;
        $sqlmap['dateline'] = array('EGT',time()-1800);
        $_vcode = $this->load->table('vcode')->where($sqlmap)->getField('vcode');

        if ($_vcode !== $vcode) showmessage(lang('member/captcha_error'),'',0);

        $data['id'] = $mid;
        $data['email'] = $email;

        $r = $this->load->table('member/member')->update($data,FALSE);
        if($r){
            showmessage(lang('member/edit_email_success'),url('member/index/index'),1);
        }else{
            showmessage(lang('member/edit_email_error'),url('member/index/index'),0);
        }
    }
    /* 手机验证 */
    public function register_validate(){
        $this->load->table('vcode')->where(array('mobile' => $_GET['mobile'],'action' =>'register_validate','dateline'=>array('LT',TIMESTAMP)))->delete();
        $result = $this->service->post_vcode($_GET,'register_validate');
        if($result){
            showmessage(lang('member/send_success'),'',1);
        }else{
            showmessage(lang('member/send_error'),'',0);
        }
    }

    public function isWechat(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
        }else{
            return false;
        }
    }

}