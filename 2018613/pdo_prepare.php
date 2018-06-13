<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 12:46
 */
$dsn = "mysql:host=127.0.0.1;port:3306;dbname=ceshi";
$user = 'root';
$pass = '';
$Option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$pdo = new PDO($dsn,$user,$pass,$Option);

$sql = "select * from yonghubiao where id = ? and username = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1,11);
$stmt->bindValue(2,'PHP');
$stmt->execute();
$arr = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($arr);



$sql = "select * from yonghubiao where id = :v1 and username = :v2";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":v1",11);
$stmt->bindValue(":v2",'PHP');
$stmt->execute();
$arr = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($arr);
echo phpinfo();