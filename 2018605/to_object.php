<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 10:58
 */
$arr = array(
    db_host => '127.0.0.1',
    db_port => '3306',
    db_user =>'root',
    db_pwd => '',
    bm => 'gb2312',
    databas => 'ceshi'
);
$obj1 = (object)$arr;
echo "<pre />";
var_dump($obj1);
echo "<pre />";
echo "<br />����ȡuser����:" . $obj1->db_user;


$arr2 = array('pp1'=>1,5=>15);
$obj2 = (object)$arr2;
echo "<pre />";
var_dump($obj2);
echo "<pre />";
echo "<br />����ȡpp1����:" . $obj2->pp1;
//echo "<br />����ȡ5����:" . $obj12->pp5;����



echo "<hr />";
$v1 = 1;    $objv1 = (object)$v1;
$v2 = 2.2;    $objv2 = (object)$v2;
$v3 = "abc";    $objv3 = (object)$v3;
$v4 = true;    $objv4 = (object)$v4;
echo "<pre />";
var_dump($objv1);
var_dump($objv2);
var_dump($objv3);
var_dump($objv4);
echo "<pre />";