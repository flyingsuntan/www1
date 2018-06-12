<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:44
 */
include_once "./xuliehua.class.php";
$s1 = file_get_contents('./obj1.txt');
$o = unserialize($s1);
echo "<pre />";
var_dump($o);
echo "<pre />";
$o->f1();