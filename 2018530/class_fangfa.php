<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 17:19
 */
class C1{
    public $p1 = 1;
    static $p2 = 2;
    function ShowInfo1(){  //实例方法
        echo "<br />实例属性被调用！";
        echo "<br />p1的值为：" . $this->p1;
        //this代表一个对象，就是调用当前这个方法的对象
    }
    static function ShowInfo2(){ //静态方法
        echo "<br />静态属性被调用！";
        //echo "<br />p1的值为：" . $this->p1;这一行出错！
        echo "<br /> p2的值为：" .self::$p2;
        //self代表一个“类”,就是这个词（self）本身所在的这个类，这里就是C1
    }
}
$o1 = new C1;
$o1 -> ShowInfo1();//使用对象调用实例方法
C1::ShowInfo2();//使用类来调用静态方法