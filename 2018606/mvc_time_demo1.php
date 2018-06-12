<meta http-equiv="content-type" content="text/html;charset=gb2312"/>
<?php
ini_set('date.timezone','Asia/Shanghai'); // 'Asia/Shanghai' 为上海时区
require 'MyDateTime.class.php';
//根据用户请求，以决定获取什么样的时间:
if(!empty($_GET['f']) && $_GET['f'] == "time"){
   // $t = date("H:i:s");
    $obj = new MyDateTime;
    $t = $obj->GetTime();
}else if(!empty($_GET['f']) && $_GET['f'] == "date"){
    //$t = date("Y年m月d日");
    $obj = new MyDateTime;
    $t = $obj->GetDate();
}else{
    //$t = date("Y年m月d日 H:i:s");
    $obj = new MyDateTime;
    $t = $obj->GetDateTime();
}
//表现（展示）该时间：
include './mvc_time_demo1.html';