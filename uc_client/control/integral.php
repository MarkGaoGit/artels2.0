<?php

/*
 * [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 绿云积分信息
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class integralcontrol extends bases {


	function __construct() {
		$this->integralcontrol();
	}

	function integralcontrol() {
		parent::__construct();
		$this->load('integral');
	}

	function onadd() {
		$this->init_input();
		$card_id =  $this->input('card_id');
		$card_no =  $this->input('card_no');
		$point_balance =  $this->input('point_balance');
		$point_charge =  $this->input('point_charge');
		$card_point_list =  $this->input('card_point_list') ;
		$uc_lvyun_order = $_ENV['integral']->add( $card_id, $card_no , $point_balance , $point_charge , $card_point_list );
		return $uc_lvyun_order;
	}

}

?>