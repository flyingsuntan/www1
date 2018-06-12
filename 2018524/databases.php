
<html><head><title></title></head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 17:35
 */
$db_host = "127.0.0.1";
$db_user = "root";
$db_pwd = "";
$link = mysql_connect($db_host,$db_user,$db_pwd);
mysql_query("set names gb2312");
$sql = "show databases";
$reslut = mysql_query($sql);
while( $rec = mysql_fetch_array($reslut)){
    echo "<br />" . $rec[0];
    echo "<a href='tables.php?db={$rec[0]}'>²é¿´±í</a>";
}
?>
</body>
</html>
