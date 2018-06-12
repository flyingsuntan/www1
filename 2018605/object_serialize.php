<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:41
 */
include "./xuliehua.class.php";
$obj1  = new Xuliehua();
echo "<pre />";
var_dump($obj1);
echo "<pre />";

//下面进行序列化操作：
$s1 = serialize($obj1);
file_put_contents('./obj1.txt',$s1);