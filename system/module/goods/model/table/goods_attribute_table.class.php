<?php
/**
 *		商品品牌数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class goods_attribute_table extends table {
	protected $_validate = array(
        array('product_id','number','{goods/goods_id_require}',0,'regex',table::EXISTS_VALIDATE),
        array('attribute_id','number','{goods/attribute_id_require}',0,'regex',table::EXISTS_VALIDATE),
        array('type','number','{goods/attribute_type_require}',0,'regex',table::EXISTS_VALIDATE),
        array('status','number','{goods_state_require}',0,'regex',table::EXISTS_VALIDATE),
        array('sort','number','{goods/sort_require}',0,'regex',table::EXISTS_VALIDATE),
    );
    protected $_auto = array(
    );
}