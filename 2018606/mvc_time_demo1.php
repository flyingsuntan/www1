<meta http-equiv="content-type" content="text/html;charset=gb2312"/>
<?php
ini_set('date.timezone','Asia/Shanghai'); // 'Asia/Shanghai' Ϊ�Ϻ�ʱ��
require 'MyDateTime.class.php';
//�����û������Ծ�����ȡʲô����ʱ��:
if(!empty($_GET['f']) && $_GET['f'] == "time"){
   // $t = date("H:i:s");
    $obj = new MyDateTime;
    $t = $obj->GetTime();
}else if(!empty($_GET['f']) && $_GET['f'] == "date"){
    //$t = date("Y��m��d��");
    $obj = new MyDateTime;
    $t = $obj->GetDate();
}else{
    //$t = date("Y��m��d�� H:i:s");
    $obj = new MyDateTime;
    $t = $obj->GetDateTime();
}
//���֣�չʾ����ʱ�䣺
include './mvc_time_demo1.html';