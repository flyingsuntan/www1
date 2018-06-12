<?php
$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //它也可能是“user“product”，或其他。。。
//这里把Product当作默认要使用的控制器

require $c."Model.class.php";
require 'ModelFactory.class.php' ;  //这个都一样，不动
require 'BaseController.class.php';//这个都一样，不动
require $c . "Controller.class.php";//这里才是需要载入的“当前控制器”
$controller_name = $c . "Controller";//构建控制器的类名

$ctr1 = new $controller_name; //可变类
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act ."Action";
$ctr1->$action();
