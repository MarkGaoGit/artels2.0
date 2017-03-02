<?php

/*
* [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 绿云积分信息 --- 数据库
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class integralmodel {

	var $db;
	var $base;

	function __construct(&$base) {
		$this->integralmodel($base);
	}

	function integralmodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function get_user_integral($card_id) {
		$arr = $this->db->fetch_first("SELECT * FROM ".UC_DBTABLEPRE."ly_integral WHERE card_id='$card_id'");
		return $arr;
	}

	function add( $card_id, $card_no , $point_balance , $point_charge , $card_point_list ) {
		$result = $this->get_user_integral($card_id);
		if($result){
			return $this->edit_user_integral( $card_id, $point_balance , $point_charge , $card_point_list );
		}else{
			$this->db->query("INSERT INTO " . UC_DBTABLEPRE . "ly_integral SET card_id='$card_id', card_no='$card_no', point_balance='$point_balance', point_charge='$point_charge',card_point_list='$card_point_list'");
			$id = $this->db->insert_id();
			return $id;
		}

	}

	function edit_user_integral( $card_id, $point_balance , $point_charge , $card_point_list ) {
		$this->db->query("UPDATE ".UC_DBTABLEPRE."ly_integral SET point_balance='$point_balance', point_charge= '$point_charge',card_point_list = '$card_point_list' WHERE card_id='$card_id'");
		return $this->db->affected_rows();
	}

}

?>