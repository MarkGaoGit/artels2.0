<?php
/**
 * 		物流地区服务层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class delivery_district_service extends service {

	public function __construct() {
		$this->table = $this->load->table('order/delivery_district');
	}

	public function import($params){
		$data = $this->table->create($params);
		return $this->table->add($data);
	}
}