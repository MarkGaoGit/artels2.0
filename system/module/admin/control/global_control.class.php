<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class global_control extends init_control
{
	public function _initialize() {
		parent::_initialize();

	}

    /* 管理登录 */
	public function index() {
		$this->load->librarys('View')->display('global_index');
    }
}