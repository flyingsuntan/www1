<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 15:20
 */
class A {
    public  $p1 = "A中属性";
    function f1(){
        echo "<br />A中方法";
    }
}
class B extends A{
    public $p2 = "这是B中属性";
}
$b1 = new B();
echo "<br />" .$b1->p1;
$b1->f1();