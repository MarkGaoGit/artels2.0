<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class node_service extends service {
    protected $sqlmap = array();

    public function __construct() {
        $this->model = $this->load->table('node');
    }
    public function setAdminid($admin_id) {
        return $this;
    }

    public function getAll() {
        $this->sqlmap['status'] = 1;
        $result =  $this->model->where($this->sqlmap)->order('sort ASC,id ASC')->select();
        return $this->_format($result);
    }


	public function fetch_all_by_ids($ids, $status = -1) {
		$_map = array();
		if($ids) {
			$_map['id'] = array("IN", explode(",", $ids));
		}
        if($status > -1) {
            $_map['status'] = $status;
        }
		$result = $this->model->where($_map)->order('sort ASC,id ASC')->select();;
		return $this->_format($result);
	}

	public function get_checkbox_data(){
		return$this->model->where(array('status'=>1))->getField('id as id,parent_id,name',TRUE);
	}

    private function _format($data) {
        if(empty($data)) return false;
        $result = array();
        foreach($data as $k => $v) {
            $v['url'] = url($v['m'].'/'.$v['c'].'/'.$v['a'], $v['param']);
            $result[$k] = $v;
        }
        return $result;
    }
}
