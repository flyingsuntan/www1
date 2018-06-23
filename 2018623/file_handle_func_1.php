<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 17:09
 */
$file = './data.txt';
$mode = 'a';//w
$handle = fopen($file,$mode);
$data = date('Y-m-d H:i:s') . "\n";
$result = fwrite($handle,$data);
var_dump($result);

fclose($handle);