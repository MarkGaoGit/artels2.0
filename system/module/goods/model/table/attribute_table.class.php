<?php
/**
 *		商品属性数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class attribute_table extends table {
	protected $_validate = array(
       /* array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间]) */
		array('name', 'require', '{goods/goods_attribute_name_require}', table::MUST_VALIDATE),
	);
    protected $_auto = array(
		
    );
}