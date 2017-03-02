<?php
/**
 *      Copyright ? 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
$_filename = basename(__FILE__, '.php');
list(, $method, $driver) = explode(".", $_filename);
define('_PAYMENT_', $driver);
$_GET['m'] = 'pay';
$_GET['c'] = 'index';
$_GET['a'] = 'd'.$method;
include dirname(__FILE__).'/../../index.php';