<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 12:33
 */
class Person{
    var $name ;
    var $age8;
    var $edu;
    function xiyifu($age,$edu,$name){
        echo "{$age}���{$edu}ѧ����{$name}���ڿ��ϴ�·�";
    }
    function zuofan($age,$edu,$name){
        echo "{$age}���{$edu}ѧ����{$name}�ڿ��ֵ�������";
    }
}
$obj1 = new Person();
$obj1->name = '����';
$obj1->age = 22;
$obj1->edu = '����';
$obj1->xiyifu($age,$edu,$name);
echo "<br .>";
$obj->zuofan($age,$edu,$name);