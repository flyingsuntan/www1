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
        echo "{$age}岁的{$edu}学历的{$name}在勤快地洗衣服";
    }
    function zuofan($age,$edu,$name){
        echo "{$age}岁的{$edu}学历的{$name}在快乐地做饭服";
    }
}
$obj1 = new Person();
$obj1->name = '李四';
$obj1->age = 22;
$obj1->edu = '高中';
$obj1->xiyifu($age,$edu,$name);
echo "<br .>";
$obj->zuofan($age,$edu,$name);