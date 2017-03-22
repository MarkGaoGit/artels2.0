<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
define('CHARSET', 'utf-8');
define('DOC_ROOT', str_replace("\\", '/', dirname(__FILE__) ).'/');

/*
 * *****************************************************
 *              开发英文版网站方法                         *
 * author : gaokang                                     *
 * time   : 2017-09-22                                  *
 * tel    : 021-51759999-5933                           *
 * 设置COOKIE 或 其他方法 表示 en cn 语言                   *
 * 判断语言后 设置其它配置参数等                             *
 * base.php 设置前端模板 缓存 配置文件 等                    *
 * index.php 入口文件 根据COOKIE 判断 然后设置 APP_PATH路径  *
 * * 　　　┏┓　　　┏┓
* 　　┏┛┻━━━┛┻┓
* 　　┃　　　　　　　┃
* 　　┃　　　━　　　┃
* 　　┃　┳┛　┗┳　┃
* 　　┃　　　　　　　┃
* 　　┃　　　┻　　　┃
* 　　┃　　　　　　　┃
* 　　┗━┓　　　┏━┛
* 　　　　┃　　　┃神兽保佑
* 　　　　┃　　　┃代码无BUG！
* 　　　　┃　　　┗━━━┓
* 　　　　┃　　　　　　　┣┓
* 　　　　┃　　　　　　　┏┛
* 　　　　┗┓┓┏━┳┓┏┛
* 　　　　　┃┫┫　┃┫┫
* 　　　　　┗┻┛　┗┻┛
* ━━━━━━神兽出没━━━━━━by:coder-pig
 * ******************************************************
 * */


define('APP_PATH', DOC_ROOT.'system/');
define('APP_DEBUG', false);
include APP_PATH.'base.php';
