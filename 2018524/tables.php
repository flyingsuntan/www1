<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 17:40
 */
$db_host = "127.0.0.1";
$db_user = "root";
$db_pwd = "";
$link = mysql_connect($db_host,$db_user,$db_pwd);
if(!empty($_GET['db'])){
    $db = $_GET['db'];
}
mysql_query("use $db");
$sql2 = "show tables";
$reslut = mysql_query($sql2);

while( $db_reslut = mysql_fetch_array($reslut)){
    echo "<br />" . $db_reslut[0];
    echo "<a href='tables.php?db={$db_reslut[0]}'>查看结构</a>";

}
?>