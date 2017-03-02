<?php

/*
* [Powerlong] Copyright  ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- CRM用户余额信息接口 --- 数据库
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class crmmodel {

	var $db;
	var $base;

	function __construct(&$base) {
		$this->crmmodel($base);
	}

	function crmmodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function get_crm_message($cardno) {
		$arr = $this->db->fetch_first("SELECT * FROM ".UC_DBTABLEPRE."crm_message WHERE cardno='$cardno'");
		return $arr;
	}

	function add( $cardno, $cardbalance , $cardfreezebalance , $cardintegral , $othbala  ) {
		$result = $this->get_crm_message($cardno);
		if($result){
			return $this->edit_crm_message( $cardno, $cardbalance , $cardfreezebalance , $cardintegral , $othbala  );
		}else{
			$this->db->query("INSERT INTO " . UC_DBTABLEPRE . "crm_message SET cardno='$cardno', cardbalance='$cardbalance', cardfreezebalance='$cardfreezebalance', cardintegral='$cardintegral',othbala='$othbala'");
			$id = $this->db->insert_id();
			return $id;
		}

	}

	function edit_crm_message( $cardno, $cardbalance , $cardfreezebalance , $cardintegral , $othbala ) {
		$this->db->query("UPDATE ".UC_DBTABLEPRE."crm_message SET cardbalance='$cardbalance', cardfreezebalance= '$cardfreezebalance',cardintegral = '$cardintegral', othbala = '$othbala' WHERE cardno='$cardno'");
		return $this->db->affected_rows();
	}

}

?>