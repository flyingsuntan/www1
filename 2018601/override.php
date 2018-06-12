<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 12:23
 */
//动物类
class Animal{
    public $p1 = "进食";
    function Move(){
        echo "<br />能移动身体!";
    }
}
//鱼类
class Fish extends Animal{
    public $skin = "布满鱼鳞"; //皮肤
    public $p1 = "张开圆形的嘴巴吸入大量含食物的水";  //覆盖了父类的同名属性
    function Move(){
        echo "<br />摆动尾巴前进"; //覆盖了父类的同名方法！
    }
}
//鸟类
class Bird extends Animal{
    public $skin = "布满羽毛";
    public $p1 = "张开尖尖的嘴巴啄食物";//覆盖了父类的同名属性
    function Move(){
        echo "<br />煽动翅膀飞翔前进";//覆盖了父类的同名方法！
    }
}
$o1 = new Fish();
$o1->Move();
$o2 = new Bird();