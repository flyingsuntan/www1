<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/3
 * Time: 12:49
 */
require 'MySQLDB.class.php';
$config = array(
    db_host => '127.0.0.1',
    db_port => '3306',
    db_user =>'root',
    db_pwd => '',
    bm => 'gb2312',
    databas => 'ceshi'
);
$db1 = MySQLDB::GetInstance($config);
//$db1 ->Bm(gb2312);
//$db1->closeDB();
$v1 = round(0,100);
$sql = "insert into join2 (c1,c2) values ($v1,$v1)";
$db1 -> exec($sql);
echo "<br />ִ�в������ɹ� ";

$sql = "select * from join2 where  id2 = 14";
$user = $db1->GetOneRow($sql);//���ﷵ�صľ���һ������
echo "<br />��һ����Ϊ��"  . $user['c1'];
echo "<br />�ڶ�����Ϊ��"  . $user['c2'];