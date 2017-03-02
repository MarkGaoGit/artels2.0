<?php

/*
 * [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 预订房间信息
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class lvyuncontrol extends bases {


	function __construct() {
		$this->lvyuncontrol();
	}

	function lvyuncontrol() {
		parent::__construct();
		$this->load('lvyun');
	}

	function onadd() {
		$this->init_input();
		$order_number =  $this->input('order_number');
		$arr =  $this->input('arr');
		$dep =  $this->input('dep');
		$rmtype =  $this->input('rmtype');
		$rateCode =  $this->input('rateCode') ;
		$rmNum =  $this->input('rmNum');
		$rsvMan =  $this->input('rsvMan');
		$mobile =  $this->input('mobile');
		$idNo =  $this->input('idNo');
		$cardNo =  $this->input('cardNo') ;
		$adult =  $this->input('adult');
		$remark =  $this->input('remark');
		$hotelIds =  $this->input('hotelIds');
		$uc_lvyun_order = $_ENV['lvyun']->add_order($order_number , $arr , $dep , $rmtype , $rateCode , $rmNum , $rsvMan , $mobile , $idNo , $cardNo , $adult , $remark , $hotelIds);
		return $uc_lvyun_order;
	}

}

?>