<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 12:18
 */



//原来的做法（面向过程）
/*
$name = "小花";
$age = 18;
$edu = "大学";
function xiyifu($n,$a,$e){
    echo "{$a}岁的{$e}学历的{$n}在勤快地洗衣服";
}
function zuofan($n,$a,$e){
    echo "{$a}岁的{$e}学历的{$n}在快乐地做饭服";
}
xiyifu($name,$age,$edu);
echo "<br .>";
zuofan($name,$age,$edu);
*/
//面向对象
class Person{
    var $name = "小花";
    var $age = 18;
    var $edu = "大学";
    function xiyifu(){
        echo "{$this->age}岁的{$this->edu}学历的{$this->name}在勤快地洗衣服";
    }
    function zuofan(){
        echo "{$this->age}岁的{$this->edu}学历的{$this->name}在快乐地做饭服";
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
$obj2 -> name = '小红';
$obj2 -> age = 19;
$obj2 -> edu = '高中';
$obj2->xiyifu();
echo "<br .>";
$obj2->zuofan();


$v1 = $obj2->getpingfanghe(3,4);
echo "<br /><br /> v1 = $v1";
