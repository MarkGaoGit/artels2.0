<?php
class favorite_control extends cp_control
{
	public function _initialize() {
		parent::_initialize();
		$this->service = $this->load->service('member/member_favorite');
		$this->sku_db = $this->load->table('goods/goods_sku');
	}

	public function index() {
		$sqlmap = array();
		$sqlmap = array('datetime'=>$_GET['closing']);
		if($_GET['sku_name']){
			$sqlmap['sku_name'] = array("LIKE","%".$_GET['sku_name']."%");
		}
		$result = $this->service->set_mid($this->member['id'])->lists($sqlmap, 20, $_GET['page']);
		foreach($result['lists'] as $k=>$v){
			$result['lists'][$k]['sku_name'] = str_replace('|','<br/>',$result['lists'][$k]['sku_name']);
		}
		$pages = pages($result['count'], 20);
		$SEO = seo('我的收藏夹 - 会员中心');
		$this->load->librarys('View')->assign('SEO',$SEO);
		$this->load->librarys('View')->assign('pages',$pages);
		$this->load->librarys('View')->assign($result,$result);
		$this->load->librarys('View')->display('favorite');
	}

	/* 添加收藏 */
	public function add() {
		$pid = (int) $_POST['pid'];
		if($pid < 1) {
			showmessage(lang('_param_error_'));
		}
		$where['spu_id'] = $pid;
		$skuDate = $this->sku_db->where($where)->select();
		$result = $this->service->set_mid($this->member['id'])->add($skuDate[0]['sku_id']);
		if($result === false) {
			showmessage($this->service->error);
		} else {
			showmessage(lang('member/add_collect_success'), '', 1);
		}
	}

	public function delete() {
		$sku_ids = (array) $_GET['sku_id'];
		$sku_ids = array_map('intval', $sku_ids);
		array_filter($sku_ids);
		if(empty($sku_ids)) {
			showmessage(lang('_param_error_'));
		}
		$result = $this->service->set_mid($this->member['id'])->delete($sku_ids);
		if($result === false) {
			showmessage($this->service->error);
		} else {
			showmessage(lang('member/delete_collect_success'), url('index'), 1);
		}
	}
	public function get_favorite(){
		$result  = $this->service->set_mid($this->member['id'])->get_favorite($_GET['page'],$_GET['limit'],$_GET['closing']);
		$this->load->librarys('View')->assign('result',$result);
		$result = $this->load->librarys('View')->get('result');
		echo json_encode($result);
	}

}