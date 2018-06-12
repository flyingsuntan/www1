<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:58
 */
include "./xuliehua2.class.php";
$obj1  = new Xuliehua2();
$obj1 -> p1 = 11;
$obj1 -> p2 = 22;
$obj1 -> p3 = 33;
echo "<pre />";
var_dump($obj1);
echo "<pre />";

//下面进行序列化操作：
$s1 = serialize($obj1);
file_put_contents('./obj1.txt',$s1);