<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class member_deposit_service extends service
{
	protected $sqlmap = array();

	public function __construct(){
		$this->table = $this->load->table('member_deposit');
	}

	public function wlog($data = array(),$sqlmap = array()) {
		if(!empty($sqlmap) && $sqlmap !== TRUE){
			$r = $this->table->where($sqlmap)->save($data);
		}else{
			$r = $this->table->add($data);
		}
		return $r;
	}
	public function is_sucess($sqlmap){
		return  $this->table->where($sqlmap)->order('id DESC')->getField('order_status');
	}
}