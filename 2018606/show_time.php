<?php
//�ȣ���ȡ���ݵ��߼�����Ȼ�ܼ򵥣���
$t = date("Y-m-d H:i:s");

//�����û��ĵ�ѡ��ȥȷ��Ҫʹ�õġ�ģ���ļ�����
if(!empty($_GET['ban'])){
    $ban = $_GET['ban'];
}
else{
    $ban = "red";
}
$file = "./show_time_" . $ban . ".html";

//������һ������̬��ҳ�������������������ʾ�����ݣ�
include $file;