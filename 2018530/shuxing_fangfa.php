<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 12:18
 */



//ԭ����������������̣�
/*
$name = "С��";
$age = 18;
$edu = "��ѧ";
function xiyifu($n,$a,$e){
    echo "{$a}���{$e}ѧ����{$n}���ڿ��ϴ�·�";
}
function zuofan($n,$a,$e){
    echo "{$a}���{$e}ѧ����{$n}�ڿ��ֵ�������";
}
xiyifu($name,$age,$edu);
echo "<br .>";
zuofan($name,$age,$edu);
*/
//�������
class Person{
    var $name = "С��";
    var $age = 18;
    var $edu = "��ѧ";
    function xiyifu(){
        echo "{$this->age}���{$this->edu}ѧ����{$this->name}���ڿ��ϴ�·�";
    }
    function zuofan(){
        echo "{$this->age}���{$this->edu}ѧ����{$this->name}�ڿ��ֵ�������";
    }
    function getpingfanghe($x,$y){
        $reslut = $x*$x + $y*$y;
        return $reslut;

    }
}
$obj1 = new Person();
$obj1->xiyifu();
echo "<br .>";
$obj1->zuofan();
echo "<br .>";
$obj2 = new Person();
$obj2 -> name = 'С��';
$obj2 -> age = 19;
$obj2 -> edu = '����';
$obj2->xiyifu();
echo "<br .>";
$obj2->zuofan();


$v1 = $obj2->getpingfanghe(3,4);
echo "<br /><br /> v1 = $v1";
