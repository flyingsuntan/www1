<?php
//header('Content-Type:text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 16:13
 */
$file = './data.txt';
$mode = 'r';
$handle = fopen($file,$mode);
////var_dump($handle);
//while(false !== ($result = fgetc($handle))){
//echo nl2br($result);
//}


//while(false !== ($str = Fgets($handle,30))){
//var_dump($str);
//}


//while(!feof($handle)){//没到达末尾
//    $line = fgets($handle,1024);
//    var_dump($line);
//}

$str = fread($handle,20);
var_dump($str);