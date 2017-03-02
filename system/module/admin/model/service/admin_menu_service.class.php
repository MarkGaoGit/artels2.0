<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class admin_menu_service extends service
{
	protected $sqlmap = array();

	public function __construct() {
		$this->model = $this->load->table('admin/admin_menu');
	}
	
	public function fetch_all_by_admin_id($admin_id = 0) {
		return $this->model->where(array('admin_id' => $admin_id))->select();
	}
}