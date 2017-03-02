<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
Core::load_class('init', 'admin');
class member_log_control extends init_control
{
    public function _initialize() {
        parent::_initialize();
        $this->service = $this->load->service('member_log');
        $this->model = $this->load->table('member_log');
    }

    public function index() {
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int) $_GET['limit'] :20;
    	$sqlmap = array('type' => 'money');
    	$lists = $this->model->where($sqlmap)->page($_GET['page'])->limit($limit)->order('dateline desc')->select();
    	$count = $this->model->where($sqlmap)->count();
    	$pages = $this->admin_pages($count, $limit);
        $this->load->librarys('View')->assign('lists',$lists);
        $this->load->librarys('View')->assign('pages',$pages);
        $this->load->librarys('View')->display('member_log');
    }
}