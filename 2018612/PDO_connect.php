<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 20:44
 */
echo phpinfo();
$DSN = "mysql : host=127.0.0.1;port:3306;dbname=ceshi";
$Option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$pdo = new pdo($DSN,"root","",$Option);
var_dump($pdo);