<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 11:52
 */
$dsn = "mysql:host=127.0.0.1;port:3306;dbname=ceshi";
$user = 'root';
$pass = '';
$Option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$pdo = new PDO($dsn,$user,$pass,$Option);

$sql = "updateee tab_int set f1 = 1";
$result = $pdo->exec($sql);
if ($result === false){
    echo "<p>发生错误";
    echo "<br />错误代号：" .$pdo->errorCode();
    $e = $pdo->errorInfo(); //这是一个数组！第3项才是错误信息
    echo "<br />错误信息：" . $e['2'];
    echo "<br />错误语句：" . $sql;
    var_dump($e);
}
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
try{
    $sql1 = "deleteeee from user_list";
    $result1 = $pdo->exec($sql1);
    echo "执行成功";
}catch (PDOException $e){
    echo "<p>发生错误：";
    echo "<br />错误代号：" . $e->GetCode();
    echo "<br />错误信息：" . $e->GetMessage();
}