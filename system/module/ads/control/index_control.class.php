<?php
class index_control extends control {
	public function _initialize() {
		parent::_initialize();
		$this->model = $this->load->table('ads/adv');
	}
	/**
	 * 跳转广告链接 并统计次数
	 */
	public function adv_view(){
		$id = $url = '';
		extract($_GET,EXTR_IF_EXISTS);
		$this->model->where(array('id'=>$id))->setInc('hist',1);
		redirect($url);
	}

}