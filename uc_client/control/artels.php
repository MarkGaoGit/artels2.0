<?php

/*
 * [Powerlong] Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * Ucenter接口 --- 艺境订单（艺术品 & 衍生品）
 * Author : gaokang
 * time : 2016-11-21
*/

!defined('IN_UC') && exit('Access Denied');

class artelscontrol extends bases
{


	function __construct()
	{
		$this->artelscontrol();
	}

	function artelscontrol()
	{
		parent::__construct();
		$this->load('artels');
	}

	function onadd()
	{
		$this->init_input();
		$sn = $this->input('sn');
		$buyer_id = $this->input('buyer_id');
		$seller_ids = $this->input('seller_ids');
		$source = $this->input('source');
		$pay_type = $this->input('pay_type');
		$sku_amount = $this->input('sku_amount');
		$delivery_amount = $this->input('delivery_amount');
		$real_amount = $this->input('real_amount');
		$paid_amount = $this->input('paid_amount');
		$balance_amount = $this->input('balance_amount');
		$pay_method = $this->input('pay_method');
		$pay_sn = $this->input('pay_sn');
		$address_name = $this->input('address_name');
		$address_mobile = $this->input('address_mobile');
		$address_detail = $this->input('address_detail');
		$address_district_ids = $this->input('address_district_ids');
		$invoice_tax = $this->input('invoice_tax');
		$invoice_title = $this->input('invoice_title');
		$invoice_content = $this->input('invoice_content');
		$status = $this->input('status');
		$pay_status = $this->input('pay_status');
		$confirm_status = $this->input('confirm_status');
		$delivery_status = $this->input('delivery_status');
		$finish_status = $this->input('finish_status');
		$pay_time = $this->input('pay_time');
		$system_time = $this->input('system_time');
		$promot_amount = $this->input('promot_amount');
		$uc_lvyun_order = $_ENV['artels']->add_order($sn, $buyer_id, $seller_ids, $source, $pay_type, $sku_amount, $delivery_amount, $real_amount, $paid_amount, $balance_amount, $pay_method, $pay_sn, $address_name, $address_mobile, $address_detail, $address_district_ids, $invoice_tax, $invoice_title, $invoice_content, $status, $pay_status, $confirm_status, $delivery_status, $finish_status, $pay_time, $system_time, $promot_amount);
		return $uc_lvyun_order;
	}
}

?>