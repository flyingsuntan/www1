<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/6
 * Time: 12:42
 */
mysql_connect('127.0.0.1','root','');
if(mysql_query("use php39")){
    echo "成功";
}
if(mysql_query("set names utf8")){
    echo "成功";
}
$sql = "select * from p39_goods where id=6";
$data = mysql_query($sql);
$data1 =mysql_fetch_assoc($data);
var_dump($data1);