<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:23
 */
//require_once 'MySQLDB.class.php';
function __autoload ($name){
    require_once ( './' . $name . ".class.php");
}
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
?>