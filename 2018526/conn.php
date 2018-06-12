<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/26
 * Time: 18:31
 */


$db_host = "127.0.0.1";
$db_user = "root";
$db_pwd = "";
$db_select = "ceshi";

$link = mysql_connect($db_host,$db_user,$db_pwd);
mysql_query("set names gb2312");
mysql_query("use ceshi");

?>