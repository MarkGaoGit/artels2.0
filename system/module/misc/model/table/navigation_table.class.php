<?php
/**
 *	    友情链接数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class navigation_table extends table {
    protected $_validate = array(
        array('name','require','{misc/article_name_require}',0),
		array('sort','number','{misc/sort_require}',2),
    );

    protected $_auto = array(
    	
    );
}