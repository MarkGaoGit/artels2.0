<?php
/**
 * [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 * This is NOT a freeware, use is subject to license terms
 * memcache操作
 * Author : gaokang
 * time : 2016-12-09
 */

class memcache_service extends service {

    public function __construct() {
//		$host = '127.0.0.1';
//        $port = '11211';
        $this->m = new memcache();
//        $this->m->addserver( $host , $port );
	}

    /*
     * 设置缓存
     * @key[String] 缓存的键
     * @val[String] 缓存的值
     * @flag[Boolean]  是否压缩数据
     * @expire[int]  默认5分钟的缓存
     * @return [Boolean] 布尔值 true false
     * **/
    public function set( $key, $var, $flag = false, $expire = 300 ){
        $status = $this->m->set( $key, $var, $flag, $expire );
        return $status;
    }

    /*
     * 取缓存
     * @key[String] 缓存的键
     * @return[String] 返回字符串
     * **/
    public function get( $key ){
        $data = $this->m->get( $key );
        return $data;
    }

    /*
     * 删除某一个缓存
     * @key [String] 需要删除的缓存的键
     * @timeout [int] 默认10秒后过期
     * @return [Boolean] 布尔值 true false
     * **/
    public function delete( $key, $timeout = 10 ){
        $status = $this->m->delete( $key, $timeout );
        return $status;
    }


    /*
     * 清除所有缓存
     * @return [Boolean] 布尔值 true false
     * **/
    public function flushCache(){
       return $this->m->flush();
    }

    public function __destruct() {
        $this->m->close();
    }
}