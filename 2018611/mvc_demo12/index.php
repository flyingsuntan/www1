<?php
$p = !empty($_GET['p']) ? $_GET['p'] : "front";  //确定使用哪个平台

define("PLAT",$p);

define("DS",DIRECTORY_SEPARATOR); //DIRECTORY_SEPARATOR表示“目录分隔符”，
                                  //只有2个：'/'unix系统，'\'（windows系统）

define("ROOT",dirname(__FILE__) . DS); //当前MVC框架的根目录


define("APP",ROOT . 'application' . DS );//application的完整路径

define("FRAMEWORK",ROOT . 'Framework' . DS); //框架基础类的完整路径


define("PLAT_PATH",APP . PLAT . DS);//平台所在目录

define("CTRL_PATH",PLAT_PATH . "Controllers" . DS); //当前控制器所在目录

define("MODEL_PATH",PLAT_PATH . "Models" . DS); //当前控制器所在目录

define("VIEW_PATH",PLAT_PATH . "Views" . DS); //当前控制器所在目录



$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //它也可能是“user“product”，或其他。。。
//这里把Product当作默认要使用的控制器
require FRAMEWORK . 'BaseModel.class.php';
require FRAMEWORK . 'ModelFactory.class.php' ;  //这个都一样，不动
require FRAMEWORK . 'BaseController.class.php';//这个都一样，不动

require MODEL_PATH . $c . "Model.class.php";

require CTRL_PATH . $c . "Controller.class.php";//这里才是需要载入的“当前控制器”

$controller_name = $c . "Controller";//构建控制器的类名

$ctr1 = new $controller_name; //可变类
$a = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $a ."Action";
$ctr1->$action();
