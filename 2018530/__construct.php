<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 17:38
 */

class Person
{
    var $name ;
    var $age ;
    var $edu ;

    function xiyifu()
    {
        echo "<br />{$this->age}岁的{$this->edu}学历";
        echo "的{$this->name}在勤快地洗衣服";
    }
}
$girl1 = new Person();//创建一个对象
$girl1->name = "小花";//然后分别设置其属性
$girl1->age = 18;
$girl1->edu = "大学";
$girl1->xiyifu();

$girl2 = new Person();//再创建一个对象
$girl2->name = "小红";//然后分别设置其属性
$girl2->age = 19;
$girl2->edu = "高中";
$girl2->xiyifu();

//以上方式，new一个对象出来，然后做一番数据赋值（初始化），
//然后才能合适的去使用（调用）该方法以完成一定的任务；


echo "<br />";
class NvShen   //女神
{
    var $name ;
    var $age ;
    var $edu ;
    function __construct($p1,$p2,$p3)
    {
        $this->name = $p1;
        $this->age = $p2;
        $this->edu = $p3;
    }

    function xiyifu()
    {
        echo "<br />{$this->age}岁的{$this->edu}学历";
        echo "的{$this->name}在勤快地洗衣服";
    }
}
//new这个NvShen类，也就是创建这个女生对象的同时
//就会自动去调用该类中的构造方法：__construct（$p1,$p2,$p3）
//这里，new后面的类名括号中的就是对应实参；
$girl3 = new NvShen('小花',18,'大学');
$girl3->xiyifu();
$girl3 = new NvShen('小红',19,'高中');
$girl3->xiyifu();