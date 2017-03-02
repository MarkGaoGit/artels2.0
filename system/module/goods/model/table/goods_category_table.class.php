<?php
/**
 *		商品分类数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class goods_category_table extends table {
    protected $result;
	protected $_validate = array(
        array('name','require','{goods/classify_name_require}',table::MUST_VALIDATE),
        array('status','number','{goods/state_require}',table::EXISTS_VALIDATE,'regex',table:: MODEL_BOTH),
        array('sort','number','{goods/sort_require}',table::EXISTS_VALIDATE,'regex',table:: MODEL_BOTH),
    );
    protected $_auto = array(
    );
    public function get_fields(){
        return $this->fields['_type'];
    }
    public function detail($id,$field){
        $this->result['category'] = $this->field($field)->find($id);
        return $this;
    }
    public function output(){
        return $this->result['category'];
    }
}