<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class taglib_navigation
{
	public function __construct() {
		$this->misc_service = model('misc/navigation','service');
	}
	public function lists($sqlmap = array(), $options = array()) {
		return $this->misc_service->lists($sqlmap,$options);
	}
}