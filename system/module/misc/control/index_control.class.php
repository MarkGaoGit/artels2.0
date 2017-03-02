<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
Core::load_class('init', 'goods');
class index_control extends init_control {
	public function _initialize() {
		parent::_initialize();
		$this->category = $this->load->service('article_category');
		$this->article = $this->load->service('article');
		$this->model = model('misc/article');
        $this->memcache = $this->load->service('goods/memcache');
	}
	/**
	 * [help_lists 前台帮助列表页]
	 */
	public function help_lists(){
		$this->load->librarys('View')->display('help_lists');
	}
	/**
	 * [help_dettail 前台帮助详情页]
	 */
	public function help_detail(){
		$id = (int) $_GET['id'];
		$row = $this->load->service('help')->get_help_by_id($id);
		if(!$row)
			showmessage(lang('_param_error_'));
		extract($row);
		$SEO = seo($title.' - 帮助中心');
		$this->load->librarys('View')->assign('SEO',$SEO);
		$this->load->librarys('View')->assign($row,$row);
        $this->load->librarys('View')->display('help_detail');
	}

	/**
	 * [article_lists 文章列表]
	 */
	public function article_lists(){

		$types = $_GET['types'];
		// 添加文章 添加节点 分配权限 后台菜单列表更改

        if($types == 'hotelnews'){
            /*酒店相关的新闻*/
            $wherezx['category_id'] = 4;
            $wherezx['display'] = 1;

		}elseif($types == 'recruit'){
			$wherezx['category_id'] = 5;
			$wherezx['display'] = 1;
		}else{
            /*艺术资讯 艺术展览*/
            $wherezx['category_id'] = array('IN','1,2');
            $wherezx['display'] = 1;

            /*艺术教育*/
            $wherejy['category_id'] = 3;
            $wherejy['display'] = 1;
            $articleEducationJson = $this->memcache->get('articleEdu');
            $articleEducation = json_decode($articleEducationJson,true);
            if( empty($articleEducation) ){
                $articleEducation = $this->model->where($wherejy)->order('sort ASC')->select();
                $articleEducationJson = json_encode($articleEducation);
                $this->memcache->set( 'articleEdu', $articleEducationJson, false, 1200 );
            }
		}

        $articleNewsJson = $this->memcache->get( 'yshArticle' );
        $articleNews = json_decode($articleNewsJson, true);
        if( empty($articleNews) ){
            $articleNews = $this->model->where($wherezx)->order('sort ASC')->select();
            $articleNewsJson = json_encode($articleNews);
            $this->memcache->set( 'yshArticle', $articleNewsJson, false, 1200 );
        }


		$this->load->librarys('View')->assign('news',$articleNews);
		$this->load->librarys('View')->assign('education',$articleEducation);
		$this->load->librarys('View')->display('article_list');
	}

	/**
	 * [article_lists 文章列表 移动端]
	 */

	public function mobile_article_lists(){

		/*艺术资讯 艺术展览*/
        $get = $_GET;
		$wherezx['category_id'] = $get['cid'];
		$wherezx['display'] = 1;
        $articleNewsJson = $this->memcache->get('m-articleNews'.$get['cid']);
        $articleNews = json_decode($articleNewsJson, true);
        if( empty($articleNews) ){
            $articleNews = $this->model->where($wherezx)->order('sort ASC')->select();
            $articleNewsJson = json_encode($articleNews);
            $this->memcache->set( 'm-articleNews'.$get['cid'], $articleNewsJson, false );
        }

		foreach($articleNews as $k=>$v){
			$articleNews[$k]['keywords'] = substr($articleNews[$k]['keywords'],0 ,250) . '......';
		}

		$this->load->librarys('View')->assign('news',$articleNews);
		$this->load->librarys('View')->display('article_list');
	}

	/**
	 * [article_detail 文章详情页]
	 */
	public function article_detail(){
		$id = (int) $_GET['id'];
        $rowJson = $this->memcache->get('wenzhang'.$id);
        $row = json_decode($rowJson,true);
        if( empty($row) ){
            $row = $this->article->get_article_by_id($id);
            $rowJson = json_encode($row);
            $this->memcache->set( 'wenzhang'.$id, $rowJson,false );
        }
		if(!$row) 
			showmessage(lang('misc/article_not_exist'));
		$this->article->hits($id);
		$row['hits'] += 1;
		extract($row);

		//查询更多文章
//		$wherezx['category_id'] = array('IN','1,2');
//		$wherezx['display'] = 1;
//		$articleNews = $this->model->where($wherezx)->order('sort ASC')->limit('0,3')->select();
//		foreach($articleNews as $k=>$v){
//			$articleNews[$k]['keywords'] = substr($articleNews[$k]['keywords'],0 ,250) . '......';
//		}

//		$this->load->librarys('View')->assign('news',$articleNews);
		$this->load->librarys('View')->assign($row,$row);
		$this->load->librarys('View')->display('article_detail');
	}
}