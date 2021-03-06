<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class admin_user_service extends service
{
	protected $sqlmap = array();

	public function __construct() {
		$this->model = $this->load->table('admin_user');
	}
	/**
	 * [获取所有团队成员]
	 * @param array $sqlmap 数据
	 * @return array
	 */
	public function getAll($sqlmap = array()) {
		$this->sqlmap = array_merge($this->sqlmap, $sqlmap);
		return $this->model->where($this->sqlmap)->select();
	}
	
	/**
	 * [更新团队]
	 * @param array $data 数据
	 * @param bool $valid 是否M验证
	 * @return bool
	 */
	public function save($data, $valid = FALSE) {
		if($valid == TRUE){
			$data = $this->model->create($data);
			$result = $this->model->add($data);
		}else{
			$result = $this->model->update($data);
		}
		if($result === false) {
			$this->error = $this->model->getError();
			return false;
		}
		return TRUE;
	}
}