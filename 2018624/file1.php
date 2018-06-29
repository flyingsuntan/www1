<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 11:12
 */
$file = './data.txt';
$mode = 'r';
$handle = fopen($file,$mode);

//尝试加锁
$lock_result = flock($handle,LOCK_SH);

//判断锁定结果
if(!$lock_result){
    //锁定失败,不能操作
    tigger_error('不能锁定该文件，不能操作');
    die();
}else {
    //锁定成功
    $str = fgets($handle, 1024);
    var_dump($str);
    sleep(5);
    echo "<br />";
    $str = fgets($handle, 1024);
    var_dump($str);
}