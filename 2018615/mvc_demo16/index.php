<?php
$p = !empty($_GET['p']) ? $_GET['p'] : "front";  //ȷ��ʹ���ĸ�ƽ̨

define("PLAT",$p);

define("DS",DIRECTORY_SEPARATOR); //DIRECTORY_SEPARATOR��ʾ��Ŀ¼�ָ�������
                                  //ֻ��2����'/'unixϵͳ��'\'��windowsϵͳ��

define("ROOT",dirname(__FILE__) . DS); //��ǰMVC��ܵĸ�Ŀ¼


define("APP",ROOT . 'application' . DS );//application������·��

define("FRAMEWORK",ROOT . 'Framework' . DS); //��ܻ����������·��


define("PLAT_PATH",APP . PLAT . DS);//ƽ̨����Ŀ¼

define("CTRL_PATH",PLAT_PATH . "Controllers" . DS); //��ǰ����������Ŀ¼

define("MODEL_PATH",PLAT_PATH . "Models" . DS); //��ǰ����������Ŀ¼

define("VIEW_PATH",PLAT_PATH . "Views" . DS); //��ǰ����������Ŀ¼



$c = !empty($_GET['c']) ? $_GET['c'] : "Product";   //��Ҳ�����ǡ�user��product����������������
//�����Product����Ĭ��Ҫʹ�õĿ�����
function __autoload($class){
    $base_class = array('BaseModel','ModelFactory','BaseController','MySQLDB');
    if(in_array($class,$base_class)){
        require  FRAMEWORK .$class .'.class.php'; //���ػ���ģ����
    }else if(substr($class,-5) =="Model"){ //����Ҫ����������5���ַ��ǡ�Model��ʱ
        require MODEL_PATH . $class . ".class.php";
    }else if (substr($class,-10) == "Controller"){
        require CTRL_PATH . $class . ".class.php";
    }
}
//����5�д��룬�������Զ����غ��������棺
/*
require FRAMEWORK . 'BaseModel.class.php';
require FRAMEWORK . 'ModelFactory.class.php' ;  //�����һ��������
require FRAMEWORK . 'BaseController.class.php';//�����һ��������

require MODEL_PATH . $c . "Model.class.php";

require CTRL_PATH . $c . "Controller.class.php";//���������Ҫ����ġ���ǰ��������
*/

$controller_name = $c . "Controller";//����������������

$ctr1 = new $controller_name; //�ɱ���
$a = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $a ."Action";
$ctr1->$action();
