<?php
/**
 *		显示营销数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class promotion_time_table extends table {
	protected $_validate = array(
        array('name','require','{promotion/title_require}',table::MUST_VALIDATE),
    );
}