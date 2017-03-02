<?php
/**
 *	    文章分类数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class article_category_table extends table {
    protected $_validate = array(
        array('name','require','{misc/classkit_name_require}',0),
		array('parent_id','number','{misc/parent_class_not_exist}',2),
		array('sort','number','{misc/sort_require}',2),
    );
    protected $_auto = array(
    	
    ); 
}