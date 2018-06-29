<?php
header('Content-Type:text/html;Charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 11:12
 */
$file = './data.txt';
$mode = 'a';
$handle = fopen($file,$mode);
//尝试加锁
$lock_result = flock($handle,LOCK_EX | LOCK_NB);
if(!$lock_result){
    //锁定失败,不能操作
    tigger_error('不能锁定该文件，不能操作');
    die();
}else {

    $data = '12345678' . "\n";
    $result = fwrite($handle, $data);
    var_dump($result);
}