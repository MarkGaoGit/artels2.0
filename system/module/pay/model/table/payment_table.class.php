<?php
/**
 *		支付方式数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class payment_table extends table {
	protected $_validate = array(
        array('pay_code','require','{pay/pay_code_require}',table::MUST_VALIDATE),
        array('pay_name','require','{pay/pay_name_require}',table::MUST_VALIDATE),
        array('config','require','{pay/config_require}',table::MUST_VALIDATE),
    );
    protected $_auto = array(
    	array('dateline','time',2,'function'),
    );
}