<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/21
 * Time: 11:47
 */
//echo "<pre />";
//var_dump($_FILES);
$tmp_file = $_FILES['goods_image']['tmp_name']; //临时文件地址
$dst_file = './upload.jpg'; //目标文件地址
$result= move_uploaded_file($tmp_file,$dst_file);
//var_dump($_POST);
//sleep(10); 