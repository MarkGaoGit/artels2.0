<?php

/*
* [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 预订房间信息 --- 数据库
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class lvyunmodel {

	var $db;
	var $base;

	function __construct(&$base) {
		$this->lvyunmodel($base);
	}

	function lvyunmodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function add_order($order_number , $arr , $dep , $rmtype , $rateCode , $rmNum , $rsvMan , $mobile , $idNo , $cardNo , $adult , $remark , $hotelIds) {
		$this->db->query("INSERT INTO ".UC_DBTABLEPRE."ly_order SET  order_number='$order_number', arr='$arr', dep='$dep', rmtype='$rmtype', rate_code='".$rateCode."', rm_num='$rmNum', rsv_man='$rsvMan', mobile='$mobile', id_no='$idNo', card_no='$cardNo', adult='$adult',remark='$remark', hotel_id='$hotelIds'");
		$id = $this->db->insert_id();
		return $id;
	}

}

?>