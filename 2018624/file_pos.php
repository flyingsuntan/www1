<?php
header('Content-Type:text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 10:32
 */
$file = './data.txt';
$mode = 'r';
$handle = fopen($file,$mode);
echo '位置：' . ftell($handle) . "<br />";
fseek($handle,5);
echo '位置：' . ftell($handle) . "<br />";
echo fgets($handle,3);