<?php
/**
 *      统计服务层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class member_service extends service {

	public function __construct() {
		$this->order_model = $this->load->table('member');
	}

	public function _query($field,$sqlmap,$group){
		return $this->order_model->field($field)->where($sqlmap)->group($group)->select();
	}
	
	public function _count($field,$sqlmap){
		return $this->order_model->field($field)->where($sqlmap)->group($group)->count();
	}
}
