<?php

/*
* [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 艺境订单（艺术品 & 衍生品） --- 数据库
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class artelsmodel {

	var $db;
	var $base;

	function __construct(&$base) {
		$this->artelsmodel($base);
	}

	function artelsmodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function add_order($sn , $buyer_id , $seller_ids , $source , $pay_type , $sku_amount , $delivery_amount , $real_amount , $paid_amount , $balance_amount , $pay_method , $pay_sn , $address_name , $address_mobile , $address_detail , $address_district_ids , $invoice_tax , $invoice_title , $invoice_content , $status , $pay_status , $confirm_status , $delivery_status , $finish_status , $pay_time , $system_time , $promot_amount) {
		$this->db->query("INSERT INTO " . UC_DBTABLEPRE . "artels_order SET
						 sn='$sn', buyer_id='$buyer_id', seller_ids='$seller_ids',
						 source='$source', pay_type='".$pay_type."', sku_amount='$sku_amount',
						 delivery_amount='$delivery_amount', real_amount='$real_amount', paid_amount='$paid_amount',
						 balance_amount='$balance_amount', pay_method='$pay_method',pay_sn='$pay_sn',
						 address_name='$address_name',address_mobile='$address_mobile', address_detail='$address_detail',
						 address_district_ids='$address_district_ids', invoice_tax='$invoice_tax',invoice_title='$invoice_title',
						 invoice_content='$invoice_content', status='$status',pay_status='$pay_status',
						 confirm_status='$confirm_status', delivery_status='$delivery_status',finish_status='$finish_status',
						 pay_time='$pay_time', system_time='$system_time',promot_amount = '$promot_amount'");
		$id = $this->db->insert_id();
		return $id;
	}

}

?>