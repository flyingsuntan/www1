<?php
$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //��Ҳ�����ǡ�user��product����������������
//�����Product����Ĭ��Ҫʹ�õĿ�����

require $c."Model.class.php";
require 'ModelFactory.class.php' ;  //�����һ��������
require 'BaseController.class.php';//�����һ��������
require $c . "Controller.class.php";//���������Ҫ����ġ���ǰ��������
$controller_name = $c . "Controller";//����������������

$ctr1 = new $controller_name; //�ɱ���
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act ."Action";
$ctr1->$action();
