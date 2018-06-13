<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>网页标题</title>
    <meta name="keywords" content="关键字列表" />
    <meta name="description" content="网页描述" />
    <link rel="stylesheet" type="text/css" href="" />
    <style type="text/css"></style>
    <script type="text/javascript"></script>
</head>
<body>
<?php
$dsn = "mysql:host=localhost; port=3306; dbname=ceshi";
$opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$pdo = new PDO($dsn, 'root', '', $opt);

$sql = "select * from product limit 0, 3";
$stmt = $pdo->query($sql);	//得到pdo的结果集
$arr1 = $stmt->fetch(PDO::FETCH_ASSOC);	//返回关联数组
$arr2 = $stmt->fetch(PDO::FETCH_NUM);	//返回索引数组
$arr3 = $stmt->fetch();	//相当于fetch(PDO::FETCH_BOTH)
echo "<br />"; print_r($arr1);
echo "<br />"; print_r($arr2);
echo "<br />"; print_r($arr3);
?>
</body>
</html>