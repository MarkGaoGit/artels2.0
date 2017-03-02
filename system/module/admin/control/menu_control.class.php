<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class menu_control extends init_control
{
	public function _initialize() {
		parent::_initialize();
		$this->service = $this->load->service('admin_menu');
	}

    /* 管理登录 */
	public function index() {
		$menus = $this->service->fetch_all_by_admin_id($this->admin['id']);
		$this->load->librarys('View')->assign('menus',$menus);
		$this->load->librarys('View')->display('menu_index');
	}
}