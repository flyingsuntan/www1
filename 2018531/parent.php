<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 16:21
 */

//parent关键字演示
class A{
    static $p1 = 1;
    static protected $p2 = 2;
}
class B extends A{
    static function Show1(){
        echo "<p>这里是子类B中的方法";
        echo "<br />这里要显示父类的属性p1：" .self::$p1;
        echo "<br />这里要显示父类的属性p2：" .parent::$p2;
}
}
B::Show1();//静态方法，直接使用类名来调用
//下面演示使用parent代表“对象”的情况（调用实例属性或实例方法）：
class C {
    public $p1 = 1;
    function ShowInfo(){
        echo "<br />C中的属性p1:" .$this->p1;
        echo "<pre />";
        var_dump($this);
        echo "<pre />";
    }
}
class D extends C{
    function Show2(){
        echo "<p>调用父类中的实例方法:" ;
        parent::ShowInfo();
    }
}
$d1 = new D();
$d1->Show2();
?>