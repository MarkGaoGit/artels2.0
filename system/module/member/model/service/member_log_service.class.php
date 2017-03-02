<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class member_log_service extends service {
	public function __construct() {
         $this->model = $this->load->table('member/member_log');
	}
	public function add($params){
        $data = $this->model->create($params);
        return $this->model->add($data);
    }
}