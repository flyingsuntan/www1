<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 16:01
 */
//������ʾ�Զ�����Զ����غ�����ʹ�ã�
spl_autoload_register("aotuoload1");//������aotuoload1����Ϊ�Զ����غ���
spl_autoload_register("aotuoload2");//������aotuoload2����Ϊ�Զ����غ���
function aotuoload1($name){//����Զ����غ��������ڼ���classĿ¼�е����ļ�
    //echo "<br />׼����aotuoload1���������" .$name;
    $file = './class/' . $name . ".class.php";
    if(file_exists($file)){
        include_once $file;
    }
}
function aotuoload2($name){//����Զ����غ��������ڼ���libĿ¼�е����ļ�
    //echo "<br />׼����aotuoload2���������" .$name;
    $file = './lib/' . $name . ".class.php";
    if(file_exists($file)){
    include_once $file;
    }
}

$a1 = new A();//�������classĿ¼�£�
echo "<br />";
var_dump($a1);
$b1 = new B(); //�������lib Ŀ¼�£�
echo "<br />";
var_dump($b1);