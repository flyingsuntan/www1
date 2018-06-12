<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 13:41
 */

/*


select * from students where college_id = (select college_id from college where college_name = '计算机系' );


start transaction;

*/
$link = mysql_connect("127.0.0.1","root","");
mysql_query("set names gb2312");
mysql_query("use ceshi");
$sql = "start transaction;";
mysql_query($sql);
$sql1 = "insert into tab_int(f1,f2,f3) values (15,25,35);";
$reslut1 = mysql_query($sql1);
$sql2 = "insert into tab_int(f1,f2,f3) values (166,266,366);";
$reslut2 = mysql_query($sql2);
if($reslut1 and $reslut2){
    mysql_query("commit");
    echo "执行成功";
}else{
    mysql_query("rollback");
    echo "执行失败";
}


?>