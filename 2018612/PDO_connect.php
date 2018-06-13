<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 20:44
 */

$dsn = "mysql:host=127.0.0.1;port:3306;dbname=ceshi";
$user = 'root';
$pass = '';
$Option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$pdo = new PDO($dsn,$user,$pass,$Option);



//$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
//$user = 'root';
//$password = 'dbpass';

//try {
//    $dbh = new PDO($dsn, $user, $password);
//} catch (PDOException $e) {
//    echo 'Connection failed: ' . $e->getMessage();
//}

var_dump($pdo);