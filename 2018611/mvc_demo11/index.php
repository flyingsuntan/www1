<?php
$p = !empty($_GET['p']) ? $_GET['p'] : "front";  //ȷ��ʹ���ĸ�ƽ̨
$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //��Ҳ�����ǡ�user��product����������������
//�����Product����Ĭ��Ҫʹ�õĿ�����
require 'Framework/BaseModel.class.php';
require 'Framework/ModelFactory.class.php' ;  //�����һ��������
require 'Framework/BaseController.class.php';//�����һ��������
require "Application/$p/Models/" . $c . "Model.class.php";

require "Application/$p/Controllers/" . $c . "Controller.class.php";//���������Ҫ����ġ���ǰ��������

$controller_name = $c . "Controller";//����������������

$ctr1 = new $controller_name; //�ɱ���
$a = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $a ."Action";
$ctr1->$action();
