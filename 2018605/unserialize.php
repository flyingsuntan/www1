<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 12:38
 */
$str1 = file_get_contents('./file1.txt');//将文件中的数据取出来
$str2 = file_get_contents('./file2.txt');
$str3 = file_get_contents('./file3.txt');
$str4 = file_get_contents('./file4.txt');
$s1 = unserialize($str1);
$s2 = unserialize($str2);
$s3 = unserialize($str3);
$s4 = unserialize($str4);
echo "<br />$s1";
echo "<br />$s2";
echo "<br />";
var_dump($s3);
echo "<br />";
var_dump($s4);