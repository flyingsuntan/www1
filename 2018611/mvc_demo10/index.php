<?php
$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //��Ҳ�����ǡ�user��product����������������
//�����Product����Ĭ��Ҫʹ�õĿ�����
require 'Framework/BaseModel.class.php';
require 'Framework/ModelFactory.class.php' ;  //�����һ��������
require 'Framework/BaseController.class.php';//�����һ��������
require "Models/" . $c . "Model.class.php";

require "Controllers/" . $c . "Controller.class.php";//���������Ҫ����ġ���ǰ��������

$controller_name = $c . "Controller";//����������������

$ctr1 = new $controller_name; //�ɱ���
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act ."Action";
$ctr1->$action();
