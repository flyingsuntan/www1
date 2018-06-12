<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 11:41
 */
require_once '../2018603/MySQLDB.class.php';
$config = array(
    db_host => '127.0.0.1',
    db_port => '3306',
    db_user =>'root',
    db_pwd => '',
    bm => 'gb2312',
    databas => 'ceshi'
);
$db1 = MySQLDB::GetInstance($config);
var_dump($db1);
$db2 = clone $db1;
echo "<br />";
var_dump($db2);