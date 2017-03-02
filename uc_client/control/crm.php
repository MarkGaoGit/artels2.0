<?php

/*
 * [Powerlong] Copyright @ 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- CRM用户余额信息接口
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class crmcontrol extends bases {


	function __construct() {
		$this->crmcontrol();
	}

	function crmcontrol() {
		parent::__construct();
		$this->load('crm');
	}

	function onadd() {
		$this->init_input();
		$cardno =  $this->input('cardno');
		$cardbalance =  $this->input('cardbalance');
		$cardfreezebalance =  $this->input('cardfreezebalance');
		$cardintegral =  $this->input('cardintegral');
		$othbala =  $this->input('othbala') ;
		$uc_lvyun_order = $_ENV['crm']->add( $cardno, $cardbalance , $cardfreezebalance , $cardintegral , $othbala );
		return $uc_lvyun_order;
	}

}

?>