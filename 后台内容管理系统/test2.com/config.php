<?php
/**
 * 程序配置文件
 */

define('PATH', dirname(__FILE__));
include(PATH.'/core/db.class.php');
//自定义query方法连接数据库
$db = new db();

include(PATH.'/core/input.class.php');
$input = new input();
?>