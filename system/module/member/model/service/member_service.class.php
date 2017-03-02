<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
define('IN_APP',true);
class member_service extends service {
    protected $result;

    public function __construct() {
        $this->vcode_table = $this->load->table('vcode');
        $this->model = $this->load->table('member/member');
        $this->setting = $this->load->service('admin/setting')->get_setting();
        $this->group_model = $this->load->table('member/member_group');
        $this->api = $this->load->service('goods/api');

    }

    /**
     * 初始化
     * @return [type] [description]
     */
    public function init() {
        $_member = array(
            'id' => 0,
            'username' => '游客',
            'group_id' => 0,
            'email' => '',
            'mobile' => '',
            'money' => 0,
            'integral' => 0,
            'exp' => 0
        );
        $authkey = cookie('member_auth');
        if($authkey) {
            list($mid, $password) = explode("\t", authcode($authkey));

            include_once DOC_ROOT.'config.inc.php';
            include_once DOC_ROOT.'uc_client/client.php';
            $data = uc_get_user($mid, 1);
            if(is_array($data)){
                $password = md5($data[4].$data[3]);
                $this->dologin($mid, $password);
                $_member = $this->model->fetch_by_username($data[1]);
                $_member['avatar'] = getavatar($_member['id']);
                return $_member;
            }

            $this->dologin($mid, $password);
            $_member = $this->model->setid($mid)->address()->group()->output();
        }
        $_member['avatar'] = getavatar($_member['id']);
        // $_member['money'] = money($_member['money']);
        return $_member;
    }

    /**
     * 检测登录状态
     * @return 返回用户ID
     */
    public function check_login() {
        $authkey = cookie('member_auth');
        if($authkey) {
            list($mid, $password, $token) = explode("\t", $authkey);
            if(is_numeric($mid) && $password && $token) {
                if($this->model->fetch_by_id($mid, 'password') == $password) {
                    return $mid;
                }
            }
        }
        return FALSE;
    }

    /**
     * 注册
     * @param  array  $params 表单信息
     * @return mixed
     */
    public function register($params = array()) {
        if(empty($params)) {
            $this->error = lang('_error_action_');
            return false;
        }
        $params['email'] = $params['email'] ? $params['email'] : $params['mobile'] . '@163.com';

        /*
         * 下面这个循环修改了了 身份证验证 可填 可不填
         * 高康 2016-10-18
         * method: _valid_id_no
         * */
        foreach( $params as $k => $v ) {
            $method = '_valid_'.$k;
            if($k == 'vcode'){
                if(method_exists($this,$method) && $this->$method($v,$params['mobile']) === false) return false;
            }else{
                if(method_exists($this,$method) && $this->$method($v) === false) return false;
            }
            $params[$k] = trim($v);
        }
        if($params['pwdconfirm'] != $params['password']) {
            $this->error = lang('member/two_passwords_differ');
            return false;
        }
        $setting = cache('setting', '', 'common');
        $data = array();

        $sms_enabled = model('notify')->where(array('code'=>'sms','enabled'=>1))->find();

        $sms_reg = false;
        if($sms_enabled){
            $sqlmap['id'] = 'sms';
            $sqlmap['enabled'] = array('like','%register_validate%');
            $sms_reg = model('notify_template')->where($sqlmap)->find();
        }
        if(in_array('phone',$setting['reg_user_fields']) && $sms_reg){
            $sqlmap = array();
            $sqlmap['mobile'] = $params['mobile'];
            $sqlmap['dateline'] = array('EGT',time()-1800);
            $vcode = $this->load->table('vcode')->where($sqlmap)->order('dateline desc')->getField('vcode');
            if($vcode != $params['vcode']){
                $this->error = lang('member/captcha_error');
                return false;
            }else{
                $data['mobilestatus'] = 1;
            }
        }
        $data['username'] = $params['username'];
        $data['email'] = $params['email'];
        $data['mobile'] = $params['mobile'] ? $params['mobile'] : '';
        $data['salt'] = random(6);
        $data['password'] = md5(md5($params['password']).$data['salt']);
        $data['group_id'] = 1;
        $data['islock'] = 0;
        $data['id_no'] = $params['id_no'] ? $params['id_no'] : '';
        $data['nickname'] = $params['nickname'];
        $data['lvyunpwd'] = $params['password'];
        $data['sex'] = $params['sex'];
        $data['pwd'] = $params['password'];
        $lvyun_result = $this->api->registerMemberCardWithOutVerify($data);
        if($lvyun_result['resultCode'] != 0){
            $this->error = $lvyun_result['resultMsg'];
            return false;
        }else {
            include_once DOC_ROOT . 'config.inc.php';
            include_once DOC_ROOT . 'uc_client/client.php';
            $uid = uc_user_register($params['username'], md5($params['password']), $data['email'], $questionid, $answer, $regip, $data['salt']);
            if ($uid > 0) {
                $data['cardNo'] = $lvyun_result['cardNo'];
                $data['ly_msg'] = serialize($lvyun_result);
                $data['question_id'] = $params['question'];
                $data['question_answer'] = $params['question-result'];
                $result = $this->model->update($data);
            }
            if ($result === false || $uid <= 0) {
                switch ($uid) {
                    case  '-1':
                        $this->error = '用户名不合法';
                        break;
                    case  '-2':
                        $this->error = '包含要允许注册的词语';
                        break;
                    case  '-3':
                        $this->error = '用户名已经存在';
                        break;
                }
                return false;
            }
            $_SESSION['userInfo'] = $lvyun_result;
            $this->dologin($result, $params['password'], $params['username']);
            runhook('after_register', $result);
            $this->login_inc($result);
            return $result;
        }
    }

    public function login($account, $password) {

        if(empty($account)) {
            $this->error = lang('member/login_username_empty');
            return false;
        }
        if(empty($password)) {
            $this->error = lang('member/login_password_empty');
            return false;
        }

        //mysql
        $sqlmap = array();
        if(is_mobile($account)) {
            $sqlmap['mobile'] = $account;
            $sqlmap['mobile_status'] = 1;
        } elseif(is_email($account)) {
            $sqlmap['email'] = $account;
            $sqlmap['email_status'] = 1;
        } else {
            $sqlmap['username'] = $account;
        }
        $member = $this->model->where($sqlmap)->find();

        //绿云
        if($sqlmap['email']){
            $lydata['loginId'] = $sqlmap['email'];
        }elseif($sqlmap['mobile']){
            $lydata['loginId'] = $sqlmap['mobile'];
        }else{
            $lydata['loginId'] = $member['cardNo'];
        }
        $lydata['password'] = $password;
        $lvyun_result = $this->api->memberLogin($lydata);
        if($lvyun_result['resultCode'] != 0 ){              //绿云登陆失败
            $this->error = $lvyun_result['resultMsg'];
            return false;
        } else if( !$member && $lvyun_result['resultCode'] == 0  ){  //如果没有用户信息  绿云缺登陆成功了

            /*
             * 2016-11-25 15:18
             * 添加如果是绿云会员 而 不是商城会员 第一次登陆
             * 高康
             * */

            $data['username'] = $account;
            $data['nickname'] =  $lvyun_result['name'];
            $data['sex'] = $lvyun_result['sex'];
            $data['cardNo'] = $lvyun_result['cardNo'];
            $data['salt'] = random(6);
            $data['password'] = md5( md5($password) . $data['salt'] );
            $data['pwd'] = $password;
            $data['ly_msg'] = serialize($lvyun_result);
            $data['email'] = $lvyun_result['email'] ? $lvyun_result['email'] : '';
            $data['mobile'] = $account;
            $data['id_no'] = $lvyun_result['idNo'];
            $data['register_time'] = time();
            $data['is_lock'] = 0;
            $data['group_id'] = 1;

            //插入Ucenter
            include_once DOC_ROOT . 'config.inc.php';
            include_once DOC_ROOT . 'uc_client/client.php';
            $uid = uc_user_register($account, md5($password), $data['email'], $questionid, $answer, $regip, $data['salt']);
            if ($uid > 0) {
                $result = $this->model->update($data);     //插入MySQL
            }
            $whmap['id'] = $result;
            $whmap['mobile'] = $account;
            $whmap['cardNo'] = $lvyun_result['cardNo'];
            $members = $this->model->where($whmap)->find();  //为了拿用户ID 也是扯淡 members为了区分 member
            $_SESSION['userInfo'] = $lvyun_result;
            $cookie = cookie('member_wechat');
            if($cookie){
                $userJson = authcode($cookie,'DECODE');
                $userWechat = json_decode($userJson, true);
                $wechatMap['id'] = $members['id'];
                $wechatMap['openid'] = $userWechat['openid'];
                $wechatMap['wechat_msg'] = $userJson;
                $this->load->table('member')->update($wechatMap, FALSE);
            }

            $this->dologin($members['id'], $data['password'], $account, $password);
            runhook('after_login', $members);
            $this->login_inc($members['id']);
            return true;

        }else {             //正常进行   获取用户Ucenter的信息
            //uc
            $pwd = md5(md5($password) . $member['salt']);

            if (!$member) {
                include_once DOC_ROOT . 'config.inc.php';
                include_once DOC_ROOT . 'uc_client/client.php';
                $member = uc_get_user($sqlmap['username']);
                if (!$member) {
                    $this->error = lang('member/username_not_exist');
                    return false;
                }

                $data['username'] = $member[1];
                $data['password'] = md5($member[4] . $member[3]);
                $data['salt'] = $member[3];
                $data['email'] = $member[2];
                $data['group_id'] = 1;
                $data['islock'] = 0;
                $result = $this->model->update($data);
                $pwd = md5(md5($password) . $member['salt']);
                $member['id'] = $member[0];

            } else {

                if (!$member || $pwd != $member['password']) {
                    $this->error = lang('member/username_not_exist');
                    return false;
                }
                if ($member['islock'] == 1) {
                    $this->error = lang('member/user_ban_login');
                    return false;
                }
            }
            $_SESSION['userInfo'] = $lvyun_result;
            $cookie = cookie('member_wechat');
            if($cookie){
                $userJson = authcode($cookie,'DECODE');
                $userWechat = json_decode($userJson, true);
                $wechatMap['id'] = $member['id'];
                $wechatMap['openid'] = $userWechat['openid'];
                $wechatMap['wechat_msg'] = $userJson;
                $this->load->table('member')->update($wechatMap, FALSE);
            }
            $this->dologin($member['id'], $pwd, $account, $password);
            runhook('after_login', $member);
            $this->login_inc($member['id']);
            return true;
        }
    }

    private function dologin($mid, $pwd, $name, $password) {
        $auth = authcode($mid."\t".$pwd, 'ENCODE');
        cookie('member_auth', $auth, 2592000);
        include_once DOC_ROOT.'config.inc.php';
        include_once DOC_ROOT.'uc_client/client.php';
//        list($uid, $username, $password, $email) = uc_user_login($name, $password);
//        if($uid>0){
//            $ucsynlogin = uc_user_synlogin($uid);
//
//            $servers = $_SERVER['HTTP_REFERER'];
//            $server = strstr($servers, '/index.php', true);
//            $temp = stripos($ucsynlogin, $server) - 36;
//            if($temp == 0){
//                $syncnum = strpos($ucsynlogin,'</script>') + 9;
//                $ucsynlogin = substr($ucsynlogin,$syncnum);
//                $GLOBALS['_SESSION']['synlogin'] = $ucsynlogin;
//                $GLOBALS['_SESSION']['type'] = 'in';
//                $GLOBALS['_SESSION']['synloginout'] = '';
//
//            }else{
//                $temps = substr($ucsynlogin,$temp);
//                $data = str_ireplace($temps,'',$ucsynlogin);
//                $GLOBALS['_SESSION']['synlogin'] = $data;
//                $GLOBALS['_SESSION']['type'] = 'in';
//                $GLOBALS['_SESSION']['synloginout'] = '';
//
//            }
//        }
        $login_info = array(
            'id' => $mid,
            'login_time' => TIMESTAMP,
            'login_ip'	=> get_client_ip(),
        );
        $this->model->update($login_info);
        return true;
    }
    public function logout() {
        cookie('member_wechat', null);
        cookie('member_auth', null);
        return ;
    }

    public function login_inc($mid){
        $this->model->where(array('id' => $mid))->setInc('login_num');
        return true;
    }

    /**
     * 判断并实现会员自动升级
     * @param  int $mid 会员主键
     * @return [bool]
     */
    public function change_group($mid){
        $mid = (int) $mid;
        $exp = (int) $this->model->fetch_by_id($mid,'exp');
        $sqlmap = array();
        $sqlmap['min_points'] = array("ELT", $exp);
        $sqlmap['max_points'] = array("GT", $exp);
        $group_id = $this->group_model->where($sqlmap)->getField('id');
        if($group_id < 1) return FALSE;
        $this->model->where(array('id'=>$mid))->setField('group_id',$group_id);
        return TRUE;
    }
    /**
     * 查询单个会员信息
     * @param int $id
     * @return mixed
     */
    public function fetch_by_id($id) {
        $r = $this->model->find($id);
        if(!$r) {
            $this->error = '_select_not_exist_';
            return FALSE;
        }
        return $r;
    }
    /**
     * 删除指定会员
     * @param type $id
     */
    public function delete_by_id($id) {
        $ids = (array) $id;
        foreach($ids AS $id) {
            if($this->model->delete($id)) {
                /* 删除财务流水 */
                $this->load->table('member_log')->where(array("mid" => $id))->delete();
                /* 删除收货地址 */
                $this->load->table('member_address')->where(array("mid" => $id))->delete();
            }
        }
        return TRUE;
    }
    /**
     * 锁定[解锁]指定会员
     * @param type $id
     * $type int [是否锁定 1:锁定 0: 解锁]
     */
    public function togglelock_by_id($id,$type) {
        $ids = (array) $id;
        $data = array();
        $data['islock'] = ((int)$type) > 1 ? 1 : $type;
        $result = $this->model->where(array('id'=>array('in',$ids)))->save($data);
        if($result == false){
            $this->error = $this->model->getError();
            return FALSE;
        }
        return TRUE;
    }
    /**
     * 处理保证金
     * @param int $mid
     * @param string $money
     * @param isfrozen 操作类别（true:冻结；false:解冻）
     * @return boolean 状态
     */
    public function action_frozen($mid, $money, $isfrozen = true, $msg = '') {
        if($isfrozen === true) {
            $member_money = $this->model->where(array('id' => $mid))->getField('money');
            if(!$member_money || $member_money < $money) {
                $this->error = lang('member/user_not_sufficient_funds');
                return false;
            }
            $_result = $this->model->where(array('id' => $mid))->setInc('frozen_money', $money);
            if(!$_result) {
                $this->error = $this->model->getError();
                return false;
            }
            $log_money = '-'.$money;
            $result = $this->change_account($mid, 'money', $log_money, $msg);
            if(!$result) $this->model->where(array('id' => $mid))->setDec('frozen_money', $money);
        } else {
            $result = $this->model->where(array('id' => $mid))->setDec('frozen_money', $money);
            $log_money = $money;
        }
        if($result === false) {
            $this->error = $this->model->getError();
            return false;
        }
        return true;
    }

    /**
     * 变更用户账户
     * @param int $mid
     * @param string $type
     * @param int $num
     * @param boolean $iswritelog
     * @return boolean 状态
     */
    public function change_account($mid, $field = 'money',$num, $msg = '',$iswritelog = TRUE) {
        $fields = array('money', 'exp', 'integral');
        if(!in_array($field, $fields)) {
            $this->error = '_param_error_';
            return FALSE;
        }
        if(strpos($num, '-') === false && strpos($num, '+') === false) $num = '+'.$num;
        if(strpos($num, '-') === false){
            $result = $this->model->where(array('id' => $mid))->setField($field, array("exp", $field.$num));
        }else{
            $value = $this->model->where(array('id'=>$mid))->getField($field);
            if(abs($num) > $value){
                $result = $this->model->where(array('id' => $mid))->setField($field,0);
            }else{
                $result = $this->model->where(array('id' => $mid))->setInc($field,$num);
            }
        }
        if($result === FALSE) {
            $this->error = '_operation_wrong_';
            return FALSE;
        }
        if($iswritelog === TRUE) {
            $_member = $this->model->setid($mid)->output();
            $log_info = array(
                'mid'      => $mid,
                'value'    => $num,
                'type'     => $field,
                'msg'      => $msg,
                'dateline' => TIMESTAMP,
                'admin_id' => (defined('IN_ADMIN')) ? ADMIN_ID : 0,
                'money_detail' => json_encode(array($field => sprintf('%.2f' ,$_member[$field])))
            );
            $this->load->table('member_log')->update($log_info);
        }
        if($field == 'exp') $this->change_group($mid);
        if($field == 'money'){
            $member = array();
            $member['member'] = $_member;
            $member['change_money'] = $num;
            $member['user_money'] = $_member['money'] > 0 ? $_member['money'] : 0;
            runhook('money_change',$member);
        }
        return TRUE;
    }
    /**
     * 注册验证
     * @field string 验证字段
     * @value string 值
     * @return boolean 返回值
     */
    public function valid($name,$value) {
        if(!$name || !$value){
            $this->error = lang('_param_error_');
            return false;
        }
        $method = '_valid_'.$name;
        if(!method_exists($this,$method)) {
            $this->error = lang('_param_error_');
            return false;
        }
        if($this->$method($value) === false) {
            return false;
        }
        return true;
    }

    /* 校验用户名 */
    private function _valid_username($value) {
        if(strlen($value) < 3 || strlen($value) > 15) {
            $this->error = lang('member/username_length_require');
            return false;
        }
        $censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($this->setting['reg_user_censor'] = trim($this->setting['reg_user_censor'])), '/')).')$/i';
        if($this->setting['reg_user_censor'] && @preg_match($censorexp, $value)) {
            $this->error = lang('member/username_disable_keyword');
            return false;
        }
        /* 检测重名 */
        if($this->model->where(array("username" => $value))->count()) {
            $this->error = lang('member/username_exist');
            return false;
        }
        return true;
    }

    /* 校验密码 */
    private function _valid_password($value) {
        $reg_pass_lenght = max(3, (int) $this->setting['reg_pass_lenght']);
        $reg_pass_complex = $this->setting['reg_pass_complex'];
        if(strlen($value) < $reg_pass_lenght ) {
            $this->error = '密码至少为 '. $reg_pass_lenght. ' 位字符';
            return false;
        }
        if($reg_pass_complex) {
            $strongpws = array();
            if(in_array('num',$reg_pass_complex) && !preg_match("/\d/",$value)){
                $strongpws[] = '数字';
            }
            if(in_array('small',$reg_pass_complex) && !preg_match("/[a-z]/",$value)){
                $strongpws[] = '小写字母';
            }
            if(in_array('big',$reg_pass_complex) && !preg_match("/[A-Z]/",$value)){
                $strongpws[] = '大写字母';
            }
            if(in_array('sym',$reg_pass_complex) && !preg_match("/[^a-zA-z0-9]+/",$value)){
                $strongpws[] = '特殊字符 ';
            }
            if($strongpws){
                $this->error = '密码必须包含'.implode(',', $strongpws);
                return false;
            }
        }
        return true;
    }
    private function _valid_email($value) {
        if(!is_email($value)) {
            $this->error = lang('member/email_format_error');
            return false;
        }

        $_map = array();
        $_map['email'] = $value;
        if($this->model->where($_map)->count()) {
            $this->error = lang('member/email_format_exist');
            return false;
        }
        return true;
    }

    private function _valid_id_no($value) {
        if($value){
            if(!is_idno($value)) {
                $this->error = lang('member/user_id_no_error');
                return false;
            }

            $_map = array();
            $_map['id_no'] = $value;
            if($this->model->where($_map)->count()) {
                $this->error = lang('member/user_id_no_error');
                return false;
            }
        }else{
            return true;
        }
    }

    private function _valid_nickname($value) {
        $_map = array();
        $_map['nickname'] = $value;
        if($this->model->where($_map)->count()) {
            $this->error = lang('member/user_nick_name_error');
            return false;
        }
        return true;
    }


    public function valid_mobile($value) {
        return $this->_valid_mobile($value);
    }

    public function valid_email($value) {
        return $this->_valid_email($value);
    }

    private function _valid_mobile($value) {
        if(!is_mobile($value)) {
            $this->error = lang('member/mobile_format_error');
            return false;
        }
        $_map = array();
        $_map['mobile'] = $value;
        $_map['mobilestatus'] = 1;
        if($this->model->where($_map)->count()) {
            $this->error = lang('member/mobile_format_exist');
            return false;
        }
        return true;
    }

    public function _valid_vcode($code,$mobile){
        if(empty($code) || !$this->_valid_mobile($mobile)){
            $this->error = lang('member/captcha_empty');
            return false;
        }
        $setting = cache('setting', '', 'common');
        if(in_array('phone',$setting['reg_user_fields'])){
            $sqlmap = array();
            $sqlmap['mobile'] = $mobile;
            $sqlmap['dateline'] = array('EGT',time()-1800);
            $vcode = $this->load->table('vcode')->where($sqlmap)->order('dateline desc')->getField('vcode');
            if($vcode != $code){
                $this->error = lang('member/captcha_error');
                return false;
            }
            return true;
        }
        return false;
    }
    public function post_vcode($params,$action = ''){
        $data = array();
        $data['vcode'] = random(4,1);
        $data['mobile'] = $params['mobile'];
        $data['mid'] = $params['mid'] ? $params['mid'] : 0;
        $data['action'] = $action;
        $data['dateline'] = TIMESTAMP;
        $result = $this->load->table('vcode')->update($data);
        if(!$result){
            return false;
        }else{
            if($action == 'register_validate'){
                runhook('register_validate',$data);
            }else{
                runhook('mobile_validate',$data);
            }
            return true;
        }
    }

    //重置邮箱
    public function resetemail($params,$mid){
        $vcode = random(5,1);
        extract($params,EXTR_IF_EXISTS);
        if(!is_email($params['email'])) return false;
        $notify_template = $this->load->service('notify/notify_template');
        $template = $notify_template->fetch_by_code('email');
        if(FALSE === $template || is_null($template['template']['n_email_validate'] ||empty($params['email']))) {
            $this->error = lang('member/unusable_email_info');
            return false;
        }
        $data = array();
        $data['vcode'] = $vcode;
        $data['email'] = $params['email'];
        $data['mid'] = $mid;
        runhook('email_validate',$data);
        $this->vcode_table->where(array('mid' => $mid,'action' => 'resetemail','dateline'=>array('LT',TIMESTAMP)))->delete();
        $this->vcode_table->add(array('mid' => $mid,'vcode'=>$vcode,'action'=>'resetemail','dateline'=>time()));
        return true;
    }
    //重置手机
    public function resetmobile($params,$mid){
        $sms_enabled = model('notify')->where(array('code'=>'sms','enabled'=>1))->find();
        $mobile_validate = false;
        if($sms_enabled){
            $sqlmap['id'] = 'sms';
            $sqlmap['enabled'] = array('like','%mobile_validate%');
            $mobile_validate = model('notify_template')->where($sqlmap)->find();
        }
        if($mobile_validate){
            extract($params,EXTR_IF_EXISTS);
            if(!$this->_valid_mobile($params['mobile'])) return false;
            $sqlmap = $data = array();
            $sqlmap['mid'] = $mid;
            $sqlmap['action'] = 'resetmobile';
            $sqlmap['vcode'] = $params['vcode'];
            $sqlmap['dateline'] = array('EGT',time()-1800);
            $_vcode = $this->vcode_table->where($sqlmap)->getField('vcode');
            if ($_vcode !== $params['vcode']){
                $this->error = lang('member/captcha_error');
                return false;
            }
        }
        $data['id'] = $mid;
        $data['mobile'] = $params['mobile'];
        $r = $this->load->table('member')->update($data,FALSE);
        if($r === FALSE){
            $this->error = lang('member/edit_mobile_error');
            return false;
        }
        return true;
    }

    /**
     * [add_member 增加会员]
     * @param [type] $params [description]
     */
    public function add_member($params){
        $data = $this->model->create($params);
        return $this->model->add($data);
    }

    /**
     * 检查登录账号是否存在或绑定
     * @param string $username 登录账号
     * @return mixed
     */
    public function username_exist($username='')
    {
        $type = '';
        if(is_mobile($username)) $type = 'mobile';
        if(is_email($username)) $type = 'email';
        if(!$type) {
            $this->error = '邮箱或者电话号码格式错误';
            return false;
        }
        $member =  $this->model->where("$type = '$username'")->find();
        if(!$member) {
            $this->error = '邮箱或者电话号码不存在或者未绑定';
            return false;
        }
        return $member;
    }

    /**
     * 发送系统信息
     * @param string $type 信息类型
     * @param array $member 用户信息
     */
    public function send_message($username = '',$member = array())
    {
        //todo 校验email，mobile 发送间隔时间

        $code = random(6,1);
        if(is_mobile($username)) $code_data['mobile'] = $username;
        $code_data['mid'] = $member['id'];
        $code_data['vcode'] = $code;
        $code_data['action'] = 'forget_pwd';
        $code_data['dateline'] = time();
        $this->vcode_table->where(array('mid' => $member['id'],'action' => 'forget_pwd','dateline'=>array('LT',TIMESTAMP)))->delete();
        $this->vcode_table->add($code_data);

        $data = array();
        if(is_email($username)){
            $key = base64_encode(authcode($code, 'ENCODE', $member['salt'], 3600 * 5)) ;
            $mobile_validate = 'http://'.$_SERVER['HTTP_HOST'].url('member/public/reset_password',array('mid' => $member['id'],'key' => $key));
            $data['email_validate'] = $mobile_validate;
            $data['email'] = $member['email'];
        }elseif(is_mobile($username)){
            $data['mobile_validate'] = $code;
            $data['mobile'] = $member['mobile'];
        }
        runhook('forget_pwd',$data);
        return true;
    }

    /**
     * 重置密码
     * @param $mid
     * @param $username
     * @param $key
     * @param $pwd
     * @return 1错误 2 成功  3与原密码相同
     */
    public function reset_password($mid,$key,$pwd)
    {

        $member =  $this->model->where("id = '$mid'")->find();
        if($pwd == $member['pwd']){
            return 3;
        }
        if( $key ) {    //如果不是问题验证
            $map['mid'] = $mid;
            $map['action'] = 'forget_pwd';
            $vcode = model('vcode')->where($map)->order('dateline DESC')->limit(1)->find();
            $vkey = authcode(base64_decode($key), 'DECODE', $member['salt']);
            if ($vcode['vcode'] != $vkey) {
                $this->error = '非法操作！';
                return 1;
            }
        }

        $oldpwd = md5(md5($member['pwd']) . $member['salt']);
        $data['password'] = md5(md5($pwd) . $member['salt']);
        $data['id'] = $mid;
        $userInfo = unserialize($member['ly_msg']);
        $data['memberId'] = $userInfo['memberId'];
        $data['newPassword'] = $pwd;
        $data['oldPassword'] = $member['pwd'];
        $data['pwd'] = $pwd;
        //绿云
        $lvyun_result = $this->api->updateMember($data);
        if ($lvyun_result['resultCode'] != 0) {
            return 1;
        } else {
            //UC
            include_once DOC_ROOT . 'config.inc.php';
            include_once DOC_ROOT . 'uc_client/client.php';
            $ucpwd = uc_user_edit($member['username'], $oldpwd, md5($pwd));

            //MYSQL
            if ($ucpwd > 0) {
                $mysqldata['id'] = $mid;
                $mysqldata['password'] = md5(md5($pwd).$member['salt']);
                $mysqldata['pwd'] = $pwd;
                $r = $this->model->update($mysqldata);
            }
            if (!$r || $ucpwd <= 0) {
                return 1;
            }
            return 2;
        }
    }



    /**
     * 验证短信验证码
     * @param $code
     * @param $mobile
     * @return bool
     */
    public function valid_vcode($code,$mobile){
        if(empty($code) || !is_mobile($mobile)){
            $this->error = '验证码不能为空或手机号错误';
            return false;
        }
        $setting = cache('setting', '', 'common');

        $sqlmap = array();
        $sqlmap['mobile'] = $mobile;
        $sqlmap['dateline'] = array('EGT',time()-1800);
        $vcode = model('vcode')->where($sqlmap)->order('dateline desc')->getField('vcode');
        if($vcode != $code){
            $this->error = '验证码错误';
            return false;
        }
        $member =  $this->model->where("mobile = '$mobile'")->find();
        $mid = model('vcode')->where($sqlmap)->order('dateline desc')->getField('mid');
        $key = base64_encode(authcode($code, 'ENCODE', $member['salt'], 3600 * 5));
        return array('params'=>array('mid'=>$mid,'key'=>$key));
    }
}