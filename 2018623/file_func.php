<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 15:48
 */
$file = './data.txt';
//$data = date('H:i:s') . "\n";
//$result = file_put_contents($file,$data,FILE_APPEND);
//var_dump($result);



//$result2 = file_get_contents($file);
//echo nl2br($result2);
//$size = filesize($file);
//echo $size;

$time = filemtime($file);
var_dump($file);
echo date('H:i:s',$time);