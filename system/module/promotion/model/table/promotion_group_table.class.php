<?php
/**
 *		捆绑营销数据层
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */

class promotion_group_table extends table {
	protected $_validate = array(
        array('title','require','{promotion/title_require}',table::MUST_VALIDATE),
        array('subtitle','require','{promotion/subtitle_require}',table::MUST_VALIDATE),
    );
}