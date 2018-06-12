<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 11:52
 */
//定义一个"人类"(Person类)
class Person{
    var $name;
    var $age;
    var $edu;
}
//创建一个新的Person类对象,并放入变量$obj1中（其实就是赋值）
$obj1 = new Person();
$obj1->name = '张三';  //符号“->”就是表示指代对象中的某个“特征”，这里就是给该特征赋值；
$obj1->age = 18;
$obj1->edu = '大学';
echo "<pre />";
var_dump($obj1);
echo "<pre />";
//又创建一个对象：
$obj2 = new Person();
$obj2->name = '李四';
$obj2->age = 22;
$obj2->edu = '高中';
echo "<pre />";
var_dump($obj2);
echo "<pre />";
